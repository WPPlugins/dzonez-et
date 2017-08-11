<?php
/*
Plugin Name: dzoneZ-Et
Plugin URI: http://blog.rswr.net/2008/07/28/dzonez-et-wordpress-plugin/
Description: Automatically displays a "dZone" button for each post. Full <a href="options-general.php?page=dzoneZ-Et.php">admin options</a> available.
Version: 1.0.4
Author: Ryan Christenson (The RSWR Network)
Author URI: http://www.rswr.net/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("dzoneZEt")) {
	class dzoneZEt {
		var $adminOptionsName = "dzoneZEtAdminOptions";
		function dzoneZEt() { //constructor
		}

		//Returns an array of admin options
		function getAdminOptions() {
			$zZEtAdminOptions = array('home' => 'true', 'post' => 'true', 'page' => 'true', 'tag' => 'true', 'arch' => 'true', 'promote' => 'true', 'display1' => 'true', 'style' => 'true', 'body' => 'true');
			$zZEtOptions = get_option($this->adminOptionsName);
			if (!empty($zZEtOptions)) {
				foreach ($zZEtOptions as $key => $option)
				$zZEtAdminOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $zZEtAdminOptions);
			return $zZEtAdminOptions;
		}
		function init() {
			$this->getAdminOptions();
		}

		//Prints out the admin page
		function printAdminPage() {
			$zZEtOptions = $this->getAdminOptions();
			if (isset($_POST['update_dzoneZEtSettings'])) {
			
				// Save Settings
				if($_POST['home'] == "on") update_option('zZEt_home', "checked=on");
  				else update_option('zZEt_home', "");
  				if($_POST['post'] == "on") update_option('zZEt_post', "checked=on");
  				else update_option('zZEt_post', "");
  				if($_POST['page'] == "on") update_option('zZEt_page', "checked=on");
  				else update_option('zZEt_page', "");
  				if($_POST['tag'] == "on") update_option('zZEt_tag', "checked=on");
  				else update_option('zZEt_tag', "");
  				if($_POST['arch'] == "on") update_option('zZEt_arch', "checked=on");
  				else update_option('zZEt_arch', "");
  				if($_POST['srch'] == "on") update_option('zZEt_srch', "checked=on");
  				else update_option('zZEt_srch', "");
  				if($_POST['promote'] == "on") update_option('zZEt_promote', "checked=on");
  				else update_option('zZEt_promote', "");
  				$zz_display1 = $_POST['display1'];
  				$zz_style = $_POST['style'];
  				$zz_body = $_POST['body'];

				// Update Settings
				update_option('zZEt_display1', $zz_display1);
				update_option('zZEt_style', $zz_style);
				update_option('zZet_body', $zz_body);

				// Update Admin
				update_option($this->adminOptionsName, $zZEtOptions);
?>
<div class="updated"><p><span class="tblBold"><?php _e("Options Updated!", "dzoneZEt");?></span></p></div>
<?php
			} else {
				// Retrieve Options
				$zz_display1 = get_option('zZEt_display1');
				$zz_style = get_option('zZEt_style');
				$zz_body = get_option('zZet_body');
			}
?>
<div class="wrap">
<h2><?php _e('dzoneZ-Et 1.0.4','diggZEt'); ?></h2>
<style type="text/css">
<!--
.tblPad td{padding:10px;text-align:left;}
.tblPad th{text-align:left;vertical-align:top;}
.tblRed{color:red;font-weight:700;}
.tblBold{font-weight:700;}
-->
</style>
<form class="form-table" method="post" action="<?php _e($_SERVER["REQUEST_URI"]); ?>">
<div class="updated"><p><span class="tblBold"><?php _e('This plugin is soon to be discontinued. Check out <a href="http://blog.rswr.net/2009/02/14/social-media-wordpress-plugin/" target="_blank">S-ButtonZ</a> the new combined version of all four of our social media button plugins.<br /><br /><a href="http://wordpress.org/extend/plugins/s-buttonz/" target="_blank">Download S-ButtonZ Here</a>', "buzzZEt");?></span></p></div>
<?php //Display Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Display Settings','dzoneZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Hide Buttons On...
</td><td>
<span class="tblBold">
<input type="checkbox" name="home" <?php _e(get_option('zZEt_home')); ?> /> Home Page (Recommended to speed up your Home Page's load time.)<br />
<input type="checkbox" name="post" <?php _e(get_option('zZEt_post')); ?> /> Posts<br />
<input type="checkbox" name="page" <?php _e(get_option('zZEt_page')); ?> /> Pages<br />
<input type="checkbox" name="tag" <?php _e(get_option('zZEt_tag')); ?> /> Tag Pages<br />
<input type="checkbox" name="arch" <?php _e(get_option('zZEt_arch')); ?> /> Archives (This is all Category, Author and Date based pages)<br />
<input type="checkbox" name="srch" <?php _e(get_option('zZEt_srch')); ?> /> Search Page Results<br />
<span class="tblRed">Single Page or Post</span>
<br />Note: Add the following html snippet to any page or post you would like to the hide the dZone button on.
<br />&lt;!--dzoneZ=none--&gt;
</span>
</td></tr>
<tr>
<th scope="row">
Button Position
</td><td>
<select id="display1" name="display1">
	<option value="" <?php _e($zz_display1=="" ? "selected" : ""); ?>>Top Right</option>
	<option value="left" <?php _e($zz_display1=="left" ? "selected" : ""); ?>>Top Left</option>
	<option value="bottomL" <?php _e($zz_display1=="bottomL" ? "selected" : ""); ?>>Bottom Left</option>
	<option value="bottomR" <?php _e($zz_display1=="bottomR" ? "selected" : ""); ?>>Bottom Right</option>
</select>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //Button Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Button Settings','dzoneZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Choose Style
</td><td style="vertical-align:top;">
<select id="style" name="style">
	<option value="" <?php _e($zz_style=="" ? "selected" : ""); ?>>Style 1</option>
	<option value="2" <?php _e($zz_style=="2" ? "selected" : ""); ?>>Style 2</option>
</select>
</td>
<td>
<img src="<?php _e(dzoneZEt_Url()) ?>dzone-examples.png" width="300px" height="120px" />
</td></tr>
<tr>
<th scope="row">
Description (Blurb)
</td><td colspan="2">
<select id="body" name="body">
	<option value="" <?php _e($zz_body=="" ? "selected" : ""); ?>>Manual (Blank Summary)</option>
	<option value="150" <?php _e($zz_body=="150" ? "selected" : ""); ?>>150 Charachter Summary</option>
	<option value="250" <?php _e($zz_body=="250" ? "selected" : ""); ?>>250 Charachter Summary</option>
</select>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //Other Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Other Settings','dzoneZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Help promote dzoneZ-Et?
</td><td>
<input type="checkbox" name="promote" <?php _e(get_option('zZEt_promote')); ?> /> <span class="tblBold">Place a support link at the bottom of each post/page that uses a dZone button. Thanks for your support!</span>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //More Plugins ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Like this plugin?','dzoneZEt'); ?> Try another Social Bookmarking Plugin by <a href="http://www.rswr.net/">The RSWR Network</a></span></h3>
      <div class="inside">
      <ul>
<li><a href="http://blog.rswr.net/2008/11/13/yahoo-buzz-wordpress-plugin/" target="blank">buzzZ-Et (Yahoo! Buzz Buttons)</a></li>
<li><a href="http://blog.rswr.net/2008/05/23/wordpress-plugin-diggz-et/" target="blank">diggZ-Et (Digg Buttons)</a></li>
<li><a href="http://blog.rswr.net/2008/07/29/reddz-et-wordpress-plugin/" target="blank">reddZ-Et (reddit Buttons)</a></li>
      </ul>
      </div>
    </div>
  </div>
	<input type="submit" name="update_dzoneZEtSettings" value="<?php _e('Update Settings', 'dzoneZEt') ?>" class="button-primary action" /><br /><br />
</form>
</div>
<?php
		}
	}
}

// Get Plugin URL
function dzoneZEt_Url() {
	$path = dirname(__FILE__);
	$path = str_replace("\\","/",$path);
	$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
	return $path;
}

// Initialize the admin panel
if (!function_exists("dzoneZEt_ap")) {
	function dzoneZEt_ap() {
		global $zZEt_init;
		if (!isset($zZEt_init)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('dzoneZ-Et', 'dzoneZ-Et', 9, basename(__FILE__), array(&$zZEt_init, 'printAdminPage'));
		}
	}
}

// Truncate the Summary
if (!function_exists("dzoneZEt_trunk")) {
	function dzoneZEt_trunc($trunc, $tnum) {
		if (strlen($trunc) > 0 && strlen($trunc) > $tnum) {
			$k = 0;
			while ($k >= 0 && $k < strlen($trunc)) {
				$i = strpos($trunc, " ", $k);
				$j = strpos($trunc, chr(10), $k);
				if ($i === FALSE && $j === FALSE) {
					return $trunc;
				} else {
					if ($i > 0 && $j > 0) {
						if ($i < $j) {
							$k = $i;
						} else {
							$k = $j;
						}
					} elseif ($i > 0) {
						$k = $i;
					} elseif ($j > 0) {
						$k = $j;
					}

					if ($k >= $tnum) {
						return substr($trunc, 0, $k) . "...";
					} else {
						$k++;
					}
				}
			}
		} else {
			return $trunc;
		}
	}
}

// Create Button
if (!function_exists("dzoneZEt_But")) {
	function dzoneZEt_But($content) {
		// Retrieve Options
		$zz_display1 = get_option('zZEt_display1');
		$zz_style = get_option('zZEt_style');
		$zz_body = get_option('zZEt_body');
?>
<?php 
// Display Top Right
if($zz_display1 == "") {
	if($zz_style == "") {
_e('<div style="float: right; width: 42px; padding-right: 10px; margin: 0 0 0 10px;">','diggZEt');
	}
	elseif($zz_style == "2") {
_e('<div style="float: right; width: 42px; padding-right: 115px; margin: 0 0 0 10px;">','diggZEt');
	}
}

// Display Top Left
elseif($zz_display1 == "left") {
	if($zz_style == "") {
_e('<div style="float: left; width: 42px; padding-right: 10px; margin: 0 10px 0 0;">','diggZEt');
	}
	elseif($zz_style == "2") {
_e('<div style="float: left; width: 42px; padding-right: 115px; margin: 0 10px 0 0;">','diggZEt');
	}
}

// Display Bottom Left
elseif($zz_display1 == "bottomL") {
	if($zz_style == "") {
_e('<div style="position:relative; width: 100%; padding: 0 0 90px 0;">','diggZEt');
_e('<div style="position: absolute; bottom: 10px; width: 42px;">','diggZEt');
	}
	elseif($zz_style == "2") {
_e('<div style="position:relative; width: 100%; padding: 0 0 30px 0;">','diggZEt');
_e('<div style="position: absolute; bottom: 10px; width: 42px;">','diggZEt');
	}
}

// Display Bottom Right
elseif($zz_display1 == "bottomR") {
	if($zz_style == "") {
_e('<div style="position:relative; width: 100%; padding: 0 0 90px 0;">','diggZEt');
_e('<div style="position: absolute; bottom: 10px; right:10px; width: 42px;">','diggZEt');
	}
	elseif($zz_style == "2") {
_e('<div style="position:relative; width: 100%; padding: 0 0 30px 0;">','diggZEt');
_e('<div style="position: absolute; bottom: 10px; right:115px; width: 42px;">','diggZEt');
	}
}
?>
<script type="text/javascript">
<?php
$zz_old = array('/\n/', '/\\[[^\\]]*\\]/');
$zz_new = array('', '');
?>
<!--
var dzone_url = '<?php the_permalink(); ?>';
var dzone_title = '<?php the_title(); ?>';
var dzone_blurb = '<?php if($zz_body != "") _e(dzoneZEt_trunc(strip_tags(preg_replace($zz_old, $zz_new, $content)),$zz_body)); ?>';
var dzone_style = '<?php if ($zz_style == '') _e('1','diggZEt'); else _e($zz_style,'diggZEt'); ?>';
//-->
</script>
<script language="javascript" src="http://widgets.dzone.com/widgets/zoneit.js"></script> 
</div>
<?php
	}
}

// Add Button
if (!function_exists("dzoneZEt_AddBut")) {
	function dzoneZEt_AddBut($content) {
		$zz_display1 = get_option('zZEt_display1');
		//error_reporting(E_ALL);
		if(is_home() && get_option('zZEt_home') == "checked=on") return $content;
		if(is_single() && get_option('zZEt_post') == "checked=on") return $content;
		if(is_page() && get_option('zZEt_page') == "checked=on") return $content;
		if(is_tag() && get_option('zZEt_tag') == "checked=on") return $content;
		if(is_archive() && get_option('zZEt_arch') == "checked=on") return $content;
		if(is_search() && get_option('zZEt_srch') == "checked=on") return $content;
		if (strpos($content, "dzoneZ=none") == TRUE) return $content;
		if($zz_display1 == "bottomL" || $zz_display1 == "bottomR") {
			$content = dzoneZEt_But($content).$content;
			if(is_page() || is_single()) {
				if (get_option('zZEt_promote') == "checked=on") {
					$content .= "<p>dZone buttons brought to you by <a href='http://blog.rswr.net/2008/07/28/dzonez-et-wordpress-plugin/'>dzoneZ-Et (WordPress Plugin)</a></p></div>";
				} else {
					$content .= '</div>';
				}
			} else {
				$content .= '</div>';
			}
			return $content;
		}
		else {
			$content = dzoneZEt_But($content).$content;
			if(is_page() || is_single()) {
				if (get_option('zZEt_promote') == "checked=on") {
					$content .= "<p>dZone buttons brought to you by <a href='http://blog.rswr.net/2008/07/28/dzonez-et-wordpress-plugin/'>dzoneZ-Et (WordPress Plugin)</a></p>";
				}
			}
			return $content;
		}
	}
}

// Initialize Class
if (class_exists("dzoneZEt")) {
	$zZEt_init = new dzoneZEt();
}

//Actions and Filters
if (isset($zZEt_init)) {
	//Actions
	add_action('dzoneZ-Et/dzoneZ-Et.php', array(&$zZEt_init, 'init'));
	add_action('admin_menu', 'dzoneZEt_ap');
	//Filters
	add_filter('the_content', 'dzoneZEt_AddBut');
}

?>
