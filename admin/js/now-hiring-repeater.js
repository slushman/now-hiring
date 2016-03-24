/**
 * Repeaters
 */
(function( $ ) {
	'use strict';

	/**
	 * Clones the hidden field to add another repeater.
	 */
	$('#add-repeater').on( 'click', function( e ) {

		e.preventDefault();

		var clone = $('.repeater.hidden').clone(true);

		clone.removeClass('hidden');
		clone.insertBefore('.repeater.hidden');

		return false;

	});

	/**
	 * Removes the selected repeater.
	 */
	$('.link-remove').on('click', function() {

		var parents = $(this).parents('.repeater');

		if ( ! parents.hasClass( 'first' ) ) {

			parents.remove();

		}

		return false;

	});

	/**
	 * Shows/hides the selected repeater.
	 */
	$( '.btn-edit' ).on( 'click', function() {

		var repeater = $(this).parents( '.repeater' );

		repeater.children( '.repeater-content' ).slideToggle( '150' );
		$(this).children( '.toggle-arrow' ).toggleClass( 'closed' );
		$(this).parents( '.handle' ).toggleClass( 'closed' );

	});

	/**
	 * Changes the title of the repeater header as you type
	 */
	$(function(){

		$( '.repeater-title' ).on( 'keyup', function(){

			var repeater = $(this).parents( '.repeater' );
			var fieldval = $(this).val();

			if ( fieldval.length > 0 ) {

				repeater.find( '.title-repeater' ).text( fieldval );

			} else {

				repeater.find( '.title-repeater' ).text( nhdata.repeatertitle );

			}

		});

	});

	/**
	 * Makes the repeaters sortable.
	 */
	$(function() {

		$( '.repeaters' ).sortable({
			cursor: 'move',
			handle: '.handle',
			items: '.repeater',
			opacity: 0.6,
		});
	});

})( jQuery );