<?php 
if($_GET['id'] == ""){
    echo'<script>swal("Shop View","ไม่พบสินค้าที่คุณเลือก","error").then((value) => {window.location.href="?page=shop";})</script>';
}else{
    
    $query_view = $pdo->prepare("SELECT * FROM shop WHERE id = '".$_GET['id']."'");
        $query_view->execute();
        $data_view = $query_view->fetch(PDO::FETCH_ASSOC);
        if(isset($_GET['id']) != $data_view['id']){
            echo'<script>swal("Shop View","ไม่พบสินค้าที่คุณเลือก","error").then((value) => {window.location.href="?page=shop";})</script>';
               }else{
?>
<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-shopping-cart"></i> ร้านค้า</h5>
                            <hr>
					<div class="row">
																<div class="col-md-12 mb-1">
												<div class="alert alert-danger">
													<i class="fas fa-exclamation-triangle"></i> กรุณาออนไลน์ในเกมก่อนซื้อสินค้า !
												</div>
											</div>
																	<div class="col-md-4">
								<img src="<?php echo $data_view['img']; ?>" class="w-100" style="border-radius: 4px 4px 4px 4px;">
							</div>
							<div class="col p-4 d-flex flex-column position-static">
					          	<strong class="d-inline-block mb-0 text-success">
					          							          	</strong>
					          	<h3 class="mb-0">
					          		ชื่อสินค้า : <small><?php echo $data_view['name']; ?></small>
                                                        </h3><p>
                                                           <h3 class="mb-0">
					          		ราคาสินค้า : <small><?php echo $data_view['price']; ?></small>
                                                           </h3><p>
					          	<div class="mb-1 text-muted">
					          		#รหัสสินค้า: <?php echo $data_view['id']; ?>
                                                                <a href="?page=shop&sv=<?php echo $_GET['sv']; ?>'&action=shoping&shop_id=<?php echo $data_view['id']; ?>" class="btn btn-primary btn-block mt-3">
						          		<i class="fas fa-shopping-basket"></i> ซื้อ POINT 500
                                                                </a>
					        </div>
                                                        </div>
											</div>
			</div>						</div>
<?php } ?>		
	
<?php } ?>
	