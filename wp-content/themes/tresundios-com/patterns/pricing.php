<?php
/**
 * Title: Pricing table
 * Slug: tresundios/pricing
 * Categories: tresundios
 * Description: Pricing section with tabs, in this site's currency.
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;

$tresundios_india = function_exists( 'tresundios_is_india' ) && tresundios_is_india();
?>
<!-- wp:group {"tagName":"section","anchor":"pricing","className":"block pricing tr-sec","layout":{"type":"default"}} -->
<section id="pricing" class="wp-block-group block pricing tr-sec"><!-- wp:group {"className":"container","layout":{"type":"default"}} -->
<div class="wp-block-group container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Pricing · USD</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"split"} -->
<h2 class="wp-block-heading split">Transparent Pricing for Global Clients</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"reveal"} -->
<p class="reveal">Choose individual services or bundled packages. All prices are in USD. Custom quotations are provided after understanding your exact requirements.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"reveal","layout":{"type":"default"}} -->
<div class="wp-block-group reveal"><!-- wp:tresundios/pricing-table /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
