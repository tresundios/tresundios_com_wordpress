/* Tresundios .com home: counters, About scrub text, marquee, pinned case-study reel, hero orbit. */
( function () {
	'use strict';
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var clamp = function ( v, a, b ) { return Math.max( a, Math.min( b, v ) ); };
	var $ = function ( s ) { return document.querySelector( s ); };
	var $$ = function ( s ) { return [].slice.call( document.querySelectorAll( s ) ); };
	function esc( t ) { var d = document.createElement( 'div' ); d.textContent = t; return d.innerHTML; }

	/* Count-up numbers */
	if ( ! reduce && 'IntersectionObserver' in window ) {
		var cio = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( ! e.isIntersecting ) return;
				var el = e.target, to = +el.dataset.count, t0 = null;
				cio.unobserve( el );
				( function tick( t ) {
					if ( ! t0 ) t0 = t;
					var p = clamp( ( t - t0 ) / 1600, 0, 1 );
					el.textContent = Math.round( to * ( 1 - Math.pow( 1 - p, 4 ) ) );
					if ( p < 1 ) requestAnimationFrame( tick );
				} )( performance.now() );
			} );
		}, { threshold: 0.6 } );
		$$( '[data-count]' ).forEach( function ( el ) { cio.observe( el ); } );
	}

	/* Word-by-word scrub text */
	var scrub = $( '#scrubText' ), words = [];
	if ( scrub ) {
		var hl = [ 'SME', 'value.' ];
		scrub.innerHTML = scrub.textContent.trim().split( /\s+/ ).map( function ( w ) {
			return '<span class="sw' + ( hl.indexOf( w ) > -1 ? ' hl' : '' ) + '">' + esc( w ) + '</span>';
		} ).join( ' ' );
		words = scrub.querySelectorAll( '.sw' );
		if ( reduce ) [].forEach.call( words, function ( s ) { s.classList.add( 'on' ); } );
	}

	/* Marquee rows: speed and skew follow scroll velocity */
	var rows = $$( '.mq-row' ).map( function ( row ) {
		var t = row.querySelector( '.mq-track' );
		t.innerHTML = t.innerHTML + t.innerHTML + t.innerHTML;
		return { el: t, dir: +row.dataset.dir, x: 0, w: 0 };
	} );
	function measureRows() { rows.forEach( function ( r ) { r.w = r.el.scrollWidth / 3; if ( r.dir > 0 ) r.x = -r.w; } ); }
	var velocity = 0, smoothV = 0, visible = true;
	if ( rows.length && 'IntersectionObserver' in window ) {
		new IntersectionObserver( function ( en ) { visible = en[ 0 ].isIntersecting; } ).observe( $( '.marquee' ) );
	}
	function frame() {
		if ( visible ) {
			smoothV += ( velocity - smoothV ) * 0.1;
			velocity *= 0.9;
			rows.forEach( function ( r ) {
				r.x += r.dir * ( 0.6 + Math.abs( smoothV ) * 0.25 );
				if ( r.x <= -r.w ) r.x += r.w;
				if ( r.x >= 0 ) r.x -= r.w;
				r.el.style.transform = 'translate3d(' + r.x + 'px,0,0) skewX(' + clamp( -smoothV * 0.25, -10, 10 ) + 'deg)';
			} );
		}
		requestAnimationFrame( frame );
	}

	/* Pinned horizontal case-study reel */
	var hs = $( '#work' ), track = $( '#hsTrack' ), hsNow = $( '#hsNow' ), hsBar = $( '#hsBar' );
	var pinned = false, hsDist = 0, total = track ? track.querySelectorAll( '.proj' ).length : 0;
	function setupReel() {
		if ( ! track ) return;
		pinned = ! reduce && window.innerWidth >= 992;
		hs.classList.toggle( 'is-pinned', pinned );
		track.style.transform = '';
		hsDist = pinned ? Math.max( 0, track.scrollWidth - window.innerWidth ) : 0;
		hs.style.height = pinned ? ( window.innerHeight + hsDist ) + 'px' : '';
	}
	function reelProgress( p ) {
		if ( ! hsNow ) return;
		var n = Math.min( total, Math.round( p * ( total - 1 ) ) + 1 );
		hsNow.textContent = ( n < 10 ? '0' : '' ) + n;
		hsBar.style.transform = 'scaleX(' + Math.max( 1 / total, p ) + ')';
	}
	track && track.addEventListener( 'scroll', function () {
		if ( pinned ) return;
		var max = track.scrollWidth - track.clientWidth;
		reelProgress( max > 0 ? track.scrollLeft / max : 0 );
	}, { passive: true } );

	/* Hero orbit parallax + anchor rotation */
	var anchor = $( '#heroAnchor' ), orbit = $( '.orbit-wrap' ), hero = $( '.hero' );
	if ( hero && orbit && ! reduce && window.matchMedia( '(pointer: fine)' ).matches ) {
		hero.addEventListener( 'pointermove', function ( e ) {
			orbit.style.transform = 'translate(' + ( e.clientX / innerWidth - 0.5 ) * 24 + 'px,' + ( e.clientY / innerHeight - 0.5 ) * 24 + 'px)';
		} );
	}

	document.addEventListener( 'tr:scroll', function ( e ) {
		var y = e.detail.y;
		velocity = e.detail.dy;
		if ( ! reduce && anchor && y < innerHeight * 1.5 ) anchor.style.transform = 'rotate(' + ( y * 0.18 ) + 'deg)';
		if ( pinned ) {
			var top = hs.getBoundingClientRect().top + y;
			var p = hsDist > 0 ? clamp( ( y - top ) / hsDist, 0, 1 ) : 0;
			track.style.transform = 'translate3d(' + ( -p * hsDist ) + 'px,0,0)';
			reelProgress( p );
		}
		if ( words.length && ! reduce ) {
			var r = scrub.getBoundingClientRect();
			var sp = clamp( ( innerHeight * 0.85 - r.top ) / ( r.height + innerHeight * 0.3 ), 0, 1 ), on = Math.round( sp * words.length );
			[].forEach.call( words, function ( s, i ) { s.classList.toggle( 'on', i < on ); } );
		}
	} );

	function layout() { setupReel(); measureRows(); }
	window.addEventListener( 'resize', function () { clearTimeout( layout.t ); layout.t = setTimeout( layout, 150 ); } );
	window.addEventListener( 'load', layout );
	layout();
	if ( ! reduce && rows.length ) requestAnimationFrame( frame );
} )();
