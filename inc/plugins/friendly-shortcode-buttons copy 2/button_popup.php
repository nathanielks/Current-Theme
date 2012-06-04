<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Button</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="../../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="includes/css/friendly_buttons_tinymce.css" />

<script type="text/javascript">
 
var ButtonDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ButtonDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertButton(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var url = jQuery('#button-dialog input#button-url').val();
		var text = jQuery('#button-dialog input#button-text').val();
		var size = jQuery('#button-dialog select#button-size').val();
		var color = jQuery('#button-dialog select#button-color').val();		 
		var style = jQuery('#button-dialog select#button-style').val();		 
		var align = jQuery('#button-dialog select#button-align').val();		 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[button ';
			output += 'size=' + size + ' ';
			output += 'style=' + style + ' ';
			output += 'color=' + color + ' ';
			output += 'align=' + align;
			
			// only insert if the url field is not blank
			if(url)
				output += ' url=' + url;
		// check to see if the TEXT field is blank
		if(text) {	
			output += ']'+ text + '[/button]';
		}
		// if it is blank, use the selected text, if present
		else {
			output += ']'+ButtonDialog.local_ed.selection.getContent() + '[/button]';
		}
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);
 
</script>

</head>
<body>
	<div id="button-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="button-url">Button URL</label>
				<input type="text" name="button-url" value="" id="button-url" />
			</div>
			<div>
				<label for="button-text">Button Text</label>
				<input type="text" name="button-text" value="" id="button-text" />
			</div>
			<div>
				<label for="button-size">Size</label>
				<select name="button-size" id="button-size" size="1">
					<option value="small">Small</option>
					<option value="medium" selected="selected">Medium</option>
					<option value="large">Large</option>
				</select>
			</div>
			<div>
				<label for="button-style">Style</label>
				<select name="button-style" id="button-style" size="1">
					<option value="less_round">Less Round</option>
					<option value="round" selected="selected">Round</option>
					<option value="square">Square</option>
				</select>
			</div>
			<div>
				<label for="button-color">Color</label>
				<select name="button-color" id="button-color" size="1">
					<option value="gray" selected="selected">Gray</option>
					<option value="blue"=>Blue</option>
					<option value="red">Red</option>
					<option value="green">Green</option>
					<option value="black">Black</option>
				</select>
			</div>
			<div>
				<label for="button-align">Alignment</label>
				<select name="button-align" id="button-align" size="1">
					<option value="gray" selected="selected">None</option>
					<option value="left"=>Left</option>
					<option value="right">Right</option>
				</select>
			</div>
			<div>	
				<a href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>