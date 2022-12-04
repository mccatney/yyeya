  <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <iframe iframe height="315" style="width:100%;" src='https://www.youtube.com/embed/<?php echo $setting['youtube_watch']; ?> 'frameborder="0" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>

<?php
	use Maythiwat\WalletAPI;
    require_once(__DIR__ . '/../_system/func_wallet/_truewallet.php');
    require_once '_system/func_wallet/_loginTW.php';

    $sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
    $query_wallet = $connect->query($sql_wallet);

    if($query_wallet->num_rows == 1)
    {
    	$f_wallet = $query_wallet->fetch_assoc();
    	$wallet_email = $f_wallet['email'];
    	$wallet_password = $f_wallet['password'];
    	$wallet_phone = $f_wallet['phone'];
    	$wallet_name = $f_wallet['name'];
    	$wallet_message = $f_wallet['message'];
    	$wallet_reference_token = $f_wallet['reference_token'];
    }

    /* ห้ามแก้ไข */
	$config_tw = array(
		'email' => $wallet_email,
		'password' => $wallet_password,
		'referen_token' => $wallet_reference_token
	);
	/* จบการห้าม */

    function curl($url) {
		global $config_tw;
		$ch = curl_init();  
		$post = [
			'email' => $config_tw['email'],
			'password' => $config_tw['password'],
			'referen_token' => $config_tw['referen_token']
		];
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$data = curl_exec($ch);     
		curl_close($ch);    
		return $data; 
	}
?>
<script type="text/javascript">
	function NumbersOnly(e){
	    var keynum;
	    var keychar;
	    var numcheck;
	    if(window.event) {// IE
	        keynum = e.keyCode;
	    } else if(e.which) {// Netscape/Firefox/Opera
	        keynum = e.which;
	    }
	    if(keynum == 13 || keynum == 8 || typeof(keynum) == "undefined"){
	        return true;
	    }
	    keychar= String.fromCharCode(keynum);
	    numcheck = /^[0-9]$/;  // อยากจะพิมพ์อะไรได้มั่ง เติม regular expression ได้ที่ line นี้เลยคับ
	    return numcheck.test(keychar);
	}
