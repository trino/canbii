<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="Medic, Medical Center" />
<meta name="description" content="Responsive Medical Health Template" />

<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon"/>
<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon"/>

<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ui.css" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery-1.11.0.min.js"></script>



<script src="<?php echo $this->webroot;?>js/validate.js"></script>
<script src="<?php echo $this->webroot;?>js/ui.js"></script>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Volkhov:400italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/superfish.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/fancybox/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/jquery-ui-1.9.2.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>style2/animations.css" />


<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.ba-bbq.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.carouFredSel-5.6.4-packed.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.sliderControl.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.timeago.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.hint.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.isotope.masonry.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery.blockUI.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/main.js"></script>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->

</head>
<body>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->

		<div class="site_container">
			<div class="header_container">
				<div class="header clearfix">
					<div class="header_left">
						<a href="<?php echo $this->webroot;?>" title="MEDICALMARIJUANA">
							<img src="<?php echo $this->webroot;?>images/logo.png" height=100 alt="logo" />
							
							
						</a>
					</div>
					
					<ul class="sf-menu header_right">
			

					<li class="current_page_item"><a href="<?php echo $this->webroot;?>" accesskey="1" title="">Home</a></li>
					<li><a href="<?php echo $this->webroot?>strains/all" accesskey="2" title="">Strains</a></li>
					<li><a href="<?php echo $this->webroot;?>pages/about" accesskey="3" title="">About</a></li>
					<li><a href="<?php echo $this->webroot;?>pages/contact_us" accesskey="4" title="">Contact Us</a></li>
					<?php if(!$this->Session->read('User')){?>
					<li><a href="<?php echo $this->webroot;?>users/register" accesskey="4" title="">Login / Register</a></li>
					<?php }else{?>
					<li class="submenu<?php echo (isset($_GET['page'])&& ($_GET["page"]=="" || $_GET["page"]=="home") ? " selected" : ""); ?>">
                        <a href="<?php echo $this->webroot;?>users/dashboard" accesskey="4" title=""><?=ucfirst($this->Session->read('User.username'))?></a>
						<ul>
                            <li<?php echo (isset($_GET['page'])&&$_GET["page"]=="home" ? " class='selected'" : ""); ?>>
                            <a href="<?php echo $this->webroot;?>users/logout" accesskey="5" title="">Logout</a>
							</li>

						</ul>
					</li>
				
					<?php }?>
					</ul>
                    <div class="mobile_menu">
    	               <select> 
                        <option value="<?php echo $this->webroot?>">Home</option>
                        <option value="<?php echo $this->webroot?>strains/all" >Strains</option>
    					<option value="<?php echo $this->webroot;?>pages/about" >About</option>
    					<option value="<?php echo $this->webroot;?>pages/contact_us" >Contact Us</option>
    					<?php if(!$this->Session->read('User')){?>
    					<option value="<?php echo $this->webroot;?>users/register" >Login / Register</option>
    					<?php }else{?>
    					<option value="<?php echo $this->webroot;?>users/dashboard" ><?=ucfirst($this->Session->read('User.username'))?> Dashboard</option>
						<option value="<?php echo $this->webroot;?>users/logout" >Logout</option>
						<?php }?>	
                       </select>
                    </div>

				</div>
			</div>

			<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->




<!-- can you create a separate page for the following and include here? -->

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

<?if(isset($homepage)){?>

<div style="height:100%; background-image: url(http://localhost/marijuana/images/bg4.jpg);text-shadow: 0px 1px 0px rgba(0,0,0,1);padding:20px 0px;">




<div class="page" style="border-top:0;padding-bottom:0px;
">
<div class=" clearfix" style="
background: #000;
background: rgba(0,0,0,0.7);
border-radius: 3px;
margin: 0 auto;
padding:30px;
">




			<!--h1 id="H1_4">
				The Personalized Medical Marijuana Database
			</h1>
			<p id="P_5">
				for <a href="/category/site-templates" id="A_6">HTML</a>, <a href="/category/marketing/email-templates" id="A_6">Email</a>, <a href="/category/wordpress" id="A_6">WordPress</a>, <a href="/category/psd-templates" id="A_6">PSD</a>, <a href="/category/cms-themes/joomla" id="A_6">Joomla</a>, <a href="/category/ecommerce/magento" id="A_6">Magento</a> and more
			</p>
			
						<div id="DIV_18">
				 <a href="/page/top_sellers" id="A_19">Browse Popular Items</a> <a href="/category/all" id="A_20">Browse Latest Items</a>
			</div-->

<h1 id="H1_4">The Personalized Medical Marijuana Database</h1>

<form  id="FORM_13" class="contact_form" action="<?php echo $this->webroot;?>strains/search" method="get" id="search" style="">

<p id="P_5">
filter by symptoms:
<?php $effect = $this->requestAction('/pages/getSym');
foreach($effect as $e)
{
?>
<a class="A_6" style="" href="javascript:void(0)" onclick="highlightsym($(this))" class=""  id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
<?php
}
?>
or <a class="A_6" href="">view more</a>
</p>

<p id="P_5">
filter by effects:
<?php $effect = $this->requestAction('/pages/getEff');
foreach($effect as $e)
{
?>
<a  href="javascript:void(0)" class="A_6" onclick="highlighteff($(this))" id="eff_<?php echo $e['Effect']['id'];?>"><?php echo $e['Effect']['title']?></a>
</a>
<?php
}
?>
or <a class="A_6" href="">view more</a>
</p>

<p style="display: none;" class="effe"></p>
<p style="display: none;" class="symp"></p>

<div class="main2">
<div class="div12"><input  id="INPUT_16"  type="text" placeholder="Search by name" name="key" class="key" style=""/>
<input  id="BUTTON_17" type="submit" value="Search" class="more blue medium " style="" />
</div>
</div>


<!-- dont know why but this div needs to be here -->
<div style="float:left;"></div>


</form>



</div>




			
			
</div>
</div>

<?}?>
	
