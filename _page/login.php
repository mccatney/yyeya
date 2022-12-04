<?php if(!$_SESSION['username']){ ?>
<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <div class="card-header bg-dark text-white">เข้าสู่ระบบ</div>
                            <hr>
                            <div class="row">

                                <div class="col-12 mb-4">
                                    <form method="post" action="">
                                  <input type="hidden" name="login_submit">
                                <div class="form-group">
                                    <input type="text"  name="username" class="form-control" placeholder="ชื่อตัวละคร : ">
                                </div>
                                <div class="form-group">
                                    <input type="password"  name="password" class="form-control" placeholder="รหัสผ่าน : ">
                                </div>
                                        <button type="submit" class="btn btn-block btn-outline-info mb-3"><i class="fa fa-sign-in fa-fw"></i> เข้าสู่ระบบ</button>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
<?php }else{ 
     include_once __DIR__.'/home.php';
} ?>
