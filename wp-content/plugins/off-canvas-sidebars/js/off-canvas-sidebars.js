;/**
 * Off-Canvas Sidebars plugin
 *
 * ocsOffCanvasSidebars
 * @author Jory Hogeveen <info@keraweb.nl>
 * @package off-canvas-sidebars
 * @version 0.3
 * @global ocsOffCanvasSidebars
 */

if ( typeof ocsOffCanvasSidebars == 'undefined' ) {
	var ocsOffCanvasSidebars = {
		"site_close": true,
		"disable_over": false,
		"hide_control_classes": false,
		"scroll_lock": false,
		"css_prefix": 'ocs',
		"sidebars": {}
	};
}

(function($) {

	ocsOffCanvasSidebars.slidebarsController = false;
	ocsOffCanvasSidebars.useAttributeSettings = false;
	ocsOffCanvasSidebars._touchmove = false;

	ocsOffCanvasSidebars.init = function() {

		/**
		 * Function call before initializing
		 * @since  0.3
		 */
		if ( typeof ocsBeforeInitHook == 'function' ) {
			ocsBeforeInitHook();
		}

		// Slidebars constructor
		ocsOffCanvasSidebars.slidebarsController = new slidebars();

		if ( false === ocsOffCanvasSidebars.slidebarsController ) {
			return;
		}
		// Initialize slidebars
		ocsOffCanvasSidebars.slidebarsController.init();

		/**
		 * Function call after initializing
		 * @since  0.3
		 */
		if ( typeof ocsAfterInitHook == 'function' ) {
			ocsAfterInitHook();
		}

		/**
		 * Validate the disable_over setting ( using _getSetting() )

		 * Internal function, do not overwrite

		 * @since  0.3
		 */
		ocsOffCanvasSidebars._checkDisableOver = function( sidebarId ) {
			var check = true;
			var disableOver = parseInt( ocsOffCanvasSidebars._getSetting( 'disable_over', sidebarId ) );
			if ( disableOver && ! isNaN( disableOver ) ) {
				if ( $( window ).width() > disableOver ) {
		  			check = false;
		  		}
			}
			return check;
		};

		/**
		 * Get the global setting or the sidebar setting (if set to overwrite)

		 * Internal function, do not overwrite

		 * @since  0.3
		 */
		ocsOffCanvasSidebars._getSetting = function( key, sidebarId ) {
			var overwrite, setting;
			var prefix = ocsOffCanvasSidebars.css_prefix;

			if ( ! sidebarId ) {
				sidebarId = ocsOffCanvasSidebars.slidebarsController.getActiveSlidebar();
			}
			if ( sidebarId ) {

				if ( ! $.isEmptyObject( ocsOffCanvasSidebars.sidebars ) && ! ocsOffCanvasSidebars.useAttributeSettings ) {
					sidebarId = sidebarId.replace( prefix + '-', '' );
					if ( ocsOffCanvasSidebars.sidebars[ sidebarId ].overwrite_global_settings ) {
						setting = ocsOffCanvasSidebars.sidebars[ sidebarId ][ key ];
						if ( setting ) {
							return setting;
						} else {
							return false;
						}
					}

				// Fallback/Overwrite to enable sidebar settings from available attributes
				} else {
					var sidebarElement = $( '#' + sidebarId );
					overwrite = sidebarElement.attr( 'ocs-overwrite_global_settings' );
					if ( typeof overwrite !== 'undefined' && overwrite ) {
						setting = sidebarElement.attr( 'ocs-' + key );
						if ( typeof setting != 'undefined' ) {
							return setting;
						} else {
							return false;
						}
					}
				}
			}

			if ( typeof ocsOffCanvasSidebars[ key ] != 'undefined' && ! ocsOffCanvasSidebars.useAttributeSettings ) {
				return ocsOffCanvasSidebars[ key ];
			} else {
				setting = $( '#' + prefix + '-site' ).attr( 'ocs-' + key );
				if ( typeof setting != 'undefined' ) {
					return setting;
				}
			}

			return false;
		};

		// Prevent swipe events to be seen as a click (bug in some browsers)
		$( document ).on( 'touchmove', function() {
			ocsOffCanvasSidebars._touchmove = true;
		} );
		$( document ).on( 'touchstart', function() {
			ocsOffCanvasSidebars._touchmove = false;
		} );

		// Validate type, this could be changed with the hooks
		if ( typeof ocsOffCanvasSidebars.setupTriggers == 'function' ) {
			ocsOffCanvasSidebars.setupTriggers();
		}
	};

	/**
	 * Set the default settings for sidebars if they are not found

	 * @since  0.3
	 */
	ocsOffCanvasSidebars.setSidebarDefaultSettings = function( sidebarId ) {

		if ( typeof ocsOffCanvasSidebars.sidebars[ sidebarId ] == 'undefined' ) {
			ocsOffCanvasSidebars.sidebars[ sidebarId ] = {
				'overwrite_global_settings': false,
				"site_close": ocsOffCanvasSidebars.site_close,
				"disable_over": ocsOffCanvasSidebars.disable_over,
				"hide_control_classes": ocsOffCanvasSidebars.hide_control_classes,
				"scroll_lock": ocsOffCanvasSidebars.scroll_lock
			}
		}
	};

	ocsOffCanvasSidebars.setupTriggers = function() {
		var controller = ocsOffCanvasSidebars.slidebarsController;
		var prefix = ocsOffCanvasSidebars.css_prefix;

		$( '.' + prefix + '-slidebar' ).each( function() {
			var id = $( this ).attr( 'ocs-sidebar-id' );

			ocsOffCanvasSidebars.setSidebarDefaultSettings( id );

			/**
			 * Toggle the sidebar
			 * @since  0.1
			 */
			$( document ).on( 'touchend click', '.' + prefix + '-toggle-' + id, function( e ) {
				// Stop default action and bubbling
				e.stopPropagation();
				e.preventDefault();

				// Prevent touch+swipe
				if ( true === ocsOffCanvasSidebars._touchmove ) {
					return;
				}

				// Toggle the slidebar with respect for the disable_over setting
				if ( ocsOffCanvasSidebars._checkDisableOver( prefix + '-' + id ) ) {
					controller.toggle( prefix + '-' + id );
				}
			} );

			/**
			 * Open the sidebar
			 * @since  0.3
			 */
			$( document ).on( 'touchend click', '.' + prefix + '-open-' + id, function( e ) {
				// Stop default action and bubbling
				e.stopPropagation();
				e.preventDefault();

				// Prevent touch+swipe
				if ( true === ocsOffCanvasSidebars._touchmove ) {
					return;
				}

				// Open the slidebar with respect for the disable_over setting
				if ( ocsOffCanvasSidebars._checkDisableOver( prefix + '-' + id ) ) {
					controller.open( prefix + '-' + id );
				}
			} );

			/**
			 * Close the sidebar
			 * @since  0.3
			 */
			$( document ).on( 'touchend click', '.' + prefix + '-close-' + id, function( e ) {
				// Stop default action and bubbling
				e.stopPropagation();
				e.preventDefault();

				// Prevent touch+swipe
				if ( true === ocsOffCanvasSidebars._touchmove ) {
					return;
				}

				// Close the slidebar, no need to check the disable_over setting since we're closing the slidebar
				//if ( ocsOffCanvasSidebars._checkDisableOver( prefix + '-' + id ) ) {
					controller.close( prefix + '-' + id );
				//}
			} );

		} );


		// Close any
		$( document ).on( 'touchend click', '.' + prefix + '-close-any', function( e ) {
			if ( ocsOffCanvasSidebars._getSetting( 'site_close', false ) ) {
				e.preventDefault();
				e.stopPropagation();
				controller.close();
			}
		} );


		// Close Slidebars when clicking on a link within a slidebar
		/*$( '[off-canvas] a' ).on( 'touchend click', function( e ) {
			e.preventDefault();
			e.stopPropagation();

			var url = $( this ).attr( 'href' ),
			target = $( this ).attr( 'target' ) ? $( this ).attr( 'target' ) : '_self';

			controller.close( function () {
				window.open( url, target );
			} );
		} );*/


		// Add close class to canvas container when Slidebar is opened
		$( controller.events ).on( 'opening', function () {
			$( '[canvas]' ).addClass( prefix + '-close-any' );
		} );

		// Add close class to canvas container when Slidebar is opened
		$( controller.events ).on( 'closing', function () {
			$( '[canvas]' ).removeClass( prefix + '-close-any' );
		} );


		// Disable slidebars when the window is wider than the set width
		var disableOver = function() {
			var prefix = ocsOffCanvasSidebars.css_prefix;
			$( '.' + prefix + '-slidebar' ).each( function() {
				var id = $( this ).attr( 'ocs-sidebar-id' );

				if ( ! ocsOffCanvasSidebars._checkDisableOver( prefix + '-' + id ) ) {
					if ( controller.isActiveSlidebar( prefix + '-' + id ) ) {
						controller.close();
					}
					// Hide control classes
					if ( ocsOffCanvasSidebars._getSetting( 'hide_control_classes', prefix + '-' + id ) ) {
						$( '.' + prefix + '-toggle-' + id ).hide();
					}
				} else {
					$( '.' + prefix + '-toggle-' + id ).show();
				}

			} );
		};
		disableOver();
		$( window ).on( 'resize', disableOver );

		// Disable scrolling on active sidebar
		$( '#' + prefix + '-site' ).on( 'scroll touchmove mousewheel', function( e ) {
			if ( ocsOffCanvasSidebars._getSetting( 'scroll_lock' ) && false != controller.getActiveSlidebar() ) {
				e.preventDefault();
				e.stopPropagation();
				return false;
			}
		} );

	};

	if ( $( '#' + ocsOffCanvasSidebars.css_prefix + '-site' ).length && ( typeof slidebars != 'undefined' ) ) {
		ocsOffCanvasSidebars.init();
	}

}) (jQuery);