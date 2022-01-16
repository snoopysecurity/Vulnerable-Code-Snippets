<!-- from http://hakipedia.com/index.php/Local_File_Inclusion -->
<?php     include("../common/header.php");   ?>

<?php hint("will include the arg specified in the GET parameter \"file\", strips prepended \"../\" strings, must encode / with %2f"); ?>


<form action="/LFI-5/index.php" method="GET">
    <input type="text" name="file">
</form>

<?php
   $file = str_replace('../', '', $_GET['file']);
   if(isset($file))
   {
       include("pages/$file");
   }
   else
   {
       include("index.php");
   }
?>
