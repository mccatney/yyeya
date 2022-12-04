<?php
		$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
		$query_wallet = $connect->query($sql_wallet);
		$wallet = $query_wallet->fetch_assoc();

		if(isset($_POST['wallet_submit']))
		{
			$sql_edit_wallet = 'UPDATE wallet_account SET password = "'.$_POST['wallet_password'].'", phone = "'.$_POST['wallet_phone'].'", name = "'.$_POST['wallet_name'].'", mutiple = "'.$_POST['wallet_mutiple'].'", message = "'.$_POST['wallet_message'].'", reference_token = "'.$_POST['wallet_reference'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
			if($query_edit_wallet)
			{
				$msg = 'แก้ไขการตั้งค่า Wallet เรียบร้อยแล้ว';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่า Wallet เรียบร้อยแล้ว</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
			}
			else
			{
				$msg = 'แก้ไขการตั้งค่า Wallet ไม่สำเร็จ';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่า Wallet ไม่สำเร็จ</strong></div>';

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
		
		$now_month = "-".date("m")."-";
		$sql_list_topup_wallet = 'SELECT * FROM activities WHERE action = "TOPUP Truewallet" AND date LIKE "%'.$now_month.'%"';
		$query_list_topup_wallet = $connect->query($sql_list_topup_wallet);
		$sql_list_topup_tmn = 'SELECT * FROM activities WHERE action = "TOPUP TrueMoney" AND date LIKE "%'.$now_month.'%"';
		$query_list_topup_tmn = $connect->query($sql_list_topup_tmn);

		$amount_wallet = 0;
		while($topup_wallet = $query_list_topup_wallet->fetch_assoc())
		{
			$amount_wallet += $topup_wallet['topup_amount'];
		}

		$amount_tmn = 0;
		while($topup_tmn = $query_list_topup_tmn->fetch_assoc())
		{
			$amount_tmn += $topup_tmn['topup_amount'];
		}
		?>
			<div class="row">
				<div class="col-md-12 mb-2">
					<span class="is-divider" data-content="ตั้งค่า Wallet Account" style="margin: 1.5rem 0;"></span>
				</div>
			</div>
			<h4 class="mb-3 text-center">
				จัดการระบบเติมเงิน <small>#Wallet Account</small>
			</h4>
			<form name="topup_settings" method="POST">
				<div class="row">
					<div class="col-md-6 mb-3">
			            <label for="wallet_email">API BY</label>
			            <input type="text" class="form-control" id="wallet_email" name="wallet_email" required="" value="ทนาย'ป๋อ">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="wallet_password">Password</label>
			            <input type="password" class="form-control" id="wallet_password" name="wallet_password" required="" value="<?php echo $wallet['password']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_phone">Phone</label>
			            <input type="tel" class="form-control" id="wallet_phone" name="wallet_phone" required="" value="<?php echo $wallet['phone']; ?>">
			        </div>
			        <div class="col-md-4 mb-3">
			            <label for="wallet_name">Name</label>
			            <input type="text" class="form-control" id="wallet_name" name="wallet_name" required="" value="<?php echo $wallet['name']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_message">Message</label>
			            <input type="text" class="form-control" id="wallet_message" name="wallet_message" required="" value="<?php echo $wallet['message']; ?>">
			        </div>
			        <div class="col-md-2 mb-3">
			            <label for="wallet_mutiple">x</label>
			            <input type="tel" class="form-control" id="wallet_mutiple" name="wallet_mutiple" required="" value="<?php echo $wallet['mutiple']; ?>">
			        </div>
			        <div class="col-md-12 mb-3">
			            <label for="wallet_reference">Access Token</label>
			            <input type="text" class="form-control" id="wallet_reference" name="wallet_reference" required="" value="<?php echo $wallet['reference_token']; ?>">
			        </div>
			        <div class="col-md-12 mb-3">
			        	<button name="wallet_submit" type="submit" class="btn btn-primary btn-block">
			        		แก้ไขการตั้งค่าเติมเงิน
			        	</button>
			        </div>
			    </div>
			</form>
                                <hr>
		<?php
		$sql_truemoney = 'SELECT * FROM truemoney';
		$query_truemoney = $connect->query($sql_truemoney);
		echo '<div class="row">
				<div class="col-md-12 mb-2">
					<span class="is-divider" data-content="ตั้งค่า TrueMoney" style="margin: 1.5rem 0;"></span>
				</div>
			</div>';
		echo '<h4 class="mb-3 text-center">
				ตั้งค่า <small>#TrueMoney</small>
			</h4>';

		if(isset($_POST['truemoney_submit']))
		{
			$sql_edit_truemoney = 'UPDATE truemoney SET points = "'.$_POST['truemoney_points'].'" WHERE amount = "'.$_POST['truemoney_id'].'"';
			$query_edit_truemoney = $connect->query($sql_edit_truemoney);

			if($query_edit_truemoney)
			{
				$msg = 'แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' เสร็จเรียบร้อย';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' เสร็จเรียบร้อย</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
			}
			else
			{
				$msg = 'แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' ไม่สำเร็จ';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' ไม่สำเร็จ</strong></div>';

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
		while($w_truemoney = $query_truemoney->fetch_assoc())
		{
			?>
                                
				<form name="truemoney_settings" method="POST">
					<div class="row">
						<div class="col-md-3 mb-3">
				            <label for="truemoney_id">ราคาบัตร</label>
				            <input type="text" class="form-control" id="truemoney_id" name="truemoney_id" required="" value="<?php echo $w_truemoney['amount']; ?>" readonly="">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="truemoney_points">พ้อยท์ที่ได้</label>
				            <input type="text" class="form-control" id="truemoney_points" name="truemoney_points" required="" value="<?php echo $w_truemoney['points']; ?>">
				        </div>
				        <div class="col-md-3 mb-3">
                                            <label for="truemoney_submit"><p></p></label>
				        	<button name="truemoney_submit" type="submit" class="btn btn-primary btn-block">
				        		แก้ไข #<?php echo $w_truemoney['amount']; ?>
				        	</button>
				        </div>
				    </div>
				</form>
			<?php
		}
?>