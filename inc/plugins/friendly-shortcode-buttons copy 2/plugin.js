(function() {
	tinymce.create('tinymce.plugins.buttonPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mcebutton', function() {
				ed.windowManager.open({
					file : url + '/button_popup.php', // file that contains HTML for our modal window
					width : 220 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
					height : 240 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
			 
			// Register buttons
			ed.addButton('friendly_button', {title : 'Insert Button', cmd : 'mcebutton', image: url + '/includes/images/icon.gif' });
		},
		 
		getInfo : function() {
			return {
				longname : 'Insert Button',
				author : 'Pippin Williamson',
				authorurl : 'http://pippinsplugins.com',
				infourl : 'http://pippinsplugins.com',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	 
	// Register plugin
	// first parameter is the button ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('friendly_button', tinymce.plugins.buttonPlugin);

})();