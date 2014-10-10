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
Reviewed by <a class="author" href="<?php echo $this->webroot;?>strains/review/all?user=<?php echo $r['Review']['user_id'];?>" title="Jonh Doe">				
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

if($q5){$vote = 1;$yes = $q5['VoteIp']['vote_yes'];}else{$vote = 0;}
?>


Was this review helpful?<br /><br /> 
<?php if($vote==0){?>
    <a href="javascript:void(0);" id="<?php echo $rand1.'_'.$r['Review']['id'];?>" class="btns yes" style="background-color: #40b2e2; padding-left:6px; padding-right:6px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">YES<?php if($r['Review']['helpful']){?> (<?php echo $r['Review']['helpful'];?>)<?php }?></strong></a> <a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$r['Review']['id'];?>" style="background-color: #1e84c6; padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">NO<?php if($r['Review']['not_helpful']){?> (<?php echo $r['Review']['not_helpful'];?>)<?php }?></strong></a>
<?php }else{
    if($yes==1)
    {
        $y1 = 'padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px;background:#e5e5e5;cursor:default;';
        $y2 = 'color:#fff'; 
        $n1 = 'background:#FFF;color:#CCC;cursor: default;padding:4px 7px;';
        $n2 = 'color:#CCC;';
    }
    else
    {
        $y1 = 'background:#FFF;color:#CCC;cursor: default;padding:4px 7px;';
        $y2 = 'color:#CCC;';
        $n1 = 'padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px;background:#e5e5e5;cursor:default;';
        $n2 = 'color:#fff';
    }
    ?>
    <a href="javascript:void(0);" id="" class="faded" style="<?php echo $y1;?>"><strong style="<?php echo $y2;?>">YES<?php if($r['Review']['helpful']){?> (<?php echo $r['Review']['helpful'];?>)<?php }?></strong></a> <a class="faded" href="javascript:void(0);" id="" style="<?php echo $n1;?>"><strong style="<?php echo $n2;?>">NO<?php if($r['Review']['not_helpful']){?> (<?php echo $r['Review']['not_helpful'];?>)<?php }?></strong></a>
<?php }?>




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
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;display:inline-block;padding:8px 7px;');
   $('#'+o+'_'+r_id+' strong').attr('style','color:#CCC;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;display:inline-block;padding:8px 7px;'));
});
$('.no').click(function(){
   var id = $(this).attr('id');
   
   var arr2 = id.split('_');
   var num = parseFloat(arr2[0]-1);
   var r_id = arr2[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/no',
   });
   $('#'+num+'_'+r_id).removeClass('yes');
   var o = parseFloat(num)+1;
   $('#'+o+'_'+r_id).removeClass('no'); 
   $('#'+num+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;display:inline-block;padding:8px 7px;')
   $('#'+num+'_'+r_id+' strong').attr('style','color:#CCC;');
   //$('#'+num+'_'+r_id).attr('onclick','return false;');
   //$('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   //$('#'+o+'_'+r_id).attr('onclick','return false;'); 
   $(this).attr('style','background:#e5e5e5;display:inline-block;padding:8px 7px;color:#CCC;cursor: default;');
});
});
</script>