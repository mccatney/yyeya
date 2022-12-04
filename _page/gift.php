<div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><i class="fa fa-shopping-cart"></i>&nbsp;ของขวัญ</h5>
<hr>
    <?php
      if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
      {
        include_once '_page/alertLogin.php';
      }
      else
      {
        echo '<div class="row">';
          $sql_gift = 'SELECT * FROM gift WHERE uid_receive = "'.$_SESSION['uid'].'"';
          $query_gift = $connect->query($sql_gift);
          $num_receive = $query_gift->num_rows;

          if($num_receive > 0)
          {
            if(isset($_POST['btn_receive']))
            {
              $sql_receive = 'SELECT * FROM gift WHERE id = "'.$_POST['receive_id'].'"';
              $query_receive = $connect->query($sql_receive);

              if($query_receive->num_rows == 1)
              {
                $receive_f = $query_receive->fetch_assoc();
                if($receive_f['uid_receive'] == $_SESSION['uid'])
                {
                  $sql_rcon_server = 'SELECT * FROM bungeecord WHERE id = "'.$receive_f['server_id'].'"';
                  $query_rcon_server = $connect->query($sql_rcon_server);

                  if($query_rcon_server->num_rows > 0)
                  {
                    $rcon_server = $query_rcon_server->fetch_assoc();
                    $rcon_ip = $rcon_server['ip_server'];
                    $rcon_port = $rcon_server['port'];
                    $rcon_password = $rcon_server['password'];

                    require_once('_system/Rcon/_rcon.php');
                    $rcon = new Rcon($rcon_ip, $rcon_port, $rcon_password, '3');

                    if($rcon->connect())
                    {
                      $sql_delete = 'DELETE FROM gift WHERE id = "'.$receive_f['id'].'"';
                      $connect->query($sql_delete);

                      $command = str_replace("<player>", $player['username'], $receive_f['command']);
                      $exp = explode('[and]',$command);

                      foreach($exp as &$val)
                      {
                        $rcon->sendCommand($val); // ส่งคำสั่ง
                      }

                      $msg = 'รับ '.$receive_f['name'].' สำเร็จ !';
                      $alert = 'success';
                      $msg_alert = 'สำเร็จ!';
                    }
                    else
                    {
                      $msg = 'เกิดข้อผิดพลาด #Rcon Connect Error !';
                      $alert = 'error';
                      $msg_alert = 'เกิดข้อผิดพลาด!';
                    }
                  }
                  else
                  {
                    $msg = 'เกิดข้อผิดพลาด #ไม่พบ Server !';
                    $alert = 'error';
                    $msg_alert = 'เกิดข้อผิดพลาด!';
                  }
                }
              }
              else
              {
                $msg = 'เกิดข้อผิดพลาด #UID ไม่ตรงกัน !';
                $alert = 'error';
                $msg_alert = 'เกิดข้อผิดพลาด!';
              }
              ?>
                <script>
                  swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
                    button: "Reload",
                  })
                  .then((value) => {
                    window.location.href = window.location.href;
                  });
                </script>
              <?php
            }

            while($gift = $query_gift->fetch_assoc())
            {
              $sql_send = 'SELECT * FROM authme WHERE id = "'.$gift['uid_send'].'"';
              $query_send = $connect->query($sql_send);
              $user_send = $query_send->fetch_assoc();
              ?>
                <div class="col-md-4">
                  <img src="<?php echo $gift['img']; ?>" class="w-100" style="border-radius: 4px 4px 4px 4px;">
                </div>
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">
                      <?php echo $gift['name']; ?>
                    </h3>
                    <div class="mb-1 text-muted">
                      #ส่งมาจาก: <?php echo $user_send['realname']; ?>  
                    </div>
                    <form name="receive" method="POST">
                      <input name="receive_id" type="hidden" value="<?php echo $gift['id']; ?>"/>
                      <button type="submit" name="btn_receive" class="btn btn-primary btn-block mt-3">
                        <i class="fa fa-shopping-cart"></i> รับ <?php echo $gift['name']; ?>
                      </button>
                    </form>
                </div>
                <div class="col-md-12">
                  <span class="is-divider" data-content="# <?php echo $gift['date']; ?> #" style="margin: 1.5rem 0;"></span>
                </div>
              <?php
            }
          }
          else
          {
            echo "<h5 class='col-md-12 text-center'><div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> ไม่มีของขวัญ</div></h5>";
          }
        echo "</div>";
      }
    ?>
</div>
</div>