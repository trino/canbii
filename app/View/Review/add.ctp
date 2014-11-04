<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
		
		
		
		
		
		
<?php
// unset($strain_hexagon);
if(isset($strain)){
$strain_hexagon = $strain;
}else{$strain_hexagon = $review;
}

include('combine/hexagon.php');?>

<?php if($this->params['action']=='add'){?>
<div style="float:left;margin-left:10px;">

<h1 class="page_title" style="">
<?=$strain_name?> Review
</h1>
<p>
<?php
switch ($strain['Strain']['type_id']) {
    case 1:
        echo "Indica";
        break;
    case 2:
        echo "Sativa";
        break;
    case 3:
        echo "Hybrid";
        break;
}
?> Cannabis
</p>
</div>

<?php }else{?>

<div style="float:left;">
<h1 class="page_title" style="">
<?php echo ucfirst($review['Strain']['name']);?> Review
</h1>
<p style="clear:both;">Reviewed on 
<?php echo $review['Review']['on_date'];?> by <?php echo $this->requestAction('/strains/getUserName/'.$review['Review']['user_id']);?>
</p>

</div>

<?php }?>


</div>
		<div class="page_header_right">
			<!--form class="search">
				<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
			</form-->
		</div>
	</div>

	<div class="clearfix page_margin_top ">

<!--a title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>
<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="active more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Review</a>
<div class="clearfix"></div-->



<div class="page_left page_margin_top">
<?php if($this->params['action']=='add'){?>
<div class="backgroundcolor"><p>Please be as precise as possible so we can further help personalize medication for other users. We thank you for your help and support.</p></div> 
<?php }?>

<form class="page_margin_top" action="" method="post" id="reviews1" >

<fieldset id="qf_review__general" class="qf-fieldset">

<h2 class="slide">
General Rating
</h2>
<div class="backgroundcolor">
<h3>Effect Scale (Active to Sedative)</h3>
        <p id="qf_review__general__mscale__prompt">
            <?php if($this->params['action']=='add'){?>
                Extremely Active
            <?php }else{
                    $typ = array('','Extremely Active','Very Active','Active','Bit Active','Balanced','Bit Sedated','Sedated','Very Sedated','Extemely Sedated');
                    echo $typ[$review['Review']['eff_scale']];
             } ?>
        </p>
        <div>
            <input id="qf_review__general__mscale" class="qf-hidden-input qf-slider qf-input" type="hidden" name="eff_scale" value="1" title="Effect Scale (Active to Sedative)"/>
        </div>
        <div id="qf_review__general__mscale__slider" class="qf-slider-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
        </div>

<h3>Effect Strength</h3>
        <p id="qf_review__general__strength__prompt">
           <?php if($this->params['action']=='add')echo  '1'; else if(isset($review))echo $review['Review']['eff_strength'];?>/5
        </p>
    <div>
        <input id="qf_review__general__strength" class="qf-hidden-input qf-slider qf-input" type="hidden" name="eff_strength" value="1" title="Effect Strength">
    </div>
    <div id="qf_review__general__strength__slider" class="qf-slider-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
    </div>
<h3>Effect Duration</h3>
    <p id="qf_review__general__duration__prompt"><?php if($this->params['action']=='add')echo '1 hr'; else $review['Review']['eff_duration']." hrs";?></p>
    <div>
        <input id="qf_review__general__duration" class="qf-hidden-input qf-slider qf-input" type="hidden" name="eff_duration" value="1" title="Effect Duration">
    </div>
    <div id="qf_review__general__duration__slider" class="qf-slider-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
    </div>

</div>
</fieldset>

<div class="clear"> </div>

<fieldset id="qf_review__effects" class="qf-fieldset">

<h2 class="slide page_margin_top">
Effects Rating
</h2>

<div class="backgroundcolor">

<h3>
Medicinal Effects
</h3>

<p>How well did this strain help your medical condition(s)?</p>

