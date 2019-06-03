/**
 * Initiate the script to adjust the vertical position of the sidebar.
 */
if ( 'loading' === document.readyState ) {
	// The DOM has not yet been loaded.
	document.addEventListener( 'DOMContentLoaded', initSidebarPosition );
} else {
	// The DOM has already been loaded.
	initSidebarPosition();
}

/**
 * Initiate the script to adjust the vertical position of the sidebar.
 */
function initSidebarPosition() {
	const primarySidebar = document.querySelector( '.primary-sidebar' );
	let resizeId = null;

	if ( ! primarySidebar ) {
		exit();
	}

	function setPrimarySidebarPosition() {
		const entryContentPosition   = document.querySelector( '.entry-content' ).offsetTop;
		const primarySidebarPosition = document.querySelector( '.primary-sidebar' ).offsetTop;
		const minWidth               = 960;

		if ( ( minWidth <= window.innerWidth ) && ! primarySidebar.style.marginTop ) {
			primarySidebar.style.marginTop = ( entryContentPosition - primarySidebarPosition ) + 'px';
		} else if ( minWidth > window.innerWidth ) {
			console.log( 'window width < 960px' );
			primarySidebar.style.marginTop = null;
		}
	}

	setPrimarySidebarPosition();

	window.addEventListener( 'resize', function() {
		clearTimeout( resizeId );
		resizeId = setTimeout( setPrimarySidebarPosition, 50 );
	});
}
