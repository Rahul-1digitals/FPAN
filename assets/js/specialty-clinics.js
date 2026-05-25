/**
 * Specialty / Primary Care Clinics — Jump To navigation active states.
 *
 * Responsibilities:
 *   1. IntersectionObserver — marks the correct Jump To link `.is-active`
 *      as the user scrolls through clinic sections.
 *   2. Click handler — smooth-scrolls with a precise offset so the target
 *      section is not hidden beneath the sticky header + nav bar.
 *
 * CSS scroll-margin-top on .clinic-section handles the offset for keyboard
 * navigation and direct URL hash links (no JS needed for those).
 */
( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		var nav      = document.querySelector( '.clinic-jump-nav' );
		var sections = Array.from( document.querySelectorAll( '.clinic-section[id]' ) );
		var links    = nav ? Array.from( nav.querySelectorAll( '.clinic-jump-nav__link' ) ) : [];

		if ( ! nav || ! sections.length || ! links.length ) return;

		/* ── Measure the combined sticky offset ──────────────────────────────── */
		function getStickyOffset() {
			var header = document.querySelector( '.site-header, header' );
			return ( header ? header.offsetHeight : 64 ) + ( nav.offsetHeight || 48 );
		}

		/* ── Active-link helper ───────────────────────────────────────────────── */
		function setActive( id ) {
			links.forEach( function ( link ) {
				var isTarget = link.getAttribute( 'data-jump-target' ) === id;
				link.classList.toggle( 'is-active', isTarget );
				link.setAttribute( 'aria-current', isTarget ? 'true' : 'false' );
			} );
		}

		/* ── IntersectionObserver ─────────────────────────────────────────────── */
		var offset       = getStickyOffset();
		var rootMarginTop = '-' + offset + 'px';

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						setActive( entry.target.id );
					}
				} );
			},
			{
				/* Consider a section "active" once its top edge crosses below
				   the combined sticky area, and before 55% of the viewport. */
				rootMargin: rootMarginTop + ' 0px -55% 0px',
				threshold: 0
			}
		);

		sections.forEach( function ( section ) { observer.observe( section ); } );

		/* ── Click handler: smooth scroll with offset ─────────────────────────── */
		links.forEach( function ( link ) {
			link.addEventListener( 'click', function ( e ) {
				var targetId = link.getAttribute( 'data-jump-target' );
				var target   = document.getElementById( targetId );
				if ( ! target ) return;

				e.preventDefault();

				/* Recalculate in case viewport was resized since page load. */
				var currentOffset = getStickyOffset();
				var top = target.getBoundingClientRect().top + window.scrollY - currentOffset - 12;

				window.scrollTo( { top: Math.max( 0, top ), behavior: 'smooth' } );

				/* Update active state immediately on click, not waiting for observer. */
				setActive( targetId );

				/* Push to history so the URL reflects the section. */
				if ( history.pushState ) {
					history.pushState( null, '', '#' + targetId );
				}
			} );
		} );

		/* ── Activate the section matching the URL hash on page load ─────────── */
		if ( window.location.hash ) {
			var initialId = window.location.hash.slice( 1 );
			if ( document.getElementById( initialId ) ) {
				setActive( initialId );
			}
		}

	} );

} )();
