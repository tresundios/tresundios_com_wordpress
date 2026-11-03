<?php
/**
 * Pricing table (.com): main tabs per price group, sub-tabs for à-la-carte categories.
 * Every panel is in the HTML; JS only switches tabs (all panels show when JS is off).
 *
 * @package Tresundios\Theme\Com
 *
 * @var array<int, array<string, mixed>> $data Price tree from tresundios_price_tree().
 */

defined( 'ABSPATH' ) || exit;

// Included from tresundios_render_template(), so these variables are function-scoped, not globals.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.WP.GlobalVariablesOverride.Prohibited

if ( empty( $data ) ) {
	return;
}

$tresundios_card_label = array(
	'marketing-packages' => __( 'Marketing package', 'tresundios' ),
	'launch-packages'    => __( 'Launch package', 'tresundios' ),
	'events'             => __( 'Events', 'tresundios' ),
);
$tresundios_uid        = wp_unique_id( 'pr' );

$tresundios_card = static function ( $item, $label ) {
	$featured = '' !== $item['badge'];
	?>
	<article class="price-card<?php echo $featured ? ' is-featured' : ''; ?>" id="price-<?php echo esc_attr( $item['id'] ); ?>">
		<div class="price-top">
			<span class="mini-title"><?php echo esc_html( $label ); ?></span>
			<?php if ( $featured ) : ?>
				<span class="price-badge"><?php echo esc_html( $item['badge'] ); ?></span>
			<?php endif; ?>
		</div>
		<h3><?php echo esc_html( $item['name'] ); ?></h3>
		<p class="price">
			<span class="price-pre"><?php echo $item['from'] ? esc_html__( 'Starting from', 'tresundios' ) : ''; ?></span>
			<b class="price-amt"><?php echo esc_html( $item['amount'] ); ?></b>
			<span class="price-per"><?php echo esc_html( $item['period'] ); ?></span>
			<?php if ( $item['plus'] ) : ?>
				<span class="price-plus"><?php echo esc_html( $item['plus'] ); ?></span>
			<?php endif; ?>
			<?php if ( $item['note'] ) : ?>
				<span class="price-note"><?php echo esc_html( $item['note'] ); ?></span>
			<?php endif; ?>
		</p>
		<p class="price-desc"><?php echo esc_html( $item['description'] ); ?></p>
		<?php if ( $item['features'] ) : ?>
			<ul class="price-feat">
				<?php foreach ( $item['features'] as $feature ) : ?>
					<li><?php echo esc_html( $feature ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<a class="btn-tr <?php echo $featured ? 'btn-tr-primary' : 'btn-tr-ghost'; ?> magnetic" href="<?php echo esc_url( tresundios_quote_url( $item ) ); ?>" data-plan="<?php echo esc_attr( $item['name'] . ' (' . $item['plain'] . ')' ); ?>" data-service="<?php echo esc_attr( $item['enquiry_service'] ); ?>">
			<span><?php esc_html_e( 'Get a Quote', 'tresundios' ); ?></span><span class="visually-hidden">: <?php echo esc_html( $item['name'] ); ?></span><i class="arrow" aria-hidden="true">→</i>
		</a>
	</article>
	<?php
};

$tresundios_tablist = static function ( $groups, $cls, $label, $prefix ) {
	?>
	<div class="<?php echo esc_attr( $cls ); ?>" role="tablist" aria-label="<?php echo esc_attr( $label ); ?>">
		<?php foreach ( $groups as $i => $g ) : ?>
			<button type="button" class="tab" role="tab" id="<?php echo esc_attr( $prefix . '-tab-' . $g['slug'] ); ?>" aria-controls="<?php echo esc_attr( $prefix . '-panel-' . $g['slug'] ); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>" tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>"><?php echo esc_html( $g['name'] ); ?></button>
		<?php endforeach; ?>
	</div>
	<?php
};
?>
<div class="tr-pricing" data-tabs>
	<noscript><style>.tr-pricing .tab-panel[hidden]{display:block}.tr-pricing [role="tablist"]{display:none}</style></noscript>
	<?php $tresundios_tablist( $data, 'tabs', __( 'Pricing categories', 'tresundios' ), $tresundios_uid ); ?>
	<?php foreach ( $data as $i => $group ) : ?>
		<div class="tab-panel" role="tabpanel" id="<?php echo esc_attr( $tresundios_uid . '-panel-' . $group['slug'] ); ?>" aria-labelledby="<?php echo esc_attr( $tresundios_uid . '-tab-' . $group['slug'] ); ?>" tabindex="0"<?php echo 0 === $i ? '' : ' hidden'; ?>>
			<?php if ( $group['description'] ) : ?>
				<p class="price-lead"><?php echo esc_html( $group['description'] ); ?></p>
			<?php endif; ?>

			<?php if ( $group['children'] ) : ?>
				<?php $tresundios_tablist( $group['children'], 'subtabs', $group['name'], $tresundios_uid . '-' . $group['slug'] ); ?>
				<?php foreach ( $group['children'] as $j => $child ) : ?>
					<div class="tab-panel" role="tabpanel" id="<?php echo esc_attr( $tresundios_uid . '-' . $group['slug'] . '-panel-' . $child['slug'] ); ?>" aria-labelledby="<?php echo esc_attr( $tresundios_uid . '-' . $group['slug'] . '-tab-' . $child['slug'] ); ?>"<?php echo 0 === $j ? '' : ' hidden'; ?>>
						<div class="price-grid">
							<?php
							foreach ( $child['items'] as $item ) {
								$tresundios_card( $item, $child['name'] );
							}
							?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="price-grid<?php echo 'events' === $group['slug'] ? '' : ' is-wide'; ?>">
					<?php
					foreach ( $group['items'] as $item ) {
						$tresundios_card( $item, isset( $tresundios_card_label[ $group['slug'] ] ) ? $tresundios_card_label[ $group['slug'] ] : $group['name'] );
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
	<div class="price-notes">
		<p><?php esc_html_e( 'Website, app and event prices are starting prices. Final quotation depends on scope, features, content, integrations and event requirements.', 'tresundios' ); ?></p>
		<p><?php esc_html_e( 'Ad spend, third-party tools, hosting, domains, print production and event vendor costs are billed separately at actual cost.', 'tresundios' ); ?></p>
	</div>
</div>
