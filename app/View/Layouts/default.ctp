<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Cerulean 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20131223

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo $this->webroot;?>font.css" rel="stylesheet" />
<link href="<?php echo $this->webroot;?>css/style.css" rel="stylesheet" />
<link href="<?php echo $this->webroot;?>default.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo $this->webroot;?>fonts.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo $this->webroot;?>js/validate.js"></script>
    <script src="<?php echo $this->webroot;?>js/ui.js"></script>
    <!--<script src="<?php echo $this->webroot;?>my.js"></script>-->
    <link rel="stylesheet" href="<?php echo $this->webroot;?>css/ui.css" />
    <link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon"/>
    
    
    <link rel="stylesheet" href="<?php echo $this->webroot;?>source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $this->webroot;?>source/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <link rel="stylesheet" href="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><span class="icon logo"></span><a href="#">Marijuana</a></h1>
			<div id="menu">
				<ul class="left">
					<li class="current_page_item"><a href="<?php echo $this->webroot;?>" accesskey="1" title="">Home</a></li>
					<li><a href="<?php echo $this->webroot?>strains/all" accesskey="2" title="">Strains</a></li>
					<li><a href="<?php echo $this->webroot;?>pages/about_us" accesskey="3" title="">About Us</a></li>
					<li><a href="<?php echo $this->webroot;?>pages/contact_us" accesskey="4" title="">Contact Us</a></li>
					
				</ul>
                <ul class="right">
                <?php if(!$this->Session->read('User')){?>
                    <li><a href="<?php echo $this->webroot;?>users/register" accesskey="4" title="">Login</a></li>
					<li><a href="<?php echo $this->webroot;?>users/register" accesskey="5" title="">Register</a></li>
                <?php }else{ 
                        echo "<strong> Welcome, ".ucfirst($this->Session->read('User.username'))."</strong>";?>
                    <li><a href="<?php echo $this->webroot;?>users/dashboard" accesskey="4" title="">Dashboard</a></li>
					<li><a href="<?php echo $this->webroot;?>users/logout" accesskey="5" title="">Logout</a></li>
                <?php }?>
                </ul>
                <div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<script>
