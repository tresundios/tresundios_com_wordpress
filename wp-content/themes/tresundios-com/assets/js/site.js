/* Tresundios .com: site-wide behaviour (no dependencies). Every animation respects prefers-reduced-motion. */
( function () {
	'use strict';
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var finePointer = window.matchMedia( '(pointer: fine)' ).matches;
	var clamp = function ( v, a, b ) { return Math.max( a, Math.min( b, v ) ); };
	var $ = function ( s, c ) { return ( c || document ).querySelector( s ); };
	var $$ = function ( s, c ) { return [].slice.call( ( c || document ).querySelectorAll( s ) ); };
	function esc( t ) { var d = document.createElement( 'div' ); d.textContent = t; return d.innerHTML; }

	/* ---------- Header: mobile menu, scrolled state, hide on scroll down, progress bar ---------- */
	var nav = $( '.site-nav' ), toggler = $( '.navbar-toggler' ), bar = $( '#progress' ), giant = $( '#giant' );
	if ( toggler ) {
		toggler.addEventListener( 'click', function () {
			var open = nav.classList.toggle( 'is-open' );
			toggler.setAttribute( 'aria-expanded', open );
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' && nav.classList.contains( 'is-open' ) ) { nav.classList.remove( 'is-open' ); toggler.setAttribute( 'aria-expanded', 'false' ); toggler.focus(); }
		} );
	}
	var lastY = window.scrollY, ticking = false;
	function onScroll() {
		var y = window.scrollY, docH = document.documentElement.scrollHeight - window.innerHeight;
		if ( bar ) bar.style.transform = 'scaleX(' + ( docH > 0 ? y / docH : 0 ) + ')';
		if ( nav ) {
			nav.classList.toggle( 'scrolled', y > 10 );
			if ( ! reduce && ! nav.classList.contains( 'is-open' ) && ! nav.contains( document.activeElement ) ) nav.classList.toggle( 'hide', y > lastY && y > 320 );
			if ( y < lastY ) nav.classList.remove( 'hide' );
		}
		if ( giant && ! reduce ) {
			var gr = giant.getBoundingClientRect();
			if ( gr.top < window.innerHeight * 1.5 ) giant.style.transform = 'translateX(' + ( ( gr.top - window.innerHeight ) * 0.35 ) + 'px)';
		}
		revealCheck();
		document.dispatchEvent( new CustomEvent( 'tr:scroll', { detail: { y: y, dy: y - lastY } } ) );
		lastY = y;
		ticking = false;
	}
	window.addEventListener( 'scroll', function () { if ( ! ticking ) { ticking = true; requestAnimationFrame( onScroll ); } }, { passive: true } );
	nav && nav.addEventListener( 'focusin', function () { nav.classList.remove( 'hide' ); } );

	/* ---------- Split headings + scroll reveals (only below-the-fold elements animate) ---------- */
	$$( '.split' ).forEach( function ( el ) {
		var text = el.textContent.trim();
		el.innerHTML = '<span class="visually-hidden">' + esc( text ) + '</span>' + text.split( /\s+/ ).map( function ( w, i ) {
			return '<span class="w" aria-hidden="true"><span style="--i:' + i + '">' + esc( w ) + '</span></span>';
		} ).join( ' ' );
	} );
	/* Elements below the fold start "pending" and reveal once they enter the lower part of the viewport,
	   or when the visitor reaches the end of the page (short pages can't scroll far enough otherwise). */
	var pending = [];
	if ( ! reduce ) {
		pending = $$( '.reveal, .split' ).filter( function ( el ) {
			if ( el.getBoundingClientRect().top > window.innerHeight * 0.92 ) { el.classList.add( 'pending' ); return true; }
			return false;
		} );
	}
	function revealCheck() {
		if ( ! pending.length ) return;
		var atEnd = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 4;
		pending = pending.filter( function ( el ) {
			if ( atEnd || el.getBoundingClientRect().top < window.innerHeight * 0.88 ) { el.classList.remove( 'pending' ); return false; }
			return true;
		} );
	}

	/* ---------- Pointer micro-interactions: cursor, magnetic, tilt ---------- */
	if ( finePointer && ! reduce ) {
		var cur = $( '.cursor' );
		if ( cur ) {
			document.body.classList.add( 'has-cursor' );
			var dot = $( '.cursor-dot', cur ), ringEl = $( '.cursor-ring', cur );
			var mx = innerWidth / 2, my = innerHeight / 2, rx = mx, ry = my, moving = false;
			var follow = function () {
				rx += ( mx - rx ) * 0.18; ry += ( my - ry ) * 0.18;
				ringEl.style.transform = 'translate3d(' + rx + 'px,' + ry + 'px,0)';
				if ( Math.abs( mx - rx ) + Math.abs( my - ry ) > 0.5 ) requestAnimationFrame( follow ); else moving = false;
			};
			window.addEventListener( 'pointermove', function ( e ) {
				mx = e.clientX; my = e.clientY;
				dot.style.transform = 'translate3d(' + mx + 'px,' + my + 'px,0)';
				if ( ! moving ) { moving = true; requestAnimationFrame( follow ); }
			}, { passive: true } );
			document.addEventListener( 'pointerover', function ( e ) {
				cur.classList.toggle( 'is-hover', !! e.target.closest( 'a, button, .proj, .svc, input, select, textarea, summary, .orbit-wrap' ) );
			} );
			document.addEventListener( 'pointerdown', function () { cur.classList.add( 'is-down' ); } );
			document.addEventListener( 'pointerup', function () { cur.classList.remove( 'is-down' ); } );
		}
		$$( '.magnetic' ).forEach( function ( wrap ) {
			var el = wrap.classList.contains( 'wp-block-button' ) ? $( 'a', wrap ) : wrap;
			el.addEventListener( 'pointermove', function ( e ) {
				var r = el.getBoundingClientRect();
				el.style.transition = 'transform .2s';
				el.style.transform = 'translate(' + ( e.clientX - r.left - r.width / 2 ) * 0.25 + 'px,' + ( e.clientY - r.top - r.height / 2 ) * 0.35 + 'px)';
			} );
			el.addEventListener( 'pointerleave', function () { el.style.transition = 'transform .7s cubic-bezier(.22,1,.36,1)'; el.style.transform = ''; } );
		} );
		$$( '.tilt' ).forEach( function ( el ) {
			var bounds, scrollX, scrollY;
			el.addEventListener( 'pointerenter', function () {
				bounds = el.getBoundingClientRect();
				scrollX = window.scrollX;
				scrollY = window.scrollY;
			} );
			el.addEventListener( 'pointermove', function ( e ) {
				if ( ! bounds ) {
					bounds = el.getBoundingClientRect();
					scrollX = window.scrollX;
					scrollY = window.scrollY;
				}
				var left = bounds.left - ( window.scrollX - scrollX );
				var top = bounds.top - ( window.scrollY - scrollY );
				var px = clamp( ( e.clientX - left ) / bounds.width, 0, 1 );
				var py = clamp( ( e.clientY - top ) / bounds.height, 0, 1 );
				el.style.setProperty( '--mx', ( px * 100 ) + '%' );
				el.style.setProperty( '--my', ( py * 100 ) + '%' );
				el.style.transform = 'perspective(1000px) rotateX(' + ( ( 0.5 - py ) * 6 ) + 'deg) rotateY(' + ( ( px - 0.5 ) * 8 ) + 'deg) translateY(-6px)';
			} );
			el.addEventListener( 'pointerleave', function () { el.style.transform = ''; bounds = null; } );
		} );
	}
	document.addEventListener( 'click', function ( e ) {
		var b = e.target.closest( '.btn-tr, .wp-block-button__link' );
		if ( ! b || reduce ) return;
		var r = b.getBoundingClientRect(), s = Math.max( r.width, r.height ) * 2.2, sp = document.createElement( 'span' );
		sp.className = 'ripple';
		sp.style.cssText = 'width:' + s + 'px;height:' + s + 'px;left:' + ( e.clientX - r.left - s / 2 ) + 'px;top:' + ( e.clientY - r.top - s / 2 ) + 'px';
		b.appendChild( sp );
		setTimeout( function () { sp.remove(); }, 750 );
	} );

	/* ---------- Accessible tabs (pricing): click, arrows, Home/End ---------- */
	$$( '[role="tablist"]' ).forEach( function ( list ) {
		var tabs = $$( ':scope > [role="tab"]', list );
		function show( tab, focus ) {
			tabs.forEach( function ( t ) {
				var on = t === tab;
				t.setAttribute( 'aria-selected', on );
				t.tabIndex = on ? 0 : -1;
				document.getElementById( t.getAttribute( 'aria-controls' ) ).hidden = ! on;
			} );
			if ( focus ) tab.focus();
		}
		tabs.forEach( function ( t, i ) {
			t.addEventListener( 'click', function () { show( t ); } );
			t.addEventListener( 'keydown', function ( e ) {
				var j = { ArrowRight: i + 1, ArrowDown: i + 1, ArrowLeft: i - 1, ArrowUp: i - 1, Home: 0, End: tabs.length - 1 }[ e.key ];
				if ( j === undefined ) return;
				e.preventDefault();
				show( tabs[ ( j + tabs.length ) % tabs.length ], true );
			} );
		} );
	} );

	/* ---------- Copy buttons ---------- */
	$$( '.copy[data-copy]' ).forEach( function ( b ) {
		b.addEventListener( 'click', function () {
			var label = b.innerHTML;
			var done = function () { b.textContent = 'Copied'; setTimeout( function () { b.innerHTML = label; }, 1500 ); };
			try { navigator.clipboard.writeText( b.dataset.copy ).then( done, function () { b.textContent = 'Select & copy'; } ); } catch ( err ) { b.textContent = 'Select & copy'; }
		} );
	} );

	/* ---------- Book-a-call: open Google Calendar in a dialog; the link still works without JS ---------- */
	var dialog;
	document.addEventListener( 'click', function ( e ) {
		var a = e.target.closest( 'a[data-book-call]' );
		if ( ! a || ! window.HTMLDialogElement || e.metaKey || e.ctrlKey || e.shiftKey ) return;
		e.preventDefault();
		if ( ! dialog ) {
			dialog = document.createElement( 'dialog' );
			dialog.className = 'book-dialog';
			dialog.setAttribute( 'aria-labelledby', 'bookTitle' );
			dialog.innerHTML = '<header><h2 id="bookTitle">Book a free call</h2>' +
				'<a class="icon-btn" href="' + esc( a.href ) + '" target="_blank" rel="noopener" aria-label="Open the booking page in a new tab">↗</a>' +
				'<button class="icon-btn" type="button" aria-label="Close" data-close>✕</button></header>' +
				'<iframe title="Book a free call with Tresundios" src="' + esc( a.href ) + '"></iframe>';
			dialog.addEventListener( 'click', function ( ev ) { if ( ev.target === dialog || ev.target.closest( '[data-close]' ) ) dialog.close(); } );
			document.body.appendChild( dialog );
		}
		if ( nav ) { nav.classList.remove( 'is-open' ); toggler && toggler.setAttribute( 'aria-expanded', 'false' ); }
		dialog.showModal();
	} );

	/* ---------- Map facade: load the Google Maps iframe only on request ---------- */
	$$( '[data-load-map]' ).forEach( function ( b ) {
		b.addEventListener( 'click', function () {
			var box = b.closest( '.map-facade' ), f = document.createElement( 'iframe' );
			f.src = box.dataset.mapSrc; f.title = 'Map'; f.loading = 'lazy'; f.referrerPolicy = 'no-referrer-when-downgrade';
			box.appendChild( f );
			b.closest( 'div' ).parentNode.hidden = true;
		} );
	} );

	/* Process scrollytelling */
	var steps = $$( '.steps .step' ), stepNum = $( '#stepNum' ), ring = $( '#stepRing' );
	function setStep( el ) {
		steps.forEach( function ( s ) { s.classList.toggle( 'is-active', s === el ); } );
		if ( stepNum.textContent !== el.dataset.step ) {
			stepNum.textContent = el.dataset.step;
			if ( ! reduce ) { stepNum.classList.remove( 'flip' ); void stepNum.offsetWidth; stepNum.classList.add( 'flip' ); }
		}
		ring.style.strokeDashoffset = 339.3 * ( 1 - ( steps.indexOf( el ) + 1 ) / steps.length );
	}
	if ( stepNum && 'IntersectionObserver' in window ) {
		var sio = new IntersectionObserver( function ( en ) { en.forEach( function ( e ) { if ( e.isIntersecting ) setStep( e.target ); } ); }, { rootMargin: '-45% 0px -45% 0px' } );
		steps.forEach( function ( s ) { sio.observe( s ); } );
	}

	window.addEventListener( 'load', onScroll );
	onScroll();
} )();
