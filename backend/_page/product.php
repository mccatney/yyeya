  <?php
    if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
    {
      $product_id = $_GET['id'];
      $sql_f_edit_product = 'SELECT * FROM shop WHERE id = "'.$product_id.'"';
      $query_f_edit_product = $connect->query($sql_f_edit_product);

      if($query_f_edit_product->num_rows != 0)
      {
        $product_f = $query_f_edit_product->fetch_assoc();

        if(isset($_POST['btn_edit_product']))
        {
          $bungee_edit = $_POST['edit_product_bungee'];
          $sql_edit_product = 'UPDATE shop SET name = "'.$_POST['product_name'].'", price = "'.$_POST['product_price'].'", category = "'.$_POST['product_category'].'", command = "'.$_POST['product_command'].'", pic = "'.$_POST['product_pic'].'", server_id = "'.$bungee_edit.'"';
          $sql_edit_product .= ' WHERE id = "'.$product_f['id'].'"';
          $query_edit_product = $connect->query($sql_edit_product);
          if($query_edit_product)
          {
            $msg = 'แก้ไข #'.$product_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไข #'.$product_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการแก้ไข #'.$product_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการแก้ไข #'.$product_f['id'].'</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
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
        if(isset($_POST['btn_rm_product']))
        {
          $sql_rm_product = 'DELETE FROM shop';
          $sql_rm_product .= ' WHERE id = "'.$product_f['id'].'"';
          $query_rm_product = $connect->query($sql_rm_product);
          if($query_rm_product)
          {
            $msg = 'ลบ #'.$product_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ลบ #'.$product_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการลบ #'.$product_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการลบ #'.$product_f['id'].'</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
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
        ?>
          <h4 class="mb-3 text-center">จัดการสินค้า <div class='text-muted'>#<?php echo $product_f['id']; ?></div></h4>
          <form name="edit_product" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                      <label for="product_name">ชื่อไอเทม</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product_f['name']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_price">ราคา</label>
                      <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo $product_f['price']; ?>">
                  </div>
                  <div class="col-md-4 mb-3">
                      <label for="product_category">หมวดหมู่</label>
                      <select name="product_category" class="form-control">
                        <option value="<?php echo $product_f['category']; ?>">หมวดหมู่ปัจจุบัน: <?php echo $product_f['category']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM category";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label for="edit_product_bungee">Server</label>
                      <select name="edit_product_bungee" class="form-control">
                        <option value="<?php echo $product_f['server_id']; ?>">Server ปัจจุบัน: <?php echo $product_f['server_id']; ?></option>
                          <?php
                            $sql_bungeecord = "SELECT * FROM bungeecord";
                            $query_bungeecord = $connect->query($sql_bungeecord);
                            while($result_bungee = $query_bungeecord->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result_bungee["id"];?>"><?php echo $result_bungee["id"]." - ".$result_bungee["name_server"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label for="product_command">คำสั่ง</label>
                      <input type="text" class="form-control" id="product_command" name="product_command" value="<?php echo $product_f['command']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_pic">รูปภาพ</label>
                      <input type="text" class="form-control" id="product_pic" name="product_pic" value="<?php echo $product_f['pic']; ?>">
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_edit_product" class="btn btn-primary btn-block">
                      แก้ไข #<?php echo $product_f['id']; ?>
                    </button>
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_rm_product" class="btn btn-primary btn-block">
                      ลบ #<?php echo $product_f['id']; ?>
                    </button>
                  </div>
              </div>
          </form>
        <?php
      }
    }
    elseif(isset($_GET['action']) && $_GET['action'] != NULL && $_GET['action'] != "" && $_GET['action'] == 'add')
    {
      if(isset($_POST['btn_add_product']))
      {
        $bungee_add = $_POST['product_bungeecord'];
        $sql_add_product = 'INSERT INTO shop (name,price,category,command,pic,server_id) VALUES ("'.$_POST['product_name'].'","'.$_POST['product_price'].'","'.$_POST['product_category'].'","'.$_POST['product_command'].'","'.$_POST['product_pic'].'","'.$bungee_add.'")';
        $query_add_product = $connect->query($sql_add_product);

        if($query_add_product)
        {
          $msg = 'เพิ่มสินค้าใหม่เรียบร้อยแล้ว';
          $alert = 'success';
          $msg_alert = 'สำเร็จ!';
          //* ประกาศ
          echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เพิ่มสินค้าใหม่เรียบร้อยแล้ว</strong></div>';

          //* REFRESH
          echo "<meta http-equiv='refresh' content='5 ;'>";
        }
        else
        {
          $msg = 'เกิดข้อผิดพลาดในการเพิ่มสินค้า';
          $alert = 'error';
          $msg_alert = 'เกิดข้อผิดพลาด!';
          //* ประกาศ
          echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการเพิ่มสินค้า</strong></div>';

          //* REFRESH
          echo "<meta http-equiv='refresh' content='5 ;'>";
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
      ?>
        <h4 class="mb-3 text-center">เพิ่มสินค้า</h4>
        <form name="add_product" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                      <label for="product_name">ชื่อไอเทม</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_price">ราคา</label>
                      <input type="text" class="form-control" id="product_price" name="product_price" required="">
                  </div>
                  <div class="col-md-4 mb-3">
                      <label for="product_category">หมวดหมู่</label>
                      <select name="product_category" class="form-control" required="">
                          <?php
                            $sql_category = "SELECT * FROM category";
                            $query_category = $connect->query($sql_category);
                            if($query_category->num_rows != 0)
                            {
                              while($result = $query_category->fetch_assoc())
                              {
                                  ?>
                                    <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                  <?php
                              }
                            }
                            else
                            {
                              ?>
                                <option value="0">ไม่มีหมวดหมู่ กรุณาเพิ่มหมวดหมู่ก่อน</option>
                              <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label for="product_bungeecord">Server</label>
                      <select name="product_bungeecord" class="form-control" required="">
                          <?php
                            $sql_bungeecord = "SELECT * FROM bungeecord";
                            $query_bungeecord = $connect->query($sql_bungeecord);
                            if($query_bungeecord->num_rows != 0)
                            {
                              while($result_bungee = $query_bungeecord->fetch_assoc())
                              {
                                  ?>
                                    <option value="<?php echo $result_bungee["id"];?>"><?php echo $result_bungee["id"]." - ".$result_bungee["name_server"];?></option>
                                  <?php
                              }
                            }
                            else
                            {
                              ?>
                                <option value="0">ไม่มี Server กรุณาเพิ่ม Server ก่อน</option>
                              <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label for="product_command">คำสั่ง</label>
                      <input type="text" class="form-control" id="product_command" name="product_command" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_pic">รูปภาพ</label>
                      <input type="text" class="form-control" id="product_pic" name="product_pic" required="">
                  </div>
                  <div class="col-md-6 my-4">
                    <button type="submit" name="btn_add_product" class="btn btn-primary btn-block">
                      เพิ่ม
                    </button>
                  </div>
              </div>
          </form>
      <?php
    }
    else
    {
      $sql_product = 'SELECT * FROM shop';

      if(isset($_GET['category']) && is_numeric($_GET['category']))
      {
        $sql_product .= ' WHERE category = "'.$_GET['category'].'"';
      }

      $sql_product .= ' ORDER BY id DESC';

      $query_product = $connect->query($sql_product);

      if($query_product->num_rows <= 0)
      {
        echo "<h5 class='col-md-12 text-center'>ไม่พบสินค้า</h5>";
      }
      else
      {
        echo '<div class="row">';
        while($product = $query_product->fetch_assoc())
        {
          ?>
        <div class="col-md-4">
            <div class="item" style="margin-bottom: 20px;">
              <div class="item-image">
              <a class="item-image-price"><?php echo number_format($product['price'], 2); ?> บาท</a>
              <center><img src="<?php echo $product['pic']; ?>"></center>
              <a class="item-image-bottom"><?php echo $product['name']; ?></a>
            </div>
              <div class="item-info">
                <div class="item-text">
                  <a style="font-size: 18px;"><?php echo $product['name']; ?></a><br>ราคา : <?php echo number_format($product['price'], 2); ?> พ้อยท์<br><br>
                  <a href="?page=backend&menu=manageproduct&id=<?php echo $product['id']; ?>" class="btn btn-primary w-100 mb-1 border-0">แก้ไข</a>
                </div>
              </div>
            </div>
              </div> 
          <?php
        }
        echo "</div>";
      }
    }
?>