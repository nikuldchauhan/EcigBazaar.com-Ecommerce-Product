<?php 
error_reporting(0);
$loop = 0;
global $base_url;

$category = !empty($node->field_brand['und'][0]['tid']) ? $node->field_brand['und'][0]['tid']:0;

$nid = $node->nid;
//$query="SELECT DISTINCT * FROM node WHERE type = 'product' AND nid != $nid ORDER BY RAND()";
$query="SELECT * FROM taxonomy_index WHERE tid = $category AND nid != $nid";
$result=db_query($query);
foreach ($result as $record) {
			      
				 $nids[]=$record->nid;
				 $loop++;
				  }
				  
/*
while($a_list = db_fetch_object($result)){
  foreach ($a_list as $array => $node_id){
  }
	print $node_id;
}
/*

print render($content['dimensions']);
print render($content['weight']);
//print render($content['sell_price']);
print render($content['cost']);
//print render($content['list_price']);
print render($content['display_price']);
//print render($content['links']);
print render($content['uc_product_image']);
//print render($content['model']);
print render($content['body']);

print render($content['add_to_cart']);

print "<pre>";
print_r($node);
print "</pre>";
*/
$imgpath = $base_url."/sites/default/files/styles/product_image/public/".$node->uc_product_image['und'][0]['filename'];


$listprice = number_format($node->list_price, 2, '.', '');
$sellprice = number_format($node->sell_price, 2, '.', '');
?>

<?php //print render($content['uc_product_image']);?> 
<div class="product_detail">
<div class="field field-name-uc-product-image field-type-image field-label-above"><div class="field-label">Image:&nbsp;</div><div class="field-items"><div class="field-item even"><img width="" height="264" alt="" src="<?=$imgpath;?>" typeof="foaf:Image"></div></div></div>
<?php 
//print render($content['uc_product_image']);
print render($content['body']);
?>

<div class="product-info list-price"><span class="uc-price-label">Price:</span> <span class="uc-price">$<?=$listprice;?></span></div>
<div class="product-info sell-price"><span class="uc-price-label">Discounted Price:</span> <span class="uc-price">$<?=$sellprice;?></span></div>

<?php


//print render($content['list_price']);
//print render($content['sell_price']);

print render($content['add_to_cart']);

?>
</div>
<div class="related-product">
<?php 
			if(count($nids)>0)
			{
				print "<h3>Related Products</h3>";	
			?>
	
			<?php 
			if($loop>6)
				$loop=6;
			for($i=0; $i<$loop; $i++){
				$nodedetail = node_load($nids[$i]);
				$node_title = $nodedetail->title;
				$imgfile = $nodedetail->uc_product_image['und'][0]['filename'];


				
	
				$options = array('absolute' => TRUE);
				$nodepath = url('node/'.$nids[$i],$options);
				
				?>
                <div class="views-row-even">
				
				<span class="field-content"><?php print l($node_title,'node/'.$nids[$i]);?></span>
				<div class="pic"><a href="<?=$nodepath;?>"><img src="<?php print $base_url;?>/sites/default/files/styles/product_image/public/<?=$imgfile;?>" alt="" /></a></div>
				<?php //print render($content['add_to_cart']);?>
				
			</div>
                
				
				<?php
				

				}
			}	
			?>
 </div>       
<style type="text/css">
.product{
width:200px;
}
.product_detail {
    float: left;
    margin: 0 0 20px;
    width: 100%;
}
.views-row-even span {
    border-bottom: 2px solid #2475AD;
    color: #6B6969;
    float: left;
    font-size: 15px;
    font-weight: normal;
    padding: 0 0 10px;
    text-transform: uppercase;
    width: 100%;
}
.pic{
text-align: center;
}
</style>