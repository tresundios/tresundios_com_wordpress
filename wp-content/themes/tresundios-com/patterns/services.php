<?php
/**
 * Title: Service grid
 * Slug: tresundios/services
 * Categories: tresundios
 * Description: Dark band with the service cards (from Services).
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","anchor":"services","className":"block dark tr-sec","layout":{"type":"default"}} -->
<section id="services" class="wp-block-group block dark tr-sec"><!-- wp:group {"className":"container","layout":{"type":"default"}} -->
<div class="wp-block-group container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">What we do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"split"} -->
<h2 class="wp-block-heading split">Everything your brand needs to be seen.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"reveal","layout":{"type":"default"}} -->
<div class="wp-block-group reveal"><!-- wp:paragraph -->
<p>Digital marketing is not only for big brands. We give SMEs, restaurants, cafés and startups the same reach, polish and launch power, without the agency price tag.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a class="view-link" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>">View Pricing <i>→</i></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:tresundios/services-grid /--></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
