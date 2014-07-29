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