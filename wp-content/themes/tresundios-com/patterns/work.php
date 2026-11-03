<?php
/**
 * Title: Case-study reel
 * Slug: tresundios/work
 * Categories: tresundios
 * Description: Pinned horizontal reel of case studies.
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;

$tresundios_count = function_exists( 'tresundios_case_studies' ) ? count( tresundios_case_studies() ) : 0;
?>
<!-- wp:group {"tagName":"section","anchor":"work","className":"hscroll tr-sec","layout":{"type":"default"}} -->
<section id="work" class="wp-block-group hscroll tr-sec"><!-- wp:group {"className":"hs-sticky","layout":{"type":"default"}} -->
<div class="wp-block-group hs-sticky"><!-- wp:group {"className":"container","layout":{"type":"default"}} -->
<div class="wp-block-group container"><!-- wp:group {"className":"sec-head mb-4","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head mb-4"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Case studies · client work so far</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"split"} -->
<h2 class="wp-block-heading split">Real businesses. Shipped results.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="hs-count" aria-hidden="true"><b id="hsNow">01</b> / <span><?php echo esc_html( sprintf( '%02d', $tresundios_count ) ); ?></span><div class="hs-bar"><span id="hsBar"></span></div></div>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:tresundios/case-studies {"layout":"reel"} /--></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
