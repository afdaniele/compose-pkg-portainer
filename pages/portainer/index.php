<?php
# @Author: Andrea F. Daniele <afdaniele>
# @Email:  afdaniele@ttic.edu
# @Last modified by:   afdaniele

use \system\classes\Core;
use \system\classes\Configuration;

$pages_available = [
  'dashboard',
  'templates',
  'stacks',
  'containers',
  'images',
  'networks',
  'volumes',
  'events',
  'host',
  // ---
  'extensions',
  'endpoints',
  'settings'
];
$default_page = 'dashboard';

$page = Configuration::$ACTION;
if (!in_array(Configuration::$ACTION, $pages_available))
  $page = $default_page;

// get Portainer hostname (defaults to HTTP_HOST if not set)
$portainer_hostname = Core::getSetting('hostname', 'portainer');
if(strlen($portainer_hostname) < 2){
  $portainer_hostname = Core::getBrowserHostname();
}
$portainer_port = Core::getSetting('port', 'portainer');
$portainer_url = sprintf('http://%s:%s/#/%s', $portainer_hostname, $portainer_port, $page);
?>

<style type="text/css">
    #page_container{
      min-width: 100%;
    }
    
    ._ctheme_content {
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border-top: 1px solid black;
        border-left: 1px solid black;
    }
    
    #portainer_iframe {
        width: 100%;
        height: 100%;
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
    }
</style>

<iframe
  id="portainer_iframe"
  src="<?php echo $portainer_url ?>"
  frameborder="0"
  scrolling="yes"
></iframe>
