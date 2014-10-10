<div class="page_left">

<div class="comments clearfix page_margin_top">
<div id="comments_list">
<ul>
<?php 
$j=0;
foreach($reviews as $review)
{
$j++;?>

<li class="comment clearfix">
<div class="comment_author_avatar">
&nbsp;
</div>

<div class="comment_details">
<div class="posted_by">
Reviewed by <a class="author" href="#" title="Jonh Doe">get user name </a> on <?php echo $review['Review']['on_date'];?>
</div>

<h3><?php echo $review['Strain']['name'];?></h3>

<div class="rating<?php echo $j;?> rat" style=""></div>
<script>
$(function(){    
$('.rating<?php echo $j;?>').raty({number:5,readOnly:true,score:<?php echo $review['Review']['rate'];?>});
});
</script>
<p>
<?php echo $review['Review']['review'];?>
</p>
<a class="more reply_button" href="#comment_form">
<a href="<?php echo $this->webroot;?>review/detail/<?php echo $review['Review']['id'];?>" class="more blue">View Detail →</a>
</a>
</div>
</li>
<?php }?>
</ul>
</div>
</div>

</div>