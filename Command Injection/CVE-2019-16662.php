<?php
$rootUname = $_GET['rootUname'];
$array = array();
/* check PHP Safe_Mode is off */
if (ini_get('safe_mode')) {
    $array['phpSafeMode'] = '<strong><font class="bad">Fail - php safe mode is on - turn it off before you proceed with the installation</strong></font>br/>';
} else {
    $array['phpSafeMode'] = '<strong><font class="Good">Pass - php safe mode is off</strong></font><br/>';
}
/* Test root account details */
$rootTestCmd1 = 'sudo -S -u ' . $rootUname . ' chmod 0777 /home 2>&1';
exec($rootTestCmd1, $cmdOutput, $err);
$homeDirPerms = substr(sprintf('%o', fileperms('/home')), -4);
if ($homeDirPerms == '0777') {
    $array['rootDetails'] = '<strong><font class="Good">Pass - root account details are good </strong></font><br/>';
} else {
    $array['rootDetails'] = '<strong><font class="bad">The root details provided have not passed: ' . $cmdOutput[0] . '</strong></font><br/>';
}
// reset /home dir permissions
$rootTestCmd2 = 'sudo -S -u ' . $rootUname . ' chmod 0755 /home 2>&1';
exec($rootTestCmd2, $cmdOutput, $err);
echo json_encode($array);
