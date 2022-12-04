<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <div class="card-header bg-dark" style="color:#FFF"><b><i class="fa fa-server" aria-hidden="true"></i> เลือกเชิฟเวอร์ที่ท่านต้องการ</b></div>
                            <hr>
                             <?php
                                    $sql_bungeecord = 'SELECT * FROM bungeecord';
                                      $query_bungeecord = $connect->query($sql_bungeecord);
                                      echo '<div class="row mb-3">';
                                      while($server_bungeecord = $query_bungeecord->fetch_assoc())
                                      {
                                        if(isset($_GET['category']) && !empty($_GET['category']) && $_GET['category'] != NULL)
                                        {
                                          echo '<div class="col-md-3">';
                                          echo '<a href="?page=shop&category='.$_GET['category'].'&server='.$server_bungeecord['id'].'" class="btn btn-danger btn-block">'.$server_bungeecord['name_server'].'</a>';
                                          echo '</div>';
                                        }
                                        else
                                        {
                                          echo '<div class="col-md-3">';
                                          echo '<a href="?page=shop&server='.$server_bungeecord['id'].'" class="btn btn-danger btn-block">'.$server_bungeecord['name_server'].'</a>';
                                          echo '</div>';
                                        }
                                      }
                                      echo '</div>';
                                        echo '<hr/>';
                                  ?>
                            <div class="row"><br>
                             <?php
                                if(isset($_GET['page']) && $_GET['page'] != 'shop')
                                {
                                  $sql_product = 'SELECT * FROM shop ORDER BY id DESC';
                                }
                                else
                                {
                                  $sql_product = 'SELECT * FROM shop';
                                }

                                if(isset($_GET['server']) && is_numeric($_GET['server']))
                                {
                                  $sql_product .= ' WHERE server_id = "'.$_GET['server'].'"';
                                }

                                if(isset($_GET['category']) && is_numeric($_GET['category']))
                                {
                                  if(isset($_GET['server']) && is_numeric($_GET['server']))
                                  {
                                    $sql_product .= ' AND category = "'.$_GET['category'].'"';
                                  }
                                  else
                                  {
                                    $sql_product .= ' WHERE category = "'.$_GET['category'].'"';
                                  }
                                }

                                if(isset($_GET['page']) && $_GET['page'] != 'shop')
                                {
                                  $sql_product .= ' LIMIT 6';
                                }
                                elseif(!isset($_GET['page']))
                                {
                                  $sql_product .= ' LIMIT 6';
                                }

                                $query_product = $connect->query($sql_product);

                                if($query_product->num_rows <= 0)
                                {
                                  echo "<h5 class='col-md-12 text-center'>เลือกเซิฟเวอร์ที่จะซื้อครับ</h5>";
                                }
                                else
                                {
                                  while($product = $query_product->fetch_assoc())
                                  { ?>
                <div class="col-md-4">
            <div class="item" style="margin-bottom: 20px;">
              <div class="item-image">
              <a class="item-image-price"><?php echo number_format($product['price'], 2); ?> POINT</a>
              <center><img src="<?php echo $product['pic']; ?>"></center>
              <a class="item-image-bottom"><?php echo $product['name']; ?></a>
            </div>
              <div class="item-info">
                <div class="item-text">
				  <a style="font-size: 18px;"><?php echo $product['name']; ?></a>
                  <a href="?page=confirm&id=<?php echo $product['id']; ?>" class="btn btn-primary w-100 mb-1 border-0">กดเพื่อซื้อสินค้า</a>
                </div>
              </div>
            </div>
              </div> 
                            
                                <?php } } ?>
                                </div>
                            </div>
                        </div>