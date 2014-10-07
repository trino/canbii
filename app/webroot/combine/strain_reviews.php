<p>Most Helpful</p>
<?php if($helpful || $isset($show_all)){
// debug( $helpful);
?>

<div class="comments clearfix page_margin_top">
<div id="comments_list">
<ul>

<li class="comment clearfix">
<div class="comment_author_avatar">&nbsp;</div>

<div class="comment_details">
<div class="posted_by">
Reviewed by <a class="author" href="#" title="Jonh Doe"><?php echo $this->requestAction('/strains/getUserName/'.$helpful['Review']['user_id']);?></a> on <?php echo $helpful['Review']['on_date'];?>
</div>

<h3><?php echo $helpful['Strain']['name'];?></h3>
<?
$j=0;
?>
<div class="rating<?php echo $j;?> rat" style=""></div>
<script>
$(function(){    
$('.rating<?php echo $j;?>').raty({number:5,readOnly:true,score:<?php echo $helpful['Review']['rate'];?>});
});
</script>
<p>
<?php echo $helpful['Review']['review'];?>
</p>

<?php
$rand1 = rand(100,999);
$rand2 = rand(100,999);
?>

<p>
Was this review helpful? <?php if($vote==0){?>
<a href="javascript:void(0);" id="<?php echo $rand1.'_'.$helpful['Review']['id'];?>" class="btns yes" style="background-color: #40b2e2; padding-left:6px; padding-right:6px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">YES</strong></a>
<a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$helpful['Review']['id'];?>" style="background-color: #1e84c6; padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">NO</strong></a>
<?php }else{?>
<a href="javascript:void(0);" id="" class="faded">YES</a> <a class="faded" href="javascript:void(0);" id="">NO</a><?php }?>
</p>

<a class="more reply_button" href="#comment_form">
<a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>" class="viewall more blue martop25">All Reviews</a>
</a>

</div>
</li>

</ul>
</div>
</div>

<?php }?>