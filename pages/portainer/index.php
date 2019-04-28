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
$portainer_hostname = Core::getSetting('portainer_hostname', 'portainer');
if(strlen($portainer_hostname) < 2){
  $portainer_hostname = $_SERVER['HTTP_HOST'];
}
$portainer_port = Core::getSetting('portainer_port', 'portainer');
$portainer_url = sprintf('http://%s:%s/#/%s', $portainer_hostname, $portainer_port, $page);
?>

<style type="text/css">
body > #page_container{
  min-width: 100%;
  padding-left: 0;
  padding-right: 0;
}
</style>

<iframe
  id="portainer_iframe"
  src="<?php echo $portainer_url ?>"
  frameborder="0"
  scrolling="yes"
  style="width: 100%; position: absolute; top: 50px;"
></iframe>

<script type="text/javascript">
  var navbar_height = 50;
  var footbar_height = 50;

  function adjustIFrameHeight() {
    var height = $(window).height() - navbar_height - footbar_height;
    // apply height to iframe
    $('#portainer_iframe').css("height", height);
  }

  $(window).on("resize", adjustIFrameHeight);
  $(document).load(adjustIFrameHeight);
  $(document).ready(adjustIFrameHeight);
</script>
