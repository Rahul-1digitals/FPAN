/**
 * File navigation.js
 *
 * Handles the mobile menu toggle and keyboard accessibility for the header nav.
 * No jQuery. No dependencies.
 */
( function () {

	const toggle = document.getElementById( 'menu-toggle' );
	const nav    = document.getElementById( 'primary-navigation' );

	if ( ! toggle || ! nav ) {
		return;
	}

	// --- Toggle open/close ---
	toggle.addEventListener( 'click', function () {
		const isOpen = toggle.getAttribute( 'aria-expanded' ) === 'true';

		toggle.setAttribute( 'aria-expanded', String( ! isOpen ) );
		nav.classList.toggle( 'is-open', ! isOpen );
	} );

	// --- Close when user clicks outside the header ---
	document.addEventListener( 'click', function ( event ) {
		const header = document.getElementById( 'masthead' );
		if ( header && ! header.contains( event.target ) ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
			nav.classList.remove( 'is-open' );
		}
	} );

	// --- Close on Escape key ---
	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'Escape' && nav.classList.contains( 'is-open' ) ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
			nav.classList.remove( 'is-open' );
			toggle.focus(); // return focus to the button
		}
	} );

} () );
