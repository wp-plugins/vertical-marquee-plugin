<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php echo WP_vm_TITLE; ?></h2>
    <?php

	$vm_setting1 = get_option('vm_setting1');
	$vm_setting2 = get_option('vm_setting2');
	$vm_setting3 = get_option('vm_setting3');
	
	list($vm_scrollamount1, $vm_scrolldelay1, $vm_direction1, $vm_style1) = explode("~~", $vm_setting1);
	list($vm_scrollamount2, $vm_scrolldelay2, $vm_direction2, $vm_style2) = explode("~~", $vm_setting2);
	list($vm_scrollamount3, $vm_scrolldelay3, $vm_direction3, $vm_style3) = explode("~~", $vm_setting3);
	
	if (isset($_POST['vm_form_submit']) && $_POST['vm_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('sdp_form_setting');
		
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
	
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/vertical-marquee-plugin/pages/setting.js"></script>
	<form name="vm_form" method="post" action="">
	
		<h3>Setting 1</h3>
		<label for="tag-title">Scroll amount</label>
		<input name="vm_scrollamount1" type="text" value="<?php echo $vm_scrollamount1; ?>"  id="vm_scrollamount1" maxlength="5">
		<p>Scroll Amount, together with Scroll Delay, sets the speed of the scrolling. (Example: 2)</p>
		<label for="tag-title">Scroll delay</label>
		<input name="vm_scrolldelay1" type="text" value="<?php echo $vm_scrolldelay1; ?>"  id="vm_scrolldelay1" maxlength="5">
		<p>Scroll Delay, together with Scroll Amount, sets the speed of the scrolling. (Example: 5)</p>
		<label for="tag-title">Direction</label>
		<select name="vm_direction1" id="vm_direction1">
          <option value='up' <?php if($vm_direction1=='up') { echo 'selected' ; } ?>>Up</option>
          <option value='down' <?php if($vm_direction1=='down') { echo 'selected' ; } ?>>Down</option>
         </select>
		<p>Select your scroll direction.</p>
		<label for="tag-title">Style</label>
		<input name="vm_style1" type="text" value="<?php echo $vm_style1; ?>"  id="vm_style1" size="70" maxlength="500">
		<p>The style attribute can contain any CSS property. (Example: height:100px;)</p>
		
		<h3>Setting 2</h3>
		<label for="tag-title">Scroll amount</label>
		<input name="vm_scrollamount2" type="text" value="<?php echo $vm_scrollamount2; ?>"  id="vm_scrollamount2" maxlength="5">
		<p>Scroll Amount, together with Scroll Delay, sets the speed of the scrolling.</p>
		<label for="tag-title">Scroll delay</label>
		<input name="vm_scrolldelay2" type="text" value="<?php echo $vm_scrolldelay2; ?>"  id="vm_scrolldelay2" maxlength="5">
		<p>Scroll Delay, together with Scroll Amount, sets the speed of the scrolling.</p>
		<label for="tag-title">Direction</label>
		<select name="vm_direction2" id="vm_direction2">
          <option value='up' <?php if($vm_direction2=='up') { echo 'selected' ; } ?>>Up</option>
          <option value='down' <?php if($vm_direction2=='down') { echo 'selected' ; } ?>>Down</option>
         </select>
		<p>Select your scroll direction.</p>
		<label for="tag-title">Style</label>
		<input name="vm_style2" type="text" value="<?php echo $vm_style2; ?>"  id="vm_style2" size="70" maxlength="500">
		<p>The style attribute can contain any CSS property. </p>
		
		<h3>Setting 3</h3>
		<label for="tag-title">Scroll amount</label>
		<input name="vm_scrollamount3" type="text" value="<?php echo $vm_scrollamount3; ?>"  id="vm_scrollamount3" maxlength="5">
		<p>Scroll Amount, together with Scroll Delay, sets the speed of the scrolling.</p>
		<label for="tag-title">Scroll delay</label>
		<input name="vm_scrolldelay3" type="text" value="<?php echo $vm_scrolldelay3; ?>"  id="vm_scrolldelay3" maxlength="5">
		<p>Scroll Delay, together with Scroll Amount, sets the speed of the scrolling.</p>
		<label for="tag-title">Direction</label>
		<select name="vm_direction3" id="vm_direction3">
          <option value='up' <?php if($vm_direction3=='up') { echo 'selected' ; } ?>>Up</option>
          <option value='down' <?php if($vm_direction3=='down') { echo 'selected' ; } ?>>Down</option>
         </select>
		<p>Select your scroll direction.</p>
		<label for="tag-title">Style</label>
		<input name="vm_style3" type="text" value="<?php echo $vm_style3; ?>"  id="vm_style3" size="70" maxlength="500">
		<p>The style attribute can contain any CSS property.</p>
		
		<br />		
		<input type="hidden" name="vm_form_submit" id="vm_form_submit" value="yes"/>
		<input name="vm_submit" id="vm_submit" class="button add-new-h2" value="Submit" type="submit" />
		<input name="publish" lang="publish" class="button add-new-h2" onclick="_vm_redirect()" value="Cancel" type="button" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="_vm_help()" value="Help" type="button" />
		<?php wp_nonce_field('sdp_form_setting'); ?>
	</form>
  </div>
  <br /><p class="description"><?php echo WP_sdp_LINK; ?></p>
</div>
