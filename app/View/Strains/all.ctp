<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<?php
if(isset($_GET['effects'])&&$_GET['effects'])
{
    foreach($_GET['effects'] as $ef)
    {
        $effects[] = $ef;
    }
}
else
$effects = array();

if(isset($_GET['symptoms'])&&$_GET['symptoms'])
{
    foreach($_GET['symptoms'] as $ef)
    {
        $symptoms[] = $ef;
    }
}
else
$symptoms = array();
?>
<div id="portfolio" class="container">
    <h1 class="title" style="margin-bottom: 30px;">Strains</h1>
    <p style="margin-bottom: 30px;">&nbsp;</p>
    <div  class="sort right">
        <strong>SORT:</strong>  &nbsp; &nbsp; <a href="javascript:void(0);" onclick="highlighteff2('recent')">Most Recent</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" onclick="highlighteff2('rated')">Top Rated</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" onclick="highlighteff2('viewed')">Most Viewed</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" onclick="highlighteff2('reviewed')">Most Reviewed</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" onclick="highlighteff2('alpha')">Alphabetically</a>
    </div>
    <div class="clear"></div>
    <div>
    <div class="right listing">
    <?php
    if($strain)
    {
        $j=0;
        foreach($strain as $s)
        {
            $j++;
            ?>
            <div class="list">
			<div class="box"> 
            <div class="others"><strong><em><?php echo $s['Strain']['published_date'];?></em></strong></div>
            <a class="lista" href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>"><div class="iconstrain">
                <h2><?php echo $s['StrainType']['title'];?></h2>
                <strong>
                <?php 
                $name_arr = explode(' ',$s['Strain']['name']);
                $i=0;
                foreach($name_arr as $na)
                {
                    $i++;
                    if($i==1){
                        echo ucfirst($na[0]);
                        }
                        else echo strtolower($na[0]);
                        }
                        ?></strong>
                <br />
                <?php echo $s['Strain']['name'];?>
                </div>
                </a>
				<p><?php echo substr($s['Strain']['description'],0,130).'...';?></p>
                <div class="clear"></div>
                <div class="others">
				<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>" class="button-small">View Detail</a>
                <div class="rating<?php echo $j;?> right" style="margin: 0 10px;"></div>
                <div class="left"><em><strong><?php if($s['Strain']['review'])echo $s['Strain']['review'];else echo 0;?> Reviews</strong></em></div>
                <div class="clear"></div>
                <script>
                $(function(){    
                    $('.rating<?php echo $j;?>').raty({number:10,readOnly:true,score:<?php echo $s['Strain']['rating'];?>});
                });
                </script> 
                </div>
                
                </div>
		  </div>
            <?php
        }
    }
    ?>
    <div class="clear"></div>
	</div>
    <div class="left filter">
        <strong style="text-align: center;" class="block">FILTER STRAINS</strong>
        <p>&nbsp;</p>
        <a href="javascript:void(0);" class="block-btn2">FILTER BY EFFECTS</a>
                <div class="choose_eff" >
                <?php $effect = $this->requestAction('/pages/getEff');
                foreach($effect as $e)
                {
                    ?>
                    <a href="javascript:void(0)" class="small-btn" onclick="highlighteff2($(this))" id="eff_<?php echo $e['Effect']['id'];?>"><?php echo $e['Effect']['title']?></a>
                    <?php
                }
                ?>
                <p style="display: none;" class="effe"></p>
                </div>
                
                <a href="javascript:void(0);" class="block-btn2">FILTER BY SYMPTOM</a>
                <div class="choose_sym">
                <?php $effect = $this->requestAction('/pages/getSym');
                foreach($effect as $e)
                {
                    ?>
                    <a href="javascript:void(0)" onclick="highlightsym2($(this))" class="small-btn" id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
                    <?php
                }
                ?>
                <p style="display: none;" class="symp"></p>
                </div>
    </div>
    <div class="clear"></div>	
    </div>
		
	</div>
    <div id="spinner">
        Loading...
    </div>
    
    
    <script>
    
    $(function(){
    <?php
    if($effects)
    {
        foreach($effects as $eff)
        {
            ?>
            $('#eff_<?php echo $eff;?>').click();
            <?php
        }
    }
    if($symptoms)
    {
        foreach($symptoms as $eff)
        {
            ?>
            $('#sym_<?php echo $eff;?>').click();
            <?php
        }
    }
    ?>
    });
    </script>