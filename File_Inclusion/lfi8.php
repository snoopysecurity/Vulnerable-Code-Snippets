<?php     include("../common/header.php");   ?>

<!-- from http://www.ush.it/2009/02/08/php-filesystem-attack-vectors/ -->
<?php hint("will include the arg specified in the POST parameter \"file\", looks for .php at end - bypass by apending /. (slash plus dot)"); ?>

<form action="/LFI-8/index.php" method="POST">
    <input type="text" name="file">
</form>


<?php
if (substr($_POST['file'], -4, 4) != '.php')
 echo file_get_contents($_POST['file']);
else
 echo 'You are not allowed to see source files!'."\n";
?>

