<?php
/**
 * Title: Case study body: DentalPin India
 * Slug: tresundios/case-study-dentalpin
 * Categories: tresundios
 * Description: Body of the DentalPin India case study (/work/dentalpin-india/). The hero (H1, tech tags, image) comes from the case study fields and featured image.
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;

$tresundios_svc_web    = esc_url( home_url( '/services/websites-and-apps/' ) );
$tresundios_svc_custom = esc_url( home_url( '/services/websites-and-apps/custom-software-apis/' ) );
$tresundios_svc_devops = esc_url( home_url( '/services/devops/' ) );
?>
<!-- wp:group {"className":"case-body prose","layout":{"type":"default"}} -->
<div class="wp-block-group case-body prose"><!-- wp:paragraph {"className":"lede"} -->
<p class="lede"><?php esc_html_e( 'We localised an open-source dental practice system for Indian clinics, then built the pipeline that deploys and runs it on AWS in Mumbai.', 'tresundios' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'The brief', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'DentalPin is dental practice software built by the DentalPin project in Spain. Its core is source-available under BSL 1.1 and becomes Apache 2.0 four years after each release. Indian clinics need software that works with GST, WhatsApp, their own language and Indian payment rails, so Tresundios secured the exclusive India licence and took on the job of making it fit how clinics in India actually work.', 'tresundios' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'What we built', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'We maintain an India fork of the DentalPin core and build and maintain the India modules on top of it:', 'tresundios' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php esc_html_e( 'GST billing: GSTIN checks, CGST, SGST and IGST by place of supply, and financial-year invoice numbering', 'tresundios' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'WhatsApp reminders and recalls over the official WhatsApp Business API, on the clinic’s own number', 'tresundios' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'An interface in seven languages (Tamil, Telugu, Hindi, Kannada, Malayalam, Marathi and English), with patient messages sent in each person’s language', 'tresundios' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'A DPDP consent pack and ABDM connect for Indian compliance', 'tresundios' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'UPI payments and Razorpay payment links, so patients can pay from the WhatsApp message (in development)', 'tresundios' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The product also includes an AI assistant that is off until a clinic switches it on and masks patient identifiers before any request leaves the system. The stack is FastAPI, Nuxt and PostgreSQL.', 'tresundios' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'How we run it', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The application runs as Docker containers, orchestrated by Coolify on AWS EC2 in the ap-south-1 (Mumbai) region, so patient data is stored in India, encrypted and backed up daily. Coolify builds the images from source on the server. The public demo is a seeded clinic that resets itself every night, so anyone can try anything.', 'tresundios' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<figure class="arch" role="img" aria-label="<?php esc_attr_e( 'Architecture: a user reaches the Nuxt frontend, which calls the FastAPI backend, which stores data in PostgreSQL. All three run as Docker containers, orchestrated by Coolify on an AWS EC2 server in Mumbai, ap-south-1. The public demo resets every night.', 'tresundios' ); ?>">
	<p class="arch-user"><span><?php esc_html_e( 'User', 'tresundios' ); ?></span></p>
	<div class="arch-host">
		<p class="arch-label"><?php esc_html_e( 'AWS EC2 · ap-south-1 (Mumbai) · orchestrated by Coolify', 'tresundios' ); ?></p>
		<div class="arch-docker">
			<p class="arch-label"><?php esc_html_e( 'Docker containers · built from source on the server', 'tresundios' ); ?></p>
			<ol class="arch-flow">
				<li><b><?php esc_html_e( 'Nuxt', 'tresundios' ); ?></b><span><?php esc_html_e( 'frontend', 'tresundios' ); ?></span></li>
				<li><b><?php esc_html_e( 'FastAPI', 'tresundios' ); ?></b><span><?php esc_html_e( 'backend API', 'tresundios' ); ?></span></li>
				<li><b><?php esc_html_e( 'PostgreSQL', 'tresundios' ); ?></b><span><?php esc_html_e( 'database', 'tresundios' ); ?></span></li>
			</ol>
		</div>
	</div>
	<figcaption class="arch-note"><?php esc_html_e( 'Public demo resets every night', 'tresundios' ); ?></figcaption>
</figure>
<!-- /wp:html -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'The India edition in numbers', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:html -->
<div class="row g-3 case-results">
	<!-- TODO: add real metric (page load time) -->
	<!-- TODO: add real metric (monthly hosting cost) -->
	<!-- TODO: add real metric (clinics onboarded) -->
	<div class="col-md-4"><div class="result"><b>35</b><?php esc_html_e( 'modules available, so a clinic switches on only what it uses.', 'tresundios' ); ?></div></div>
	<div class="col-md-4"><div class="result"><b>7</b><?php esc_html_e( 'languages in the interface, with patient messages sent in each person’s own.', 'tresundios' ); ?></div></div>
	<div class="col-md-4"><div class="result"><b><?php esc_html_e( 'Daily', 'tresundios' ); ?></b><?php esc_html_e( 'encrypted backups, with data hosted in Mumbai.', 'tresundios' ); ?></div></div>
</div>
<!-- /wp:html -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Services used', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><a href="<?php echo $tresundios_svc_web; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>"><?php esc_html_e( 'Websites & Apps', 'tresundios' ); ?></a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo $tresundios_svc_custom; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>"><?php esc_html_e( 'Custom Software & APIs', 'tresundios' ); ?></a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo $tresundios_svc_devops; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>"><?php esc_html_e( 'DevOps & Cloud', 'tresundios' ); ?></a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:group {"className":"case-cta","layout":{"type":"default"}} -->
<div class="wp-block-group case-cta"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Need software localised or deployed for a new market?', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"magnetic has-arrow"} -->
<div class="wp-block-button magnetic has-arrow"><a class="wp-block-button__link wp-element-button" href="#book-a-call"><?php esc_html_e( 'Book a free call', 'tresundios' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph -->
<p><a href="https://dentalpin.in" target="_blank" rel="noopener"><?php esc_html_e( 'See DentalPin India live (for clinics in India) →', 'tresundios' ); ?> dentalpin.in</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"case-note"} -->
<p class="case-note"><?php
printf(
	/* translators: %s: link to dentalpin.com */
	esc_html__( 'Tresundios is the exclusive licensee of DentalPin for India. Outside India, see %s.', 'tresundios' ),
	'<a href="https://www.dentalpin.com/en/" target="_blank" rel="noopener">dentalpin.com</a>'
);
?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
