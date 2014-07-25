<div id="three-column" class="container">
		<div><span class="arrow-down"></span></div>
        <h2>BROWSE BY STRAIN CATEGORY</h2>
		<div id="tbox1">
			<div class="title">
				<h2>INDICA</h2>
			</div>
			<p>Indica plants typically grow short and wide. Indica plants are better suited for indoor growing because of their short growth. The smoking of Indica bud will make you sleepy and provides a deep relaxation feeling. This type of strain has great medecal benefit as well as treatment to certain illness.</p>
			<a href="<?php echo $this->webroot;?>strains/all/indica" class="button">Browse Strain</a> </div>
		<div id="tbox2">
			<div class="title">
				<h2>SATIVA</h2>
			</div>
			<p>Sativa plants grow tall and thin. sativa plants are better suited for outdoor growing because some strains can reach over 25 ft. in height. Sativa smoking is known for its energetic and uplifting feeling. This type of strain has great medecal benefit as well as treatment to certain illness.</p>
			<a href="<?php echo $this->webroot;?>strains/all/sativa" class="button">Browse Strain</a> </div>
		<div id="tbox3">
			<div class="title">
				<h2>HYBRID</h2>
			</div>
			<p>Sativa and Indica are the two major types of cannabis plants which can mix together to create hybrid strains. Marijuana strains range from pure sativas to pure indicas and hybrid strains consisting of both indica and sativa (30% indica – 70% sativa, 50% – 50% combinations, 80% indica – 20% sativa).</p>
			<a href="<?php echo $this->webroot;?>strains/all/hybrid" class="button">Browse Strain</a> </div>
	</div>
	<div id="portfolio" class="container">
    <h2 style="text-align: center;margin-bottom:15px;">LATEST STRAIN</h2>
    <?php
    if($strain)
    {
        $j=0;
        foreach($strain as $s)
        {
            $j++;
            ?>
            <div class="column<?php echo $j;?>">
			<div class="box"> 
            <a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>"><div class="iconstrain">
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
				<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>" class="button button-small">View Detail</a> </div>
		  </div>
            <?php
        }
    }
    ?>
		
		
	</div>