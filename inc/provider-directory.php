<?php
/**
 * Provider Directory — CPT, taxonomies, and meta registration.
 *
 * @package FPAN_Theme
 */

/**
 * Register the Provider custom post type.
 */
function fpan_register_provider_cpt() {
	$labels = array(
		'name'                  => __( 'Providers', 'fpan-theme' ),
		'singular_name'         => __( 'Provider', 'fpan-theme' ),
		'add_new_item'          => __( 'Add New Provider', 'fpan-theme' ),
		'edit_item'             => __( 'Edit Provider', 'fpan-theme' ),
		'view_item'             => __( 'View Provider', 'fpan-theme' ),
		'search_items'          => __( 'Search Providers', 'fpan-theme' ),
		'not_found'             => __( 'No providers found.', 'fpan-theme' ),
		'not_found_in_trash'    => __( 'No providers found in trash.', 'fpan-theme' ),
		'menu_name'             => __( 'Providers', 'fpan-theme' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,   // Required for FSE + REST API
		'rest_base'          => 'providers', // /wp-json/wp/v2/providers (plural, conventional)
		'has_archive'        => false,  // Directory page handles the listing
		'menu_icon'          => 'dashicons-businessperson',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'            => array( 'slug' => 'providers' ),
	);

	register_post_type( 'provider', $args );
}
add_action( 'init', 'fpan_register_provider_cpt' );

/**
 * Register the Provider Specialty taxonomy.
 * Hierarchical — like categories (e.g. Cardiology > Interventional Cardiology).
 */
function fpan_register_provider_taxonomies() {

	register_taxonomy(
		'provider_specialty',
		'provider',
		array(
			'labels'            => array(
				'name'          => __( 'Specialties', 'fpan-theme' ),
				'singular_name' => __( 'Specialty', 'fpan-theme' ),
				'add_new_item'  => __( 'Add New Specialty', 'fpan-theme' ),
				'search_items'  => __( 'Search Specialties', 'fpan-theme' ),
			),
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'specialty' ),
		)
	);

	register_taxonomy(
		'provider_location',
		'provider',
		array(
			'labels'            => array(
				'name'          => __( 'Locations', 'fpan-theme' ),
				'singular_name' => __( 'Location', 'fpan-theme' ),
				'add_new_item'  => __( 'Add New Location', 'fpan-theme' ),
				'search_items'  => __( 'Search Locations', 'fpan-theme' ),
			),
			'hierarchical'      => false,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'location' ),
		)
	);
}
add_action( 'init', 'fpan_register_provider_taxonomies' );

/**
 * Register provider meta fields.
 * show_in_rest: true exposes them via the REST API and Gutenberg meta panels.
 */
function fpan_register_provider_meta() {

	$shared = array(
		'object_subtype' => 'provider',
		'type'           => 'string',
		'single'         => true,
		'show_in_rest'   => true,
	);

	register_post_meta( 'provider', '_provider_clinic_name', array_merge( $shared, array(
		'description'   => 'Clinic or practice name',
		'auth_callback' => '__return_true',
	) ) );

	register_post_meta( 'provider', '_provider_phone', array_merge( $shared, array(
		'description'   => 'Provider phone number',
		'auth_callback' => '__return_true',
	) ) );

	register_post_meta( 'provider', '_provider_email', array_merge( $shared, array(
		'description'   => 'Provider email address',
		'auth_callback' => '__return_true',
	) ) );

	register_post_meta( 'provider', '_provider_npi', array_merge( $shared, array(
		'description'   => 'National Provider Identifier (NPI)',
		'auth_callback' => '__return_true',
	) ) );

	register_post_meta( 'provider', '_provider_accepting_patients', array(
		'object_subtype' => 'provider',
		'type'           => 'boolean',
		'single'         => true,
		'show_in_rest'   => true,
		'description'    => 'Whether the provider is accepting new patients',
		'auth_callback'  => '__return_true',
	) );
}
add_action( 'init', 'fpan_register_provider_meta' );

/**
 * Expose specialty + location names on the provider REST response.
 * Used by the autocomplete JS so it can show "Cardiology · Miami" under each suggestion.
 */
function fpan_register_provider_autocomplete_field() {
	register_rest_field(
		'provider',
		'fpan_autocomplete',
		array(
			'get_callback' => function ( $post ) {
				$specialties = get_the_terms( $post['id'], 'provider_specialty' );
				$locations   = get_the_terms( $post['id'], 'provider_location' );
				return array(
					'specialty' => ( $specialties && ! is_wp_error( $specialties ) ) ? $specialties[0]->name : '',
					'location'  => ( $locations   && ! is_wp_error( $locations ) )   ? $locations[0]->name  : '',
				);
			},
			'schema' => null,
		)
	);
}
add_action( 'rest_api_init', 'fpan_register_provider_autocomplete_field' );


