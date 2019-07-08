/**
 * File editor-filters.js.
 *
 * Modify the behavior of the block editor.
 */

wp.domReady( function() {

	wp.blocks.registerBlockStyle( 'core/list', {
		name: 'checkmark-list',
		label: 'Checkmark'
	});
});
