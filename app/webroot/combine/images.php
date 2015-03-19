<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>style2/fancybox/jquery.fancybox.css"/>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js2/jquery.fancybox-1.3.4.pack.js"></script>


<table style="width:100%;">
    <tr>

        <?
        $breaker = 0;
        for ($i = 1; $i < 5; $i++) {
            $image = "images/strains/" . $strain['Strain']['id'] . "/" . $strain['Strain']['slug'] . "_" . $i . ".jpg";
            $filename = getcwd() . "/" . $image; //C:\wamp\www\marijuana\app\webroot
            $image = $this->webroot . $image;
            if (!file_exists($filename) && file_exists(str_replace(".jpg", ".jpeg", $filename))) {
                $image=str_replace(".jpg", ".jpeg", $image);
                $filename=str_replace(".jpg", ".jpeg", $filename);
            }
            if (file_exists($filename)) {
                $breaker++;

                ?>
                <td align="" style="width: 50%;text-align: center;">
                        <a class="fancybox" rel="group"
                           href="<?=$image?>"
                            >
                            <img
                                style=""
                                class="reportimage"
                                src="<?php echo $image;?>"
                                />
                        </a>
                </td>

                <?
                if ($breaker == 2) {
                    echo "</tr><tr>";
                }
            }
        }
        if ($breaker==0){
            echo "<P>No images</P>";
        }
        ?>
    </tr>
</table>