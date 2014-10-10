<?php if($this->params['action']=='review'){
    //echo $this->params['action'];?>
<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<div class="page_layout page_margin_top clearfix">
<div class="page_header clearfix">
<div class="page_header_left">
<h1 class="page_title"><?php if(!isset($_GET['user'])){?>My Reviews<?php }else{?>Reviewed By: <?php echo $this->requestAction('/strains/getUserName/'.$_GET['user']);?><?php  }?></h1>
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
User Reviews
</li>
</ul>
</div>
<div class="page_header_right">
<!--form class="search">
<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
</form-->
</div>
</div>
<?php }?>
<div class="clearfix page_margin_top revi">

<?php include_once('combine/my_reviews.php');?>




<?php
if(!isset($_GET['user']))
{
    ?>
    
<div class="page_right page_margin_top">

<a style="width:120px;float:right;" title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class=" more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>

<div class="clear"></div>
<a style="width:120px;float:right;"  title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">Settings</a>

<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top">Add Review</a>

<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top active">My Reviews</a>

</div>
<?php
}
?>

</div>
</div>
<?php if($this->params['action']=='review'){
    //echo $this->params['action'];?>
<script>
$(function(){
    var more='<?php echo $limit?>';    
    var spinnerVisible = false; 
    var sort='<?php echo(isset($this->params['pass'][1]) && $this->params['pass'][1]!="")?$this->params['pass'][1]:"recent";?>';    
    $('.loadmore a').live('click',function(){
        more=parseFloat(more)+4;
        var val = '';
        var user = '<?php echo (isset($_GET['user']))?$_GET['user']:"";?>';
        if(user !="")
        {  
            user = "?user="+user;
        }
        else
            user = "";
        var i=0;
       $.ajax({
           url:'<?php echo $this->webroot;?>strains/review_filter/<?php echo $slug;?>/'+sort+'/'+more+user,
           data:val,
           type:'get',
           success:function(res){
             if (spinnerVisible) {
        var spinner = $("div#spinner");
        spinner.stop();
        spinner.fadeOut("fast");
        spinnerVisible = false;
    }
            $('.morelist').show();
            $('.morelist').addClass('morelist2');
            $('.morelist2').removeClass('morelist');
            $('.morelist2').html(res);
            $('.morelist2').removeClass('morelist2');
           } 
        });
    });
$('.rates img').each(function(){
    var src = $(this).attr('src');
    src = src.replace('../','<?php echo $this->webroot;?>');
    $(this).attr('src',src);
});
})
</script>
<?php }?>