/* =============================================================================
   PROVIDER DIRECTORY — META BOX
   Shows a clean "Provider Details" panel below the content editor.
   ============================================================================= */

function fpan_add_provider_meta_box() {
	add_meta_box(
		'fpan_provider_details',
		__( 'Provider Details', 'fpan-theme' ),
		'fpan_render_provider_meta_box',
		'provider',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'fpan_add_provider_meta_box' );

function fpan_render_provider_meta_box( $post ) {
	wp_nonce_field( 'fpan_provider_meta_save', 'fpan_provider_meta_nonce' );

	$clinic    = get_post_meta( $post->ID, '_provider_clinic_name',       true );
	$phone     = get_post_meta( $post->ID, '_provider_phone',              true );
	$email     = get_post_meta( $post->ID, '_provider_email',              true );
	$npi       = get_post_meta( $post->ID, '_provider_npi',                true );
	$accepting = get_post_meta( $post->ID, '_provider_accepting_patients', true );
	?>
	<style>
		.fpan-meta-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px 24px;padding:6px 0}
		.fpan-meta-field{display:flex;flex-direction:column;gap:5px}
		.fpan-meta-field--full{grid-column:1/-1}
		.fpan-meta-field label{font-size:12px;font-weight:600;color:#1e1e1e;text-transform:uppercase;letter-spacing:.04em}
		.fpan-meta-field input[type="text"],
		.fpan-meta-field input[type="email"],
		.fpan-meta-field input[type="tel"]{width:100%;padding:7px 10px;border:1px solid #8c8f94;border-radius:4px;font-size:14px;color:#1e1e1e}
		.fpan-meta-field input:focus{border-color:#0f7b82;outline:2px solid rgba(15,123,130,.25);outline-offset:0}
		.fpan-meta-checkbox{display:flex;align-items:center;gap:8px;font-size:13px;color:#1e1e1e;cursor:pointer}
		.fpan-meta-checkbox input{width:16px;height:16px;cursor:pointer}
	</style>
	<div class="fpan-meta-grid">

		<div class="fpan-meta-field fpan-meta-field--full">
			<label for="provider_clinic_name"><?php esc_html_e( 'Clinic / Practice Name', 'fpan-theme' ); ?></label>
			<input type="text" id="provider_clinic_name" name="provider_clinic_name"
				   value="<?php echo esc_attr( $clinic ); ?>"
				   placeholder="e.g. Miami Children's Clinic">
		</div>

		<div class="fpan-meta-field">
			<label for="provider_phone"><?php esc_html_e( 'Phone Number', 'fpan-theme' ); ?></label>
			<input type="tel" id="provider_phone" name="provider_phone"
				   value="<?php echo esc_attr( $phone ); ?>"
				   placeholder="(305) 555-0100">
		</div>

		<div class="fpan-meta-field">
			<label for="provider_email"><?php esc_html_e( 'Email Address', 'fpan-theme' ); ?></label>
			<input type="email" id="provider_email" name="provider_email"
				   value="<?php echo esc_attr( $email ); ?>"
				   placeholder="dr.name@clinic.com">
		</div>

		<div class="fpan-meta-field">
			<label for="provider_npi"><?php esc_html_e( 'NPI Number', 'fpan-theme' ); ?></label>
			<input type="text" id="provider_npi" name="provider_npi"
				   value="<?php echo esc_attr( $npi ); ?>"
				   placeholder="10-digit NPI">
		</div>

		<div class="fpan-meta-field fpan-meta-field--full">
			<label class="fpan-meta-checkbox">
				<input type="checkbox" name="provider_accepting_patients" value="1"
					   <?php checked( $accepting, '1' ); ?>>
				<?php esc_html_e( 'Currently accepting new patients', 'fpan-theme' ); ?>
			</label>
		</div>

	</div>
	<?php
}

function fpan_save_provider_meta( $post_id ) {
	if ( ! isset( $_POST['fpan_provider_meta_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['fpan_provider_meta_nonce'], 'fpan_provider_meta_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$text_fields = array(
		'_provider_clinic_name' => 'provider_clinic_name',
		'_provider_phone'       => 'provider_phone',
		'_provider_email'       => 'provider_email',
		'_provider_npi'         => 'provider_npi',
	);

	foreach ( $text_fields as $meta_key => $post_key ) {
		if ( isset( $_POST[ $post_key ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) ) );
		}
	}

	update_post_meta(
		$post_id,
		'_provider_accepting_patients',
		isset( $_POST['provider_accepting_patients'] ) ? '1' : '0'
	);
}
add_action( 'save_post_provider', 'fpan_save_provider_meta' );


/* =============================================================================
   PROVIDER DIRECTORY — SHORTCODE + RENDERING
   Shortcode: [fpan_provider_directory]
   ============================================================================= */

/**
 * Build a filtered URL for the provider directory, preserving all active params.
 */
function fpan_provider_dir_url( $base, $specialty = 0, $location = 0, $search = '', $page = 1 ) {
	$args = array();

	if ( $specialty ) $args['specialty'] = $specialty;
	if ( $location )  $args['location']  = $location;
	if ( $search )    $args['pd_search'] = $search;
	if ( $page > 1 )  $args['pd_page']   = $page;

	return empty( $args ) ? $base : add_query_arg( $args, $base );
}

/**
 * Render a single provider card. Returns HTML string.
 */
function fpan_render_provider_card( $post ) {
	$id         = $post->ID;
	$name       = get_the_title( $id );
	$permalink  = get_permalink( $id );
	$clinic     = get_post_meta( $id, '_provider_clinic_name', true );

	$specialties   = get_the_terms( $id, 'provider_specialty' );
	$locations     = get_the_terms( $id, 'provider_location' );

	$specialty_label = ( $specialties && ! is_wp_error( $specialties ) )
		? esc_html( $specialties[0]->name ) : '';

	$location_label = '';
	if ( $locations && ! is_wp_error( $locations ) ) {
		$location_label = esc_html( $locations[0]->name );
	} elseif ( $clinic ) {
		$location_label = esc_html( $clinic );
	}

	// Two-letter initials for avatar fallback.
	$words    = preg_split( '/\s+/', trim( $name ) );
	$initials = '';
	foreach ( array_slice( $words, 0, 2 ) as $word ) {
		$initials .= mb_strtoupper( mb_substr( $word, 0, 1 ) );
	}

	ob_start();
	?>
	<article class="provider-card">

		<div class="provider-card__avatar">
			<?php if ( has_post_thumbnail( $id ) ) : ?>
				<?php echo get_the_post_thumbnail( $id, array( 120, 120 ), array(
					'class' => 'provider-card__image',
					'alt'   => esc_attr( $name ),
				) ); ?>
			<?php else : ?>
				<div class="provider-card__initials" aria-hidden="true">
					<?php echo esc_html( $initials ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="provider-card__body">

			<h3 class="provider-card__name">
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $name ); ?></a>
			</h3>

			<?php if ( $specialty_label ) : ?>
			<p class="provider-card__specialty"><?php echo $specialty_label; ?></p>
			<?php endif; ?>

			<?php if ( $location_label ) : ?>
			<p class="provider-card__location">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
				</svg>
				<?php echo $location_label; ?>
			</p>
			<?php endif; ?>

			<hr class="provider-card__divider">

			<a href="<?php echo esc_url( $permalink ); ?>" class="btn btn--primary btn--sm provider-card__cta">
				<?php esc_html_e( 'View Profile', 'fpan-theme' ); ?>
			</a>

		</div>

	</article>
	<?php
	return ob_get_clean();
}

/**
 * Main shortcode renderer.
 * Reads specialty, location, pd_search, pd_page from GET.
 * Returns fully server-rendered HTML — no JS required to function.
 */
function fpan_provider_directory_shortcode() {
	// Enqueue here — the only reliable place when the shortcode lives in a
	// block template file rather than post_content (is_page_template and
	// has_shortcode($post->post_content) both fail in that case).
	wp_enqueue_script(
		'fpan-provider-directory',
		get_template_directory_uri() . '/assets/js/provider-directory.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/provider-directory.js' ),
		true
	);

	$current_specialty = isset( $_GET['specialty'] ) ? absint( $_GET['specialty'] ) : 0;
	$current_location  = isset( $_GET['location'] )  ? absint( $_GET['location'] )  : 0;
	$search_term       = isset( $_GET['pd_search'] )  ? sanitize_text_field( wp_unslash( $_GET['pd_search'] ) ) : '';
	$paged             = isset( $_GET['pd_page'] )    ? max( 1, absint( $_GET['pd_page'] ) ) : 1;

	// --- WP_Query ---
	$query_args = array(
		'post_type'      => 'provider',
		'post_status'    => 'publish',
		'posts_per_page' => 9,
		'paged'          => $paged,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);

	if ( $search_term ) {
		$query_args['s'] = $search_term;
	}

	$tax_query = array();
	if ( $current_specialty ) {
		$tax_query[] = array(
			'taxonomy' => 'provider_specialty',
			'field'    => 'term_id',
			'terms'    => $current_specialty,
		);
	}
	if ( $current_location ) {
		$tax_query[] = array(
			'taxonomy' => 'provider_location',
			'field'    => 'term_id',
			'terms'    => $current_location,
		);
	}
	if ( ! empty( $tax_query ) ) {
		$query_args['tax_query'] = $tax_query;
	}

	$query = new WP_Query( $query_args );

	// --- Filter terms ---
	$specialties = get_terms( array( 'taxonomy' => 'provider_specialty', 'hide_empty' => false, 'orderby' => 'name' ) );
	$locations   = get_terms( array( 'taxonomy' => 'provider_location',  'hide_empty' => false, 'orderby' => 'name' ) );

	$page_url     = get_permalink();
	$has_filters  = ( $current_specialty || $current_location || $search_term );

	ob_start();
	?>

	<div class="provider-directory" id="provider-directory"
		 data-rest-url="<?php echo esc_url( rest_url( 'fpan/v1/providers' ) ); ?>">

		<!-- ============================================================
		     SEARCH BAR
		     ============================================================ -->
		<div class="provider-directory__search">
			<form class="provider-search-form" id="provider-search-form"
				  method="get" action="<?php echo esc_url( $page_url ); ?>" role="search">

				<?php if ( $current_specialty ) : ?>
					<input type="hidden" name="specialty" value="<?php echo esc_attr( $current_specialty ); ?>">
				<?php endif; ?>
				<?php if ( $current_location ) : ?>
					<input type="hidden" name="location" value="<?php echo esc_attr( $current_location ); ?>">
				<?php endif; ?>

				<div class="provider-search-bar">
					<span class="provider-search-bar__icon" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
						</svg>
					</span>
					<input
						type="search"
						name="pd_search"
						id="provider-search-input"
						class="provider-search-bar__input"
						value="<?php echo esc_attr( $search_term ); ?>"
						placeholder="<?php esc_attr_e( 'Search by provider name or clinic…', 'fpan-theme' ); ?>"
						autocomplete="off"
						aria-label="<?php esc_attr_e( 'Search providers', 'fpan-theme' ); ?>"
						data-autocomplete-url="<?php echo esc_url( rest_url( 'wp/v2/providers' ) ); ?>"
					/>
					<div class="provider-search-bar__suggestions" id="provider-suggestions" role="listbox" aria-label="<?php esc_attr_e( 'Suggestions', 'fpan-theme' ); ?>" hidden></div>
					<button type="submit" class="provider-search-bar__btn"
						aria-label="<?php esc_attr_e( 'Search providers', 'fpan-theme' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2.5"
							 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<circle cx="11" cy="11" r="8"/>
							<line x1="21" y1="21" x2="16.65" y2="16.65"/>
						</svg>
					</button>
				</div>

			</form>
		</div><!-- /.provider-directory__search -->


		<!-- ============================================================
		     LAYOUT: SIDEBAR + RESULTS
		     ============================================================ -->
		<div class="provider-directory__layout"
			 style="display:flex;gap:2rem;align-items:flex-start;width:100%;">

			<!-- Sidebar -->
			<aside class="provider-directory__sidebar"
				   style="width:280px;flex-shrink:0;min-width:280px;"
				   aria-label="<?php esc_attr_e( 'Filter providers', 'fpan-theme' ); ?>">

				<h2 class="provider-filters__heading">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
						 fill="none" stroke="currentColor" stroke-width="2.5"
						 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
					</svg>
					<?php esc_html_e( 'Filters', 'fpan-theme' ); ?>
				</h2>

				<div class="provider-filters">

					<!-- Specialty dropdown -->
					<div class="provider-filter-group">
						<label class="provider-filter-group__label" for="filter-specialty">
							<?php esc_html_e( 'Specialty', 'fpan-theme' ); ?>
						</label>
						<div class="provider-filter-select-wrap">
							<select id="filter-specialty" name="specialty"
									class="provider-filter-select" data-filter="specialty">
								<option value="0"<?php selected( 0, $current_specialty ); ?>>
									<?php esc_html_e( 'All Specialties', 'fpan-theme' ); ?>
								</option>
								<?php if ( ! is_wp_error( $specialties ) ) : foreach ( $specialties as $term ) : ?>
								<option value="<?php echo absint( $term->term_id ); ?>"<?php selected( $term->term_id, $current_specialty ); ?>>
									<?php echo esc_html( $term->name ); ?>
								</option>
								<?php endforeach; endif; ?>
							</select>
						</div>
					</div>

					<!-- Location dropdown -->
					<div class="provider-filter-group">
						<label class="provider-filter-group__label" for="filter-location">
							<?php esc_html_e( 'Location', 'fpan-theme' ); ?>
						</label>
						<div class="provider-filter-select-wrap">
							<select id="filter-location" name="location"
									class="provider-filter-select" data-filter="location">
								<option value="0"<?php selected( 0, $current_location ); ?>>
									<?php esc_html_e( 'All Locations', 'fpan-theme' ); ?>
								</option>
								<?php if ( ! is_wp_error( $locations ) ) : foreach ( $locations as $term ) : ?>
								<option value="<?php echo absint( $term->term_id ); ?>"<?php selected( $term->term_id, $current_location ); ?>>
									<?php echo esc_html( $term->name ); ?>
								</option>
								<?php endforeach; endif; ?>
							</select>
						</div>
					</div>

					<?php if ( $has_filters ) : ?>
					<a href="<?php echo esc_url( $page_url ); ?>" class="provider-filters__clear-all">
						<?php esc_html_e( 'Clear all filters', 'fpan-theme' ); ?>
					</a>
					<?php endif; ?>

				</div>

				<?php
				$specialty_page = get_page_by_path( 'specialty-care-clinics' );
				$primary_page   = get_page_by_path( 'primary-care-clinics' );
				$specialty_url  = $specialty_page ? get_permalink( $specialty_page->ID ) : home_url( '/specialty-care-clinics/' );
				$primary_url    = $primary_page   ? get_permalink( $primary_page->ID )   : home_url( '/primary-care-clinics/' );
				?>
				<div class="clinic-nav-widget">
					<a href="<?php echo esc_url( $specialty_url ); ?>" class="clinic-nav-widget__link">
						<span><?php esc_html_e( 'Browse our specialty care clinics', 'fpan-theme' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2.5"
							 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<polyline points="9 18 15 12 9 6"/>
						</svg>
					</a>
					<a href="<?php echo esc_url( $primary_url ); ?>" class="clinic-nav-widget__link">
						<span><?php esc_html_e( 'Browse our primary care clinics', 'fpan-theme' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2.5"
							 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<polyline points="9 18 15 12 9 6"/>
						</svg>
					</a>
				</div>

			</aside><!-- /.provider-directory__sidebar -->


			<!-- Results -->
			<div class="provider-directory__results" id="provider-results"
				 style="flex:1;min-width:0;">

				<div class="provider-results__header">
					<p class="provider-results__count">
						<?php
						$found = $query->found_posts;
						printf(
							esc_html( _n( '%s provider found', '%s providers found', $found, 'fpan-theme' ) ),
							'<strong>' . number_format_i18n( $found ) . '</strong>'
						);
						?>
					</p>
				</div>

				<?php if ( $query->have_posts() ) : ?>

					<div class="provider-cards-grid">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php echo fpan_render_provider_card( get_post() ); ?>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>

					<?php if ( $query->max_num_pages > 1 ) :
						$total = $query->max_num_pages;
						$win   = 2;
					?>
					<nav class="provider-pagination" aria-label="<?php esc_attr_e( 'Provider listing pages', 'fpan-theme' ); ?>">

						<?php if ( $paged > 1 ) : ?>
						<a href="<?php echo esc_url( fpan_provider_dir_url( $page_url, $current_specialty, $current_location, $search_term, $paged - 1 ) ); ?>"
						   class="provider-pagination__btn" rel="prev">← <?php esc_html_e( 'Prev', 'fpan-theme' ); ?></a>
						<?php endif; ?>

						<?php for ( $i = 1; $i <= $total; $i++ ) :
							if ( 1 === $i || $i === $total || abs( $i - $paged ) <= $win ) : ?>
							<a href="<?php echo esc_url( fpan_provider_dir_url( $page_url, $current_specialty, $current_location, $search_term, $i ) ); ?>"
							   class="provider-pagination__page<?php echo $i === $paged ? ' is-current' : ''; ?>"
							   <?php echo $i === $paged ? 'aria-current="page"' : ''; ?>><?php echo absint( $i ); ?></a>
						<?php elseif ( abs( $i - $paged ) === $win + 1 ) : ?>
							<span class="provider-pagination__dots">…</span>
						<?php endif; endfor; ?>

						<?php if ( $paged < $total ) : ?>
						<a href="<?php echo esc_url( fpan_provider_dir_url( $page_url, $current_specialty, $current_location, $search_term, $paged + 1 ) ); ?>"
						   class="provider-pagination__btn" rel="next"><?php esc_html_e( 'Next', 'fpan-theme' ); ?> →</a>
						<?php endif; ?>

					</nav>
					<?php endif; ?>

				<?php else : ?>

					<div class="provider-no-results">
						<div class="provider-no-results__icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
							</svg>
						</div>
						<h3 class="provider-no-results__heading"><?php esc_html_e( 'No providers found', 'fpan-theme' ); ?></h3>
						<p class="provider-no-results__text">
							<?php esc_html_e( 'Try adjusting your search or clearing the filters.', 'fpan-theme' ); ?>
						</p>
						<a href="<?php echo esc_url( $page_url ); ?>" class="btn btn--secondary">
							<?php esc_html_e( 'Clear all filters', 'fpan-theme' ); ?>
						</a>
					</div>

				<?php endif; ?>

			</div><!-- /.provider-directory__results -->

		</div><!-- /.provider-directory__layout -->

	</div><!-- /.provider-directory -->

	<?php
	return ob_get_clean();
}
add_shortcode( 'fpan_provider_directory', 'fpan_provider_directory_shortcode' );


/* =============================================================================
   PROVIDER DIRECTORY — REST API ENDPOINT
   GET /wp-json/fpan/v1/providers
   Returns JSON: { html, found, max_pages }
   The JS layer (Phase 5) calls this to refresh results without a page reload.
   ============================================================================= */

/**
 * Find the Provider Directory page URL.
 * Used to build correct pagination links inside the REST response.
 */
function fpan_get_provider_directory_url() {
	$pages = get_posts( array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'meta_query'     => array(
			array(
				'key'   => '_wp_page_template',
				'value' => 'page-provider-directory',
			),
		),
	) );

	if ( ! empty( $pages ) ) {
		return get_permalink( $pages[0]->ID );
	}

	$page = get_page_by_path( 'provider-directory' );
	return $page ? get_permalink( $page->ID ) : home_url( '/provider-directory/' );
}

/**
 * Render the results section HTML: count header + cards grid + pagination (or empty state).
 * Shared between the shortcode (initial load) and the REST handler (AJAX refresh).
 */
function fpan_render_provider_results_html( $query, $specialty, $location, $search, $paged, $page_url ) {
	$found = $query->found_posts;
	ob_start();
	?>

	<div class="provider-results__header">
		<p class="provider-results__count">
			<?php
			printf(
				esc_html( _n( '%s provider found', '%s providers found', $found, 'fpan-theme' ) ),
				'<strong>' . number_format_i18n( $found ) . '</strong>'
			);
			?>
		</p>
	</div>

	<?php if ( $query->have_posts() ) : ?>

		<div class="provider-cards-grid">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php echo fpan_render_provider_card( get_post() ); ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php if ( $query->max_num_pages > 1 ) :
			$total = $query->max_num_pages;
			$win   = 2;
		?>
		<nav class="provider-pagination" aria-label="<?php esc_attr_e( 'Provider listing pages', 'fpan-theme' ); ?>">

			<?php if ( $paged > 1 ) : ?>
			<a href="<?php echo esc_url( fpan_provider_dir_url( $page_url, $specialty, $location, $search, $paged - 1 ) ); ?>"
			   class="provider-pagination__btn" rel="prev">← <?php esc_html_e( 'Prev', 'fpan-theme' ); ?></a>
			<?php endif; ?>

			<?php for ( $i = 1; $i <= $total; $i++ ) :
				if ( 1 === $i || $i === $total || abs( $i - $paged ) <= $win ) : ?>
				<a href="<?php echo esc_url( fpan_provider_dir_url( $page_url, $specialty, $location, $search, $i ) ); ?>"
				   class="provider-pagination__page<?php echo $i === $paged ? ' is-current' : ''; ?>"
				   <?php echo $i === $paged ? 'aria-current="page"' : ''; ?>><?php echo absint( $i ); ?></a>
			<?php elseif ( abs( $i - $paged ) === $win + 1 ) : ?>
				<span class="provider-pagination__dots">…</span>
			<?php endif; endfor; ?>

			<?php if ( $paged < $total ) : ?>
			<a href="<?php echo esc_url( fpan_provider_dir_url( $page_url, $specialty, $location, $search, $paged + 1 ) ); ?>"
			   class="provider-pagination__btn" rel="next"><?php esc_html_e( 'Next', 'fpan-theme' ); ?> →</a>
			<?php endif; ?>

		</nav>
		<?php endif; ?>

	<?php else : ?>

		<div class="provider-no-results">
			<div class="provider-no-results__icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
					<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
				</svg>
			</div>
			<h3 class="provider-no-results__heading"><?php esc_html_e( 'No providers found', 'fpan-theme' ); ?></h3>
			<p class="provider-no-results__text">
				<?php esc_html_e( 'Try adjusting your search or clearing the filters.', 'fpan-theme' ); ?>
			</p>
			<a href="<?php echo esc_url( $page_url ); ?>" class="btn btn--secondary">
				<?php esc_html_e( 'Clear all filters', 'fpan-theme' ); ?>
			</a>
		</div>

	<?php endif; ?>

	<?php
	return ob_get_clean();
}

/**
 * Register the REST route.
 */
/**
 * Enqueue the provider directory JS only on the directory page.
 */
// Script is enqueued inside the shortcode function itself (see below).
// This is the only reliable approach when the shortcode lives in a block
// template file rather than in post_content — is_page_template() and
// has_shortcode($post->post_content) both fail in that case.

function fpan_register_provider_rest_routes() {
	register_rest_route(
		'fpan/v1',
		'/providers',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'fpan_provider_rest_handler',
			'permission_callback' => '__return_true',
			'args'                => array(
				'specialty' => array(
					'type'              => 'integer',
					'default'           => 0,
					'sanitize_callback' => 'absint',
				),
				'location'  => array(
					'type'              => 'integer',
					'default'           => 0,
					'sanitize_callback' => 'absint',
				),
				'pd_search' => array(
					'type'              => 'string',
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
				),
				'pd_page'   => array(
					'type'              => 'integer',
					'default'           => 1,
					'sanitize_callback' => 'absint',
				),
			),
		)
	);
}
add_action( 'rest_api_init', 'fpan_register_provider_rest_routes' );

/**
 * REST handler — builds the query, renders results HTML, returns JSON.
 */
function fpan_provider_rest_handler( WP_REST_Request $request ) {
	$specialty = $request->get_param( 'specialty' );
	$location  = $request->get_param( 'location' );
	$search    = $request->get_param( 'pd_search' );
	$paged     = max( 1, (int) $request->get_param( 'pd_page' ) );

	$query_args = array(
		'post_type'      => 'provider',
		'post_status'    => 'publish',
		'posts_per_page' => 9,
		'paged'          => $paged,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);

	if ( $search ) {
		$query_args['s'] = $search;
	}

	$tax_query = array();
	if ( $specialty ) {
		$tax_query[] = array(
			'taxonomy' => 'provider_specialty',
			'field'    => 'term_id',
			'terms'    => $specialty,
		);
	}
	if ( $location ) {
		$tax_query[] = array(
			'taxonomy' => 'provider_location',
			'field'    => 'term_id',
			'terms'    => $location,
		);
	}
	if ( ! empty( $tax_query ) ) {
		$query_args['tax_query'] = $tax_query;
	}

	$query    = new WP_Query( $query_args );
	$page_url = fpan_get_provider_directory_url();
	$html     = fpan_render_provider_results_html( $query, $specialty, $location, $search, $paged, $page_url );

	return new WP_REST_Response(
		array(
			'html'      => $html,
			'found'     => (int) $query->found_posts,
			'max_pages' => (int) $query->max_num_pages,
		),
		200
	);
}


/* =============================================================================
   SINGLE PROVIDER PROFILE — [fpan_provider_profile] shortcode
   Renders the full provider profile page: hero + contact sidebar + bio.
   ============================================================================= */

function fpan_provider_profile_shortcode() {
	global $post;

	if ( ! $post || 'provider' !== $post->post_type ) {
		return '';
	}

	// ── Meta ──────────────────────────────────────────────────────────────────
	$clinic_name = get_post_meta( $post->ID, '_provider_clinic_name', true );
	$phone       = get_post_meta( $post->ID, '_provider_phone',       true );
	$email       = get_post_meta( $post->ID, '_provider_email',       true );
	$npi         = get_post_meta( $post->ID, '_provider_npi',         true );
	$accepting   = get_post_meta( $post->ID, '_provider_accepting_patients', true );

	// ── Taxonomy terms ────────────────────────────────────────────────────────
	$specialties = wp_get_post_terms( $post->ID, 'provider_specialty', array( 'orderby' => 'name' ) );
	$locations   = wp_get_post_terms( $post->ID, 'provider_location',  array( 'orderby' => 'name' ) );

	$specialty_names = ( ! is_wp_error( $specialties ) && ! empty( $specialties ) )
		? implode( ', ', wp_list_pluck( $specialties, 'name' ) )
		: '';

	$location_names = ( ! is_wp_error( $locations ) && ! empty( $locations ) )
		? implode( ', ', wp_list_pluck( $locations, 'name' ) )
		: '';

	// ── Avatar ────────────────────────────────────────────────────────────────
	$has_avatar = has_post_thumbnail( $post->ID );
	$avatar_url = $has_avatar ? get_the_post_thumbnail_url( $post->ID, 'medium' ) : '';

	// Initials fallback
	$words    = array_filter( explode( ' ', trim( $post->post_title ) ) );
	$initials = '';
	foreach ( array_slice( $words, 0, 2 ) as $w ) {
		$initials .= strtoupper( mb_substr( $w, 0, 1 ) );
	}

	// ── Directory URL ─────────────────────────────────────────────────────────
	$dir_url = fpan_get_provider_directory_url();

	ob_start();
	?>

	<!-- ================================================================
	     HERO: navy background — avatar + name + specialty + location
	     ================================================================ -->
	<div class="sp-hero">
		<div class="sp-hero__inner">

			<!-- Avatar -->
			<div class="sp-hero__avatar">
				<?php if ( $has_avatar ) : ?>
					<img src="<?php echo esc_url( $avatar_url ); ?>"
						 alt="<?php echo esc_attr( $post->post_title ); ?>"
						 class="sp-hero__avatar-img">
				<?php else : ?>
					<span class="sp-hero__initials"><?php echo esc_html( $initials ); ?></span>
				<?php endif; ?>
			</div>

			<!-- Info -->
			<div class="sp-hero__info">

				<?php if ( '1' === $accepting ) : ?>
					<span class="sp-hero__badge sp-hero__badge--accepting">
						<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
							<polyline points="20 6 9 17 4 12"/>
						</svg>
						<?php esc_html_e( 'Accepting New Patients', 'fpan-theme' ); ?>
					</span>
				<?php else : ?>
					<span class="sp-hero__badge sp-hero__badge--not-accepting">
						<?php esc_html_e( 'Not Currently Accepting', 'fpan-theme' ); ?>
					</span>
				<?php endif; ?>

				<h1 class="sp-hero__name"><?php echo esc_html( $post->post_title ); ?></h1>

				<?php if ( $specialty_names ) : ?>
					<p class="sp-hero__specialty"><?php echo esc_html( $specialty_names ); ?></p>
				<?php endif; ?>

				<?php if ( $location_names ) : ?>
					<p class="sp-hero__location">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2"
							 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
							<circle cx="12" cy="10" r="3"/>
						</svg>
						<?php echo esc_html( $location_names ); ?>
					</p>
				<?php endif; ?>

			</div><!-- /.sp-hero__info -->
		</div><!-- /.sp-hero__inner -->
	</div><!-- /.sp-hero -->


	<!-- ================================================================
	     BODY: sidebar (contact) + main (bio)
	     ================================================================ -->
	<div class="sp-body">
		<div class="sp-layout" style="display:flex;gap:2rem;align-items:flex-start;width:100%;">

			<!-- ── Sidebar ─────────────────────────────────────────── -->
			<aside class="sp-sidebar" style="width:280px;flex-shrink:0;min-width:280px;">

				<a href="<?php echo esc_url( $dir_url ); ?>" class="sp-back-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
						 fill="none" stroke="currentColor" stroke-width="2.5"
						 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<polyline points="15 18 9 12 15 6"/>
					</svg>
					<?php esc_html_e( 'Back to Directory', 'fpan-theme' ); ?>
				</a>

				<!-- Contact card -->
				<div class="sp-card">
					<h2 class="sp-card__heading"><?php esc_html_e( 'Contact Information', 'fpan-theme' ); ?></h2>

					<?php if ( $clinic_name ) : ?>
					<div class="sp-contact-row">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
							<polyline points="9 22 9 12 15 12 15 22"/>
						</svg>
						<span><?php echo esc_html( $clinic_name ); ?></span>
					</div>
					<?php endif; ?>

					<?php if ( $phone ) : ?>
					<div class="sp-contact-row">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.08-1.08a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
						</svg>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+\-\(\)\s]/', '', $phone ) ); ?>">
							<?php echo esc_html( $phone ); ?>
						</a>
					</div>
					<?php endif; ?>

					<?php if ( $email ) : ?>
					<div class="sp-contact-row">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
							<polyline points="22,6 12,13 2,6"/>
						</svg>
						<a href="mailto:<?php echo esc_attr( $email ); ?>">
							<?php echo esc_html( $email ); ?>
						</a>
					</div>
					<?php endif; ?>

					<?php if ( $npi ) : ?>
					<div class="sp-contact-row">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
							<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
						</svg>
						<span><?php printf( esc_html__( 'NPI: %s', 'fpan-theme' ), esc_html( $npi ) ); ?></span>
					</div>
					<?php endif; ?>

					<?php if ( ! $clinic_name && ! $phone && ! $email && ! $npi ) : ?>
					<p class="sp-card__empty"><?php esc_html_e( 'No contact information available.', 'fpan-theme' ); ?></p>
					<?php endif; ?>

				</div><!-- /.sp-card -->

				<!-- Specialties -->
				<?php if ( ! is_wp_error( $specialties ) && ! empty( $specialties ) ) : ?>
				<div class="sp-card sp-card--tags">
					<h3 class="sp-card__heading"><?php esc_html_e( 'Specialties', 'fpan-theme' ); ?></h3>
					<div class="sp-tags">
						<?php foreach ( $specialties as $term ) : ?>
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="sp-tag">
							<?php echo esc_html( $term->name ); ?>
						</a>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

			</aside><!-- /.sp-sidebar -->


			<!-- ── Main content ────────────────────────────────────── -->
			<div class="sp-main" style="flex:1;min-width:0;">

				<div class="sp-card sp-card--bio">
					<h2 class="sp-card__heading"><?php esc_html_e( 'About', 'fpan-theme' ); ?></h2>

					<?php if ( ! empty( $post->post_content ) ) : ?>
					<div class="sp-bio-content">
						<?php echo wp_kses_post( apply_filters( 'the_content', $post->post_content ) ); ?>
					</div>
					<?php else : ?>
					<p class="sp-card__empty">
						<?php esc_html_e( 'No biography available for this provider.', 'fpan-theme' ); ?>
					</p>
					<?php endif; ?>
				</div>

			</div><!-- /.sp-main -->

		</div><!-- /.sp-layout -->
	</div><!-- /.sp-body -->

	<?php
	return ob_get_clean();
}
add_shortcode( 'fpan_provider_profile', 'fpan_provider_profile_shortcode' );
