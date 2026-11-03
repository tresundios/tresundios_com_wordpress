<?php
/**
 * Title: Hero with stats
 * Slug: tresundios/hero
 * Categories: tresundios
 * Description: Home hero: kinetic headline, service orbit and four stats.
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","className":"hero tr-sec","layout":{"type":"default"}} -->
<section class="wp-block-group hero tr-sec"><!-- wp:group {"className":"container","layout":{"type":"default"}} -->
<div class="wp-block-group container"><!-- wp:group {"className":"row align-items-center g-5","layout":{"type":"default"}} -->
<div class="wp-block-group row align-items-center g-5"><!-- wp:group {"className":"col-lg-7","layout":{"type":"default"}} -->
<div class="wp-block-group col-lg-7"><!-- wp:html -->
<span class="eyebrow load-in" style="--d:.05s"><img class="icon-badge" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/favicon.webp' ) ); ?>" alt="" width="20" height="20">Chennai · DPIIT-recognised · Est. Nov 2024</span>
<h1 class="hero-title">
	<span class="hline"><span class="load-up" style="--d:.15s">Small business.</span></span>
	<span class="hline"><span class="load-up" style="--d:.3s">Big-brand</span></span>
	<span class="hline"><span class="load-up" style="--d:.45s"><em>presence.</em></span></span>
</h1>
<p class="rotator-line load-in" style="--d:.7s">We do
	<span class="rotator"><span class="visually-hidden">digital marketing, graphic design, events, websites and apps</span>
		<span class="rot-track" aria-hidden="true"><span>digital marketing</span><span>graphic design</span><span>event management</span><span>websites &amp; apps</span><span>digital marketing</span></span>
	</span>
</p>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"lede load-in"} -->
<p class="lede load-in">One Chennai studio for growing businesses. We run your social media, design your brand, produce your events and build your website and apps, at prices that make sense for an SME budget.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"mt-4 load-in"} -->
<div class="wp-block-buttons mt-4 load-in"><!-- wp:button {"className":"magnetic has-arrow"} -->
<div class="wp-block-button magnetic has-arrow"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Book a free consultation</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-ghost magnetic"} -->
<div class="wp-block-button is-style-ghost magnetic"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">See our work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="col-lg-5">
	<div class="orbit-wrap load-in" style="--d:.4s" aria-hidden="true">
		<div class="orbit-ring r1"></div>
		<div class="orbit-ring r2"></div>
		<img class="orbit-anchor" id="heroAnchor" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icon.webp' ) ); ?>" alt="" width="128" height="128" fetchpriority="high">
		<div class="orbit">
			<span class="pill" style="--a:0deg"><b>Marketing</b></span>
			<span class="pill" style="--a:90deg"><b>Design</b></span>
			<span class="pill" style="--a:180deg"><b>Events</b></span>
			<span class="pill" style="--a:270deg"><b>Apps</b></span>
		</div>
	</div>
</div>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:html -->
<ul class="stats row g-0 row-cols-2 row-cols-md-4">
	<li class="stat col"><div class="n"><span data-count="50">50</span>%</div><div class="l">lower cost than enterprise agencies</div></li>
	<li class="stat col"><div class="n"><span data-count="24">24</span>h</div><div class="l">response time on every enquiry</div></li>
	<li class="stat col"><div class="n"><span data-count="100">100</span>%</div><div class="l">client satisfaction to date</div></li>
	<li class="stat col"><div class="n"><span data-count="6">6</span></div><div class="l">client case studies shipped</div></li>
</ul>
<!-- /wp:html --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