<span id="qf_review__effects__medical__inner">
<?php 
if($this->params['action']=='add'){
    foreach($symptoms as $effect)
    {
    ?>
    <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel');" title="<?php echo $effect['Symptom']['id'];?>" class="eff3 btn qf_review__effects__medical"><?php echo ucfirst($effect['Symptom']['title']);?></a>
    <?php
    }
}
else
{
    foreach($review['SymptomRating'] as $effect)
    {?> 
     <div id="efft_<?php echo $effect['id'];?>er" class="review-slider"><label><?php echo $symptoms[$effect['symptom_id']-1]['Symptom']['title'];?></label>
     <div  id="<?php echo $effect['id'];?>er"></div><p><?php echo $effect['rate'];?>/5</p><div class="clear"> </div></div>   
    <script>
    $(function(){
        $('#<?php echo $effect['id'];?>er').slider({
    			range: "min",
                disabled: true,
    			value: <?php echo $effect['rate'];?>,
    			min: 0,
    			max: 5,
    			slide: function( event, ui ) {
    				$('#'+id+'p').html(''+ui.value+'/5');
    				$('#'+id+'i').val(ui.value);
    			}
    		});
            });
    </script>
<?php }

}
?>
</span>

<div class="clear"></div>
<div style="border-bottom: 1px solid #dadada;margin:10px 0;"></div>

<h3>
Positive Effects
</h3>

<p>What positive effect(s) did this strain have on you?</p>

<span id="qf_review__effects__positive__inner">
<?php 
if($this->params['action']=='add')
{
    foreach($effects as $effect)
    {?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="eff3 btn qf_review__effects__positive"><?php echo ucfirst($effect['Effect']['title']);?></a>
    <?php 
    }
}
else
{
    $pos = array(); 
foreach($effects as $e)
{
    array_push($pos,$e['Effect']['id']);
}

foreach($review['EffectRating'] as $effect)
{
    if(in_array($effect['effect_id'],$pos)){?> 
     <div id="efft_<?php echo $effect['id'];?>pe" class="review-slider"><label><?php echo $effects[$effect['effect_id']-1]['Effect']['title'];?></label>
     <div  id="<?php echo $effect['id'];?>pe"></div><p><?php echo $effect['rate'];?>/5</p><div class="clear"> </div></div>   
    <script>
        $('#<?php echo $effect['id'];?>pe').slider({
    			range: "min",
                disabled: true,
    			value: <?php echo $effect['rate'];?>,
    			min: 0,
    			max: 5,
    			slide: function( event, ui ) {
    				$('#'+id+'p').html(''+ui.value+'/5');
    				$('#'+id+'i').val(ui.value);
    			}
    		});
    </script>
    <?php }
}
}
?>
</span>
<div style="border-bottom: 1px solid #dadada;margin:10px 0;"></div>

<h3>
Negative Effects
</h3>

<p>What negative effect(s) did this strain have on you?</p>

<span id="qf_review__effects__negative__inner">

<?php 
if($this->params['action'] == 'add')
{
    foreach($negative as $effect)
    {?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="eff3 btn btn-info qf_review__effects__negative"><?php echo ucfirst($effect['Effect']['title']);?></a>
    <?php 
    }
}
else
{
    $pos = array(); 
    foreach($negative as $e)
    {
        array_push($pos,$e['Effect']['id']);
    }
    
    foreach($review['EffectRating'] as $effect)
    {
        if(in_array($effect['effect_id'],$pos)){?> 
         <div id="efft_<?php echo $effect['id'];?>ne" class="review-slider"><label><?php echo $effectz[$effect['effect_id']-1]['Effect']['title'];?></label>
         <div  id="<?php echo $effect['id'];?>ne"></div><p><?php echo $effect['rate'];?>/5</p><div class="clear"> </div></div>   
        <script>
            $('#<?php echo $effect['id'];?>ne').slider({
        			range: "min",
                    disabled: true,
        			value: <?php echo $effect['rate'];?>,
        			min: 0,
        			max: 5,
        			slide: function( event, ui ) {
        				$('#'+id+'p').html(''+ui.value+'/5');
        				$('#'+id+'i').val(ui.value);
        			}
        		});
        </script>
        <?php }
    }
}
?>

