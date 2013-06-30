<div class="wrap">
<?php
$vm_errors = array();
$vm_success = '';
$vm_error_found = FALSE;

// Preset the form fields
$form = array(
	'vm_text' => '',
	'vm_link' => '',
	'vm_group' => '',
	'vm_date' => ''
);

// Form submitted, check the data
if (isset($_POST['vm_form_submit']) && $_POST['vm_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('vm_form_add');
	
	$form['vm_text'] = isset($_POST['vm_text']) ? $_POST['vm_text'] : '';
	if ($form['vm_text'] == '')
	{
		$vm_errors[] = __('Please enter marquee message.', WP_vm_UNIQUE_NAME);
		$vm_error_found = TRUE;
	}

	$form['vm_link'] = isset($_POST['vm_link']) ? $_POST['vm_link'] : '';
	$form['vm_group'] = isset($_POST['vm_group']) ? $_POST['vm_group'] : '';
	$form['vm_date'] = isset($_POST['vm_date']) ? $_POST['vm_date'] : '';
			
	//	No errors found, we can add this Group to the table
	if ($vm_error_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".WP_VM_TABLE."`
			(`vm_text`, `vm_link`, `vm_group`, `vm_date`)
			VALUES(%s, %s, %s, %s)",
			array($form['vm_text'], $form['vm_link'], $form['vm_group'], $form['vm_date'])
		);
		$wpdb->query($sql);
		
		$vm_success = __('New details was successfully added.', WP_vm_UNIQUE_NAME);
		
		// Reset the form fields
		$form = array(
			'vm_text' => '',
			'vm_link' => '',
			'vm_group' => '',
			'vm_date' => ''
		);
	}
}

if ($vm_error_found == TRUE && isset($vm_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $vm_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($vm_error_found == FALSE && strlen($vm_success) > 0)
{
	?>
	  <div class="updated fade">
		<p><strong><?php echo $vm_success; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=vertical-marquee-plugin">Click here</a> to view the details</strong></p>
	  </div>
	  <?php
	}
?>
<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/vertical-marquee-plugin/pages/setting.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php echo WP_vm_TITLE; ?></h2>
	<form name="vm_form" method="post" action="#" onsubmit="return _vm_submit()"  >
      <h3>Add message</h3>
      
	  <label for="tag-image">Enter marquee message</label>
      <textarea name="vm_text" id="vm_text" cols="125" rows="5"></textarea>
      <p>We can enter HTML content also.</p>
	  
	  <label for="tag-image">Enter link</label>
      <input name="vm_link" type="text" id="vm_link" value="#" size="125" />
      <p>When someone clicks on the message, where do you want to send them.</p>
	  
      <label for="tag-select-gallery-group">Select group</label>
      <select name="vm_group" id="vm_group">
	  <option value=''>Select</option>
	  <?php
		$sSql = "SELECT distinct(vm_group) as vm_group FROM `".WP_VM_TABLE."` order by vm_group";
		$myDistinctData = array();
		$arrDistinctDatas = array();
		$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
		$i = 0;
		if(count($myDistinctData) > 0)
		{
			foreach ($myDistinctData as $DistinctData)
			{
				$arrDistinctData[$i]["vm_group"] = strtoupper($DistinctData['vm_group']);
				$i = $i+1;
			}
		}
		for($j=$i; $j<$i+7; $j++)
		{
			$arrDistinctData[$j]["vm_group"] = "GROUP" . $j;
		}
		$arrDistinctData[$j+1]["vm_group"] = "WIDGET";
		$arrDistinctDatas = array_unique($arrDistinctData, SORT_REGULAR);
		foreach ($arrDistinctDatas as $arrDistinct)
		{
			?><option value='<?php echo $arrDistinct["vm_group"]; ?>'><?php echo $arrDistinct["vm_group"]; ?></option><?php
		}
		?>
      </select>
      <p>This is to group the message. Select your group. </p>
	  
	  <label for="tag-image">Expiration date</label>
      <input name="vm_date" type="text" id="vm_date" size="20" value="<?php echo date('Y-m-d', strtotime('+1 years')); ?>" maxlength="10" />
      <p>Enter expiration date for the message as per format. (Format: YYYY-MM-DD).</p>

      <input name="vm_id" id="vm_id" type="hidden" value="">
      <input type="hidden" name="vm_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="Insert Details" type="submit" />
        <input name="publish" lang="publish" class="button add-new-h2" onclick="_vm_redirect()" value="Cancel" type="button" />
        <input name="Help" lang="publish" class="button add-new-h2" onclick="_vm_help()" value="Help" type="button" />
      </p>
	  <?php wp_nonce_field('vm_form_add'); ?>
    </form>
</div>
<p class="description"><?php echo WP_vm_LINK; ?></p>
</div>