<div class="page clearfix">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?> 
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->


<div class="footer_container">
				<div class="footer">
					<ul class="footer_banner_box_container clearfix">
						<li class="footer_banner_box super_light_blue animated_element animation-fadeIn duration-500">
							<h2>
								Why Go Natural?
							</h2>
							<p style="color: white;margin-bottom:20px;">
								 <a href="<?php echo $this->webroot;?>pages/about" title="">The guide to Medical Marijuana &raquo;</a>
							</p>
						</li>
						<li class="footer_banner_box light_blue animated_element animation-slideRight duration-800 delay-500">
							<h2>
								Featured Strains
							</h2><p>
							<div style="float: left; width:33%; color: white">
							Jack Herer
							</div>
							<div style="float: left; width:33%; color: white">
							Sour Diesel
							</div>
							<div style="float: left; width:33%; color: white">
							Blue Dream
							</div></p>
						</li>
						<li class="footer_banner_box blue animated_element animation-slideRight200 duration-800 delay-1000">
							<h2>
								Questions or Concerns?
							</h2>
							<p>
								 <a href="<?php echo $this->webroot;?>pages/contact_us" title="">Feel free to contact us by clicking here  &raquo;</a>
							</p>
						</li>
						
					</ul>
					<div class="footer_box_container clearfix">
						<div class="footer_box">
							<h3 class="box_header">
								canbii
							</h3>
							<p class="info">
								Medicinal marijuana is a growing movement and we're doing our part to spread the word.(name of site) is an online database dedicated to educate the public on the benefits of medical marijuana. This all natural plant is used to treat illnesses and to help those who suffer from chronic pain that affects their daily lives.<br />
								<br />
								We need your input to enhance our information so we can help as many people as we can. <a href="<?php echo $this->webroot;?>users/register" accesskey="4" title="">Sign up</a> today!
							</p>
							<ul class="social_icons clearfix">
								<li>
									<a class="social_icon facebook" href="http://facebook.com/QuanticaLabs" title="" target="_blank">
										&nbsp;
									</a>
								</li>
								<li>
									<a class="social_icon twitter" href="https://twitter.com/QuanticaLabs" title="" target="_blank">
										&nbsp;
									</a>
								</li>
								<li>
									<a class="social_icon mail" href="mailto:info@canbii.com" title="">
										&nbsp;
									</a>
								</li>
							</ul>
						</div>
						<div class="footer_box">
							<div class="clearfix">
								<div class="header_left">
									<h3 class="box_header">
										Latest Reviews
									</h3>
								</div>
								<div class="header_right">
									<a href="#" id="footer_recent_posts_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
									<a href="#" id="footer_recent_posts_next" class="scrolling_list_control_right icon_small_arrow right_white"></a>
								</div>
							</div>
							<div class="scrolling_list_wrapper">
							
							
							



								<ul class="scrolling_list footer_recent_posts">
								
								
								<?
								
$strains = $this->requestAction('pages/get_strain');								
if($strains)
{
?>

<?php
foreach($strains as $s)
{
?>

				<li class="icon_small_arrow right_white">
										<a href="?page=post">
										<b><?php echo $s['Strain']['name'];?></b><br>

<?php echo substr($s['Strain']['description'],0,80) . '...';?>

										</a>
<abbr title="" class="timeago"><?php echo $s['Strain']['published_date'];?></abbr>
									</li>
									
									
									
<?php
}
}
?>
								
								
								
					
	
								</ul>
							</div>
						</div>
						<div class="footer_box last">
							<div class="clearfix">
								<div class="header_left">
									<h3 class="box_header">
										Latest Tweets
									</h3>
								</div>
								<div class="header_right">
									<!--a href="#" id="latest_tweets_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
									<a href="#" id="latest_tweets_next" class="scrolling_list_control_right icon_small_arrow right_white"></a-->
								</div>
							</div>
							<div class="scrolling_list_wrapper">


<a class="twitter-timeline"   data-chrome="noborders"  href="https://twitter.com/canbiionline" data-widget-id="511869655112114176">Tweets by @canbiionline</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div>
						</div>
					</div>
					<div class="copyright_area clearfix">
						<div class="copyright_left">
							© Copyright 2014 - <a href="" title="canbii" target="_blank">canbii</a> 
						</div>
						<div class="copyright_right">
							<a class="scroll_top icon_small_arrow top_white" href="#top" title="Scroll to top">Top</a>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->

<?php echo $this->element('sql_dump'); ?>            