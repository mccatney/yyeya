<?php
                if(isset($_GET['code']))
			{
				$sql_delete = 'DELETE FROM redeem WHERE id = "'.$_GET['code'].'"';
				$query_delete = $connect->query($sql_delete);

				if($query_delete)
				{
                                        $msg = 'ลบ CODE : '.$_GET['id'].' เรียบร้อยแล้ว';
                                        $alert = 'success';
                                        $msg_alert = 'สำเร็จ!';
                                        //* REFRESH
                                        echo '<meta http-equiv="refresh" content="1;url=?page=backend&menu=redeem">';
				}
				else
				{
                                    $msg = 'ไม่สามารถลบ CODE : '.$_GET['id'].' ได้ในขณะนี้';
                                        $alert = 'error';
                                        $msg_alert = 'ผิดพลาด!';
                                        //* REFRESH
                                        echo '<meta http-equiv="refresh" content="1;url=?page=backend&menu=redeem">';
				}	?>
                               <script>
                                                            swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
                                                                    button: "Reload",
                                                            })
                                                            .then((value) => {
                                                                    window.location.href = window.location.href;
                                                            });
                                                    </script>
                               <?php }
		if(isset($_POST['redeem_submit']))
		{
                        $time_date = date("Y-m-d H:i");
                        $redeem_code = $connect->real_escape_string($_POST['code']);
                        $check = $connect->query("SELECT * FROM redeem WHERE code = '".$redeem_code."'");
			$numrow = $check->num_rows;
			if($numrow > 0){
                            $msg = 'Code นี้มีการเพิ่มไปแล้ว';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
                        }else{
                        $sql_edit_tmtopup = 'INSERT INTO redeem (code,cmd,status,date) VALUES ("'.$_POST['code'].'","'.$_POST['cmd'].'","1","'.$time_date.'")';
			$query_edit_tmtopup = $connect->query($sql_edit_tmtopup);
                        if($query_edit_tmtopup)
			{
				$msg = 'เพิ่ม Code เรียบร้อย';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
			}
			else
			{
				$msg = 'เพิ่ม Code ไม่สำเร็จ';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
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
                                <div class="row">
				<div class="col-md-12">
				</div>
			</div>
                                <div class="alert alert-danger">หากปล่อยช่อง Code ว่าง ระบบจะทำการ ใส่ให้เองเป็น @amc</div>
			<form name="redeem_submit" method="POST">
				<div class="row">
					<div class="col-md-12 mb-3">
			            <label for="code">Code</label>
                                    <input type="text" class="form-control" id="code" name="code" required="">
			        </div>
			        <div class="col-md-12 mb-3">
			            <label for="cmd">จำนวนเงิน ที่ต้องการ</label>
                                    <input type="text" class="form-control" id="cmd" name="cmd" required="">
                                    </div>
			        <div class="col-md-12 mb-3">
			        	<button name="redeem_submit" type="submit" class="btn btn-primary btn-block">
			        		เพิ่ม Code
			        	</button>
			        </div>
			    </div>
			</form>
                                                 <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-code"></i>  Code ทั้งหมดที่มี ( <?php echo $redeem_row; ?> ) Code</h5>
                            <br>
                            			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-dark">#</th>
						<th style="background-color: #FFF;" class="text-center text-dark">Code</th>
						<th style="background-color: #FFF;" class="text-center text-dark">จำนวนเงิน</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_list_redeem = 'SELECT * FROM redeem ORDER BY id ASC';
						$query_list_redeem = $connect->query($sql_list_redeem);
						$i = 0;
						if($query_list_redeem->num_rows != 0)
						{
							while($list_redeem = $query_list_redeem->fetch_assoc())
							{
								$i++;
								echo '
									<tr>
										<td class="text-left">'.$list_redeem['id'].'</td>
										<td class="text-center"><a href="?page=backend&menu=redeem&code='.$list_redeem['id'].'">'.$list_redeem['code'].'</a></td>
										<td class="text-center">'.$list_redeem['cmd'].'</td>
										<td class="text-center">'.$list_redeem['date'].'</td>
									</tr>
								';
							}
						}
						else
						{
							?>
								<tr>
									<td class="text-center" colspan="6">
										ไม่พบข้อมูล
									</td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
                        </div>
                    </div>