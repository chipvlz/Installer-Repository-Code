<?php
/*
	Installer 5 Repository
	© 2017-2018, Infini Dev (Sam Guichelaar & Cristian Tabuyo), © 2008 Slava Karpenko

	Should you have any questions, do not hesitate to send them at info@installer5.com.
*/

define('REPOSITORY_URL', "http://yourdomain.com/");

// Several configuration parameters for this repository
define('PACKAGES_PATH', "./packages"); // Local path to the packages directory
define('PACKAGES_PATH_URL', REPOSITORY_URL . "packages/"); // Full URL to the packages (must have the trailing slash '/')

define('INFO_PATH', "./info");	// Local path to the package info directory. MUST BE WRITABLE BY THE HTTP USER(mind permissions)!
define('INFO_PATH_URL', REPOSITORY_URL . "info/"); // Full URL to the package info directory (must have the trailing slash '/')

define('CACHE_TTL', (60 * 60));	// Time to live for the cache (in seconds). new/updated packages will be loaded into the repo this often. don't set this too low or your repo server will be loaded. by default this is set to 1 hour.
define('CACHE_OLD_TTL', (60*60*24*3));	//How long should we keep old caches? - keep this somewhere above 1 day but below a month, so indexes are not taking up too much space on your hard drive...

define('INCLUDE_ICONS', true); // Should the repo include the icons found in the package zip files (Install.png) or not? May affect your bandwidth...

define('ENABLE_DEBUG', true);	// If set to true, you'll be able to see the repo contents by appending ?debug=1 to the URL.

define('SEARCH_ENABLED', true);	// Defines whether this repository should be included in Installer web searches (and be indexed with a crawler)

// Cache regeneration control. Calling regenerate.php will regenerate index files, so make sure you provide a good password and don't forget to update the firmware versions array when new firmware comes out.
define('REGENERATE_SECRET', '');	// This is a secret key to access regenerate.php(avoiding unauthorised people to run it). Please define it to something non-obvious - you will be calling regenerate.php?secret=[yoursecretword]

global $POSSIBLE_FIRMWARE_VERSIONS;
// Update this array whenever new firmware comes out. The repository will serve empty list of packages for all other versions. This means you have to add subversions of supported iOS versions as well. '8.0'  will only generate a package list for 8.0, not for 8.0.1 or above.
$POSSIBLE_FIRMWARE_VERSIONS = array( '8.0', '8.0.1', '10.0', '11.1.1' );

define('DEFAULT_FIRMWARE', '8.0'); // Defines the default firmware. It has to be listed in the array above

function sanitizeVariable($variable) {
	$variable = strip_tags($variable);
	$variable = filter_var($variable, FILTER_SANITIZE_STRING);
	return $variable;
}

?>
