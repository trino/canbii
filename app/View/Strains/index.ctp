<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<h1 class="title"><?php echo $strain['Strain']['name'];?></h1>
<div class="goto">
    <div class="left"><strong><img src="<?php echo $this->webroot;?>ra.png" height="50px" /></strong></div>
    <ul id="quick" class="left">        
        <li><a href="#" class="active">Overview</a></li>
        <li><a href="#">Avaibility</a></li>
        <li><a href="#">Reviews</a></li>
        <li><a href="#">Images</a></li>
    </ul>
    <div class="clear"></div>
</div>
<div class="maincontent">
    <div class="description">
    <strong>Description: </strong><?php
    echo $strain['Strain']['description'];
    ?>
    </div>
    <div class="leftcontent left">
        <strong>OVERALL RATING:</strong>
        <div class="rating">
        </div>
    </div>
    <div class="rightcontent right"></div>
    <div class="clear"></div>
</div>
<script>
$(function(){
$('.rating').raty({readOnly:true,score:<?php echo $strain['Strain']['rating'];?>})
});
</script>