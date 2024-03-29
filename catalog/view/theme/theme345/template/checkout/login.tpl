<div class="login-content row">
<div class="left col-sm-6">
	<div class="heading">
		<i class="fa fa-file-text-o"></i>
		<div class="extra-wrap">
			<h2><?php echo $text_new_customer; ?></h2>
			<b><?php echo $text_checkout; ?></b>
		</div>
	</div>
	<div class="extra-wrap"> 
		<label class="radio" for="register">
		<?php if ($account == 'register') { ?>
		<input type="radio" name="account" value="register" id="register" checked="checked" />
		<?php } else { ?>
		<input type="radio" name="account" value="register" id="register" />
		<?php } ?>
		<b><?php echo $text_register; ?></b>
		</label>
	</div>
  
  <?php if ($guest_checkout) { ?>
  <div class="extra-wrap">
  <label class="radio" for="guest">
	<?php if ($account == 'guest') { ?>
	<input type="radio" name="account" value="guest" id="guest" checked="checked" />
	<?php } else { ?>
	<input type="radio" name="account" value="guest" id="guest" />
	<?php } ?>
	<b><?php echo $text_guest; ?></b></label>
</div>
  <?php } ?>
  <p class="login-padd"><?php echo $text_register_account; ?></p>
  <a id="button-account" class="button-cont-right"><?php echo $button_continue; ?><i class="fa fa-arrow-circle-right"></i></a>
  <div class="clear"></div>
</div>
<div id="login" class="right col-sm-6">
	<div class="heading">
		<i class="fa fa-key"></i>
		<div class="extra-wrap">
			<h2><?php echo $text_returning_customer; ?></h2>
			<b><?php echo $text_i_am_returning_customer; ?></b>
		</div>
	</div>
	<div class="form-horizontal">
		<div class="form-group">
			<label class="padd-form control-label col-sm-5" for="email"><?php echo $entry_email; ?></label>
			<div class="controls col-sm-7">
				<input class="q1" type="text" name="email" value="" />
			</div>
		</div>
		<div class="form-group">
			<label class="padd-form control-label col-sm-5" for="password"><?php echo $entry_password; ?></label>
			<div class="controls col-sm-7">
				<input class="q1" type="password" name="password" value="" />
			</div>
		</div>
	</div>
	<div class="login-buttons">
		<a id="button-login" class="button-cont-right"><?php echo $button_login; ?><i class="fa fa-arrow-circle-right"></i></a>
		<a class="link-login" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
	</div>
</div>
</div>