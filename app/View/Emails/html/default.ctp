<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Canbii</title>
</head>
<?php $url = "http://" . $_SERVER['HTTP_HOST'] . $this->webroot; ?>
<body>
<style>
    .btn {
        -webkit-border-radius: 28;
        -moz-border-radius: 28;
        border-radius: 28px;
        font-family: Arial;
        color: #ffffff;
        font-size: 20px;
        background: #243466;
        padding: 10px 20px 10px 20px;
        text-decoration: none;
    }

    .btn:hover {
        background: #3cb0fd;
        background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
        background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
        text-decoration: none;
    }
</style>

            <table width="100%" align="center">
                <tr>

                    <td style="text-align:left; padding-left: 10px; padding-right: 10px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif'; " valign="middle">
                        <A href="<?= $url ?>"><img src="http://canbii.com/logo.png" width="200px"><span style="text-align: right;"></A>
                        <div style="float: right"><h1>Personalized Medical Marijuana</h1></div>

                    </td>


                </tr>


                <tr>

                    <td style="padding: 45px; color: black; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif'; text-align:left; font-size:16px; valign: top;">
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$content = explode("\n", $content);
foreach ($content as $line):
	echo '<p> ' . $line . "</p>\n";
endforeach;
?>

                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-left: 45px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif'; text-align:left; font-size:16px; ">
                        <p>
                            <a href="<?= $url . "users/register" ?>" style="text-decoration: none; color: #243466; font-weight: 500;">Login</a> |
                            <a href="<?= $url . "users/settings" ?>" style="text-decoration: none; color: #243466; font-weight: 500;">Settings</a> |
                            <a style="text-decoration: none; color: #243466; font-weight: 500;" href="">Help</a> |
                            <a style="text-decoration: none; color: #243466; font-weight: 500;" href="">Not my account</a></p>
                        <p >© Canbii <?php echo date("Y"); ?></p>
                    </td>
                </tr>

                <tr>
                    <td>
                    </td>
                </tr>
            </table>
</body>
</html>
