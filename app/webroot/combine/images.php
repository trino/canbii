<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>style2/fancybox/jquery.fancybox.css"/>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js2/jquery.fancybox-1.3.4.pack.js"></script>
<style type="text/css">
    /* just format */
    #Border {border: 1px solid #efefef;margin: 0 auto; text-align:center;width:100%;  }
</style>

        <?
        //other values PATHINFO_DIRNAME (/mnt/files) | PATHINFO_BASENAME (??????.mp3) | PATHINFO_FILENAME (??????)
        function getextension($path, $value=PATHINFO_EXTENSION){
            return strtolower(pathinfo($path, $value));
        }
        $needsTRstart=true;
        $needsTRend=false;

        $breaker = 0;
        if (is_dir("images/strains/" . $strain['Strain']['id'])) {
        $images = scandir("images/strains/" . $strain['Strain']['id'], SCANDIR_SORT_ASCENDING);

        $imagecount=0;
        foreach($images as $file) {//for ($i = 1; $i < 5; $i++) {
            $ext = getextension($file);
            if ($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png") {
                $imagecount+=1;
            }
        }
        if($imagecount>0) {
            $rows = ceil($imagecount / 2);
            $rowheight = round(100 / $rows);
            echo '<table id="Border" align="center" height="' . $rows*150 .'">';

            foreach ($images as $file) {//for ($i = 1; $i < 5; $i++) {
                $ext = getextension($file);
                if ($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png") {
                    if ($needsTRstart) {
                        echo '<tr>';
                        $needsTRstart = false;
                        $needsTRend = true;
                    }

                    $image = "images/strains/" . $strain['Strain']['id'] . "/" . $file;
                    //$image = "images/strains/" . $strain['Strain']['id'] . "/" . $strain['Strain']['slug'] . "_" . $i . ".jpg";
                    $filename = getcwd() . "/" . $image; //C:\wamp\www\marijuana\app\webroot
                    $image = $this->webroot . $image;
                    if (!file_exists($filename) && file_exists(str_replace(".jpg", ".jpeg", $filename))) {
                        $image = str_replace(".jpg", ".jpeg", $image);
                        $filename = str_replace(".jpg", ".jpeg", $filename);
                    }
                    if (file_exists($filename)) {
                        $breaker++;

                        ?>

                        <TD valign="center"><div align="center"> <a class="fancybox" rel="group" href="<?= $image ?>">
                                <img style="" class="reportimage"  src="<?= $image; ?>"/>
                            </a></div></TD>


                        <?
                        if ($breaker % 2 == 0 && $breaker > 0) {
                            echo "</tr>";
                            $needsTRend = false;
                            $needsTRstart = true;
                        }
                    }
                }
            }
            if ($needsTRend) {
                echo "</tr>";
            }
        }}
        if ($breaker==0){
            echo "<P>No images</P>";
        }
        ?>
</table>