<?php

/*
Plugin Name: Vertical marquee plugin
Plugin URI: http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/
Description: Vertical marquee plugin.   
Version: 2.0
Author: Gopi.R
Author URI: http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/
Donate link: http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/
Tags: vertical, marquee
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

global $wpdb, $wp_version;
define("WP_VM_TABLE", $wpdb->prefix . "verticalmarquee");

function verticalmarquee()
{
	global $wpdb;
	$data = $wpdb->get_results("select vm_text,vm_link from ".WP_VM_TABLE." where vm_group='WIDGET' order by vm_id desc");
	if ( ! empty($data) ) 
	{
		$cnt = 0;
		$vsm = "";
		foreach ( $data as $data ) 
		{
			@$link = $data->vm_link;	
			if($cnt==0) 
			{  
				if($link != "") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "") { $vsm = $vsm . "</a>"; }
			}
			else
			{
				$vsm = $vsm . "   <br />   ";
				if($link != "") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "") { $vsm = $vsm . "</a>"; }
			}			
			$cnt = $cnt + 1;
		}
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

add_shortcode( 'vertical-marguee', 'vm_shortcode' );

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
	$data = $wpdb->get_results("select vm_text,vm_link from ".WP_VM_TABLE." where vm_group='$group' ORDER BY vm_id desc");
	if ( ! empty($data) ) 
	{
		$cnt = 0;
		$vsm = "";
		foreach ( $data as $data ) 
		{
			@$link = $data->vm_link;
			if($cnt==0) 
			{  
				if($link != "") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "") { $vsm = $vsm . "</a>"; }
			}
			else
			{
				$vsm = $vsm . "   <br />   ";
				if($link != "") { $vsm = $vsm . "<a href='".$link."'>"; } 
				$vsm = $vsm . stripslashes($data->vm_text);
				if($link != "") { $vsm = $vsm . "</a>"; }
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
		$what_marquee = "Please check your short code, no records available.";	
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
			  PRIMARY KEY  (`vm_id`) )
			");
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'WIDGET');"; 
		$wpdb->query($sSql);
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'WIDGET');"; 
		$wpdb->query($sSql);
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'GROUP1');"; 
		$wpdb->query($sSql);
		$sSql = "INSERT INTO `". WP_VM_TABLE . "` (vm_text, vm_link, vm_group) VALUES ('This is sample text for Vertical marquee plugin.', '#', 'GROUP1');"; 
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
	?>
<div class="wrap">
  <?php
    $mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=vertical-marquee-plugin/vertical-marquee-plugin.php";

    $DID=@$_GET["DID"];
    $AC=@$_GET["AC"];
    $submittext = "Insert Message";

	if(@$AC <> "DEL" and trim(@$_POST['vm_text']) <>"")
    {
			if($_POST['vm_id'] == "" )
			{
					$sql = "insert into ".WP_VM_TABLE.""
					. " set `vm_text` = '" . mysql_real_escape_string(trim($_POST['vm_text']))
					. "', `vm_link` = '" . $_POST['vm_link']
					. "', `vm_group` = '" . $_POST['vm_group']
					. "'";	
			}
			else
			{
					$sql = "update ".WP_VM_TABLE.""
					. " set `vm_text` = '" . mysql_real_escape_string(trim($_POST['vm_text']))
					. "', `vm_link` = '" . $_POST['vm_link']
					. "', `vm_group` = '" . $_POST['vm_group']
					. "' where `vm_id` = '" . $_POST['vm_id'] 
					. "'";	
			}
			$wpdb->get_results($sql);
    }
    
    if($AC=="DEL" && $DID > 0)
    {
        $wpdb->get_results("delete from ".WP_VM_TABLE." where vm_id=".$DID);
    }
    
    if($DID<>"" and $AC <> "DEL")
    {
        //select query
        $data = $wpdb->get_results("select * from ".WP_VM_TABLE." where vm_id=$DID limit 1");
    
        //bad feedback
        if ( empty($data) ) 
        {
           echo "<div id='message' class='error'><p>No data available</p></div>";
            return;
        }
        
        $data = $data[0];
        
        //encode strings
        if ( !empty($data) ) $vm_id_x = htmlspecialchars(stripslashes($data->vm_id)); 
        if ( !empty($data) ) $vm_text_x = htmlspecialchars(stripslashes($data->vm_text));
		if ( !empty($data) ) $vm_link_x = htmlspecialchars(stripslashes($data->vm_link));
		if ( !empty($data) ) $vm_group_x = htmlspecialchars(stripslashes($data->vm_group));
        
        $submittext = "Update Message";
    }
    ?>
  <h2>Vertical marquee plugin</h2>
  <script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/vertical-marquee-plugin/vertical-marquee-plugin.js"></script>
  <form name="form_vsm" method="post" action="<?php echo @$mainurl; ?>" onsubmit="return vsm_submit()"  >
    <table width="100%">
      <tr>
        <td align="left" valign="middle">Enter the message:</td>
      </tr>
      <tr>
        <td align="left" valign="middle"><textarea name="vm_text" cols="100" rows="4" id="vm_text"><?php echo @$vm_text_x; ?></textarea></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Enter the hyperlink:</td>
      </tr>
      <tr>
        <td align="left" valign="middle"><input name="vm_link" type="text" id="vm_link" size="105" value="<?php echo @$vm_link_x; ?>" maxlength="1024" /></td>
      </tr>
	  <tr>
        <td align="left" valign="middle">Select the group:</td>
      </tr>
      <tr>
        <td align="left" valign="middle">
		<select name="vm_group" id="vm_group">
			<option value='WIDGET' <?php if(@$vm_group_x=='WIDGET') { echo 'selected' ; } ?>>Widget</option>
            <option value='GROUP1' <?php if(@$vm_group_x=='GROUP1') { echo 'selected' ; } ?>>Group1</option>
            <option value='GROUP2' <?php if(@$vm_group_x=='GROUP2') { echo 'selected' ; } ?>>Group2</option>
            <option value='GROUP3' <?php if(@$vm_group_x=='GROUP3') { echo 'selected' ; } ?>>Group3</option>
            <option value='GROUP4' <?php if(@$vm_group_x=='GROUP4') { echo 'selected' ; } ?>>Group4</option>
            <option value='GROUP5' <?php if(@$vm_group_x=='GROUP5') { echo 'selected' ; } ?>>Group5</option>
            <option value='GROUP6' <?php if(@$vm_group_x=='GROUP6') { echo 'selected' ; } ?>>Group6</option>
            <option value='GROUP7' <?php if(@$vm_group_x=='GROUP7') { echo 'selected' ; } ?>>Group7</option>
            <option value='GROUP8' <?php if(@$vm_group_x=='GROUP8') { echo 'selected' ; } ?>>Group8</option>
            <option value='GROUP9' <?php if(@$vm_group_x=='GROUP9') { echo 'selected' ; } ?>>Group9</option>
          </select>
		</td>
      </tr>
      <input name="vm_id" id="vm_id" type="hidden" value="<?php echo @$vm_id_x; ?>">
    </table>
    <table width="100%">
      <tr>
        <td align="left" style="height:35px;">
			<input name="publish" lang="publish" class="button-primary" value="<?php echo @$submittext?>" type="submit" />
			<input name="publish" lang="publish" class="button-primary" onclick="_vm_redirect()" value="Cancel" type="button" />
        </td>
        <td align="right">
			<input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=vertical-marquee-plugin/vertical-marquee-plugin.php'" value="Content Management" type="button" />
			<input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=vertical-marquee-plugin/setting.php'" value="Setting Page" type="button" />
			<input name="livedemo" lang="livedemo" class="button-primary" onClick="window.open('http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/');" value="Plugin Live Demo" type="button" />
			<input name="help" lang="help" class="button-primary" onClick="window.open('http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/');" value="Plugin Help" type="button" />
        </td>	
      </tr>
    </table>
  </form>
  <div class="tool-box">
    <?php
	$data = $wpdb->get_results("select * from ".WP_VM_TABLE." order by vm_id desc");
	?>
    <form name="frm_vsm" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
			<th align="left" scope="col">Group</th>
            <th align="left" scope="col">Message</th>
            <th align="left" scope="col">Action</th>
          </tr>
        </thead>
		<tbody>
        <?php 
		if (!empty($data) ) 
		{
			$i = 0;
			foreach ( $data as $data ) 
			{ 
				?>
				  <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
					<td align="left" valign="middle"><?php echo(stripslashes($data->vm_group)); ?></td>
					<td align="left" valign="middle"><a href='<?php echo $data->vm_link; ?>'><?php echo(stripslashes($data->vm_text)); ?></a></td>
					<td align="left" valign="middle"><a href="options-general.php?page=vertical-marquee-plugin/vertical-marquee-plugin.php&DID=<?php echo($data->vm_id); ?>">Edit</a> &nbsp; <a onClick="javascript:_vsmdelete('<?php echo($data->vm_id); ?>')" href="javascript:void(0);">Delete</a> </td>
				  </tr>
				<?php 
				$i = $i+1; 
			}
		}
		else
		{
			?>
			<tr><td colspan="3">No record found..</td></tr>
			<?php
		}
		?>
		<tbody>
      </table>
    </form>
	<br />
    <strong>Plugin configuration option</strong>
    <ol>
      <li>Drag and drop the widget</li>
      <li>Add directly in the theme</li>
      <li>Short code for pages and posts</li>
    </ol>
    Note: Check official website for more info <a href="http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/" target="_blank">click here</a> </div>
</div>
<?php
}

function vm_add_to_menu() 
{
	add_options_page('Vertical marquee plugin', 'Vertical marquee', 'manage_options', __FILE__, 'vm_admin_options' );
	add_options_page('Vertical marquee plugin', '', 'manage_options', "vertical-marquee-plugin/setting.php",'' );
}

function vm_widget_init() 
{
	if(function_exists('wp_register_sidebar_widget')) 	
	{
		wp_register_sidebar_widget('Vertical marquee', 'Vertical marquee', 'vm_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 	
	{
		wp_register_widget_control('Vertical marquee', array('Vertical marquee', 'widgets'), 'vm_control');
	} 
}

function vm_control() 
{
	$vm_title = get_option('vm_title');
	if (@$_POST['vm_control_submit']) 
	{
		$vm_title = $_POST['vm_title'];
		update_option('vm_title', $vm_title);
	}
	echo '<p>Title:<br><input  style="width: 200px;" type="text" value="';
	echo $vm_title . '" name="vm_title" id="vm_title" /></p>';
	echo '<input type="hidden" id="vm_control_submit" name="vm_control_submit" value="1" />';
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

add_action("plugins_loaded", "vm_widget_init");
register_activation_hook(__FILE__, 'vm_activation');
add_action('admin_menu', 'vm_add_to_menu');
register_deactivation_hook( __FILE__, 'vm_deactivate' );
add_action('init', 'vm_widget_init');
?>
