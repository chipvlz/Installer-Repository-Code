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

ob_start("ob_gzhandler");

$installer_version = @$_REQUEST['installerVersion'];
$os_version = @$_REQUEST['firmwareVersion'];
$platform = @$_REQUEST['platform'];
$deviceUUID = @$_REQUEST['deviceUUID'];

if (!$os_version)
	$os_version = '8.0';		// 8.0 is the default

if(!@$_GET['debug'] && !(strstr($_SERVER['HTTP_USER_AGENT'], 'Install') || strstr($_SERVER['HTTP_USER_AGENT'], 'CFNetwork')))
{
	include("instructions.php");
	exit;
}

$debug = @$_GET['debug'] && ENABLE_DEBUG;

if ($debug)
	header('Content-Type: text/plain; charset=utf-8');
else
	header('Content-Type: application/x-install-repository; charset=utf-8');

$index_file = IndexFilename();

if (!file_exists($index_file))				// if there's no pre-built index cached, return a blank file.
	print file_get_contents("Info.plist");
else
	print file_get_contents($index_file);

exit;

function IndexFilename()
{
	global $os_version;

	return (INFO_PATH . "/index-" . $os_version . ".plist");
}

?>
