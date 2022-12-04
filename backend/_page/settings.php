<?php
		if(isset($_POST['settings_web_submit']))
		{
			$sql_edit_tmtopup = 'UPDATE setting SET backend_password = "'.$_POST['backend_password'].'", name_server = "'.$_POST['name_server'].'", ip_server = "'.$_POST['ip_server'].'", port_server = "'.$_POST['port_server'].'", version_server = "'.$_POST['version_server'].'", detail_server = "'.$_POST['detail_server'].'", max_reg = "'.$_POST['max_reg'].'", query_port = "'.$_POST['query_port'].'", bg = "'.$_POST['bg'].'", slash = "'.$_POST['slash'].'", icon = "'.$_POST['icon'].'", page_facebook = "'.$_POST['page_facebook'].'", www = "'.$_POST['url'].'"';
			$query_edit_tmtopup = $connect->query($sql_edit_tmtopup);
			if($query_edit_tmtopup)
			{
				$msg = 'แก้ไขการตั้งค่า WebSite เรียบร้อยแล้ว';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
			}
			else
			{
				$msg = 'แก้ไขการตั้งค่า WebSite ไม่สำเร็จ';
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
?>
                                <div class="row">
				<div class="col-md-12">
				</div>
			</div>
			<form name="settings_web_submit" method="POST">
				<div class="row">
					<div class="col-md-6 mb-3">
			            <label for="name_server">ชื่อเว็บไซต์</label>
                                    <input type="text" class="form-control" id="name_server" name="name_server" required="" value="<?php echo $setting['name_server']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="ip_server">IP Server</label>
                                    <input type="text" class="form-control" id="ip_server" name="ip_server" required="" value="<?php echo $setting['ip_server']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
			            <label for="port_server">Port Server</label>
                                    <input type="text" class="form-control" id="port_server" name="port_server" required="" value="<?php echo $setting['port_server']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="version_server">Version Server</label>
                                    <input type="text" class="form-control" id="version_server" name="version_server" required="" value="<?php echo $setting['version_server']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
			            <label for="page_facebook">Facebook_page</label>
                                    <input type="text" class="form-control" id="page_facebook" name="page_facebook" required="" value="<?php echo $setting['page_facebook']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="bg">พื้นหลัง</label>
                                    <input type="text" class="form-control" id="bg" name="bg" required="" value="<?php echo $setting['bg']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
			            <label for="max_reg">จำกัดการสมัครสมาชิก</label>
                                    <input type="text" class="form-control" id="max_reg" name="max_reg" required="" value="<?php echo $setting['max_reg']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="query_port">Query Port</label>
                                    <input type="text" class="form-control" id="query_port" name="query_port" required="" value="<?php echo $setting['query_port']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
			            <label for="detail_server">รายละเอียด Server</label>
                                    <input type="text" class="form-control" id="detail_server" name="detail_server" required="" value="<?php echo $setting['detail_server']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
			            <label for="backend_password">รหัสผ่านหลังร้าน</label>
                                    <input type="text" class="form-control" id="backend_password" name="backend_password" required="" value="<?php echo $setting['backend_password']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
			            <label for="icon">Icon</label>
                                    <input type="text" class="form-control" id="icon" name="icon" required="" value="<?php echo $setting['icon']; ?>">
			        </div>
                    <div class="col-md-6 mb-3">
                        <label for="url">URL WebShop <font color="red"> * ใช้สำหรับเชื่อม API TRUEWALLET</font></label>
                                    <input type="url" class="form-control" id="url" name="url" required="" value="<?php echo $setting['www']; ?>" placeholder="เช่น https://www.kpz.net.he/">
			        </div>
                    <div class="col-md-12 mb-2">
					<hr class="is-divider">
                                        <div class="text-center" width="24" data-toggle="collapse" href="#collapseDetail-112" role="button" aria-expanded="false" aria-controls="collapseDetail-112"><i class="fa fa-arrow-circle-down"></i> ตั้งค่าขั้นสูง</div>
                                            <div class="collapse" id="collapseDetail-112" style="">
                                                <p class="ml-4 detail-notice"><span></span><hr>
                                                <div class="alert alert-danger">ระบบ ขั้นสูงยังไม่เสร็จตอนนี้กำลังทำอยุ่ จะมาในเร็วๆนี้ในไฟล์ชื่อ Patch</div>
                                          
                                                </p>
                                            </div>
                                        <hr>
				</div>
			        <div class="col-md-12 mb-3">
			        	<button name="settings_web_submit" type="submit" class="btn btn-primary btn-block">
			        		แก้ไขการตั้งค่าระบบ
			        	</button>
			        </div>
			    </div>
			</form>