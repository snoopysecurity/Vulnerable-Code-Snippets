<?php     include("../common/header.php");   ?>

<!-- from https://pentesterlab.com/exercises/php_include_and_post_exploitation/course -->
<?php
hint("will exec 'whois' with the arg specified in the GET parameter \"domain\"");
?>

<form action="/CMD-3/index.php" method="GET">
    Whois: <input type="text" name="domain">
</form>

<pre>
<?php
    system("/usr/bin/whois " . $_GET["domain"]);
 ?>
</pre>