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

	/**
	 * @brief Implements file browser modal window.
	 * This object listens to special inputs click events
	 * and shows file manager after a click.
	 */
	var FilePicker = ( function() {
		// private scope
		var m_selector = "";
		var m_modal_class = "file-window";

		var m_modal_template = [
			'<div class="' + m_modal_class + ' modal fade">',
				'<div class="modal-dialog">',
					'<div class="modal-content">',
						'<div class="modal-header">',
							'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>',
						'</div>',
						'<div class="modal-body">',
						'</div>',
					'</div>',
				'</div>',
			'</div>'
		].join( "" );

		/**
		 * @brief Creates a modal with file manager inside.
		 */
		var createModal = function( file_callback ) {
			var $modal = $( m_modal_template );
			$( "body" ).append( $modal );

			$browser = $( "<div>", { className : "file-manager" } );

			$modal.find( ".modal-body" ).append( $browser );
			$browser.elfinder( {
				connector : "/elfinder/connector",
				url : "/elfinder/connector",
				height: 800,
				getFileCallback : file_callback
			} );
			$modal.modal( "show" );
		}

		/**
		 * @brief Listens to buttons clicks.
		 */
		var listenToPickers = function() {
			$( document ).on( "click", m_selector + " .btn", function( event ) {
				event.preventDefault();
				var modal_selector = "." + m_modal_class;

				$( modal_selector ).remove();
				
				var $this = $( this );

				createModal( function( file ) {
					$this.parent().siblings( "input" ).val( file.url );
					$( modal_selector ).modal( { show : false } );
				} );

				return false;
			} );
		}

		return {
			/**
			 * @brief Fake constructor.
			 */
			init : function( config ) {
				m_selector = config.selector;

				listenToPickers();
			}
		}
	} )();

	// run initializers
	$( function() {
		RichEditor.init( {
			selector : ".rich-editor"
		} );

		FilePicker.init( {
			selector : ".file-picker"
		} );
	} );

} )( jQuery );
