<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />




<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">Reviews for - <?php echo $strain['Strain']['name'];?></h1>
			<ul class="bread_crumb">
				<li>
					<a href="?page=home" title="Home">
						Home
					</a>
				</li>
				<li class="separator icon_small_arrow right_gray">
					&nbsp;
				</li>
				<li>
					Reviews for - <?php echo $strain['Strain']['name'];?>
				</li>
			</ul>
		</div>
		<div class="page_header_right">
			<!--form class="search">
				<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
			</form-->
		</div>
	</div>

	<div class="clearfix page_margin_top ">


	
<ul class="tabs_navigation2 clearfix" >
<li style=""><p>Sort By:</p></li>
<li>
<a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>/recent">Most Recent</a> 
	</li><li>
<a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>/helpful">Most Helpful</a>
	</li>
</ul>


		
<div class="comments clearfix page_margin_top">
<div id="comments_list">
<ul>




<?php
if($review)
{
    $i = 0;
    foreach($review as $r)
    {
        $i++;
        ?>

            <?php if($r){?>
			
			



		

<li class="comment clearfix">
<div class="comment_author_avatar">&nbsp;</div>

<div class="comment_details">
<div class="posted_by">
Reviewed by <a class="author" href="#" title="Jonh Doe">				
<?php echo $this->requestAction('/strains/getUserName/'.$r['Review']['user_id']);?>

</a> on <?php echo $r['Review']['on_date'];?>


</div>

<h3><?php echo $r['Strain']['name'];?></h3>



<?
$j=0;
?>
<div class="rates frate<?php echo $j;?>" style=""></div>
<script>
$(function(){
$('.frate<?php echo $j;?>').raty({readOnly:true,score:<?php echo $r['Review']['rate']/2;?>}); 
});
</script>

<p>
<?php echo $r['Review']['review'];?>
</p>

<?php 
$ip = $_SERVER['REMOTE_ADDR'];
$rand1 = rand(100,999);
$rand2 = rand(100,999);
$q5 = $vip->find('first',array('conditions'=>array('review_id'=>$r['Review']['id'],'ip'=>$ip)));

if($q5){$vote = 1;}else{$vote = 0;}
?>


Was this review helpful? <?php if($vote==0){?><a href="javascript:void(0);" id="<?php echo $rand1.'_'.$r['Review']['id'];?>" class="btns yes" style="background-color: #40b2e2; padding-left:6px; padding-right:6px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">YES</strong></a> <a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$r['Review']['id'];?>" style="background-color: #1e84c6; padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">NO</strong></a><?php }else{?><a href="javascript:void(0);" id="" class="faded">YES</a> <a class="faded" href="javascript:void(0);" id="">NO</a><?php }?>




</div>
</li>






<?php }?>




		

<?php
    }
}
?>

</ul>
</div>
</div>
		
		
		
		
		
</div>
</div>
<div class="clear"></div>
<script>
$(function(){
$('.rates img').each(function(){
    var src = $(this).attr('src');
    src = src.replace('../','<?php echo $this->webroot;?>');
    $(this).attr('src',src);
});

$('.yes').click(function(){
   var id = $(this).attr('id');
   var arr = id.split('_');
   var r_id = arr[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/yes',
   });
   $('#'+arr[0]+'_'+r_id).removeClass('yes');
   $('#'+arr[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+arr[0]+'_'+r_id).attr('onclick','return false;');
   var o = parseFloat(arr[0])+1;
   $('#'+o+'_'+r_id).removeClass('no');
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;display:inline-block;padding:8px 7px;'));
});
$('.no').click(function(){
   var id = $(this).attr('id');
   
   var arr2 = id.split('_');
   var r_id = arr2[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/no',
   });
   $('#'+arr2[0]+'_'+rid).removeClass('yes');
   var o = parseFloat(arr2[0])+1;
   $('#'+o+'_'+r_id).removeClass('no'); 
   $('#'+arr2[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;')
   $('#'+arr2[0]+'_'+r_id).attr('onclick','return false;');
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;display:inline-block;padding:8px 7px;'));
});
});
</script>