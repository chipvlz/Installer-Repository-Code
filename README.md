# Installer BETA Repository Code v0.1.2b

Fixed in v0.1.2b: 
- Added sanity checks to avoid XSS type attacks.
- Fixed an issue where macOS GUI zipped packages wouldn’t be processed.

Installer PRELIMINARY repository code to set up your own Installer repository.

Please note that this code is in the early stages of beta. It can change a lot for the public release of Installer.

Instructions for hosting your own repository in 2 minutes:

1. Upload all files via FTP
2. In the folder packages, you can create folders, which will be treated by Installer as categories. 
  If one of your folders is named 'SpringBoard Tweaks' installer will create a category called SpringBoard Tweaks.
  Add zip packages to the category folders.
3. Make sure 'info' folder is writeable by the http user. (Change permissions) 
4. Open config.inc.default.php
5. Find (line 33) define('REGENERATE_SECRET', '');
  Create your secret key. define('REGENERATE_SECRET', 'SecretKey12345');
6. Find (line 40) $POSSIBLE_FIRMWARE_VERSIONS = array( '8.0', '8.0.1', '10.0', '11.1.1' );
  Add the firmwares you want your repository to support
  Close config.inc.default.php and rename to config.inc.php
7. Regenerate your repository by calling http://mywebsite.com/regenerate.php?secret=secretkeyhere

All done. The Installer repository is now ready. When the beta becomes available, please test your repo. 
