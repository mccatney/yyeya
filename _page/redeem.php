<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-code"></i> เติมไอเท็ม</h5>
                            <hr>
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    include_once '_page/alertLogin.php';
		}
		else
		{
			?>
<form method="post" action="">
            <input type="hidden" name="submit" value="redeem">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-barcode"></i>&nbsp;โค๊ต&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="redeem_code" class="form-control form-control-lg lp-input">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;ยืนยันและเติมโค๊ต</button>

</form>
			<?php
		}
	?>
</div></div>