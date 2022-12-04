<?php
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$sql_buy = 'SELECT * FROM shop WHERE id = "'.$_GET['id'].'"';
	}
	else
	{
		$sql_buy = 'SELECT * FROM shop WHERE id = "0"';
	}

	$query_buy = $connect->query($sql_buy);
?>
    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-shopping-cart"></i> ยืนยันการซื้อ</h5>
                            <hr>
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    echo '<div class="col-md-12 mb-1">
                            <div class="alert alert-danger">
				<i class="fa fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนซื้อสินค้า !
			</div>
                    </div>';
		}
		else
		{
			?>
				<div class="row">
					<?php
						if($query_buy->num_rows <= 0)
						{
							?>
								<div class="col-md-12">
                                                                    <h5 class="col-md-12 text-center"><div class="alert alert-danger">ไม่พบสินค้านี้</div></h5>
								</div>
							<?php
						}
						else
						{
							$buy = $query_buy->fetch_assoc();
							$sql_category = 'SELECT * FROM category WHERE id = "'.$buy['category'].'"';
							$query_category = $connect->query($sql_category);
							$category_f = $query_category->fetch_assoc();

							// START BUY
							if(isset($_POST['btn_buy']))
							{
								$msg = '';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
								?>
									<div class="col-md-12 mb-3">
										<?php
											if($player['points'] < $buy['price'])
											{
												$msg = 'พ้อยท์คุณไม่เพียงพอ กรุณาเติมเงินค่ะ !';
												$alert = 'error';
												$msg_alert = 'เกิดข้อผิดพลาด!';
											}
											else
											{
												$sql_rcon_server = 'SELECT * FROM bungeecord WHERE id = "'.$buy['server_id'].'"';
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
														$sql_rem_points = 'UPDATE authme SET points = points-"'.$buy['price'].'" WHERE id = "'.$_SESSION['uid'].'"';
														$query_rem_points = $connect->query($sql_rem_points);

														if($query_rem_points)
														{
															$activities_action = "Buy Item #".$buy['id'];
															$time_date = date("Y-m-d H:i");
															$sql_insert_log = 'INSERT INTO activities (uid,username,action,date,transaction) VALUES ("'.$_SESSION['uid'].'","'.$_SESSION['username'].'","'.$activities_action.'","'.$time_date.'","'.$buy['id'].'")';
															$connect->query($sql_insert_log);
                                                                                                                        $rcon->sendCommand("m ".$_SESSION['username']." คุณได้ทำการสั่งซื้อ ".$buy['name']." ในราคา ".$buy['price']." บาท");
															$command = str_replace("<player>", $player['username'], $buy['command']);
						                                    $exp = explode('<and>',$command);

						                                    foreach($exp as &$val)
						                                    {
						                                        $rcon->sendCommand($val); // ส่งคำสั่ง
						                                    }

						                                    $msg = 'ซื้อ '.$buy['name'].' สำเร็จ !';
															$alert = 'success';
															$msg_alert = 'สำเร็จ!';
														}
														else
														{
															$msg = 'เกิดข้อผิดพลาด #ไม่สามารถอัพเดทพ้อยท์ล่าสุดได้ !';
															$alert = 'error';
															$msg_alert = 'เกิดข้อผิดพลาด!';
														}
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
													$msg = 'ไม่พบ Server กรุณาแจ้งแอดมิน !';
													$alert = 'error';
													$msg_alert = 'เกิดข้อผิดพลาด!';
												}
											}
										?>
									</div>

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
							else
							{
								if(!isset($_POST['btn_gift']))
								{
									if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
									{
										?>
											<div class="col-md-12 mb-1">
												<div class="alert alert-info">
													<i class="fa fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนซื้อสินค้า !
												</div>
											</div>
										<?php
									}
									else
									{
										?>
											<div class="col-md-12 mb-1">
												<div class="alert alert-info">
													<i class="fa fa-exclamation-triangle"></i> กรุณาออนไลน์ในเกมก่อนซื้อสินค้า !
												</div>
											</div>
										<?php
									}
								}
							}
							// END BUY

							// START GIFT
							if(isset($_POST['btn_gift']))
							{
								?>
									<div class="col-md-12 mb-3">
										<?php
											if($player['points'] < $buy['price'])
											{
												$msg = 'พ้อยท์คุณไม่เพียงพอ กรุณาเติมเงินค่ะ !';
												$alert = 'error';
												$msg_alert = 'เกิดข้อผิดพลาด!';
											}
											else
											{
												$username_receive = $connect->real_escape_string($_POST['gift_username']);
												$sql_receive = 'SELECT * FROM authme WHERE username = "'.$username_receive.'"';
												$query_receive = $connect->query($sql_receive);
												if($query_receive->num_rows != 0)
												{
													$receive_f = $query_receive->fetch_assoc();
													$receive_uid = $receive_f['id'];
													$receive_username = $receive_f['username'];
													$receive_realname = $receive_f['realname'];

													$sql_rem_points = 'UPDATE authme SET points = points-"'.$buy['price'].'" WHERE id = "'.$_SESSION['uid'].'"';
													$query_rem_points = $connect->query($sql_rem_points);

													if($query_rem_points)
													{
														$time_date = date("Y-m-d H:i");
														$sql_send_gift = 'INSERT INTO gift (uid_send,uid_receive,date,img,command,name,server_id) VALUES ("'.$_SESSION['uid'].'","'.$receive_uid.'","'.$time_date.'","'.$buy['pic'].'","'.$buy['command'].'","'.$buy['name'].'","'.$buy['server_id'].'")';
														$query_send_gift = $connect->query($sql_send_gift);

														if($query_send_gift)
														{
															$msg = 'ส่ง '.$buy['name'].' ให้ '.$receive_realname.' เรียบร้อยแล้ว !';
															$alert = 'success';
															$msg_alert = 'สำเร็จ!';
															?>
																<div class="col-md-12 mb-1">
																	<div class="alert alert-info">
																		<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ส่ง <?php echo $buy['name']." ให้ ".$receive_realname." เรียบร้อยแล้ว"; ?> !
																	</div>
																</div>
															<?php

															//* REFRESH
															echo "<meta http-equiv='refresh' content='5 ;'>";
														}
														else
														{
															$msg = 'เกิดข้อผิดพลาด #ไม่สามารถส่ง '.$buy['name'].' ให้ '.$receive_realname.' ได้ในขณะนี้';
															$alert = 'error';
															$msg_alert = 'เกิดข้อผิดพลาด!';
														}
													}
													else
													{
														$msg = 'เกิดข้อผิดพลาด #ไม่สามารถอัพเดทพ้อยท์ล่าสุดได้ !';
														$alert = 'error';
														$msg_alert = 'เกิดข้อผิดพลาด!';
													}
												}
												else
												{
													$msg = 'เกิดข้อผิดพลาด #ไม่พบผู้เล่น '.$username_receive.' คนนี้ !';
													$alert = 'error';
													$msg_alert = 'เกิดข้อผิดพลาด!';
												}
											}								
										?>
									</div>

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
							else
							{
								if(!isset($_POST['btn_buy']))
								{
									if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
									{
										?>
											<div class="col-md-12 mb-1">
												<div class="alert alert-info">
													<i class="fas fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนซื้อสินค้า !
												</div>
											</div>
										<?php
									}
								}
							}
							// END GIFT
							?>
							<div class="col-md-4">
								<img src="<?php echo $buy['pic']; ?>" class="w-100" style="border-radius: 4px 4px 4px 4px;">
							</div>
							<div class="col p-4 d-flex flex-column position-static">
					          	<strong class="d-inline-block mb-0 text-success">
					          		<?php echo $category_f['name']; ?>
					          	</strong>
					          	<h3 class="mb-0">
					          		<?php echo $buy['name']; ?> <small>ราคา <?php echo number_format($buy['price'],2); ?> พ้อยท์</small>
					          	</h3>
					          	<div class="mb-1 text-muted">
					          		#รหัสสินค้า: <?php echo $buy['id']; ?>
					          	</div>
					          	<form name="buy" method="POST">
					          		<input type="hidden" value="<?php echo $buy['id']; ?>"/>
						          	<button type="submit" name="btn_buy" class="btn btn-primary btn-block mt-3">
						          		<i class="fa fa-shopping-cart"></i> ซื้อ <?php echo $buy['name']; ?>
						          	</button>
                                                                
					          	</form>
					          		<hr class="is-divider" data-content="หรือส่งให้เพื่อน" style="margin: 1.5rem 0;">
						          	<form name="buy" method="POST">
                                                                <div class="row">
						          		<div class="col-md-8">
                                                                            <input name="gift_username" class="form-control mb-1" type="text" placeholder="ชื่อตัวละครของคนที่จะส่งให้" required=""/>
							          	</div>
							          	<div class="col-md-4">
							          		<button type="submit" name="btn_gift" class="btn btn-primary btn-block">
							          			<i class="fa fa-gift"></i> ส่ง
							          		</button>
							          	</div>
						          	</div>
                                                                </form>
					        </div>
							<?php
						}
					?>
				</div>
			<?php
		}
	?>
</div>
</div>