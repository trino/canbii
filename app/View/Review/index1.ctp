<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<style>
.sel{text-decoration:none;}
</style>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<form action="" method="post" id="reviews" >
<div class="form">
<div class="gap">
<strong>FORM</strong><br />
<a href="javascript:void(0);" onclick="insert_val($(this).attr('title'),'form')" title="extraction" class="btn btn-info form1" >Extraction</a>
<a href="javascript:void(0);" onclick="insert_val($(this).attr('title'),'form')" title="raw" class="btn btn-info form1">Raw</a><br />
<input type="hidden" name="form" value="" class="form" />
</div>
<div class="gap">
<strong>CONSUMPTION</strong><br />
<a href="javascript:void(0);"onclick="insert_val($(this).attr('title'),'consume')" title="smoke" class="btn btn-info consume">Smoke</a>
<a href="javascript:void(0);"onclick="insert_val($(this).attr('title'),'consume')" title="vaporize" class="btn btn-info consume">Vaporize</a>
<a href="javascript:void(0);"onclick="insert_val($(this).attr('title'),'consume')" title="eat" class="btn btn-info consume">Eat</a>
<a href="javascript:void(0);"onclick="insert_val($(this).attr('title'),'consume')" title="drink" class="btn btn-info consume">Drink</a><br />
<input type="hidden" name="consumption" value="" class="consume" />
</div>
</div>
<div class="gap">
<strong>OVERALL RATING</strong>
<div id="preci">
<div id="precision" class="left" style="cursor: pointer;" >
</div>
</div>
<div id="precision-hint" class="input hint left marleft"></div>
<div class="clear"></div>
</div>
<input type="hidden" name="rate" class="ratingz" />
<div class="information">
<h2 class="title">Add Effect Information</h2>
<div class="gap martop">
<strong>CHOOSE EFFECT</strong><br />
<?php foreach($effects as $effect)
{?> <a href="javascript:void(0);"onclick="insert_val($(this).attr('title'),'effects_<?php echo $effect['Effect']['id'];?>'); load_model('<?php echo $strain_id;?>','<?php echo $effect['Effect']['id'];?>','effect'); $(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="btn btn-info"><?php echo ucfirst($effect['Effect']['title']);?></a>
    <input type="hidden" class="effects_<?php echo $effect['Effect']['id'];?>" value="" name="effects[]"/>
<?php }
?>
</div>
<div class="gap">
<strong>CHOOSE MEDICAL SYMPTOMS</strong><br />
<?php foreach($symptoms as $effect)
{?> <a href="javascript:void(0);"onclick="insert_val($(this).attr('title'),'symptom_<?php echo $effect['Symptom']['id'];?>'); load_model('<?php echo $strain_id;?>','<?php echo $effect['Symptom']['id'];?>','symptom'); $(this).addClass('sel')" title="<?php echo $effect['Symptom']['id'];?>" class="btn btn-info"><?php echo ucfirst($effect['Symptom']['title']);?></a>
    <input type="hidden" class="symptom_<?php echo $effect['Symptom']['id'];?>" value="" name="symptom[]"/>
<?php }
?>
</div>

</div>
<div class="revie">
<h2 class="title">Add a Review</h2>
<div class="gap martop">
<strong>Write a review.</strong><br />
<textarea name="review" cols="70" rows="10"></textarea>
</div>
</div>
<div class="submit">
<input type="submit" name="submit" value="Save My Review" class="button"/>
</div>
</form>
<div id="dialog" title="Rating">
    
</div>
<script>
function load_model(strain_id, eff_id,table)
{
    $('#dialog').load('<?php  echo $this->webroot;?>review/rating/'+strain_id+'/'+eff_id+'/'+table);
    $('#dialog').dialog();
}
function insert_val(values,cls)
{
    $('.'+cls).val(values);
}
$(function(){
    $('.consume').click(function(){
      
        if($(this).attr('class').replace('sel',"")!=$(this).attr('class'))
        {
            $(this).removeClass('sel');
            return
        }
        $('.consume').each(function(){
            $(this).removeClass('sel');
        });
        
        $(this).addClass('sel');
    });
    $('.form1').click(function(){
      if($(this).attr('class').replace('sel',"")!=$(this).attr('class'))
        {
            $(this).removeClass('sel');
            return
        }
        $('.form1').each(function(){
            $(this).removeClass('sel');
        });
        $(this).addClass('sel');
    })

    $('#precision').raty({
      cancel     : true,
      cancelOff  : 'cancel-off.png',
      cancelOn   : 'cancel-on.png',
      path       : '<?php echo $this->webroot;?>raty/images',
      starHalf   : 'star-half.png',
      starOff    : 'star-off.png',
      starOn     : 'star-on.png',
      target     : '#precision-hint',
      targetKeep : true,
      precision  : true,
      click      : function(score){
                        $('.ratingz').val(score.toFixed(2));
                    }
    });
});
</script>