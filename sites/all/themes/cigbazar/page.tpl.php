<?php
error_reporting(0);
global $base_url;
global $user;
$number_of_items = count(uc_cart_get_contents());
$cur_url = request_uri();
?>
<script type="text/javascript" src="<?=$base_url;?>/sites/all/themes/cigbazar/js/jquery-1.4.min.js"></script>
<script src="<?=$base_url;?>/sites/all/themes/cigbazar/js/jquery.reveal.js"></script>
<link rel="stylesheet" href="<?=$base_url;?>/sites/all/themes/cigbazar/css/styles.css">
<script src="<?=$base_url;?>/sites/all/themes/cigbazar/js/jquery.cookie.js"></script>

  <?php print render($page['header']); ?>

  <div id="wrapper">
    <div id="container" class="clearfix">

      <div id="header">
        <div id="logo-floater">
        <?php if ($logo || $site_title): ?>
          <?php if ($title): ?>
            <div id="branding"><strong><a href="<?php print $front_page ?>">
            <?php if ($logo): ?>
              <img src="<?php print $logo ?>" alt="<?php print $site_name_and_slogan ?>" title="<?php print $site_name_and_slogan ?>" id="logo" />
            <?php endif; ?>
            <?php print $site_html ?>
            </a></strong></div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="branding"><a href="<?php print $front_page ?>">
            <?php if ($logo): ?>
              <img src="<?php print $logo ?>" alt="<?php print $site_name_and_slogan ?>" title="<?php print $site_name_and_slogan ?>" id="logo" />
            <?php endif; ?>
            <?php print $site_html ?>
            </a></h1>
        <?php endif; ?>
        <?php endif; ?>
        </div>
			<?php //if ($secondary_nav): print $secondary_nav; endif; 

$menu = menu_tree('user-menu');
$menuhtml = drupal_render($menu);
if($user->uid=='0')
{
	?>
	<ul class="links inline secondary-menu">
<li class="leaf"><?php print l('My Cart ', 'cart'); ?> <?php print '<span>(' .$number_of_items .')</span>';?></li>
<li class="leaf"><?php print l('Checkout','cart/checkout');?></li>
<li class="last leaf"><?php print l('Login','user/login');?></li>
</ul>	
<?php
//print $menuhtml;
}
else{
	?>
	<ul class="links inline secondary-menu">
<li class="leaf"><?php print l('My Account','user/'.$user->uid.'/edit');?></li>
<li class="leaf"><?php print l('My Cart ', 'cart'); ?> <?php print '<span>(' .$number_of_items .')</span>';?></li>
<li class="leaf"><?php print l('Checkout','cart/checkout');?></li>
<li class="last leaf"><?php print l('Log out','user/logout');?></li>
</ul>	
<?php 
}
?>
			
        <?php //if ($primary_nav): print $primary_nav; endif; ?>
        <?php print render($page['headmenu']); ?>
      </div> <!-- /#header -->

      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first" class="sidebar">
          <?php print render($page['sidebar_first']); ?>
        </div>
      <?php endif; ?>

      <div id="center"><div id="squeeze"><div class="right-corner"><div class="left-corner">
      
    
       	<div class="inner-banner">
          <img width="1001" height="289" border="0" alt="" src="<?=$base_url;?>/sites/all/themes/cigbazar/images/inner-banner.jpg" />
          </div>
      
   
          <?php print $breadcrumb; ?>
          <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
          <a id="main-content"></a>
          <?php if ($tabs): ?><div id="tabs-wrapper" class="clearfix"><?php endif; ?>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <h1<?php print $tabs ? ' class="with-tabs"' : '' ?>><?php print $title ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
          <?php print render($tabs2); ?>
          <?php print $messages; ?>
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
         	<?php
			if($node->type!='homcontent' || $node->type!='webform'){
			?>
            <div class="left-bar"> <?php print render($page['categorymenu']); ?></div>
           <div class="right-bar">
            <?php
			}
			?>
          <div class="clearfix">
            <?php print render($page['content']); 
			
			?>
          </div>
          <?php
			if($node->type!='homcontent' || $node->type!='webform'){
			?>
          </div>
          <?php
		  }
		  ?>
          <?php print $feed_icons ?>
         
      </div></div></div></div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center -->
 <?php print render($page['footer']); ?>
 <div class="warnning">18+ Only | CALIFORNIA PROPOSITION 65 - Warning: This product contains nicotine, a chemical known to the state of California to cause birth defects or other reproductive harm.</div>
      <?php if ($page['sidebar_second']): ?>
        <div id="sidebar-second" class="sidebar">
          <?php print render($page['sidebar_second']); ?>
        </div>
      <?php endif; ?>

    </div> <!-- /#container -->
  </div> <!-- /#wrapper -->
  
 <div id="modal">
	<div class="popup-container">
		<div class="popup-logo"><img src="<?=$base_url;?>/sites/all/themes/cigbazar/images/logo.png" /></div>
		<div id="content">
        <div class="popup-content-inner">
		<h2><img src="<?=$base_url;?>/sites/all/themes/cigbazar/images/age-certif.jpg" /></h2>
		<div class="btn-container">
		<a href="#" class="button red" id="not_accept"><img src="<?=$base_url;?>/sites/all/themes/cigbazar/images/btn_under.jpg"></a>
        <a href="#" class="button green" id="accept"><img src="<?=$base_url;?>/sites/all/themes/cigbazar/images/btn_enter.jpg"></a>
        </div>
          <p>Intended for sale to adults 18 years or older. If you are not legally able 
to purchase  tobacco products in the state where you live, please do not enter this site</p>
	</div></div>
</div></div>
	

	<script type="text/javascript">
	var url = "<?=$cur_url;?>";
	
		$(document).ready(function() {	
      if($.cookie('age')!=1){			
			
			
			 // Button which will activate our modal
			 $('#modal').reveal({ // The item which will be opened with reveal
				  	animation: 'fade',                   // fade, fadeAndPop, none
					animationspeed: 600,                       // how fast animtions are
					closeonbackgroundclick: false,              // if you click background will modal close?
					dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
				});
				     
				
		 }else{
		$("#modal").css("display","none"); 
		 }
			//return false;
			
         $("#accept").click(function(){
        	   
                // alert('Yes'); 
                 $.cookie('age', '1');
						window.location=url;      	   
                 //alert($.cookie('age')); 
                   	   
        	   
        	});	
        	
        	$("#not_accept").click(function(){
        	   
                 //alert('No');  
                 window.location="http://www.tobaccofreekids.org";      	   
        	   
        	});		
			
			
		});
		
	</script>
