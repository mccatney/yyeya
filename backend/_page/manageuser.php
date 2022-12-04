<?php
	if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
	{
		$user_id = $_GET['id'];
		$sql_user = 'SELECT * FROM authme WHERE id = "'.$user_id.'"';
		$query_user = $connect->query($sql_user);

		if($query_user->num_rows != 0)
		{
			$user_f = $query_user->fetch_assoc();

			if(isset($_POST['btn_edit_user']))
			{
				if($_POST['email'] != NULL && $_POST['email'] != "" && $_POST['points'] != NULL && $_POST['points'] != "" && $_POST['status'] != NULL && $_POST['status'] != "")
				{
					$sql_edit = 'UPDATE authme SET email = "'.$_POST['email'].'", points = "'.$_POST['points'].'", status = "'.$_POST['status'].'" WHERE id = "'.$user_f['id'].'"';
					$query_edit = $connect->query($sql_edit);

					if($query_edit)
					{
						$msg = 'แก้ไข #'.$user_f['id'].' เรียบร้อยแล้ว';
						$alert = 'success';
						$msg_alert = 'สำเร็จ!';
						//* ประกาศ
						echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไข #'.$user_f['id'].' เรียบร้อยแล้ว</strong></div>';

						//* REFRESH
						echo "<meta http-equiv='refresh' content='5 ;'>";
					}
					else
					{
						$msg = 'เกิดข้อผิดพลาดในการแก้ไข #'.$user_f['id'];
						$alert = 'error';
						$msg_alert = 'เกิดข้อผิดพลาด!';
						//* ประกาศ
						echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการแก้ไข #'.$user_f['id'].'</strong></div>';

						//* REFRESH
						echo "<meta http-equiv='refresh' content='5 ;'>";
					}
				}
				else
				{
					$msg = 'กรุณากรอกให้ครบทุกช่อง';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>กรุณากรอกให้ครบทุกช่อง</strong></div>';

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
				<h4 class="mb-3 text-center">จัดการสมาชิก <div class='text-muted'>#<?php echo $user_f['id']; ?></div></h4>
				<form name="edit_user" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
				            <label for="username">UserName</label>
				            <input type="text" class="form-control" id="username" name="username" readonly="" value="<?php echo $user_f['username']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="realname">RealName</label>
				            <input type="text" class="form-control" id="realname" name="realname" readonly="" value="<?php echo $user_f['realname']; ?>">
				        </div>
				        <div class="col-md-8 mb-3">
				            <label for="email">Email</label>
				            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_f['email']; ?>">
				        </div>
				        <div class="col-md-4 mb-3">
				            <label for="ip">IP Address</label>
				            <input type="text" class="form-control" id="ip" name="ip" readonly="" value="<?php echo $user_f['ip']; ?>">
				        </div>
				        <div class="col-md-3 mb-3">
				            <label for="points">Points</label>
				            <input type="text" class="form-control" id="points" name="points" value="<?php echo $user_f['points']; ?>">
				        </div>
				        <div class="col-md-3 mb-3">
				            <label for="status">Status</label>
				            <input type="text" class="form-control" id="status" name="status" value="<?php echo $user_f['status']; ?>">
				        </div>
				        <div class="col-md-6 my-4">
				        	<button type="submit" name="btn_edit_user" class="btn btn-primary btn-block">
				        		แก้ไข #<?php echo $user_f['id']; ?>
				        	</button>
				        </div>
				    </div>
				</form>
			<?php
		}
		else
		{
			echo "<h5 class='mb-2 text-center'>ไม่พบผู้เล่น ID: ".$user_id."</h5>";
			echo "<div class='text-center'><a href='?page=backend&menu=manageuser'>กดเพื่อกลับ</a></div>";
		}
	}
	else
	{
		?>
			<form name="search_user" method="POST">
				<div class="col-12 col-md-12  pull-left text-right mb-2">
					<div class="input-group">
					    <input type="text" class="form-control" id="input_search" name="input_search" placeholder="Username หรือ ID">
					    <div class="input-group-append">
			            	<button type="submit" name="btn_search_user" class="btn btn-primary">ค้นหา</button>
			          	</div>
					</div>
				</div>
			</form>
			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-dark">#</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ชื่อตัวละคร</th>
						<th style="background-color: #FFF;" class="text-center text-dark">อีเมล์</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ไอพี</th>
						<th style="background-color: #FFF;" class="text-center text-dark">พ้อยท์</th>
						<th style="background-color: #FFF;" class="text-center text-dark">สถานะ</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_user_w = 'SELECT * FROM authme';
						if(isset($_POST['btn_search_user']))
						{
							$sql_user_w .= " WHERE (username LIKE '%".$_POST["input_search"]."%' ) || id LIKE '%".$_POST["input_search"]."%'";
						}
						else
						{
							$sql_user_w .= ' ORDER BY id ASC';
						}
						$query_user_w = $connect->query($sql_user_w);
						$i = 0;

						if($query_user_w->num_rows != 0)
						{
							while($user_w = $query_user_w->fetch_assoc())
							{
								$i++;
								echo '
									<tr>
										<td class="text-left">'.$user_w['id'].'</td>
										<td class="text-center"><a href="?page=backend&menu=manageuser&id='.$user_w['id'].'">'.$user_w['realname'].'</a></td>
										<td class="text-center">'.$user_w['email'].'</td>
										<td class="text-center">'.$user_w['ip'].'</td>
										<td class="text-center">'.$user_w['points'].'</td>
										<td class="text-center">'.$user_w['status'].'</td>
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
		<?php
	}
?>