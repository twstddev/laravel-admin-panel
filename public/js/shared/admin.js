( function( $ ) {
	/**
	 * @brief Creates and assigns a rich
	 * editor to the given area.
	 */
	var RichEditor = ( function() {
		//private scope
		var m_area_selector = "";

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
				]
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
