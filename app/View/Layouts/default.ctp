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
    <link rel="stylesheet" href="<?php echo $this->webroot;?>css/ui.css" />
    <link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon"/>

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
					<li><a href="#" accesskey="3" title="">About Us</a></li>
					<li><a href="#" accesskey="4" title="">Contact Us</a></li>
					
				</ul>
                <ul class="right">
                <?php if(!$this->Session->read('User')){?>
                    <li><a href="<?php echo $this->webroot;?>users/register" accesskey="4" title="">Login</a></li>
					<li><a href="<?php echo $this->webroot;?>users/register" accesskey="5" title="">Register</a></li>
                <?php }else{ ?>
                    <li><a href="<?php echo $this->webroot;?>users/dashboard" accesskey="4" title="">Dashboard</a></li>
					<li><a href="<?php echo $this->webroot;?>users/logout" accesskey="5" title="">Logout</a></li>
                <?php }?>
                </ul>
                <div class="clear"></div>
			</div>
		</div>
	</div>
</div>
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
                <input type="text" placeholder="Title" name="key" />
                <select>
                    <option>Choose Effect</option>
                </select>
                <select class="second">
                    <option>Choose Symptom</option>
                </select>
                <div class="clear"></div>
            </div>
            <div class="right">
                <input type="checkbox" /> Indica<br />
                <input type="checkbox" /> Satica<br />
                <input type="checkbox" /> Hybrid<br />
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