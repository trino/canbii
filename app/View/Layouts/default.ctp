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

<!--link href="<?php echo $this->webroot;?>font.css" rel="stylesheet" /-->



<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ui.css" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js2/jquery-1.11.0.min.js"></script>

<!--link href="<?php echo $this->webroot;?>default.css" rel="stylesheet" type="text/css" media="all" /-->
<!--link rel="stylesheet" href="<?php echo $this->webroot;?>source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" /-->


<!--script type="text/javascript" src="<?php echo $this->webroot;?>source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script-->


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
							<img src="<?php echo $this->webroot;?>images/header_logo.png" alt="logo" />
							<span class="logo">medical marijuana</span>
						</a>
					</div>
					
					<ul class="sf-menu header_right">
			

					<li class="current_page_item"><a href="<?php echo $this->webroot;?>" accesskey="1" title="">Home</a></li>
					<li><a href="<?php echo $this->webroot?>strains/all" accesskey="2" title="">Strains</a></li>
					<li><a href="<?php echo $this->webroot;?>pages/about_us" accesskey="3" title="">About Us</a></li>
					<li><a href="<?php echo $this->webroot;?>pages/contact_us" accesskey="4" title="">Contact Us</a></li>
					<?php if(!$this->Session->read('User')){?>
					<li><a href="<?php echo $this->webroot;?>users/register" accesskey="4" title="">Login / Register</a></li>
					<?php }else{?>
					<li class="submenu<?php echo (isset($_GET['page'])&& ($_GET["page"]=="" || $_GET["page"]=="home") ? " selected" : ""); ?>">
                        <a href="<?php echo $this->webroot;?>users/dashboard" accesskey="4" title=""><?=ucfirst($this->Session->read('User.username'))?> Dashboard</a>
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
    					<option value="<?php echo $this->webroot;?>pages/about_us" >About Us</option>
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


<div class="page">


	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?> 

</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////////// NEW SITE-->




<div class="footer_container">
				<div class="footer">
					<ul class="footer_banner_box_container clearfix">
						<li class="footer_banner_box super_light_blue animated_element animation-fadeIn duration-500">
							<h2>
								Say
							</h2>
							<p>
								<a class="icon_small_arrow right_white" href="#">Here in medicenter we have individual</a>
							</p>
						</li>
						<li class="footer_banner_box light_blue animated_element animation-slideRight duration-800 delay-500">
							<h2>
								Something
							</h2>
							<p>
								<a class="icon_small_arrow right_white" href="#">Here in medicenter we have individual</a>
							</p>
						</li>
						<li class="footer_banner_box blue animated_element animation-slideRight200 duration-800 delay-1000">
							<h2>
								Here
							</h2>
							<p>
								<a class="icon_small_arrow right_white" href="#">Here in medicenter we have individual</a>
							</p>
						</li>
						
					</ul>
					<div class="footer_box_container clearfix">
						<div class="footer_box">
							<h3 class="box_header">
								Medicenter Clinic
							</h3>
							<p class="info">
								Mauris adipiscing mauris fringilla turpis interdum sed pulvinar nisi malesuada individual.
							</p>
							<ul class="footer_contact_info_container clearfix">
								<li class="footer_contact_info_row">
									<div class="footer_contact_info_left">
										Medicenter Clinic
									</div>
								</li>
								<li class="footer_contact_info_row">
									<div class="footer_contact_info_left">
										33 Farlane Street
									</div>
									<div class="footer_contact_info_right">
										+123 655 655
									</div>
								</li>
								<li class="footer_contact_info_row">
									<div class="footer_contact_info_left">
										Keilor East
									</div>
									<div class="footer_contact_info_right">
										+123 755 755
									</div>
								</li>
								<li class="footer_contact_info_row">
									<div class="footer_contact_info_left">
										VIC 3033, Australia
									</div>
									<div class="footer_contact_info_right">
										<a href="mailto:medicenter@mail.com" title="Send Email">
											medicenter@mail.com
										</a>
									</div>
								</li>
							</ul>
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
									<a class="social_icon googleplus" href="#" title="">
										&nbsp;
									</a>
								</li>
								<li>
									<a class="social_icon mail" href="mailto:medicenter@mail.com" title="">
										&nbsp;
									</a>
								</li>
							</ul>
						</div>
						<div class="footer_box">
							<div class="clearfix">
								<div class="header_left">
									<h3 class="box_header">
										Latest Posts
									</h3>
								</div>
								<div class="header_right">
									<a href="#" id="footer_recent_posts_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
									<a href="#" id="footer_recent_posts_next" class="scrolling_list_control_right icon_small_arrow right_white"></a>
								</div>
							</div>
							<div class="scrolling_list_wrapper">
								<ul class="scrolling_list footer_recent_posts">
									<li class="icon_small_arrow right_white">
										<a href="?page=post">
											Mauris adipiscing mauris fringilla turpis interdum sed pulvinar nisi malesuada.
										</a>
										<abbr title="29 May 2012" class="timeago">29 May 2012</abbr>
									</li>
									<li class="icon_small_arrow right_white">
										<a href="?page=post">
											Lorem ipsum dolor sit amat velum.
										</a>
										<abbr title="04 Apr 2012" class="timeago">04 Apr 2012</abbr>
									</li>
									<li class="icon_small_arrow right_white">
										<a href="?page=post">
											Mauris adipiscing mauris fringilla turpis interdum sed pulvinar nisi malesuada.
										</a>
										<abbr title="02 Feb 2012" class="timeago">02 Feb 2012</abbr>
									</li>
									<li class="icon_small_arrow right_white">
										<a href="?page=post">
											Lorem ipsum dolor sit amat velum, consectetur adipiscing elit.
										</a>
										<abbr title="24 Jan 2011" class="timeago">24 Jan 2011</abbr>
									</li>
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
									<a href="#" id="latest_tweets_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
									<a href="#" id="latest_tweets_next" class="scrolling_list_control_right icon_small_arrow right_white"></a>
								</div>
							</div>
							<div class="scrolling_list_wrapper">

							</div>
						</div>
					</div>
					<div class="copyright_area clearfix">
						<div class="copyright_left">
							© Copyright - <a href="http://themeforest.net/item/medicenter-responsive-medical-health-template/4000598?ref=QuanticaLabs" title="MediCenter Template" target="_blank">MediCenter Template</a> by <a href="http://quanticalabs.com" title="QuanticaLabs" target="_blank">QuanticaLabs</a>
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




<?php //echo $this->Session->flash(); ?>
<?php //echo $this->fetch('content'); ?>  
<?php echo $this->element('sql_dump'); ?>            