<?php
			if(isset($_POST['btn_edit']))
			{
				$edit_name_category_u = $connect->real_escape_string($_POST['edit_name_category']);
				$sql_edit = 'UPDATE setting SET discord_id = "'.$edit_name_category_u.'"';
				$query_edit = $connect->query($sql_edit);

				if($query_edit)
				{
					//* ประกาศ
                                    $msg = 'แก้ไขเรียบร้อยแล้ว Discord สำเร็จแล้ว';
                                        $alert = 'success';
                                        $msg_alert = 'สำเร็จ!';
					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
                                    //* ประกาศ
                                    $msg = 'ไม่สามารถแก้ไขได้ในขณะนี้';
                                        $alert = 'error';
                                        $msg_alert = 'คำเตือน!';
					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				} ?>
<script>
	              swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
	                button: "Reload",
	              })
	              .then((value) => {
	                window.location.href = window.location.href;
	              });
	            </script>
		<?php	}
			?>
                        <form name="edit_user" method="POST">
					<div class="row">
						<div class="col-md-12 mb-3">
				            <label for="edit_name_category"></label>
                                            <input type="text" class="form-control" id="edit_name_category" name="edit_name_category" placeholder="ใส่ id_discord" value="<?php echo $setting['discord_id']; ?>">
				        </div>
				        <div class="col-md-12 mt-4 mb-3">
				            <button type="submit" class="btn btn-primary btn-block" name="btn_edit">
				            	แก้ไข
				            </button>
				        </div>
				    </div>
				</form>
                 <?php
	//}
?>