</span>
</div>
</fieldset>

<fieldset id="qf_review__aesthetics" class="qf-fieldset">

<h2 class="slide page_margin_top">
Aesthetic Rating
</h2>

<div class="backgroundcolor">

<h3>
Color
</h3>

<p>What color(s) stand out in this bud?</p>

<span  id="qf_review__aesthetics__color__inner">
<?php 
if($this->params['action']=='add')
{
    foreach($colours as $colour)
    {?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $colour['Colour']['id'];?>" class="eff3 btn btn-info qf_review__aesthetics__color"><?php echo ucfirst($colour['Colour']['title']);?></a>
    <?php 
    }
}
else
{
    foreach($review['ColourRating'] as $effect)
    {?> 
     <span id="efft_<?php echo $effect['id'];?>" class="eff3 sel btn btn-info"><?php echo $colours[$effect['colour_id']-1]['Colour']['title'];?></span>
    <?php
    }
}
?>
</span>
<div class="clear"> </div>
<div style="border-bottom: 1px solid #dadada;margin:10px 0;"></div>

<h3>
Flavor & Scent
</h3>

<p>How does this strain taste & smell?</p>

<span id="qf_review__aesthetics__flavor__inner">
<?php 
if($this->params['action']=='add')
{
    foreach($flavors as $flavor)
    {?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $flavor['Flavor']['id'];?>" class="eff3 btn btn-info qf_review__aesthetics__flavor"><?php echo ucfirst($flavor['Flavor']['title']);?></a>
    <?php 
    }
}
else
{
    foreach($review['FlavorRating'] as $effect)
    {?> 
     <span id="efft_<?php echo $effect['id'];?>" class="eff3 sel btn btn-info"><?php echo $flavors[$effect['flavor_id']-1]['Flavor']['title'];?></span>
    <?php
    }
}
?>



</span>
</div>
</fieldset>

<h2 class="slide page_margin_top">
Rating & Comment <?php if($this->params['action']=='add')echo '(Required)';?>
</h2>
<div class="backgroundcolor">

<h3>Overall Rating</h3>

<div id="preci">
<div id="precision" class="left" style="cursor: pointer;" ></div>
<div class="errorz" style="display: none;" >Overall Rating Is Mandatory.</div>
</div>

<p id="qf_review__other__overall__prompt">1/5</p>

<input title="Overall Rating" value="0" type="hidden" name="rate" id="qf_review__other__overall" class="qf-hidden-input qf-slider qf-input"/>

<div class="qf-slider-bar" id="qf_review__other__overall__slider"> </div>

<h3 class="page_margin_top">Final Thoughts</h3>
<?php if($this->params['action']=='add')
    {?>
    <textarea title="Comments" rows="8" maxlength="4000" name="review" id="qf_review__other__comments" class="qf-maxlength-4000 qf-required qf-textarea" required="required"></textarea>
    <div class="submit">
<input type="submit" name="submit" value="Save My Review" class="button more blue"/>
</div>
<?php 
    }
    else
    {?>
       <br />
        <em><?php echo $review['Review']['review'];?></em>
 <?php
    }
?>


<div class="clear"></div>


</div>


</form>
</div>

<?php
if($this->Session->read('User') && $this->params['action']!='detail')
{
?>
<div class="page_right page_margin_top">

<a style="width:120px;float:right;" title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class=" more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>

<div class="clear"></div>
<a style="width:120px;float:right;"  title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">Settings</a>

<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top active ">Add Review</a>

<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">My Reviews</a>

<div class="clear"></div>



</div>
<?php }
/*
else
{
    ?>
    <div class="page_right page_margin_top">
        <div class="vote" style="position:fixed;top:300px;">
            <strong>Was this review helpful to you?</strong>
        </div>
    </div>
    <?php
}
*/
?>
</div>
</div>






