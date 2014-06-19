<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php _e('Vertical marquee plugin','vertical-marquee'); ?></h2>
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
			<p><strong><?php _e('Details successfully updated.','vertical-marquee'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo WP_vm_PLUGIN_URL; ?>/pages/setting.js"></script>
	<form name="vm_form" method="post" action="">
	
		<h3><?php _e('Setting 1','vertical-marquee'); ?></h3>
		<label for="tag-title"><?php _e('Scroll amount','vertical-marquee'); ?></label>
		<input name="vm_scrollamount1" type="text" value="<?php echo $vm_scrollamount1; ?>"  id="vm_scrollamount1" maxlength="5">
		<p><?php _e('Scroll Amount, together with Scroll Delay, sets the speed of the scrolling.','vertical-marquee'); ?> (Example: 2)</p>
		
		<label for="tag-title"><?php _e('Scroll delay','vertical-marquee'); ?></label>
		<input name="vm_scrolldelay1" type="text" value="<?php echo $vm_scrolldelay1; ?>"  id="vm_scrolldelay1" maxlength="5">
		<p><?php _e('Scroll Delay, together with Scroll Amount, sets the speed of the scrolling.','vertical-marquee'); ?> (Example: 5)</p>
		
		<label for="tag-title"><?php _e('Direction','vertical-marquee'); ?></label>
		<select name="vm_direction1" id="vm_direction1">
          <option value='up' <?php if($vm_direction1=='up') { echo 'selected' ; } ?>>Up</option>
          <option value='down' <?php if($vm_direction1=='down') { echo 'selected' ; } ?>>Down</option>
         </select>
		<p><?php _e('Select your scroll direction.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Style','vertical-marquee'); ?></label>
		<input name="vm_style1" type="text" value="<?php echo $vm_style1; ?>"  id="vm_style1" size="70" maxlength="500">
		<p><?php _e('The style attribute can contain any CSS property.','vertical-marquee'); ?> (Example: height:100px;)</p>
		
		<h3><?php _e('Setting 2','vertical-marquee'); ?></h3>
		<label for="tag-title"><?php _e('Scroll amount','vertical-marquee'); ?></label>
		<input name="vm_scrollamount2" type="text" value="<?php echo $vm_scrollamount2; ?>"  id="vm_scrollamount2" maxlength="5">
		<p><?php _e('Scroll Amount, together with Scroll Delay, sets the speed of the scrolling.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Scroll delay','vertical-marquee'); ?></label>
		<input name="vm_scrolldelay2" type="text" value="<?php echo $vm_scrolldelay2; ?>"  id="vm_scrolldelay2" maxlength="5">
		<p><?php _e('Scroll Delay, together with Scroll Amount, sets the speed of the scrolling.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Direction','vertical-marquee'); ?></label>
		<select name="vm_direction2" id="vm_direction2">
          <option value='up' <?php if($vm_direction2=='up') { echo 'selected' ; } ?>>Up</option>
          <option value='down' <?php if($vm_direction2=='down') { echo 'selected' ; } ?>>Down</option>
         </select>
		<p><?php _e('Select your scroll direction.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Style','vertical-marquee'); ?></label>
		<input name="vm_style2" type="text" value="<?php echo $vm_style2; ?>"  id="vm_style2" size="70" maxlength="500">
		<p><?php _e('The style attribute can contain any CSS property.','vertical-marquee'); ?></p>
		
		<h3><?php _e('Setting 3','vertical-marquee'); ?></h3>
		<label for="tag-title"><?php _e('Scroll amount','vertical-marquee'); ?></label>
		<input name="vm_scrollamount3" type="text" value="<?php echo $vm_scrollamount3; ?>"  id="vm_scrollamount3" maxlength="5">
		<p><?php _e('Scroll Amount, together with Scroll Delay, sets the speed of the scrolling.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Scroll delay','vertical-marquee'); ?></label>
		<input name="vm_scrolldelay3" type="text" value="<?php echo $vm_scrolldelay3; ?>"  id="vm_scrolldelay3" maxlength="5">
		<p><?php _e('Scroll Delay, together with Scroll Amount, sets the speed of the scrolling.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Direction','vertical-marquee'); ?></label>
		<select name="vm_direction3" id="vm_direction3">
          <option value='up' <?php if($vm_direction3=='up') { echo 'selected' ; } ?>>Up</option>
          <option value='down' <?php if($vm_direction3=='down') { echo 'selected' ; } ?>>Down</option>
         </select>
		<p><?php _e('Select your scroll direction.','vertical-marquee'); ?></p>
		
		<label for="tag-title"><?php _e('Style','vertical-marquee'); ?></label>
		<input name="vm_style3" type="text" value="<?php echo $vm_style3; ?>"  id="vm_style3" size="70" maxlength="500">
		<p><?php _e('The style attribute can contain any CSS property.','vertical-marquee'); ?></p>
		
		<br />		
		<input type="hidden" name="vm_form_submit" id="vm_form_submit" value="yes"/>
		<input name="vm_submit" id="vm_submit" class="button add-new-h2" value="<?php _e('Submit','vertical-marquee'); ?>" type="submit" />
		<input name="publish" lang="publish" class="button add-new-h2" onclick="_vm_redirect()" value="<?php _e('Cancel','vertical-marquee'); ?>" type="button" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="_vm_help()" value="<?php _e('Help','vertical-marquee'); ?>" type="button" />
		<?php wp_nonce_field('sdp_form_setting'); ?>
	</form>
  </div>
  <br />
<p class="description">
	<?php _e('Check official website for more information', 'vertical-marquee'); ?>
	<a target="_blank" href="<?php echo WP_vm_FAV; ?>"><?php _e('click here', 'vertical-marquee'); ?></a>
</p>
</div>