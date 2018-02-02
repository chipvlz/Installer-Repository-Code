<?php
/*
	Installer 5 Repository
	© 2017-2018, Infini Dev (Sam Guichelaar & Cristian Tabuyo), © 2008 Slava Karpenko

	Should you have any questions, do not hesitate to send them at info@installer5.com.
*/

if (!file_exists("config.inc.php"))
	die("config.inc.php does not exist.");

require_once("config.inc.php");

// No user serviceable parts beyond this point.

function IndexFilename() {
	global $os_version;
	return (INFO_PATH . "/index-" . $os_version . ".plist");
}

ob_start("ob_gzhandler");

$installer_version = @sanitizeVariable($_REQUEST['installerVersion']);
$os_version = @sanitizeVariable($_REQUEST['firmwareVersion']);
$platform = @sanitizeVariable($_REQUEST['platform']);
$deviceUUID = @sanitizeVariable($_REQUEST['deviceUUID']);

if (!$os_version || !in_array($os_version, $POSSIBLE_FIRMWARE_VERSIONS))
	$os_version = DEFAULT_FIRMWARE;

if(!@sanitizeVariable($_GET['debug']) && !(strstr($_SERVER['HTTP_USER_AGENT'], 'Install') || strstr($_SERVER['HTTP_USER_AGENT'], 'CFNetwork'))) {
	include("instructions.php");
	exit;
}

$debug = @sanitizeVariable($_GET['debug']) && ENABLE_DEBUG;

if ($debug)
	header('Content-Type: text/plain; charset=utf-8');
else
	header('Content-Type: application/x-install-repository; charset=utf-8');

$index_file = IndexFilename();

if (!file_exists($index_file))				// if there's no pre-built index cached, return a blank file.
	print file_get_contents("Info.plist");
else
	print file_get_contents($index_file);

ob_end_flush();

exit;

?>
