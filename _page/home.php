  <div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><i class="fa fa-youtube"></i> คริปรีวิว</h5>
<hr>
                            <div class="row">
                                <iframe iframe height="315" style="width:100%;" src='https://www.youtube.com/embed/<?php echo $setting['youtube_watch']; ?> 'frameborder="0" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>

<div id="slider_img" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
            <li data-target="#slider_img" class="active" data-slide-to="0"></li>
      </ol>
  <div class="carousel-inner">
            <div class="carousel-item active">
          <img class="d-block w-100" src="http://www.amzcraft.net/png/promotion1.png">

        </div>
      </div>
  <a class="carousel-control-prev" href="#slider_img" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slider_img" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br>


<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <div class="card-header bg-dark btn-line-b red_line" style="color:#FFF;font-size:18px!important;"><b><i class="fa fa-bullhorn fa-lg"></i> ข่าวประกาศ</b></div>
                            <br>
                            <div class="table-responsive">
	<table class="table" style="color: black;">
	    <thead>
	      <tr>
	        <th scope="col" class="text-center">#</th>
	        <th scope="col" class="text-center">ประกาศ</th>
	        <th scope="col" class="text-right">วันที่-เวลา</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$query_announce = $connect->query('SELECT * FROM announce ORDER BY id DESC LIMIT 5');
		        if($query_announce->num_rows > 0)
		        {
		        	$i = 1;
		         	while($announce = $query_announce->fetch_assoc())
		          	{
		            ?>
		              <tr>
		                <td class="text-center">
		                	<?php echo $i; $i++; ?>
		                </td>
		                <td class="text-center">
		                	<?php echo $announce['html']; ?>
		                </td>
		                <td class="text-right">
		                	<?php echo $announce['date_create']; ?>
		                </td>
		              </tr>
		            <?php
		          	}
		        }
		        else
		        {
		          ?>
		            <tr>
		                <td class="text-center" colspan="3">
		                  ยังไม่มีประกาศ
		                </td>
		            </tr>
		          <?php
		        }
		    ?>
	    </tbody>
	</table>
                            </div>
                        </div>
                    </div>
 
					
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-trophy"></i> อันดับรายเดือน Truemoney</h5>
                            <br>
                                                                                                            <?php
                                                                                            $sql_last_m = 'SELECT * FROM authme ORDER BY topup_m DESC LIMIT 5';
                                                                                            $query_last_m = $connect->query($sql_last_m);
                                                                                            ?>
                                                                                            <table class="table table-striped ranking_tb" border="0" style="font-size:13px;">
                                                                                              <thead>
                                                                                                <tr>
                                                                                                  <th scope="col">ชื่อผู้เล่น</th>
                                                                                                  <th scope="col">จำนวน</th>
                                                                                                </tr>
                                                                                              </thead>
                                                                                              <tbody>
                                                                                                <?php
                                                                                                if($query_last_m->num_rows > 0)
                                                                                                {
                                                                                                  while($list_topup = $query_last_m->fetch_assoc())
                                                                                                  {
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                      <td>
                                                                                                        <img src="https://minotar.net/avatar/<?php echo $list_topup['username']; ?>/28" class="mr-3" width="28"><?php echo $list_topup['realname']; ?>
                                                                                                      </td>
                                                                                                      <td>
                                                                                                        <?php echo number_format($list_topup['topup_m'],2); ?> <i class="fas fa-coins text-dark"></i>
                                                                                                      </td>
                                                                                                    </tr>
                                                                                                    <?php
                                                                                                  }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                  ?>
                                                                                                  <tr>
                                                                                                    <td>
                                                                                                      <img src="https://minotar.net/avatar/steve/28" class="mr-3" width="28">ไม่มีอันดับคนเติมเงินรายเดือน TrueMoney
                                                                                                    </td>
                                                                                                    <td>
                                                                                                      <?php echo number_format("0",2); ?> <i class="fas fa-coins text-dark"></i>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                  <?php
                                                                                                }
                                                                                                ?>
                                                                                              </tbody>
                                                                                            </table>
											</div>
                                                                                 </div>
	