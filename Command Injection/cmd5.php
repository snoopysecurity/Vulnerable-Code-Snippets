<?php     include("../common/header.php");   ?>
<!-- from https://pentesterlab.com/exercises/php_include_and_post_exploitation/course -->
<?php  hint("not everything you need to inject is in a text input field ..."); ?>

<form action="/CMD-5/index.php" method="GET">
    <input type="text" name="domain">
    <input type="hidden" name="server" value="whois.publicinterestregistry.net">
</form>

<pre>
<?php
if (preg_match('/^[-a-z0-9]+\.a[cdefgilmnoqrstuwxz]|b[abdefghijmnorstvwyz]|c[acdfghiklmnoruvxyz]|d[ejkmoz]|e[cegrstu]|f[ijkmor]|g[abdefghilmnpqrstuwy]|h[kmnrtu]|i[delmnoqrst]|j[emop]|k[eghimnprwyz]|l[abcikrstuvy]|m[acdeghklmnopqrstuvwxyz]|n[acefgilopruz]|om|p[aefghklmnrstwy]|qa|r[eosuw]|s[abcdeghijklmnortuvyz]|t[cdfghjklmnoprtvwz]|u[agksyz]|v[aceginu]|w[fs]|y[et]|z[amw]|biz|cat|com|edu|gov|int|mil|net|org|pro|tel|aero|arpa|asia|coop|info|jobs|mobi|name|museum|travel|arpa|xn--[a-z0-9]+$/', strtolower($_GET["domain"])))
        { system("whois -h " . $_GET["server"] . " " . $_GET["domain"]); } 
    else 
        {echo "malformed domain name";}
    
 ?>
</pre>