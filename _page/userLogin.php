<div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><i class="fa fa-user"></i>&nbsp;ผู้ใช้งาน</h5>
<hr>
<?php
	if(isset($_POST['login_submit']))
	{
		$msg = '';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';

		$username = $connect->real_escape_string($_POST['username']);
		$sql = 'SELECT * FROM authme WHERE username = "'.$username.'"';
		$a = $connect->query($sql);
		$a_num = $a->num_rows;
		if($a_num == 1)
		{
			$password_info = $a->fetch_assoc();
			$sha_info = explode("$",$password_info['password']);
			$salt = $sha_info[2];
			$sha256_password = hash('sha256', $_POST['password']);
			$sha256_password .= $sha_info[2];

			if(strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password)) == 0){
				$sql_user = 'SELECT * FROM authme WHERE username = "'.$username.'"';
				$query_user = $connect->query($sql_user);
				$fetch_user = $query_user->fetch_assoc();

				//* SET SESSION
				$_SESSION['uid'] = $fetch_user['id'];
				$_SESSION['username'] = $fetch_user['username'];
				$_SESSION['realname'] = $fetch_user['realname'];


				$msg = 'ยินดีต้อนรับคุณ: '.$_SESSION['realname'];
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
			}
			else
			{
				$msg = 'รหัสผ่านไม่ถูกต้อง';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
		}
		else
		{
			$msg = 'ไม่พบตัวละครนี้';
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
	else
	{
		?>
			<div class="alert alert-danger">
				<i class="fa fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนทำรายการ !
			</div>
		<?php
	}
?>
<form name="login" method="POST">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text">
				<i class="fa fa-user"></i>
			</span>
		</div>
		<input type="text"  name="username" class="form-control" placeholder="ชื่อตัวละคร : ">
	</div>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text">
				<i class="fa fa-lock"></i>
			</span>
		</div>
		<input type="password"  name="password" class="form-control" placeholder="รหัสผ่าน : ">
	</div>
	<br>
	<?php
		if(isset($_POST['login_submit']))
		{
			?>
				<button class="btn btn-primary btn-block" type="button" disabled>
				  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				  Loading...
				</button>
			<?php
		}
		else
		{
			?>
				<button type="submit" class="btn btn-block btn-outline-info mb-3" name="login_submit"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>
			<?php
		}
	?>
</form>
</div>
</div>