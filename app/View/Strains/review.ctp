<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<h1 class="title">Reviews for - <?php echo $strain['Strain']['name'];?></h1>
<p class="gap" style="margin-top: 20px;">&nbsp;</p>
<?php
if($strain['Review'])
{
    $i = 0;
    foreach($strain['Review']  as $r)
    {
        $i++;
        ?>
        <div class="rev <?php if($i%2==1){?>leftcontents left<?php }else{?>rightcontents left<?php }?>">
            
            <div class="gap">
            <?php if($r){?>
                <div class="userinfo">
                    <div class="names left"><strong><?php echo $this->requestAction('/strains/getUserName/'.$r['user_id']);?></strong></div>
                    <div class="dates left"><em><?php echo $r['on_date'];?></em></div>
                    <div class="rates frate<?php echo $i;?> left"></div>
                    <div class="clear"></div>
                    <script>
                    $(function(){
                       $('.frate<?php echo $i;?>').raty({readOnly:true,score:<?php echo $r['rate']/2;?>}); 
                    });
                    </script>
                </div>
                <?php echo $r['review'];
                $rand1 = rand(100,999);
                $rand2 = rand(100,999);
                ?>
                <p class="gap martop">
                    <em>WAS THIS REVIEW HELPFUL TO YOU? </em> &nbsp; &nbsp; <a href="javascript:void(0);" id="<?php echo $rand1.'_'.$r['id'];?>" class="btns yes">YES</a> <a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$r['id'];?>">NO</a>
                </p>
                <?php }?>
            </div>
        </div>
        <?php
    }
}
?>
<div class="clear"></div>
<script>
$(function(){
$('.rates img').each(function(){
    var src = $(this).attr('src');
    src = src.replace('../','<?php echo $this->webroot;?>');
    $(this).attr('src',src);
});
$('.yes').click(function(){
   var id = $(this).attr('id');
   var arr = id.split('_');
   var r_id = arr[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/yes',
   });
   $('#'+arr[0]+'_'+r_id).removeClass('yes');
   $('#'+arr[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+arr[0]+'_'+r_id).attr('onclick','return false;');
   var o = parseFloat(arr[0])+1;
   $('#'+o+'_'+r_id).removeClass('no');
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
});
$('.no').click(function(){
   var id = $(this).attr('id');
   
   var arr2 = id.split('_');
   var r_id = arr2[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/no',
   });
   $('#'+arr2[0]+'_'+rid).removeClass('yes');
   var o = parseFloat(arr2[0])+1;
   $('#'+o+'_'+r_id).removeClass('no'); 
   $('#'+arr2[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;')
   $('#'+arr2[0]+'_'+r_id).attr('onclick','return false;');
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
});
});
</script>