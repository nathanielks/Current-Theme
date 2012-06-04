(function() {
	tinymce.create('tinymce.plugins.dsShortcodeButtons', {
		init : function(ed, url) {

			// Register commands

            ed.addCommand('dsModal', function( a, args){
                var button = args.button;
                tb_show("Insert Shortcode", url + "/button_popup.php?button=" + button + "&width=" + 800);
            });
 
            //Register Buttons
            ed.addButton('column', {
                title : 'Insert Column',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'column'
                    })
                },
            });

            ed.addButton('button', {
                title : 'Insert Button',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'button'
                    })
                },
            });

            ed.addButton('toggle', {
                title : 'Insert Toggle',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'toggle'
                    })
                },
            });

            ed.addButton('warning', {
                title : 'Insert Warning',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'warning'
                    })
                },
            });

            ed.addButton('small', {
                title : 'Insert Smalltext',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'small'
                    })
                },
            });

            ed.addButton('tabs', {
                title : 'Insert Tab section',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'tabs'
                    })
                },
            });

            ed.addButton('tab', {
                title : 'Insert Tab pane',
                image: url + '/includes/images/icon.gif',
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("dsModal", false, {
                        button: 'tab'
                    })
                },
            });

        },
		getInfo : function() {
			return {
				longname : 'Designa Studio Shortcode buttons',
				author : 'Nathaniel Schweinberg',
				authorurl : 'http://fightthecurrent.org',
				infourl : 'http://fightthecurrent.org',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	 
	// Register plugin
	// first parameter is the button ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('ds_shortcode_buttons', tinymce.plugins.dsShortcodeButtons);

})();
