<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<h1 class="title">Reviews for - <?php echo $strain['Strain']['name'];?></h1>
<p class="gap" style="margin-top: 20px;">&nbsp;</p>
<div class="sort">
<strong>SORT:</strong>  &nbsp; &nbsp; <a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>/recent">Most Recent</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>/helpful">Most Helpful</a>
</div>
<?php
if($review)
{
    $i = 0;
    foreach($review as $r)
    {
        $i++;
        ?>
        <div class="rev <?php if($i%2==1){?>leftcontents left<?php }else{?>rightcontents left<?php }?>">
            
            <div class="gap">
            <?php if($r){?>
                <div class="userinfo">
                    <div class="names left"><strong><?php echo $this->requestAction('/strains/getUserName/'.$r['Review']['user_id']);?></strong></div>
                    <div class="dates left"><em><?php echo $r['Review']['on_date'];?></em></div>
                    <div class="rates frate<?php echo $i;?> left"></div>
                    <div class="clear"></div>
                    <script>
                    $(function(){
                       $('.frate<?php echo $i;?>').raty({readOnly:true,score:<?php echo $r['Review']['rate']/2;?>}); 
                    });
                    </script>
                </div>
                <?php echo $r['Review']['review'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $rand1 = rand(100,999);
                $rand2 = rand(100,999);
                $q5 = $vip->find('first',array('conditions'=>array('review_id'=>$r['Review']['id'],'ip'=>$ip)));
        if($q5)
        {
            $vote = 1;
        }
        else
        $vote = 0;
                ?>
                <p class="gap martop">
                
                    <em>WAS THIS REVIEW HELPFUL TO YOU? </em> &nbsp; &nbsp; <?php if($vote==0){?><a href="javascript:void(0);" id="<?php echo $rand1.'_'.$r['Review']['id'];?>" class="btns yes">YES</a> <a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$r['Review']['id'];?>">NO</a><?php }else{echo "<em style='color:#AAA;'>ALREADY VOTED</em>";}?>
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
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;'));
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
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;'));
});
});
</script>