var spinnerVisible = false;
function showProgress() {
    if (!spinnerVisible) {
        $("div#spinner").fadeIn("fast");
        spinnerVisible = true;
    }
};
function hideProgress() {
    if (spinnerVisible) {
        var spinner = $("div#spinner");
        spinner.stop();
        spinner.fadeOut("fast");
        spinnerVisible = false;
    }
};
function highlighteff(thiss){
if(thiss.attr('class').replace('searchact','')==thiss.attr('class'))
{
    thiss.addClass('searchact');
    $('.effe').append('<input type="hidden" name="effects[]" value="'+thiss.attr('id').replace('eff_','')+'" class="'+thiss.attr('id')+'"  />')}else{thiss.removeClass('searchact')
   
        $('.'+thiss.attr('id')).remove();
    }
    $('.key').val('');
}
function highlightsym(thiss){
if(thiss.attr('class').replace('searchact','')==thiss.attr('class'))
{
    thiss.addClass('searchact');
    $('.symp').append('<input type="hidden" name="symptoms[]" value="'+thiss.attr('id').replace('sym_','')+'" class="'+thiss.attr('id')+'"  />')}else{thiss.removeClass('searchact')
    
        $('.'+thiss.attr('id')).remove();
    }
    $('.key').val('');
}
function highlighteff2(thiss,order=null){

    
    
    if(thiss!='recent' && thiss!='rated' && thiss!='alpha' && thiss!='viewed' && thiss!='reviewed'){
        var sort =0;
if(thiss.attr('class').replace('searchact','')==thiss.attr('class'))
{
        
    thiss.addClass('searchact');
    $('.effe').append('<input type="hidden" name="effects[]" value="'+thiss.attr('id').replace('eff_','')+'" class="effs '+thiss.attr('id')+'"  />')}else{thiss.removeClass('searchact')
   
        $('.'+thiss.attr('id')).remove();
    }
    $('.key').val('');}
    else
    var sort = 1;
    showProgress();
        var i=0;
        var val = '';
       $('.effs').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'effects[]='+$(this).val();
        else
            val = val+'&effects[]='+$(this).val();
            }
                
       });
       $('.symps').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'symptoms[]='+$(this).val();
        else
            val = val+'&symptoms[]='+$(this).val();  
            }       
    });
    if(val){
        val = val+'&key=';
        }
        else
        val = 'key=';
        if(sort)
        {
            val = val+'&sort='+thiss+'&order='+order;
        }
         
        
        $.ajax({
           url:'filter',
           data:val,
           type:'get',
           success:function(res){
            hideProgress();
            $('.listing').html(res);
           } 
        });
}
function highlightsym2(thiss){
if(thiss.attr('class').replace('searchact','')==thiss.attr('class'))
{
    thiss.addClass('searchact');
    $('.symp').append('<input type="hidden" name="symptoms[]" value="'+thiss.attr('id').replace('sym_','')+'" class="symps '+thiss.attr('id')+'"  />')}else{thiss.removeClass('searchact')
    
        $('.'+thiss.attr('id')).remove();
    }
    $('.key').val('');
    showProgress();
        var i=0;
        var val = '';
       $('.effs').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'effects[]='+$(this).val();
        else
            val = val+'&effects[]='+$(this).val();
            }
                
       });
       $('.symps').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'symptoms[]='+$(this).val();
        else
            val = val+'&symptoms[]='+$(this).val();  
            }       
    });
    if(val)
        val = val+'&key=';
        else
        val = 'key='; 
        $.ajax({
           url:'filter',
           data:val,
           type:'get',
           success:function(res){
            hideProgress();
            $('.listing').html(res);
           } 
        });    
}
</script>
<?php
if($this->params['controller'] == 'pages' && $this->params['action'] == 'index')
{
?>
<div id="page-wrapper">
	<div id="page" class="container">
		<div class="title">
			<h2>Search Strains</h2>
		</div>
		<p>
            <form action="<?php echo $this->webroot;?>strains/search" method="get" id="search">
            <div class="left">
                <input type="text" placeholder="Title" name="key" class="key" /><br />
                
                <center><strong>OR</strong></center>
                
                <a href="javascript:void(0);" onclick="$('.choose_eff').toggle();" class="block-btn">Choose Effect</a>
                <div class="choose_eff" style="display: none;">
                <?php $effect = $this->requestAction('/pages/getEff');
                foreach($effect as $e)
                {
                    ?>
                    <a href="javascript:void(0)" class="small-btn" onclick="highlighteff($(this))" id="eff_<?php echo $e['Effect']['id'];?>"><?php echo $e['Effect']['title']?></a>
                    <?php
                }
                ?>
                <p style="display: none;" class="effe"></p>
                </div>
                
                <a href="javascript:void(0);" onclick="$('.choose_sym').toggle();" class="block-btn">Choose Symptom</a>
                <div class="choose_sym" style="display: none;">
                <?php $effect = $this->requestAction('/pages/getSym');
                foreach($effect as $e)
                {
                    ?>
                    <a href="javascript:void(0)" onclick="highlightsym($(this))" class="small-btn" id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
                    <?php
                }
                ?>
                <p style="display: none;" class="symp"></p>
                </div>
                
                <div class="clear"></div>
            </div>
            
            <div class="clear"></div>   
            <div class="clear"></div>
                <input type="submit" value="Search" class="button" />
            </form>
        </p>
	</div>
</div>
<?php
}
?>
<div class="wrapper">
	<div id="page" class="container">
	<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?> 
    </div>
</div>
<?php
if($this->params['controller'] == 'pages' && $this->params['action'] == 'index')
{
?>
<div id="wrapper2">
	<div id="tools">
		<div class="title">
			<h2>Vivamus fermentum nibh</h2>
		</div>
		<ul class="tools">
			<li><a href="#" class="icon icon-legal"></a></li>
			<li><a href="#" class="icon icon-random"></a></li>
			<li><a href="#" class="icon icon-key"></a></li>
			<li><a href="#" class="icon icon-wrench"></a></li>
			<li><a href="#" class="icon icon-cut"></a></li>
			<li><a href="#" class="icon icon-filter"></a></li>
			<li><a href="#" class="icon icon-lock"></a></li>
		</ul>
	
	</div>
</div>
<?php
}
?>
<div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
		<ul class="contact">
			<li><a href="#" class="icon icon-twitter"><span>Twitter</span></a></li>
			<li><a href="#" class="icon icon-facebook"><span></span></a></li>
			<li><a href="#" class="icon icon-dribbble"><span>Pinterest</span></a></li>
			<li><a href="#" class="icon icon-tumblr"><span>Google+</span></a></li>
			<li><a href="#" class="icon icon-rss"><span>Pinterest</span></a></li>
		</ul>
</div>
</body>
</html>
<?php //echo $this->Session->flash(); ?>
			<?php //echo $this->fetch('content'); ?>  
<?php echo $this->element('sql_dump'); ?>            