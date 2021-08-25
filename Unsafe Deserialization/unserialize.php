class ViewFile { public $filename = ''; 


public function __toString()


 { include $this->filename; return ""; } }



 if (isset($_GET['page']))
 
 
 { $pdfobject = unserialize(base64_decode($_GET['page'])); } 
 
 else { $pdfobject = new File(); } ?> 
