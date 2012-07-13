// JavaScript Document
function vsm_submit()
{
	if(document.form_vsm.vm_text.value=="")
	{
		alert("Please enter the message to marquee.")
		document.form_vsm.vm_text.focus();
		return false;
	}
}

function _vsmdelete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm_vsm.action="options-general.php?page=vertical-marquee-plugin/vertical-marquee-plugin.php&AC=DEL&DID="+id;
		document.frm_vsm.submit();
	}
}	

function _vm_redirect()
{
	window.location = "options-general.php?page=vertical-marquee-plugin/vertical-marquee-plugin.php";
}