<script>
$(function(){
    <?php if($this->params['action']=='add'){?>
    $('#reviews1').submit(function(){
        if($('#qf_review__other__overall').val()=='0')
        {
            $('.errorz').show();
            return false;
        }
        else
        {
            $('.errorz').hide();
            return true;
        }
            
    });

               	$('.qf_review__effects__medical').click(function() {
					addSlider($(this), 'medical');
				});
                $('.qf_review__aesthetics__color').click(function() {
					addSlider($(this), 'color');
				});
				$('.qf_review__aesthetics__flavor').click(function() {
					addSlider($(this), 'flavor');
				});
   	            $('.qf_review__effects__positive').click(function() {
					addSlider($(this), 'positive');
				});
				$('.qf_review__effects__negative').click(function() {
					addSlider($(this), 'negative');
				});

                
				function addSlider(jQ, type) {
                    var sel = jQ.attr('title');
					if (sel <= 0) return false;
					var opt = jQ.find('option:selected');
                    var txt = jQ.text();
					var id = type+sel;
					var h = "";
					if ($('#'+id).length != 0) {
						opt.removeClass("selected");
						$('#'+id).remove();
					} else {
						opt.addClass("selected");
						var cat = (type == 'color' || type == 'flavor') ? 'aesthetics' : 'effects';
                        if(cat == 'aesthetics')
                            h = "display:none";
						var innerId = '#qf_review__'+cat+'__'+type+'__inner';
                        if(type == 'positive' || type == 'negative')
                            type = 'effect';
                            
						$(innerId).append('<div id="'+id+'" class="review-slider" style="'+h+'"><h4>'+txt+'</h4><input type="hidden" id="'+id+'i" name="'+type+'['+sel+']" value="0" /><div class="slider"  id="'+id+'s"></div><p id="'+id+'p" >0/5</p><div class="clear"> </div></div>');
						$('#'+id+'s').slider({
							range: "min",
							value: 0,
							min: 0,
							max: 5,
							slide: function( event, ui ) {
								$('#'+id+'p').html(''+ui.value+'/5');
								$('#'+id+'i').val(ui.value);
							}
						});
					}
					jQ.val("");
				}
                $("#qf_review__general__mscale__slider").slider({'min':1,'max':9,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__general__mscale').val(ui.value);var vals = ['Extremely Active','Very Active','Active','Bit Active','Balanced','Bit Sedated','Sedated','Very Sedated','Extemely Sedated'];$('#qf_review__general__mscale__prompt').html(vals[Math.ceil( ((ui.value+1-1)/(9+1-1))*vals.length )-1]); },'range':'min'});		
				$("#qf_review__general__strength__slider").slider({'min':1,'max':5,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__general__strength').val(ui.value);$('#qf_review__general__strength__prompt').html(''+ui.value+'/5'); },'range':'min'});		
				$("#qf_review__general__duration__slider").slider({'min':1,'max':5,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__general__duration').val(ui.value);$('#qf_review__general__duration__prompt').html(''+ui.value+' hrs'); },'range':'min'});		
				$("#qf_review__aesthetics__hairs__slider").slider({'min':1,'max':5,'step':1,'value':5,'slide':function(e,ui){ $('#qf_review__aesthetics__hairs').val(ui.value);$('#qf_review__aesthetics__hairs__prompt').html(''+ui.value+'/5'); },'range':'min'});		
				$("#qf_review__aesthetics__crystals__slider").slider({'min':1,'max':5,'step':1,'value':5,'slide':function(e,ui){ $('#qf_review__aesthetics__crystals').val(ui.value);$('#qf_review__aesthetics__crystals__prompt').html(''+ui.value+'/5'); },'range':'min'});		
		
			$('#precision').raty({
                  cancel     : false,
                  cancelOff  : 'cancel-off.png',
                  cancelOn   : 'cancel-on.png',
                  path       : '<?php echo $this->webroot;?>raty/images',
                  starHalf   : 'star-half.png',
                  starOff    : 'star-off.png',
                  starOn     : 'star-on.png',
                  target     : '#qf_review__other__overall__prompt',
                  targetKeep : true,
                  precision  : true,
                  number     : 5,
                  //hints      : ['1/5','2/5','3/5','4/5','5/5'],
                  click      : function(score){
                                    $('#qf_review__other__overall').val(score.toFixed(2));
                                    $('.errorz').hide();
                    }
    });
    <?php 
    }else
    {?>
            $("#qf_review__general__mscale__slider").slider({'min':1,disabled: true,'max':9,'step':1,'value':<?php echo $review['Review']['eff_scale'];?>,'slide':function(e,ui){ $('#qf_review__general__mscale').val(ui.value);var vals = ['Extremely Active','Very Active','Active','Bit Active','Balanced','Bit Sedated','Sedated','Very Sedated','Extemely Sedated'];$('#qf_review__general__mscale__prompt').html(vals[Math.ceil( ((ui.value+1-1)/(9+1-1))*vals.length )-1]); },'range':'min'});		
			$("#qf_review__general__strength__slider").slider({'min':1,'max':5,disabled: true,'step':1,'value':<?php echo $review['Review']['eff_strength'];?>,'slide':function(e,ui){ $('#qf_review__general__strength').val(ui.value);$('#qf_review__general__strength__prompt').html(''+ui.value+'/5'); },'range':'min'});		
			$("#qf_review__general__duration__slider").slider({'min':1,'max':5,'step':1,disabled: true,'value':<?php echo $review['Review']['eff_duration'];?>,'slide':function(e,ui){ $('#qf_review__general__duration').val(ui.value);$('#qf_review__general__duration__prompt').html(''+ui.value+' hrs'); },'range':'min'});		
			$("#qf_review__aesthetics__hairs__slider").slider({'min':1,'max':5,'step':1,disabled: true,'value':<?php echo $review['Review']['eff_scale'];?>,'slide':function(e,ui){ $('#qf_review__aesthetics__hairs').val(ui.value);$('#qf_review__aesthetics__hairs__prompt').html(''+ui.value+'/5'); },'range':'min'});		
			$("#qf_review__aesthetics__crystals__slider").slider({'min':1,'max':5,'step':1,disabled: true,'value':<?php echo $review['Review']['eff_scale'];?>,'slide':function(e,ui){ $('#qf_review__aesthetics__crystals').val(ui.value);$('#qf_review__aesthetics__crystals__prompt').html(''+ui.value+'/5'); },'range':'min'});		
			//$("#qf_review__other__overall__slider").slider({'min':1,'max':5,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__other__overall').val(ui.value);$('#qf_review__other__overall__prompt').html(''+ui.value+'/5'); },'range':'min'});			
			$('#precision').raty({
                  cancel     : false,
                  readOnly   : true,
                  cancelOff  : 'cancel-off.png',
                  cancelOn   : 'cancel-on.png',
                  path       : '<?php echo $this->webroot;?>raty/images',
                  starHalf   : 'star-half.png',
                  starOff    : 'star-off.png',
                  starOn     : 'star-on.png',
                  target     : '#qf_review__other__overall__prompt',
                  targetKeep : true,
                  precision  : true,
                  number     : 5,
                  score      : <?php echo $review['Review']['rate'];?>,
                  //hints      : ['1/10','2/10','3/10','4/10','5/10','6/10','7/10','8/10','9/10','10/10'],
                  click      : function(score){
                                    $('#qf_review__other__overall').val(score.toFixed(2));
                                    $('.errorz').hide();
                    }
    });  
    <?php
    }?>

});
</script>