</script>
<div class="card  border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-credit-card"></i> การเติมเงิน</h5>
                            <hr>
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    include_once '_page/alertLogin.php';
		}
		else
		{
			?>
				<div class="row">
					<?php
						if(!isset($_POST['btn_wallet']) && !isset($_POST['btn_truemoney']))
						{
							?>
								<div class="col-md-12 mb-1">
									<div class="alert alert-info text-center">
										<i class="fa fa-exclamation-triangle text-dark"></i>
										โอนเงินผ่าน Wallet ได้ที่เบอร์ <strong><?php echo $wallet_phone; ?></strong>
										<br/>
										ชื่อบัญชี: <?php echo $wallet_name; ?>
										<br/>
										<?php
											if($wallet_message != '0')
											{
												?>
													ตอนโอนให้พิมพ์ข้อความว่า: <strong><?php echo $wallet_message; ?></strong>
												<?php
											}
										?>
									</div>
								</div>
							<?php
						}

						if(isset($_POST['btn_wallet']))
						{
							/* ห้ามแก้ไข หากไม่รู้ */
							$url_truewallet = "".$setting['www']."_system/api/truewallet.php?transaction=";
							/* จบการห้ามแก้ไข */

							/* GET TRANSACTION */
							if(empty($_POST['wallet_transaction']))
							{
								$msg = 'กรุณาอย่าเว้นว่างช่องหมายเลขอ้างอิง';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
							}
							else
							{
								$tw = json_decode(curl($url_truewallet.$_POST['wallet_transaction']));
								if($tw->code == 100)
								{
									$fti_u = $tw->transaction; // หมายเลขอ้างอิง
									$ftam_u = $tw->amount; // จำนวนเงิน
									$ftm_u = $tw->message_transfer; // ข้อความ
									$ftphone_u = $tw->phone; // เบอร์ที่โอนมา
									$fttime_u = $tw->time; // วันที่และเวลาที่ทำรายการ

									$sql_check_reportid = 'SELECT * FROM activities WHERE transaction = "'.$fti_u.'" LIMIT 1';
									$query_check_reportid = $connect->query($sql_check_reportid);
									$numrows_check_reportid = $query_check_reportid->num_rows;

									if($numrows_check_reportid != 0)
									{
										$msg = 'หมายเลขอ้างอิงนี้มีการเติมเข้ามาแล้ว';
										$alert = 'error';
										$msg_alert = 'เกิดข้อผิดพลาด!';

										//* ประกาศ
										echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>หมายเลขอ้างอิงนี้มีการเติมเข้ามาแล้ว</strong></div></div>';

										//* REFRESH
										echo "<meta http-equiv='refresh' content='3 ;'>";
									}
									else
									{
										$activities_action = "TOPUP Truewallet";
					            		$time_date = date("Y-m-d H:i");
					            		$sql_insert_log = 'INSERT INTO activities (uid,username,action,date,topup_amount,transaction) VALUES("'.$_SESSION['uid'].'","'.$_SESSION['username'].'","'.$activities_action.'","'.$time_date.'","'.$ftam_u.'","'.$fti_u.'")';
					            		$query_insert_log = $connect->query($sql_insert_log);
					            		if($query_insert_log)
					            		{	
					            			$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
												$query_wallet = $connect->query($sql_wallet);
												$wallet = $query_wallet->fetch_assoc();

												if($wallet['message'] == '0')
												{
													$mutiple_amount = $ftam_u * $wallet['mutiple'];

													$query_list_rp = $connect->query($sql_list_rp);
													if($query_list_rp->num_rows != 0)
													{
														$list_rp = $query_list_rp->fetch_assoc();
														$rp_update = $list_rp['rp'];
													}
													else
													{
														$rp_update = 0;
													}
                                                                                                        /// ทดสอบการ UPDATE //
                                                                                                        //$sql_updatep_r = 'UPDATE test SET name = name+"'.$mutiple_amount.'", pass = pass+"'.$ftam_u.'"';
                                                                                                        //$connect->query($sql_updatep_r);
                                                                                                        ////// จบการทดสอบ //
                                                                                                $sql_updatep = 'UPDATE authme SET points = points+"'.$mutiple_amount.'", topup = topup+"'.$ftam_u.'", rp = rp+"'.$ftam_u.'" WHERE id = "'.$_SESSION['uid'].'"';
											    	$connect->query($sql_updatep);

											    	$msg = 'คุณได้ทำการเติมเงินด้วยการโอน Truewallet จำนวน '.$ftam_u.' บาท';
													$alert = 'success';
													$msg_alert = 'สำเร็จ!';
												}
												else
												{
													if($ftm_u == $wallet['message'])
													{
														$mutiple_amount = $ftam_u * $wallet['mutiple'];

														$query_list_rp = $connect->query($sql_list_rp);
														if($query_list_rp->num_rows != 0)
														{
															$list_rp = $query_list_rp->fetch_assoc();
															$rp_update = $list_rp['rp'];
														}
														else
														{
															$rp_update = 0;
														}

								            			$sql_updatep = 'UPDATE authme SET points = points+"'.$mutiple_amount.'", topup = topup+"'.$ftam_u.'", rp = rp+"'.$ftam_u.'" WHERE id = "'.$_SESSION['uid'].'"';
											    	$connect->query($sql_updatep);

												    	$msg = 'คุณได้ทำการเติมเงินด้วยการโอน Truewallet จำนวน '.$ftam_u.' บาท';
														$alert = 'success';
														$msg_alert = 'สำเร็จ!';
													}
													else
													{
														$sql_delete_transaction = 'DELETE FROM activities WHERE transaction = "'.$fti_u.'"';
														$connect->query($sql_delete_transaction);
														
														$msg = 'เกิดข้อผิดพลาด ข้อความไม่ตรงกับระบบ<br/>กรุณากรอกข้อความตอนโอนว่า '.$wallet['message'];
														$alert = 'error';
														$msg_alert = 'เกิดข้อผิดพลาด!';
													}
												}
					            		}
					            		else
					            		{
					            			$msg = 'กรุณาลองใหม่ภายหลัง';
											$alert = 'error';
											$msg_alert = 'เกิดข้อผิดพลาด!';

					            			//* ประกาศ
											echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาด กรุณาลองใหม่ภายหลัง</strong></div></div>';
											//* REFRESH
											echo "<meta http-equiv='refresh' content='3 ;'>";
					            		}
									}
								}
								elseif($tw->code == '404(3)')
								{
									$msg = 'เกิดข้อผิดพลาด หรือ ไม่พบหมายเลขอ้างอิงนี้';
									$alert = 'error';
									$msg_alert = 'เกิดข้อผิดพลาด!';

									//* ประกาศ
									echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาด หรือ ไม่พบหมายเลขอ้างอิงนี้</strong></div></div>';
									//* REFRESH
									echo "<meta http-equiv='refresh' content='3 ;'>";
								}
								else
								{
									$msg = 'เกิดข้อผิดพลาด ไม่ทราบสาเหตุ';
									$alert = 'error';
									$msg_alert = 'เกิดข้อผิดพลาด!';

									//* ประกาศ
									echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาด ไม่ทราบสาเหตุ</strong></div></div>';
									//* REFRESH
									echo "<meta http-equiv='refresh' content='3 ;'>";
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
					<div class="col-md-12">
						<h5 class="text-center">เติมเงินด้วย <img src="images/truewallet.png" alt="Wallet" style="width:18%"></h5>
						<hr class="mb-3"/>
						<form name="topup_wallet" method="POST">
							<div class="row">
								<div class="input-group col-md-8 mb-2">
									<input name="wallet_transaction" type="text" onkeypress="return NumbersOnly(event);" class="form-control" placeholder="เลขอ้างอิง 14 หลัก #ได้หลังจากการโอนเงิน" required="" maxlength="14">
								</div>
								<div class="input-group col-md-4 mb-2">
									<button name="btn_wallet" type="submit" class="btn btn-primary btn-block">
										เติมเงิน
									</button>
								</div>
							</div>
						</form>
						<span class="is-divider" data-content="หรือเติมเงินด้วย TrueMoney" style="margin: 1.5rem 0;"></span>
						<div class="col-md-12 col-12 text-center text-dark">
			                <h5>อัตราการเติมเงินด้วย TrueMoney</h5>
			                <table class="table text-dark text-center">
				                <thead>
				                    <tr>
				                        <td class="py-1">ราคาเติม</td>
				                        <td class="py-1">พ้อยที่ได้</td>
				                    </tr>
				                </thead>
				               	<tbody>
				                   <tr>
				                   		<?php
				                   			$sql_truemoney_points = 'SELECT * FROM truemoney ORDER BY amount ASC';
			            					$query_truemoney_points = $connect->query($sql_truemoney_points);

			            					while($truemoney_points = $query_truemoney_points->fetch_assoc())
			            					{
			            						?>
													<td class="py-1"><?php echo $truemoney_points['amount']; ?> บาท</td>
							                        <td class="py-1"><?php echo $truemoney_points['points']; ?> <i class="fas fa-coins text-dark"></i></td>
							                        </tr><tr>
			            						<?php
			            					}
				                   		?>
				                    </tr>
				                </tbody>
			                </table>
			            </div>

							<div class="row">
								<div class="input-group col-md-8 mb-2">
									
								</div>
								<div class="input-group col-md-4 mb-2">
									
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php
		}
	?>
</div>
</div>