<?PHP
#################################################################################
## Developed by Manifest Interactive, LLC                                      ##
## http://www.manifestinteractive.com                                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
##                                                                             ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY           ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE         ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR          ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE          ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        ##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR             ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE        ##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,           ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Schmalfeldt                                           ##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 */

/**
 * Begin Document
 */

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO )
# $db = new DbConnect('localhost', 'apnsuser', 'apnspassword', 'apnsdb');

# use an ini file in the directory above this one
# ../apns.ini should look like this:
/*
[db]
host = "localhost"
user = "dbuser"
passwd = "dbpass"
schema = "apns"
*/

$config = parse_ini_file('../apns.ini', true);
$db = new DbConnect($config['db']['host'], $config['db']['user'], $config['db']['passwd'], $config['db']['schema']);
$db->show_errors();

// FETCH $_GET OR CRON ARGUMENTS TO AUTOMATE TASKS
$args = (!empty($_GET)) ? $_GET:array('task'=>$argv[1]);

// CREATE APNS OBJECT, WITH DATABASE OBJECT AND ARGUMENTS
$apns = new APNS($db, $args);
?>
