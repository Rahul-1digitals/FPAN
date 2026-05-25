( function () {
	'use strict';

	// ── Elements ──────────────────────────────────────────────────────────────
	const directory   = document.getElementById( 'provider-directory' );
	const results     = document.getElementById( 'provider-results' );
	const searchForm  = document.getElementById( 'provider-search-form' );
	const searchInput = document.getElementById( 'provider-search-input' );
	const sidebar     = document.querySelector( '.provider-directory__sidebar' );

	if ( ! directory || ! results ) return;

	const REST_URL = directory.dataset.restUrl;

	// ── State ─────────────────────────────────────────────────────────────────
	// Mirrors the GET params the server reads. Initialised from the current URL
	// so refreshing a filtered URL restores the correct active states.
	const state = {
		specialty : 0,
		location  : 0,
		search    : '',
		page      : 1,
	};

	function initFromUrl() {
		const p        = new URLSearchParams( window.location.search );
		state.specialty = parseInt( p.get( 'specialty' ) || '0', 10 );
		state.location  = parseInt( p.get( 'location' )  || '0', 10 );
		state.search    = p.get( 'pd_search' ) || '';
		state.page      = parseInt( p.get( 'pd_page' )   || '1', 10 );
	}

	// ── URL builders ──────────────────────────────────────────────────────────
	function buildApiUrl( overrides ) {
		const s   = Object.assign( {}, state, overrides );
		const url = new URL( REST_URL );
		if ( s.specialty ) url.searchParams.set( 'specialty', s.specialty );
		if ( s.location )  url.searchParams.set( 'location',  s.location );
		if ( s.search )    url.searchParams.set( 'pd_search', s.search );
		if ( s.page > 1 )  url.searchParams.set( 'pd_page',   s.page );
		return url.toString();
	}

	function buildBrowserUrl( overrides ) {
		const s   = Object.assign( {}, state, overrides );
		const url = new URL( window.location.origin + window.location.pathname );
		if ( s.specialty ) url.searchParams.set( 'specialty', s.specialty );
		if ( s.location )  url.searchParams.set( 'location',  s.location );
		if ( s.search )    url.searchParams.set( 'pd_search', s.search );
		if ( s.page > 1 )  url.searchParams.set( 'pd_page',   s.page );
		return url.toString();
	}

	// ── Core fetch + render ───────────────────────────────────────────────────
	async function fetchResults( overrides, pushHistory ) {
		if ( pushHistory === undefined ) pushHistory = true;

		results.classList.add( 'is-loading' );
		results.setAttribute( 'aria-busy', 'true' );

		try {
			const res = await fetch( buildApiUrl( overrides ) );
			if ( ! res.ok ) throw new Error( 'HTTP ' + res.status );

			const data = await res.json();

			// Swap results HTML
			results.innerHTML = data.html;

			// Commit new state
			Object.assign( state, overrides );

			// Push browser URL so back button works
			if ( pushHistory ) {
				history.pushState( Object.assign( {}, state ), '', buildBrowserUrl() );
			}

			// Sync sidebar active states
			syncSidebarActiveStates();

			// Sync search input value (needed on popstate navigation)
			if ( searchInput ) searchInput.value = state.search;

			// Re-wire pagination links that were just injected
			wirePagination();

			// Scroll results into view if they scrolled off-screen during filter change
			const top = results.getBoundingClientRect().top;
			if ( top < 0 ) {
				results.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			}

		} catch ( err ) {
			console.error( '[Provider Directory] fetch failed:', err );
		} finally {
			results.classList.remove( 'is-loading' );
			results.removeAttribute( 'aria-busy' );
		}
	}

	// ── Sidebar active state sync ─────────────────────────────────────────────
	// After each fetch, keep the <select> values in sync with state.
	function syncSidebarActiveStates() {
		const specEl = document.getElementById( 'filter-specialty' );
		const locEl  = document.getElementById( 'filter-location' );
		if ( specEl ) specEl.value = state.specialty;
		if ( locEl )  locEl.value  = state.location;
	}

	// ── Event: filter dropdown change ─────────────────────────────────────────
	function onFilterChange() {
		const specEl = document.getElementById( 'filter-specialty' );
		const locEl  = document.getElementById( 'filter-location' );
		fetchResults( {
			specialty : specEl ? parseInt( specEl.value, 10 ) : 0,
			location  : locEl  ? parseInt( locEl.value,  10 ) : 0,
			search    : state.search,
			page      : 1,
		} );
	}

	// ── Event: search form submit ─────────────────────────────────────────────
	function onSearchSubmit( e ) {
		e.preventDefault();
		fetchResults( {
			search : searchInput ? searchInput.value.trim() : '',
			page   : 1,
		} );
	}

	// ── Event: pagination click ───────────────────────────────────────────────
	// Pagination is injected by the server into #provider-results, so we
	// delegate from the results container and re-wire after every render.
	function onPaginationClick( e ) {
		const link = e.target.closest( '.provider-pagination__btn, .provider-pagination__page' );
		if ( ! link || link.classList.contains( 'is-current' ) ) return;
		e.preventDefault();

		const p = new URL( link.href ).searchParams;
		fetchResults( {
			page : parseInt( p.get( 'pd_page' ) || '1', 10 ),
		} );
	}

	function wirePagination() {
		const nav = results.querySelector( '.provider-pagination' );
		if ( nav ) nav.addEventListener( 'click', onPaginationClick );
	}

	// ── Browser back / forward ────────────────────────────────────────────────
	window.addEventListener( 'popstate', function ( e ) {
		if ( e.state ) {
			Object.assign( state, e.state );
			fetchResults( {}, false );
		}
	} );

	// ── Autocomplete ──────────────────────────────────────────────────────────
	const suggestionsEl    = document.getElementById( 'provider-suggestions' );
	const AUTOCOMPLETE_URL = searchInput ? searchInput.dataset.autocompleteUrl : '';
	const MIN_CHARS        = 3;
	const DEBOUNCE_MS      = 300;
	let   debounceTimer    = null;
	let   activeIndex      = -1;

	function escapeHtml( str ) {
		const d = document.createElement( 'div' );
		d.textContent = str;
		return d.innerHTML;
	}

	function hideSuggestions() {
		if ( ! suggestionsEl ) return;
		suggestionsEl.setAttribute( 'hidden', '' );
		suggestionsEl.innerHTML = '';
		activeIndex = -1;
	}

	function renderSuggestions( items ) {
		if ( ! suggestionsEl ) return;

		if ( ! items || items.length === 0 ) {
			hideSuggestions();
			return;
		}

		suggestionsEl.innerHTML = items.map( function ( item ) {
			const name = item.title ? item.title.rendered : '';
			const meta = item.fpan_autocomplete || {};
			const sub  = [ meta.specialty, meta.location ].filter( Boolean ).join( ' · ' );

			return '<div class="provider-suggestion" role="option" tabindex="-1" data-href="' + escapeHtml( item.link ) + '">'
				+ '<span class="provider-suggestion__name">' + escapeHtml( name ) + '</span>'
				+ ( sub ? '<span class="provider-suggestion__meta">' + escapeHtml( sub ) + '</span>' : '' )
				+ '</div>';
		} ).join( '' );

		suggestionsEl.removeAttribute( 'hidden' );
		activeIndex = -1;

		suggestionsEl.querySelectorAll( '.provider-suggestion' ).forEach( function ( el ) {
			el.addEventListener( 'click', function () {
				window.location.href = el.dataset.href;
			} );
			// Keyboard select from suggestion item
			el.addEventListener( 'keydown', function ( e ) {
				if ( e.key === 'Enter' || e.key === ' ' ) {
					e.preventDefault();
					window.location.href = el.dataset.href;
				}
			} );
		} );
	}

	async function fetchSuggestions( term ) {
		if ( ! AUTOCOMPLETE_URL || ! suggestionsEl ) return;

		try {
			const url = new URL( AUTOCOMPLETE_URL );
			url.searchParams.set( 'search',   term );
			url.searchParams.set( 'per_page', '6' );
			url.searchParams.set( '_fields',  'id,title,link,fpan_autocomplete' );

			const res = await fetch( url.toString() );
			if ( ! res.ok ) return;

			renderSuggestions( await res.json() );
		} catch ( err ) {
			console.error( '[Autocomplete] fetch failed:', err );
		}
	}

	function onSearchInput() {
		clearTimeout( debounceTimer );
		const term = searchInput.value.trim();

		if ( term.length < MIN_CHARS ) {
			hideSuggestions();
			return;
		}

		debounceTimer = setTimeout( function () { fetchSuggestions( term ); }, DEBOUNCE_MS );
	}

	// Arrow-key / Escape navigation for the suggestion list
	function onSearchKeydown( e ) {
		if ( ! suggestionsEl || suggestionsEl.hidden ) return;

		const items = suggestionsEl.querySelectorAll( '.provider-suggestion' );
		if ( ! items.length ) return;

		if ( e.key === 'ArrowDown' ) {
			e.preventDefault();
			activeIndex = Math.min( activeIndex + 1, items.length - 1 );
			items[ activeIndex ].focus();
		} else if ( e.key === 'ArrowUp' ) {
			e.preventDefault();
			activeIndex = Math.max( activeIndex - 1, -1 );
			if ( activeIndex >= 0 ) items[ activeIndex ].focus();
			else searchInput.focus();
		} else if ( e.key === 'Escape' ) {
			hideSuggestions();
			searchInput.focus();
		}
	}

	// Close suggestions when clicking anywhere outside the search bar
	document.addEventListener( 'click', function ( e ) {
		const bar = document.querySelector( '.provider-search-bar' );
		if ( bar && ! bar.contains( e.target ) ) hideSuggestions();
	} );

	// Hide suggestions when the main search form is submitted
	if ( searchForm ) {
		searchForm.addEventListener( 'submit', function () { hideSuggestions(); } );
	}

	if ( searchInput ) {
		searchInput.addEventListener( 'input',   onSearchInput );
		searchInput.addEventListener( 'keydown', onSearchKeydown );
	}


	// ── Boot ──────────────────────────────────────────────────────────────────
	initFromUrl();

	const specSelect = document.getElementById( 'filter-specialty' );
	const locSelect  = document.getElementById( 'filter-location' );
	if ( specSelect ) specSelect.addEventListener( 'change', onFilterChange );
	if ( locSelect )  locSelect.addEventListener( 'change', onFilterChange );

	if ( searchForm ) searchForm.addEventListener( 'submit', onSearchSubmit );

	wirePagination();

} )();
