( function( $ ) {
	/**
	 * @brief Creates and assigns a rich
	 * editor to the given area.
	 */
	var RichEditor = ( function() {
		//private scope
		var m_area_selector = "";

		/**
		 * @brief Opens elfdiner browser.
		 */
		var openElfinder = function( field_name, url, type, win ) {
			tinymce.activeEditor.windowManager.open({
				file: '/elfinder/tinymce',// use an absolute path!
				title: 'elFinder 2.0',
				width: 900,
				height: 450,
				resizable: 'yes'
			}, {
				setUrl: function (url) {
					win.document.getElementById(field_name).value = url;
				}
			});
			return false;
		}

		/**
		 * @brief Binds editor to provided
		 * elements.
		 */
		var initializeEditors = function() {
			tinymce.init( {
				selector : m_area_selector,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				file_browser_callback : openElfinder
			} );
		}


		return {
			/**
			 * @brief Fake constructor.
			 */
			init : function( config ) {
				m_area_selector = config.selector;
				initializeEditors();
			}
		}
	} )();

	// run initializers
	$( function() {
		RichEditor.init( {
			selector : ".rich-editor"
		} );
	} );

} )( jQuery );
