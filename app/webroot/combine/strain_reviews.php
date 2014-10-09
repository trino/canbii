<p>Most Helpful</p>
<?php if($helpful || isset($show_all)){
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
<a href="javascript:void(0);" id="<?php echo $rand1.'_'.$helpful['Review']['id'];?>" class="btns yes" style="background-color: #40b2e2; padding-left:6px; padding-right:6px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">YES<?php if($helpful['Review']['helpful']){?> (<?php echo $helpful['Review']['helpful'];?>)<?php }?></strong></a>
<a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$helpful['Review']['id'];?>" style="background-color: #1e84c6; padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px"><strong style="color: white">NO<?php if($helpful['Review']['not_helpful']){?> (<?php echo $helpful['Review']['not_helpful'];?>)<?php }?></strong></a>
<?php }else{
    if($yes==1)
    {
        $y1 = 'padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px;background:#e5e5e5;cursor:default;';
        $y2 = 'color:#fff'; 
        $n1 = 'background:#FFF;color:#CCC;cursor: default;display:inline-block;padding:4px 7px;';
        $n2 = 'color:#CCC;';
    }
    else
    {
        $y1 = 'background:#FFF;color:#CCC;cursor: default;display:inline-block;padding:4px 7px;';
        $y2 = 'color:#CCC;';
        $n1 = 'padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px;background:#e5e5e5;cursor:default;';
        $n2 = 'color:#fff';
    }
    ?>
<a href="javascript:void(0);" id="" class="faded" style="<?php echo $y1;?>"><strong style="<?php echo $y2;?>">YES<?php if($helpful['Review']['helpful']){?> (<?php echo $helpful['Review']['helpful'];?>)<?php }?><strong></strong></a> <a class="faded" href="javascript:void(0);" id="" style="<?php echo $n1;?>"><strong style="<?php echo $n2;?>">NO<?php if($helpful['Review']['not_helpful']){?> (<?php echo $helpful['Review']['not_helpful'];?>)<?php }?></strong></a><?php }?>
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