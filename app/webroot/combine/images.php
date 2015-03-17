<table>
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
                <td align="">
                    <center>
                        <a class="fancybox" rel="group"
                           href="<?=$image?>"
                            >
                            <img
                                class="reportimage"
                                src="<?php echo $image;?>"
                                />
                        </a>
                    </center>
                </td>

                <?
                if ($breaker == 2) {
                    echo "</tr><tr>";
                }
            }
        } ?>
    </tr>
</table>