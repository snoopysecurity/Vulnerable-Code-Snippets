<?php     include("../common/header.php");   ?>

<!-- from http://www.ush.it/2009/02/08/php-filesystem-attack-vectors/ -->
<?php hint("will include the arg specified in the GET parameter \"class\", appends .php to end, defeat with NULL byte %00"); ?>


<form action="/LFI-4/index.php" method="GET">
    <input type="text" name="class">
</form>

<?php
include('includes/class_'.addslashes($_GET['class']).'.php');
?>

