<div class="wrap">
  <h2>Vertical marquee setting</h2>
  <?php
global $wpdb, $wp_version;

$vm_setting1 = get_option('vm_setting1');
$vm_setting2 = get_option('vm_setting2');
$vm_setting3 = get_option('vm_setting3');

list($vm_scrollamount1, $vm_scrolldelay1, $vm_direction1, $vm_style1) = explode("~~", $vm_setting1);
list($vm_scrollamount2, $vm_scrolldelay2, $vm_direction2, $vm_style2) = explode("~~", $vm_setting2);
list($vm_scrollamount3, $vm_scrolldelay3, $vm_direction3, $vm_style3) = explode("~~", $vm_setting3);

if (@$_POST['vm_submit']) 
{
	$vm_scrollamount1 = stripslashes($_POST['vm_scrollamount1']);
	$vm_scrollamount2 = stripslashes($_POST['vm_scrollamount2']);
	$vm_scrollamount3 = stripslashes($_POST['vm_scrollamount3']);
	$vm_scrolldelay1 = stripslashes($_POST['vm_scrolldelay1']);
	$vm_scrolldelay2 = stripslashes($_POST['vm_scrolldelay2']);
	$vm_scrolldelay3 = stripslashes($_POST['vm_scrolldelay3']);
	$vm_direction1 = stripslashes($_POST['vm_direction1']);
	$vm_direction2 = stripslashes($_POST['vm_direction2']);
	$vm_direction3 = stripslashes($_POST['vm_direction3']);
	$vm_style1 = stripslashes($_POST['vm_style1']);
	$vm_style2 = stripslashes($_POST['vm_style2']);
	$vm_style3 = stripslashes($_POST['vm_style3']);

	update_option('vm_setting1', $vm_scrollamount1 . "~~" . $vm_scrolldelay1 . "~~" . $vm_direction1 . "~~" . $vm_style1 );
	update_option('vm_setting2', $vm_scrollamount2 . "~~" . $vm_scrolldelay2 . "~~" . $vm_direction2 . "~~" . $vm_style2 );
	update_option('vm_setting3', $vm_scrollamount3 . "~~" . $vm_scrolldelay3 . "~~" . $vm_direction3 . "~~" . $vm_style3 );
}
?>
  <form name="form_vsm" method="post" action="">
  <table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
      <td width="7%">&nbsp;</td>
      <td width="13%"><strong>Scroll Amount</strong></td>
      <td width="13%"><strong>Scroll Delay</strong></td>
      <td width="7%"><strong>Direction</strong></td>
      <td width="60%"><strong>Style</strong></td>
    </tr>
    <tr>
      <td style="height:45px;"><strong>Setting 1 </strong></td>
      <td><input name="vm_scrollamount1" type="text" value="<?php echo $vm_scrollamount1; ?>"  id="vm_scrollamount1" maxlength="5">
      </td>
      <td><input name="vm_scrolldelay1" type="text" value="<?php echo $vm_scrolldelay1; ?>"  id="vm_scrolldelay1" maxlength="5"></td>
      <td><select name="vm_direction1" id="vm_direction1">
          <option value='up' <?php if(@$vm_direction1=='up') { echo 'selected' ; } ?>>up</option>
          <option value='down' <?php if(@$vm_direction1=='down') { echo 'selected' ; } ?>>down</option>
         </select></td>
      <td><input name="vm_style1" type="text" value="<?php echo $vm_style1; ?>"  id="vm_style1" size="70" maxlength="500"></td>
    </tr>
    <tr>
      <td style="height:45px;"><strong>Setting 2 </strong></td>
      <td><input name="vm_scrollamount2" type="text" value="<?php echo $vm_scrollamount2; ?>"  id="vm_scrollamount2" maxlength="5"></td>
      <td><input name="vm_scrolldelay2" type="text" value="<?php echo $vm_scrolldelay2; ?>"  id="vm_scrolldelay2" maxlength="5"></td>
      <td><select name="vm_direction2" id="vm_direction2">
          <option value='up' <?php if(@$vm_direction2=='up') { echo 'selected' ; } ?>>up</option>
          <option value='down' <?php if(@$vm_direction2=='down') { echo 'selected' ; } ?>>down</option>
         </select></td>
      <td><input name="vm_style2" type="text" value="<?php echo $vm_style2; ?>"  id="vm_style2" size="70" maxlength="500"></td>
    </tr>
    <tr>
      <td style="height:45px;"><strong>Setting 3 </strong></td>
      <td><input name="vm_scrollamount3" type="text" value="<?php echo $vm_scrollamount3; ?>"  id="vm_scrollamount3" maxlength="5"></td>
      <td><input name="vm_scrolldelay3" type="text" value="<?php echo $vm_scrolldelay3; ?>"  id="vm_scrolldelay3" maxlength="5"></td>
      <td><select name="vm_direction3" id="vm_direction3">
          <option value='up' <?php if(@$vm_direction3=='up') { echo 'selected' ; } ?>>up</option>
          <option value='down' <?php if(@$vm_direction3=='down') { echo 'selected' ; } ?>>down</option>
         </select></td>
      <td><input name="vm_style3" type="text" value="<?php echo $vm_style3; ?>"  id="vm_style3" size="70" maxlength="500"></td>
    </tr>
  </table>
      <table width="100%">
      <tr>
        <td align="left" style="height:35px;">
			<input name="vm_submit" id="vm_submit" lang="publish" class="button-primary" value="Update Setting" type="submit" />
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
	<br />
    <strong>Plugin configuration option</strong>
    <ol>
      <li>Drag and drop the widget</li>
      <li>Add directly in the theme</li>
      <li>Short code for pages and posts</li>
    </ol>
    Note: Check official website for more info <a href="http://www.gopipulse.com/work/2012/06/30/vertical-marquee-wordpress-plugin/" target="_blank">click here</a>
</div>
