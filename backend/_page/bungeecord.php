<?php
	if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
	{
		$sql_bungeecord = 'SELECT * FROM bungeecord WHERE id = "'.$_GET['id'].'"';
		$query_bungeecord = $connect->query($sql_bungeecord);
		if($query_bungeecord->num_rows != 0)
		{
			$bungeecord_f = $query_bungeecord->fetch_assoc();

			if(isset($_POST['btn_edit']))
			{
				$edit_name_server_u = $connect->real_escape_string($_POST['edit_name_server']);
				$sql_edit = 'UPDATE bungeecord SET name_server = "'.$edit_name_server_u.'", ip_server = "'.$_POST['edit_ip_server'].'", port = "'.$_POST['edit_port_server'].'", password = "'.$_POST['edit_password_server'].'" WHERE id = "'.$bungeecord_f['id'].'"';
				$query_edit = $connect->query($sql_edit);

				if($query_edit)
				{
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขเรียบร้อยแล้ว เรียบร้อยแล้ว</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ไม่สามารถแก้ไขได้ในขณะนี้</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
			}

			if(isset($_POST['btn_delete']))
			{
				$sql_delete = 'DELETE FROM bungeecord WHERE id = "'.$bungeecord_f['id'].'"';
				$query_delete = $connect->query($sql_delete);

				if($query_delete)
				{
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ลบ ID: '.$bungeecord_f['id'].' เรียบร้อยแล้ว</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ไม่สามารถลบ ID: '.$bungeecord_f['id'].' ได้ในขณะนี้</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
			}
			?>
				<h4 class="mb-3 text-center">จัดการ Server Bungeecord<div class='text-muted'>#<?php echo $bungeecord_f['id']; ?></div></h4>
				<form name="edit_bungeecord" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
				            <label for="edit_name_server">ชื่อ Server</label>
				            <input type="text" class="form-control" id="edit_name_server" name="edit_name_server" value="<?php echo $bungeecord_f['name_server']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_ip_server">IP SERVER</label>
				            <input type="text" class="form-control" id="edit_ip_server" name="edit_ip_server" value="<?php echo $bungeecord_f['ip_server']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_port_server">PORT Rcon</label>
				            <input type="text" class="form-control" id="edit_port_server" name="edit_port_server" value="<?php echo $bungeecord_f['port']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_password_server">Password Rcon</label>
				            <input type="text" class="form-control" id="edit_password_server" name="edit_password_server" value="<?php echo $bungeecord_f['password']; ?>">
				        </div>
				        <div class="col-md-6 mt-4 mb-3">
				            <button type="submit" class="btn btn-primary btn-block" name="btn_edit">
				            	แก้ไข
				            </button>
				        </div>
				        <div class="col-md-6 mt-4 mb-3">
				            <button type="submit" class="btn btn-primary btn-block" name="btn_delete">
				            	ลบ
				            </button>
				        </div>
				    </div>
				</form>
			<?php
		}
		else
		{
			echo "<h5 class='col-md-12 text-center'>ไม่พบ Server นี้</h5>";
		}
	}
	elseif(isset($_GET['add']))
	{
		if(isset($_POST['btn_add_bungeecord']))
		{
			if(!empty($_POST['add_name_server']) && !empty($_POST['add_ip_server']) && !empty($_POST['add_port_server']) && !empty($_POST['add_password_server']))
			{
				$name_server_add = $connect->real_escape_string($_POST['add_name_server']);
				$sql_add = 'INSERT INTO bungeecord (name_server,ip_server,port,password) VALUES ("'.$name_server_add.'","'.$_POST['add_ip_server'].'","'.$_POST['add_port_server'].'","'.$_POST['add_password_server'].'")';
				$query_add = $connect->query($sql_add);

				if($query_add)
				{
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เพิ่ม Server '.$name_server_add.' เรียบร้อยแล้ว</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ไม่สามารถเพิ่ม Server '.$name_server_add.' ได้</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
			}
			else
			{
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>กรุณากรอกข้อมูลให้ครบ</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
			}
		}
		?>
			<form name="add_bungeecord" method="POST">
				<div class="row">
					<div class="col-md-6 mb-3">
				        <label for="add_name_server">ชื่อ Server</label>
				        <input type="text" class="form-control" id="add_name_server" name="add_name_server">
				    </div>
				    <div class="col-md-6 mb-3">
				        <label for="add_ip_server">IP SERVER</label>
				        <input type="text" class="form-control" id="add_ip_server" name="add_ip_server" >
				    </div>
				    <div class="col-md-6 mb-3">
				        <label for="add_port_server">PORT Rcon</label>
				        <input type="text" class="form-control" id="add_port_server" name="add_port_server">
				    </div>
				    <div class="col-md-6 mb-3">
				        <label for="add_password_server">Password Rcon</label>
				        <input type="text" class="form-control" id="add_password_server" name="add_password_server">
				    </div>
				    <div class="col-md-12 mt-4 mb-3">
				        <button type="submit" class="btn btn-primary btn-block" name="btn_add_bungeecord">
				        	เพิ่ม
				        </button>
				    </div>
				</div>
			</form>
		<?php
	}
	else
	{
	?>
	<div class="col-md-12 mb-3">
		<a href="?page=backend&menu=bungeecord&add" class="btn btn-primary btn-block">
			เพิ่ม Server
		</a>
	</div>
	<table class="table table-default table-striped table-condenseds">
		<thead>
			<tr>
				<th style="background-color: #FFF;" class="text-dark">#</th>
				<th style="background-color: #FFF;" class="text-center text-dark">ชื่อ Server</th>
				<th style="background-color: #FFF;" class="text-center text-dark">แก้ไข</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql_list_bungeecord = 'SELECT * FROM bungeecord ORDER BY id ASC';
				$query_list_bungeecord = $connect->query($sql_list_bungeecord);
				$i = 0;
				if($query_list_bungeecord->num_rows != 0)
				{
					while($list_bungeecord = $query_list_bungeecord->fetch_assoc())
					{
						$i++;
						echo '
							<tr>
								<td class="text-left">'.$list_bungeecord['id'].'</td>
								<td class="text-center">'.$list_bungeecord['name_server'].'</td>
								<td class="text-center"><a href="?page=backend&menu=bungeecord&id='.$list_bungeecord['id'].'" class="btn btn-primary">แก้ไข #'.$list_bungeecord['id'].'</a></td>
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