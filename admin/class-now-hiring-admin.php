<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/admin
 * @author 		Slushman <chris@slushman.com>
 */
class Now_Hiring_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$i18n 		The ID of this plugin.
	 */
	private $i18n;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$Now_Hiring 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $i18n, $version ) {

		$this->i18n = $i18n;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->i18n, plugin_dir_url( __FILE__ ) . 'css/now-hiring-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->i18n, plugin_dir_url( __FILE__ ) . 'js/now-hiring-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Creates a new custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public function new_cpt_jobs() {

		$cap_type 	= 'post';
		$plural 	= 'Jobs';
		$single 	= 'Job';
		$cpt_name 	= 'jobs';

		$opts['can_export']								= TRUE;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= FALSE;
		$opts['has_archive']							= FALSE;
		$opts['hierarchical']							= FALSE;
		$opts['map_meta_cap']							= TRUE;
		$opts['menu_icon']								= 'dashicons-admin-post';
		$opts['menu_position']							= 25;
		$opts['public']									= TRUE;
		$opts['publicly_querable']						= TRUE;
		$opts['query_var']								= TRUE;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= FALSE;
		$opts['show_in_admin_bar']						= TRUE;
		$opts['show_in_menu']							= TRUE;
		$opts['show_in_nav_menu']						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['supports']								= array( 'title', 'editor', 'thumbnail' );
		$opts['taxonomies']								= array();

		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

		$opts['labels']['add_new']						= __( "Add New {$single}", $this->i18n );
		$opts['labels']['add_new_item']					= __( "Add New {$single}", $this->i18n );
		$opts['labels']['all_items']					= __( $plural, $this->i18n );
		$opts['labels']['edit_item']					= __( "Edit {$single}" , $this->i18n);
		$opts['labels']['menu_name']					= __( $plural, $this->i18n );
		$opts['labels']['name']							= __( $plural, $this->i18n );
		$opts['labels']['name_admin_bar']				= __( $single, $this->i18n );
		$opts['labels']['new_item']						= __( "New {$single}", $this->i18n );
		$opts['labels']['not_found']					= __( "No {$plural} Found", $this->i18n );
		$opts['labels']['not_found_in_trash']			= __( "No {$plural} Found in Trash", $this->i18n );
		$opts['labels']['parent_item_colon']			= __( "Parent {$plural} :", $this->i18n );
		$opts['labels']['search_items']					= __( "Search {$plural}", $this->i18n );
		$opts['labels']['singular_name']				= __( $single, $this->i18n );
		$opts['labels']['view_item']					= __( "View {$single}", $this->i18n );

		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= FALSE;
		$opts['rewrite']['pages']						= TRUE;
		$opts['rewrite']['slug']						= __( strtolower( $plural ), $this->i18n );
		$opts['rewrite']['with_front']					= FALSE;

		register_post_type( strtolower( $cpt_name ), $opts );

	} // new_cpt_jobs()

	/**
	 * Creates a new taxonomy for a custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public function new_taxonomy_type() {

		$plural 	= 'Types';
		$single 	= 'Type';
		$tax_name 	= 'job_type';

		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['query_var']								= $tax_name;
		$opts['show_admin_column'] 						= FALSE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= __( "Add New {$single}", $this->i18n );
		$opts['labels']['add_or_remove_items'] 			= __( "Add or remove {$plural}", $this->i18n );
		$opts['labels']['all_items'] 					= __( $plural, $this->i18n );
		$opts['labels']['choose_from_most_used'] 		= __( "Choose from most used {$plural}", $this->i18n );
		$opts['labels']['edit_item'] 					= __( "Edit {$single}" , $this->i18n);
		$opts['labels']['menu_name'] 					= __( $plural, $this->i18n );
		$opts['labels']['name'] 						= __( $plural, $this->i18n );
		$opts['labels']['new_item_name'] 				= __( "New {$single} Name", $this->i18n );
		$opts['labels']['not_found'] 					= __( "No {$plural} Found", $this->i18n );
		$opts['labels']['parent_item'] 					= __( "Parent {$single}", $this->i18n );
		$opts['labels']['parent_item_colon'] 			= __( "Parent {$single}:", $this->i18n );
		$opts['labels']['popular_items'] 				= __( "Popular {$plural}", $this->i18n );
		$opts['labels']['search_items'] 				= __( "Search {$plural}", $this->i18n );
		$opts['labels']['separate_items_with_commas'] 	= __( "Separate {$plural} with commas", $this->i18n );
		$opts['labels']['singular_name'] 				= __( $single, $this->i18n );
		$opts['labels']['update_item'] 					= __( "Update {$single}", $this->i18n );
		$opts['labels']['view_item'] 					= __( "View {$single}", $this->i18n );

		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= __( strtolower( $tax_name ), $this->i18n );
		$opts['rewrite']['with_front']					= FALSE;

		register_taxonomy( $tax_name, 'jobs', $opts );

	} // new_taxonomy_type()

	/**
	 * [add_metaboxes description]
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'now_hiring_job_location',
			__( 'Job Location', $this->i18n ),
			array( $this, 'callback_metabox_job_location' ),
			'jobs',
			'normal',
			'default'
		);

	} // add_metaboxes()

	/**
	 * [callback_metabox_job_location description]
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return [type] [description]
	 */
	public function callback_metabox_job_location( $object, $box ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/now-hiring-admin-display-metabox-job-location.php' );

	} // callback_metabox_job_location()

	/**
	 * Saves metabox data
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function save_meta( $post_id, $object ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( ! current_user_can( 'edit_page', $post_id ) ) { return $post_id; }
		if ( ! isset( $_POST['job_location_nonce'] ) ) { return $post_id; }
		if ( ! wp_verify_nonce( $_POST['job_location_nonce'], NOW_HIRING_BASENAME ) ) { return $post_id; }
		if ( 'jobs' !== $object->post_type ) { return $post_id; }

		$custom = get_post_custom( $post_id );
		$metas 	= array( 'job-location' );

		foreach ( $metas as $meta ) {

			$value		= ( empty( $custom[$meta][0] ) ? '' : $custom[$meta][0] );
			$new_value	= sanitize_text_field( $_POST[$meta] );

			if ( $new_value && $new_value != $value ) {

				// If the new meta value does not match the old value, update it.
				update_post_meta( $post_id, $meta, $new_value );

			} elseif ( '' == $new_value && $value ) {

				// If there is no new meta value but an old value exists, delete it.
				delete_post_meta( $post_id, $meta, $value );

			} elseif ( $new_value && '' == $value ) {

				// If a new meta value was added and there was no previous value, add it.
				add_post_meta( $post_id, $meta, $new_value, true );

			} // End of meta value checks

		} // End of foreach loop

	} // save_meta()

	/**
	 * [settings_link description]
	 * @param  [type] $links [description]
	 * @return [type]        [description]
	 */
	public function settings_link( $links ) {

		$settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=now-hiring' ), __( 'Settings' ) );

		array_unshift( $links, $settings_link );

		return $links;

	} // settings_link()

	/**
	 * [row_links description]
	 * @param  [type] $links [description]
	 * @return [type]        [description]
	 */
	public function row_links( $links, $file ) {

		if ( $file == NOW_HIRING_BASENAME ) {

			$link = '<a href="http://grumpycats.com/">Grumpy Cat</a>';

			array_push( $links, $link );

		}

		return $links;

	} // row_links()

	public function add_menu() {

		// add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback );

		add_options_page(
			__( 'Now Hiring Settings', $this->i18n ),
			__( 'Now Hiring', $this->i18n ),
			'manage_options',
			'now-hiring',
			array( $this, 'options_page' )
		);

	} // add_menu()

	public function options_page() {

		?><h2>Now Hiring Settings</h2>
		<form method="post" action="options.php"><?php

		settings_fields( 'now_hiring_options' );

		do_settings_sections( 'now-hiring' );

		submit_button( 'Save Settings' );

		?></form><?php

	} // options_page()

	public function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback );

		register_setting(
			'now_hiring_options',
			'now_hiring_options',
			array( $this, 'validate_options' )
		);

		// add_settings_section( $id, $title, $callback, $menu_slug );

		add_settings_section(
			'now_hiring_display_options',
			'Display Options',
			array( $this, 'display_options_section' ),
			'now-hiring'
		);

		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

		add_settings_field(
			'display_salary',
			'Display Salary',
			array( $this, 'display_options_field' ),
			'now-hiring',
			'now_hiring_display_options'
		);

	} // register_settings()

	public function validate_options( $input ) {

		$display_salary 			= trim( $input['display_salary'] );
		$valid 						= array();
		$valid['display_salary'] 	= isset( $display_salary ) ? 1 : 0;

		if ( $valid['display_salary'] != $input['display_salary'] ) {

			add_settings_error( 'display_salary', 'display_salary_error', 'Display salary error.', 'error' );

		}

		return $valid;

	} // validate_options()

	public function display_options_section( $params ) {

		echo '<p>' . $params['title'] . '</p>';

	} // display_options_section()

	public function display_options_field() {

		$options = get_option( 'now_hiring_options' );

		?><input type="checkbox" id="now_hiring_options[display_salary]" name="now_hiring_options[display_salary]" value="1" <?php checked( 1, $options['display_salary'], false ); ?> /><?php

	} // display_options_field()

} // class