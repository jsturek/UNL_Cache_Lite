<?php
/**
 * Make package file for the UNL_UCBCN package.
 * 
 * PHP version 5
 * 
 * @category  Events 
 * @package   UNL_UCBCN
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2009 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://code.google.com/p/unl-event-publisher/
 */

ini_set('display_errors', true);

/**
 * Require the PEAR_PackageFileManager2 classes, and other
 * necessary classes for package.xml file creation.
 */
require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/File.php';
require_once 'PEAR/Task/Postinstallscript/rw.php';
require_once 'PEAR/Config.php';
require_once 'PEAR/Frontend.php';

/**
 * @var PEAR_PackageFileManager
 */
PEAR::setErrorHandling(PEAR_ERROR_DIE);
chdir(dirname(__FILE__));
//$pfm = PEAR_PackageFileManager2::importOptions('package.xml', array(
$pfm = new PEAR_PackageFileManager2();
$pfm->setOptions(array(
    'packagedirectory' => dirname(__FILE__),
    'baseinstalldir' => '/',
    'filelistgenerator' => 'svn',
    'ignore' => array(  'package.xml',
                        '.project',
                        '.buildpath',
                        '*.tgz',
                        'makepackage.php',
                        '*CVS/*',
                        '*.sh',
                        '*.svg',
                        '.cache',
                        'dataobject.ini',
                        'DBDataObjects',
                        'insert_sample_data.php',
                        'install.sh',
                        '*tests*',
                        '*scripts*'),
    'simpleoutput' => true,
    'roles'=>array('php'=>'php'),
    'exceptions'=>array()
));
$pfm->setPackage('UNL_Cache_Lite');
$pfm->setPackageType('php'); // this is a PEAR-style php script package
$pfm->setSummary('Basic caching library');
$pfm->setDescription('
This is a port of the Cache_Lite package from PEAR, with support for PHP 5 and
exceptions.
This package is a little cache system optimized for file containers. It is fast
and safe (because it uses file locking and/or anti-corruption tests).');
$pfm->setChannel('pear.unl.edu');
$pfm->setAPIStability('beta');
$pfm->setReleaseStability('beta');
$pfm->setAPIVersion('0.1.0');
$pfm->setReleaseVersion('0.1.0');
$pfm->setNotes('
Port of cache lite, remove PEAR dependency, use exceptions instead of PEAR_Error.
');

$pfm->updateMaintainer('lead','saltybeagle','Brett Bieber','brett.bieber@gmail.com');
$pfm->setLicense('LGPL', 'http://www.gnu.org/licenses/lgpl-3.0.txt');
$pfm->clearDeps();
$pfm->setPhpDep('5.1.2');
$pfm->setPearinstallerDep('1.5.4');
//$pfm->addPackageDepWithChannel('required', 'Cache_Lite', 'pear.php.net', '1.0');


$pfm->generateContents();
if (isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'make') {
    $pfm->writePackageFile();
} else {
    $pfm->debugPackageFile();
}
?>