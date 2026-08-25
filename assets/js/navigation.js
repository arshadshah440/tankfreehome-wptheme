/**
 * Mobile navigation drawer, submenu toggles and the sticky header state.
 *
 * @package Tank_Free_Home
 */

( function () {
	'use strict';

	var header = document.querySelector( '.tfh-header' );
	var toggle = document.querySelector( '.tfh-menu-toggle' );
	var nav = document.getElementById( 'tfh-primary-nav' );
	var closeBtn = nav ? nav.querySelector( '.tfh-nav__close' ) : null;

	if ( ! toggle || ! nav ) {
		return;
	}

	var backdrop = document.createElement( 'div' );
	backdrop.className = 'tfh-nav-backdrop';
	document.body.appendChild( backdrop );

	var labels = window.tfhNav || { openLabel: 'Open menu', closeLabel: 'Close menu' };

	function openNav() {
		nav.classList.add( 'is-open' );
		backdrop.classList.add( 'is-open' );
		document.body.classList.add( 'tfh-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		toggle.setAttribute( 'aria-label', labels.closeLabel );
	}

	function closeNav() {
		nav.classList.remove( 'is-open' );
		backdrop.classList.remove( 'is-open' );
		document.body.classList.remove( 'tfh-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		toggle.setAttribute( 'aria-label', labels.openLabel );

		var openItems = nav.querySelectorAll( '.menu-item-has-children.is-open' );
		for ( var i = 0; i < openItems.length; i++ ) {
			openItems[ i ].classList.remove( 'is-open' );
		}
	}

	toggle.addEventListener( 'click', function () {
		if ( nav.classList.contains( 'is-open' ) ) {
			closeNav();
		} else {
			openNav();
		}
	} );

	backdrop.addEventListener( 'click', closeNav );

	if ( closeBtn ) {
		closeBtn.addEventListener( 'click', function () {
			closeNav();
			toggle.focus();
		} );
	}

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key && nav.classList.contains( 'is-open' ) ) {
			closeNav();
			toggle.focus();
		}
	} );

	// On small screens, the first tap on a parent link opens its submenu
	// instead of navigating away; desktop keeps the hover dropdown.
	var parents = nav.querySelectorAll( '.menu-item-has-children > a' );

	for ( var p = 0; p < parents.length; p++ ) {
		parents[ p ].addEventListener( 'click', function ( event ) {
			if ( window.innerWidth > 1024 ) {
				return;
			}

			var item = this.parentElement;

			if ( ! item.classList.contains( 'is-open' ) ) {
				event.preventDefault();
				item.classList.add( 'is-open' );
			}
		} );
	}

	// Sticky header: swap to a solid background once the page has scrolled
	// past the top bar, so the "sticky" header style stays legible.
	if ( header && header.classList.contains( 'tfh-header--sticky' ) ) {
		var onScroll = function () {
			if ( window.scrollY > 40 ) {
				header.classList.add( 'is-scrolled' );
			} else {
				header.classList.remove( 'is-scrolled' );
			}
		};

		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}
}() );
