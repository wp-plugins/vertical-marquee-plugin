<?php
/*
Plugin Name: Vertical marquee plugin
Plugin URI: http://www.gopiplus.com/work/2012/06/30/vertical-marquee-wordpress-plugin/
Description:  You can use this vertical marquee plugin to make your text scroll upward or downwards. This plugin will work all leading browsers. 
Version: 5.1
Author: Gopi.R
Author URI: http://www.gopiplus.com/work/2012/06/30/vertical-marquee-wordpress-plugin/
Donate link: http://www.gopiplus.com/work/2012/06/30/vertical-marquee-wordpress-plugin/
Tags: vertical, marquee
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

global $wpdb, $wp_version;
define("WP_VM_TABLE", $wpdb->prefix . "verticalmarquee");
define('WP_vm_FAV', 'http://www.gopiplus.com/work/2012/06/30/vertical-marquee-wordpress-plugin/');

if ( ! defined( 'WP_vm_BASENAME' ) )
	define( 'WP_vm_BASENAME', plugin_basename( __FILE__ ) );
	
if ( ! defined( 'WP_vm_PLUGIN_NAME' ) )
	define( 'WP_vm_PLUGIN_NAME', trim( dirname( WP_vm_BASENAME ), '/' ) );
	
if ( ! defined( 'WP_vm_PLUGIN_URL' ) )
	define( 'WP_vm_PLUGIN_URL', WP_PLUGIN_URL . '/' . WP_vm_PLUGIN_NAME );
	
if ( ! defined( 'WP_vm_ADMIN_URL' ) )
	define( 'WP_vm_ADMIN_URL', get_option('siteurl') . '/wp-admin/options-general.php?page=vertical-marquee-plugin' );

function vmarquee( $setting="1", $group="group1" ) 
{
	$arr = array();
	$arr["setting"] = $setting;
	$arr["group"] = $group;
	echo vm_shortcode($arr);
}

function verticalmarquee()
{
	global $wpdb;
	$sSql = "select vm_text,vm_link from ".WP_VM_TABLE." where vm_group='WIDGET' ";
	$sSql = $sSql . " and (`vm_date` >= NOW())";
	$sSql = $sSql . " order by vm_id desc";
	$data = $wpdb->get_results($sSql);
	if ( ! empty($data) ) 
	{
		$cnt = 0;
		$vsm = "";
		foreach ( $data as $data ) 
		{
			@$link = $data->vm_link;	
			if($cnt==0) 
			{  
				if($link != "" && $link != "#") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "" && $link != "#") { $vsm = $vsm . "</a><br />"; }
			}
			else
			{
				$vsm = $vsm . "   <br /><br />   ";
				if($link != "" && $link != "#") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "" && $link != "#") { $vsm = $vsm . "</a><br />"; }
			}			
			$cnt = $cnt + 1;
		}
	}
	else
	{
		$vsm = __('No data found, please check the expiration date.', 'vertical-marquee');
	}
	$vm_title = get_option('vm_title');
	$vm_setting1 = get_option('vm_setting1');
	list($vm_scrollamount, $vm_scrolldelay, $vm_direction, $vm_style) = explode("~~", $vm_setting1);
	
	$what_marquee = "";	
	$what_marquee = $what_marquee . "<div style='padding:3px;'>";
	$what_marquee = $what_marquee . "<marquee style='$vm_style' scrollamount='$vm_scrollamount' scrolldelay='$vm_scrolldelay' direction='$vm_direction' onmouseover='this.stop()' onmouseout='this.start()'>";
	$what_marquee = $what_marquee . $vsm;
	$what_marquee = $what_marquee . "</marquee>";
	$what_marquee = $what_marquee . "</div>";
	echo $what_marquee;
}

function vm_shortcode( $atts ) 
{
	global $wpdb;
	//[vertical-marguee setting="1" group="widget"]
	if ( ! is_array( $atts ) )	{ return ''; }
	$setting = $atts['setting'];
	$group = $atts['group'];
	switch ($setting) 
	{ 
		case 1: 
			$vm_setting = get_option('vm_setting1');
			break;
		case 2: 
			$vm_setting = get_option('vm_setting2');
			break;
		default:
			$vm_setting = get_option('vm_setting3');
	}
	list($vm_scrollamount, $vm_scrolldelay, $vm_direction, $vm_style) = explode("~~", $vm_setting);
	
	// Database query
	$what_marquee = "";	
	$sSql = "select vm_text,vm_link from ".WP_VM_TABLE." where vm_group='$group'";
	$sSql = $sSql . " and (`vm_date` >= NOW())";
	$sSql = $sSql . " ORDER BY vm_id desc";
	$data = $wpdb->get_results($sSql);
	if ( ! empty($data) ) 
	{
		$cnt = 0;
		$vsm = "";
		foreach ( $data as $data ) 
		{
			@$link = $data->vm_link;
			if($cnt==0) 
			{  
				if($link != "" && $link != "#") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "" && $link != "#") { $vsm = $vsm . "</a><br />"; }
			}
			else
			{
				$vsm = $vsm . "   <br /><br />   ";
				if($link != "" && $link != "#") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "" && $link != "#") { $vsm = $vsm . "</a><br />"; }
			}			
			$cnt = $cnt + 1;
		}
		
		// Marquee text display
		$what_marquee = $what_marquee . "<div style='padding:3px;'>";
		$what_marquee = $what_marquee . "<marquee style='$vm_style' scrollamount='$vm_scrollamount' scrolldelay='$vm_scrolldelay' direction='$vm_direction' onmouseover='this.stop()' onmouseout='this.start()'>";
		$what_marquee = $what_marquee . $vsm;
		$what_marquee = $what_marquee . "</marquee>";
		$what_marquee = $what_marquee . "</div>";
	}
	else
	{
		$what_marquee = __('Please check your short code, no records available.', 'vertical-marquee');	
	}
	return $what_marquee;
}

function vm_deactivate() 
{
	delete_option('vm_title');
	delete_option('vm_setting1');
	delete_option('vm_setting2');
	delete_option('vm_setting3');
}

function vm_activation() 
{
	global $wpdb;
	if($wpdb->get_var("show tables like '". WP_VM_TABLE . "'") != WP_VM_TABLE) 
	{
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `". WP_VM_TABLE . "` (
			  `vm_id` int(11) NOT NULL auto_increment,
			  `vm_text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
			  `vm_link` VARCHAR( 1024 ) NOT NULL default '#',
			  `vm_group` VARCHAR( 10 ) NOT NULL default 'GROUP1',
			  `vm_date` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`vm_id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			");
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group, vm_date) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'WIDGET', '9999-01-01');"; 
		$wpdb->query($sSql);
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group, vm_date) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'WIDGET', '9999-01-01');"; 
		$wpdb->query($sSql);
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group, vm_date) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'GROUP1', '9999-01-01');"; 
		$wpdb->query($sSql);
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group, vm_date) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'GROUP1', '9999-01-01');"; 
		$wpdb->query($sSql);
	}
	// vm_scrollamount~~vm_scrolldelay~~vm_direction~~vm_style
	add_option('vm_title', "Vertical marquee");
	add_option('vm_setting1', "2~~5~~up~~height:100px;");
	add_option('vm_setting2', "2~~5~~up~~color:#FF0000;font:Arial;height:100px;");
	add_option('vm_setting3', "2~~5~~down~~color:#FF0000;font:Arial;height:100px;");
}

function vm_admin_options() 
{
	global $wpdb;
	$current_page = isset($_GET['ac']) ? $_GET['ac'] : '';
	switch($current_page)
	{
		case 'edit':
			include('pages/content-management-edit.php');
			break;
		case 'add':
			include('pages/content-management-add.php');
			break;
		case 'set':
			include('pages/content-setting.php');
			break;
		default:
			include('pages/content-management-show.php');
			break;
	}
}

function vm_add_to_menu() 
{
	add_options_page( __('Vertical marquee','vertical-marquee'), __('Vertical marquee','vertical-marquee'), 'manage_options', 'vertical-marquee-plugin', 'vm_admin_options' );
}

function vm_widget_init() 
{
	if(function_exists('wp_register_sidebar_widget')) 	
	{
		wp_register_sidebar_widget( __('Vertical marquee','vertical-marquee'), __('Vertical marquee','vertical-marquee'), 'vm_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 	
	{
		wp_register_widget_control( __('Vertical marquee','vertical-marquee'), array( __('Vertical marquee','vertical-marquee'), 'widgets'), 'vm_control');
	} 
}

function vm_control() 
{
	$vm_title = get_option('vm_title');
	if (isset($_POST['vm_control_submit'])) 
	{
		$vm_title = $_POST['vm_title'];
		update_option('vm_title', $vm_title);
	}
	echo '<p>'.__('Title:','vertical-marquee').'<br><input  style="width: 200px;" type="text" value="';
	echo $vm_title . '" name="vm_title" id="vm_title" /></p>';
	echo '<input type="hidden" id="vm_control_submit" name="vm_control_submit" value="1" />';
	
	echo '<p>';
	_e('Check official website for more info', 'vertical-marquee');
	?> <a target="_blank" href="<?php echo WP_vm_FAV; ?>"><?php _e('click here', 'vertical-marquee'); ?></a></p><?php
}

function vm_widget($args) 
{
	extract($args);
	$vm_title = get_option('vm_title');
	if($vm_title <> "")
	{
		echo $before_widget . $before_title;
		echo get_option('vm_title');
		echo $after_title;
	}
	else
	{
		echo "<div style='padding-top:10px;padding-bottom:10px;'>";
	}
	verticalmarquee();
	if($vm_title <> "")
	{
		echo $after_widget;
	}
	else
	{
		echo "</div>";
	}
}

function vm_textdomain() 
{
	  load_plugin_textdomain( 'vertical-marquee', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action('plugins_loaded', 'vm_textdomain');
add_shortcode( 'vertical-marguee', 'vm_shortcode' );
add_action("plugins_loaded", "vm_widget_init");
register_activation_hook(__FILE__, 'vm_activation');
add_action('admin_menu', 'vm_add_to_menu');
register_deactivation_hook( __FILE__, 'vm_deactivate' );
add_action('init', 'vm_widget_init');
?>