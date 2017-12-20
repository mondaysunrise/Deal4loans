<?php

/**
 * ColorMag Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
function colormag_customize_register($wp_customize) {

	// Theme important links started
	class COLORMAG_Important_Links extends WP_Customize_Control {

		public $type = "colormag-important-links";

		public function render_content() {
			//Add Theme instruction, Support Forum, Demo Link, Rating Link
			$important_links = array(
					'documentation' => array(
					'link' => esc_url('http://themegrill.com/theme-instruction/colormag-pro/'),
					'text' => __('Documentation', 'colormag'),
				),
					'support' => array(
					'link' => esc_url('http://themegrill.com/support-forum/'),
					'text' => __('Support', 'colormag'),
				),
					'demo' => array(
					'link' => esc_url('http://demo.themegrill.com/colormag-pro/'),
					'text' => __('View Demo', 'colormag'),
				),
					'rating' => array(
					'link' => esc_url('https://wordpress.org/support/view/theme-reviews/colormag'),
					'text' => __('Rate This Theme', 'colormag'),
				)
			);
			foreach ($important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
			}
		}

	}

	$wp_customize->add_section('colormag_important_links', array(
		'priority' => 700,
		'title' => __('ColorMag Theme Important Links', 'colormag'),
	));

	/**
	 * This setting has the dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting('colormag_important_links', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_links_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Important_Links($wp_customize, 'important_links', array(
		'label' => __('Important Links', 'colormag'),
		'section' => 'colormag_important_links',
		'settings' => 'colormag_important_links'
	)));
	// Theme Important Links Ended

	// Start of the Header Options
	$wp_customize->add_panel('colormag_header_options', array(
		'capabitity' => 'edit_theme_options',
		'description' => __('Change the Header Settings from here as you want', 'colormag'),
		'priority' => 500,
		'title' => __('Header Options', 'colormag')
	));

	// breaking news enable/disable
	$wp_customize->add_section('colormag_breaking_news_section', array(
		'title' => __('Breaking News', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_breaking_news', array(
		'priority' => 1,
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_breaking_news', array(
		'type' => 'checkbox',
		'label' => __('Check to enable the breaking news section', 'colormag'),
		'section' => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news'
	));

	$wp_customize->add_setting('colormag_breaking_news_content_option', array(
		'priority' => 3,
		'default' => __( 'Latest:', 'colormag' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	));

	$wp_customize->add_control('colormag_breaking_news_content_option', array(
		'label' => __('Enter the text to display for the ticker news', 'colormag'),
		'section' => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news_content_option',
	));

	$wp_customize->add_setting('colormag_breaking_news_setting_animation_options', array(
		'priority' => 2,
		'default' => 'down',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_breaking_news_setting_animation_options', array(
		'type' => 'select',
		'label' => __('Choose the animation style for the Breaking News in the Header', 'colormag'),
		'section' => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news_setting_animation_options',
		'choices' => array(
				'up' => __( 'Up', 'colormag' ),
				'down' => __( 'Down', 'colormag' )
			),
	));

	$wp_customize->add_setting('colormag_breaking_news_duration_setting_options', array(
		'priority' => 3,
		'default' => 4,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_breaking_news_duration_setting_options_sanitize'
	));

	$wp_customize->add_control('colormag_breaking_news_duration_setting_options', array(
		'label' => __('Enter the duration time for the Breaking News in the Header', 'colormag'),
		'section' => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news_duration_setting_options',
	));

	$wp_customize->add_setting('colormag_breaking_news_speed_setting_options', array(
		'priority' => 4,
		'default' => 1,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_breaking_news_speed_setting_options_sanitize'
	));

	$wp_customize->add_control('colormag_breaking_news_speed_setting_options', array(
		'label' => __('Enter the speed time for the Breaking News in the Header', 'colormag'),
		'section' => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news_speed_setting_options',
	));

	$wp_customize->add_setting('colormag_breaking_news_position_options', array(
		'priority' => 5,
		'default' => 'header',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_breaking_news_position_options', array(
		'type' => 'radio',
		'label' => __('Choose the location/area to place the Breaking News', 'colormag'),
		'section' => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news_position_options',
		'choices' => array(
				'header' => __( 'Header', 'colormag' ),
				'main' => __( 'Below Navigation', 'colormag' )
			),
	));

	// date display enable/disable
	$wp_customize->add_section('colormag_date_display_section', array(
		'title' => __('Show Date', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_date_display', array(
		'priority' => 2,
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_date_display', array(
		'type' => 'checkbox',
		'label' => __('Check to show the date in header', 'colormag'),
		'section' => 'colormag_date_display_section',
		'settings' => 'colormag_date_display'
	));

	// home icon enable/disable in primary menu
	$wp_customize->add_section('colormag_home_icon_display_section', array(
		'title' => __('Show Home Icon', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_home_icon_display', array(
		'priority' => 3,
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_home_icon_display', array(
		'type' => 'checkbox',
		'label' => __('Check to show the home icon in the primary menu', 'colormag'),
		'section' => 'colormag_home_icon_display_section',
		'settings' => 'colormag_home_icon_display'
	));

	// primary sticky menu enable/disable
	$wp_customize->add_section('colormag_primary_sticky_menu_section', array(
		'title' => __('Sticky Menu', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_primary_sticky_menu', array(
		'priority' => 4,
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_primary_sticky_menu', array(
		'type' => 'checkbox',
		'label' => __('Check to enable the sticky behavior of the primary menu', 'colormag'),
		'section' => 'colormag_primary_sticky_menu_section',
		'settings' => 'colormag_primary_sticky_menu'
	));

	// search icon in menu enable/disable
	$wp_customize->add_section('colormag_search_icon_in_menu_section', array(
		'title' => __('Search Icon', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_search_icon_in_menu', array(
		'priority' => 5,
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_search_icon_in_menu', array(
		'type' => 'checkbox',
		'label' => __('Check to display the Search Icon in the primary menu', 'colormag'),
		'section' => 'colormag_search_icon_in_menu_section',
		'settings' => 'colormag_search_icon_in_menu'
	));

	// random posts in menu enable/disable
	$wp_customize->add_section('colormag_random_post_in_menu_section', array(
		'title' => __('Random Post', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_random_post_in_menu', array(
		'priority' => 6,
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_random_post_in_menu', array(
		'type' => 'checkbox',
		'label' => __('Check to display the Random Post Icon in the primary menu', 'colormag'),
		'section' => 'colormag_random_post_in_menu_section',
		'settings' => 'colormag_random_post_in_menu'
	));

	// logo upload options
	$wp_customize->add_section('colormag_header_logo', array(
		'priority' => 1,
		'title' => __('Header Logo', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_logo', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'colormag_logo', array(
		'label' => __('Upload logo for your header', 'colormag'),
		'section' => 'colormag_header_logo',
		'setting' => 'colormag_logo'
	)));

	$wp_customize->add_setting('colormag_header_logo_placement', array(
		'default' => 'header_text_only',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_header_logo_placement', array(
		'type' => 'radio',
		'label' => __('Choose the option that you want', 'colormag'),
		'section' => 'colormag_header_logo',
		'choices' => array(
			'header_logo_only' => __('Header Logo Only', 'colormag'),
			'header_text_only' => __('Header Text Only', 'colormag'),
			'show_both' => __('Show Both', 'colormag'),
			'disable' => __('Disable', 'colormag')
		)
	));

	// header image position setting
	$wp_customize->add_section('colormag_header_image_position_setting', array(
		'priority' => 6,
		'title' => __('Header Image Position', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_header_image_position', array(
		'default' => 'position_two',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_header_image_position', array(
		'type' => 'radio',
		'label' => __('Header image display position', 'colormag'),
		'section' => 'colormag_header_image_position_setting',
		'choices' => array(
			'position_one' => __('Display the Header image just above the site title/text.', 'colormag'),
			'position_two' => __('Default: Display the Header image between site title/text and the main/primary menu.', 'colormag'),
			'position_three' => __('Display the Header image below main/primary menu.', 'colormag')
		)
	));

	$wp_customize->add_setting('colormag_header_image_link', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_header_image_link', array(
		'type' => 'checkbox',
		'label' => __('Check to make header image link back to home page', 'colormag'),
		'section' => 'colormag_header_image_position_setting'
	));

	// header display type
	$wp_customize->add_section('colormag_header_display_type_setting', array(
		'priority' => 3,
		'title' => __('Header Display Type', 'colormag'),
		'panel' => 'colormag_header_options'
	));

	$wp_customize->add_setting('colormag_header_display_type', array(
		'default' => 'type_one',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_header_display_type', array(
		'type' => 'radio',
		'label' => __('Choose the header display type that you want', 'colormag'),
		'section' => 'colormag_header_display_type_setting',
		'choices' => array(
			'type_one' => __('Type 1 (Default): Header text & logo on left, header sidebar on right', 'colormag'),
			'type_two' => __('Type 2: Header sidebar on left, header text & logo on right', 'colormag'),
			'type_three' => __('Type 3: Header text, header sidebar both aligned center', 'colormag')
		)
	));
	// end of header options

	// Start of the Design Options
	$wp_customize->add_panel('colormag_design_options', array(
		'capabitity' => 'edit_theme_options',
		'description' => __('Change the Design Settings from here as you want', 'colormag'),
		'priority' => 505,
		'title' => __('Design Options', 'colormag')
	));

	// FrontPage setting
	$wp_customize->add_section('colormag_front_page_setting', array(
		'priority' => 1,
		'title' => __('Front Page Settings', 'colormag'),
		'panel' => 'colormag_design_options'
	));
	$wp_customize->add_setting('colormag_hide_blog_front', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_hide_blog_front', array(
		'type' => 'checkbox',
		'label' => __('Check to hide blog posts/static page on front page', 'colormag'),
		'section' => 'colormag_front_page_setting'
	));

	// site layout setting
	$wp_customize->add_section('colormag_site_layout_setting', array(
		'priority' => 2,
		'title' => __('Site Layout', 'colormag'),
		'panel' => 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_site_layout', array(
		'default' => 'wide_layout',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_site_layout', array(
		'type' => 'radio',
		'label' => __('Choose your site layout. The change is reflected in whole site', 'colormag'),
		'choices' => array(
			'boxed_layout' => __('Boxed Layout', 'colormag'),
			'wide_layout' => __('Wide Layout', 'colormag')
		),
		'section' => 'colormag_site_layout_setting'
	));

	class COLORMAG_Image_Radio_Control extends WP_Customize_Control {

		public function render_content() {

			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<style>
				#colormag-img-container .colormag-radio-img-img {
					border: 3px solid #DEDEDE;
					margin: 0 5px 5px 0;
					cursor: pointer;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				#colormag-img-container .colormag-radio-img-selected {
					border: 3px solid #AAA;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				input[type=checkbox]:before {
					content: '';
					margin: -3px 0 0 -4px;
				}
			</style>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul class="controls" id = 'colormag-img-container'>
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ($this->value() == $value)?'colormag-radio-img-selected colormag-radio-img-img':'colormag-radio-img-img';
					?>
					<li style="display: inline;">
					<label>
						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
					</label>
					</li>
					<?php
				endforeach;
			?>
			</ul>
			<script type="text/javascript">

				jQuery(document).ready(function($) {
					$('.controls#colormag-img-container li img').click(function(){
						$('.controls#colormag-img-container li').each(function(){
							$(this).find('img').removeClass ('colormag-radio-img-selected') ;
						});
						$(this).addClass ('colormag-radio-img-selected') ;
					});
				});

			</script>
			<?php
		}
	}

	// default layout setting
	$wp_customize->add_section('colormag_default_layout_setting', array(
		'priority' => 3,
		'title' => __('Default layout', 'colormag'),
		'panel'=> 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_default_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Image_Radio_Control($wp_customize, 'colormag_default_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout. This layout will be reflected in whole site archives, categories, search page etc. The layout for a single post and page can be controlled from below options', 'colormag'),
		'section' => 'colormag_default_layout_setting',
		'settings' => 'colormag_default_layout',
		'choices' => array(
			'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
		)
	)));

	// default layout for pages
	$wp_customize->add_section('colormag_default_page_layout_setting', array(
		'priority' => 4,
		'title' => __('Default layout for pages only', 'colormag'),
		'panel'=> 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_default_page_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Image_Radio_Control($wp_customize, 'colormag_default_page_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page', 'colormag'),
		'section' => 'colormag_default_page_layout_setting',
		'settings' => 'colormag_default_page_layout',
		'choices' => array(
			'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
		)
	)));

	// default layout for single posts
	$wp_customize->add_section('colormag_default_single_posts_layout_setting', array(
		'priority' => 5,
		'title' => __('Default layout for single posts only', 'colormag'),
		'panel'=> 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_default_single_posts_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Image_Radio_Control($wp_customize, 'colormag_default_single_posts_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post', 'colormag'),
		'section' => 'colormag_default_single_posts_layout_setting',
		'settings' => 'colormag_default_single_posts_layout',
		'choices' => array(
			'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
		)
	)));

	// category/archive pages layout setting
	$wp_customize->add_section('colormag_archive_search_layout_setting', array(
		'priority' => 6,
		'title' => __('Blog/Archive and Search Pages Layout', 'colormag'),
		'panel' => 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_archive_search_layout', array(
		'default' => 'double_column_layout',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_archive_search_layout', array(
		'type' => 'radio',
		'label' => __('Choose the layout option for the blog, archive and search results pages.', 'colormag'),
		'choices' => array(
			'double_column_layout' => __('Default (First image large and other two side by side)', 'colormag'),
			'single_column_layout' => __('One Coulmn (Featured image on left and post excerpt on right)', 'colormag')
		),
		'section' => 'colormag_archive_search_layout_setting'
	));

	// primary color options
	$wp_customize->add_section('colormag_primary_color_setting', array(
		'panel' => 'colormag_design_options',
		'priority' => 7,
		'title' => __('Primary color option', 'colormag')
	));

	$wp_customize->add_setting('colormag_primary_color', array(
		'default' => '#289dcc',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_color_option_hex_sanitize',
		'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'colormag_primary_color', array(
		'label' => __('This will reflect in links, buttons and many others. Choose a color to match your site', 'colormag'),
		'section' => 'colormag_primary_color_setting',
		'settings' => 'colormag_primary_color'
	)));

	// custom CSS setting
	class COLORMAG_Custom_CSS_Control extends WP_Customize_Control {

		public $type = 'custom_css';

		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}

	}

	$wp_customize->add_section('colormag_custom_css_setting', array(
		'priority' => 9,
		'title' => __('Custom CSS', 'colormag'),
		'panel' => 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_custom_css', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
	));

	$wp_customize->add_control(new COLORMAG_Custom_CSS_Control($wp_customize, 'colormag_custom_css', array(
		'label' => __('Write your custom css', 'colormag'),
		'section' => 'colormag_custom_css_setting',
		'settings' => 'colormag_custom_css'
	)));
	// End of the Design Options

	// Start of the Social Link Options
	$wp_customize->add_panel('colormag_social_links_options', array(
		'priority' => 510,
		'title' => __('Social Options', 'colormag'),
		'description'=> __('Change the Social Links Settings from here as you want', 'colormag'),
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_section('colormag_social_link_activate_settings', array(
		'priority' => 1,
		'title' => __('Activate social links area', 'colormag'),
		'panel' => 'colormag_social_links_options'
	));

	$wp_customize->add_setting('colormag_social_link_activate', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_social_link_activate', array(
		'type' => 'checkbox',
		'label' => __('Check to activate social links area', 'colormag'),
		'section' => 'colormag_social_link_activate_settings',
		'settings' => 'colormag_social_link_activate'
	));

	$colormag_social_links = array(
		'colormag_social_facebook' => array(
			'id' => 'colormag_social_facebook',
			'title' => __('Facebook', 'colormag'),
			'default' => ''
		),
		'colormag_social_twitter' => array(
			'id' => 'colormag_social_twitter',
			'title' => __('Twitter', 'colormag'),
			'default' => ''
		),
		'colormag_social_googleplus' => array(
			'id' => 'colormag_social_googleplus',
			'title' => __('Google-Plus', 'colormag'),
			'default' => ''
		),
		'colormag_social_instagram' => array(
			'id' => 'colormag_social_instagram',
			'title' => __('Instagram', 'colormag'),
			'default' => ''
		),
		'colormag_social_pinterest' => array(
			'id' => 'colormag_social_pinterest',
			'title' => __('Pinterest', 'colormag'),
			'default' => ''
		),
		'colormag_social_youtube' => array(
			'id' => 'colormag_social_youtube',
			'title' => __('YouTube', 'colormag'),
			'default' => ''
		),
		'colormag_social_vimeo' => array(
			'id' => 'colormag_social_vimeo',
			'title' => __('Vimeo-Square', 'colormag'),
			'default' => ''
		),
		'colormag_social_linkedin' => array(
			'id' => 'colormag_social_linkedin',
			'title' => __('LinkedIn', 'colormag'),
			'default' => ''
		),
		'colormag_social_delicious' => array(
			'id' => 'colormag_social_delicious',
			'title' => __('Delicious', 'colormag'),
			'default' => ''
		),
		'colormag_social_flickr' => array(
			'id' => 'colormag_social_flickr',
			'title' => __('Flickr', 'colormag'),
			'default' => ''
		),
		'colormag_social_skype' => array(
			'id' => 'colormag_social_skype',
			'title' => __('Skype', 'colormag'),
			'default' => ''
		),
		'colormag_social_soundcloud' => array(
			'id' => 'colormag_social_soundcloud',
			'title' => __('SoundCloud', 'colormag'),
			'default' => ''
		),
		'colormag_social_vine' => array(
			'id' => 'colormag_social_vine',
			'title' => __('Vine', 'colormag'),
			'default' => ''
		),
		'colormag_social_stumbleupon' => array(
			'id' => 'colormag_social_stumbleupon',
			'title' => __('StumbleUpon', 'colormag'),
			'default' => ''
		),
		'colormag_social_tumblr' => array(
			'id' => 'colormag_social_tumblr',
			'title' => __('Tumblr', 'colormag'),
			'default' => ''
		),
		'colormag_social_reddit' => array(
			'id' => 'colormag_social_reddit',
			'title' => __('Reddit', 'colormag'),
			'default' => ''
		),
		'colormag_social_xing' => array(
			'id' => 'colormag_social_xing',
			'title' => __('Xing', 'colormag'),
			'default' => ''
		),
		'colormag_social_vk' => array(
			'id' => 'colormag_social_vk',
			'title' => __('VK', 'colormag'),
			'default' => ''
		),
	);

	$i = 20;

	foreach($colormag_social_links as $colormag_social_link) {

		$wp_customize->add_setting($colormag_social_link['id'], array(
			'default' => $colormag_social_link['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control($colormag_social_link['id'], array(
			'label' => $colormag_social_link['title'],
			'section'=> 'colormag_social_link_activate_settings',
			'settings'=> $colormag_social_link['id'],
			'priority' => $i
		));

		$wp_customize->add_setting($colormag_social_link['id'].'_checkbox', array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_checkbox_sanitize'
		));

		$wp_customize->add_control($colormag_social_link['id'].'_checkbox', array(
			'type' => 'checkbox',
			'label' => __('Check to show in new tab', 'colormag'),
			'section'=> 'colormag_social_link_activate_settings',
			'settings'=> $colormag_social_link['id'].'_checkbox',
			'priority' => $i
		));

		$i++;

	}

	$user_custom_social_links = array(
		'user_custom_social_links_one' => array(
			'id' => 'user_custom_social_links_one',
			'title' => __('Additional Social Link One', 'colormag'),
			'default' => ''
		),
		'user_custom_social_links_two' => array(
			'id' => 'user_custom_social_links_two',
			'title' => __('Additional Social Link Two', 'colormag'),
			'default' => ''
		),
		'user_custom_social_links_three' => array(
			'id' => 'user_custom_social_links_three',
			'title' => __('Additional Social Link Three', 'colormag'),
			'default' => ''
		),
		'user_custom_social_links_four' => array(
			'id' => 'user_custom_social_links_four',
			'title' => __('Additional Social Link Four', 'colormag'),
			'default' => ''
		),
		'user_custom_social_links_five' => array(
			'id' => 'user_custom_social_links_five',
			'title' => __('Additional Social Link Five', 'colormag'),
			'default' => ''
		),
		'user_custom_social_links_six' => array(
			'id' => 'user_custom_social_links_six',
			'title' => __('Additional Social Link Six', 'colormag'),
			'default' => ''
		),
	);

	$wp_customize->add_section('colormag_additional_social_icons', array(
		'priority' => 2,
		'title' => __('Additional Social Icons', 'colormag'),
		'panel' => 'colormag_social_links_options'
	));

	$i = 20;

	foreach($user_custom_social_links as $user_custom_social_link) {
		$wp_customize->add_setting($user_custom_social_link['id'], array(
			'default' => $user_custom_social_link['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control($user_custom_social_link['id'], array(
			'label' => $user_custom_social_link['title'],
			'section'=> 'colormag_additional_social_icons',
			'settings'=> $user_custom_social_link['id'],
			'priority' => $i
		));

		$wp_customize->add_setting($user_custom_social_link['id'].'_fontawesome', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		));

		$wp_customize->add_control($user_custom_social_link['id'].'_fontawesome', array(
			'label' => __('Preferred Social Link FontAwesome Icon', 'colormag'),
			'section'=> 'colormag_additional_social_icons',
			'settings'=> $user_custom_social_link['id'].'_fontawesome',
			'priority' => $i
		));

		$wp_customize->add_setting($user_custom_social_link['id'].'_color', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
		));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $user_custom_social_link['id'].'_color', array(
			'label' => __('Preferred Social Link Color Option', 'colormag'),
			'section'=> 'colormag_additional_social_icons',
			'settings'=> $user_custom_social_link['id'].'_color',
			'priority' => $i
		)));

		$wp_customize->add_setting($user_custom_social_link['id'].'_checkbox', array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_checkbox_sanitize'
		));

		$wp_customize->add_control($user_custom_social_link['id'].'_checkbox', array(
			'type' => 'checkbox',
			'label' => __('Check to show in new tab', 'colormag'),
			'section'=> 'colormag_additional_social_icons',
			'settings'=> $user_custom_social_link['id'].'_checkbox',
			'priority' => $i
		));

		$i++;
	}
	// End of the Social Link Options

	// Start of the Additional Options
	$wp_customize->add_panel('colormag_additional_options', array(
		'capability' => 'edit_theme_options',
		'description'=> __('Change the Additional Settings from here as you want', 'colormag'),
		'priority' => 515,
		'title' => __('Additional Options', 'colormag')
	));

	// unque post system options
	$wp_customize->add_section('colormag_unique_post_system_setting', array(
		'priority' => 1,
		'title' => __('Unique Post System', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_unique_post_system', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_unique_post_system', array(
		'type' => 'checkbox',
		'label' => __('Check to activate the unique post system for the bundled widgets', 'colormag'),
		'section' => 'colormag_unique_post_system_setting',
		'settings' => 'colormag_unique_post_system'
	));

	// favicon options
	$wp_customize->add_section('colormag_favicon_show_setting', array(
		'priority' => 1,
		'title' => __('Activate favicon', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_favicon_show', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_favicon_show', array(
		'type' => 'checkbox',
		'label' => __('Check to activate favicon. Upload favicon from below option', 'colormag'),
		'section' => 'colormag_favicon_show_setting',
		'settings' => 'colormag_favicon_show'
	));

	$wp_customize->add_setting('colormag_favicon_upload', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'colormag_favicon_upload', array(
		'label' => __('Upload favicon for your site', 'colormag'),
		'section' => 'colormag_favicon_show_setting',
		'settings' => 'colormag_favicon_upload'
	)));

	// related posts
	$wp_customize->add_section('colormag_related_posts_section', array(
		'priority' => 4,
		'title' => __('Related Posts', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_related_posts_activate', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_related_posts_activate', array(
		'type' => 'checkbox',
		'label' => __('Check to activate the related posts', 'colormag'),
		'section' => 'colormag_related_posts_section',
		'settings' => 'colormag_related_posts_activate'
	));

	$wp_customize->add_setting('colormag_related_posts', array(
		'default' => 'categories',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_related_posts', array(
		'type' => 'radio',
		'label' => __('Related Posts Must Be Shown As:', 'colormag'),
		'section' => 'colormag_related_posts_section',
		'settings' => 'colormag_related_posts',
		'choices' => array(
			'categories' => __('Related Posts By Categories', 'colormag'),
			'tags' => __('Related Posts By Tags', 'colormag')
		)
	));

	// entry meta remove
	$wp_customize->add_section('colormag_entry_meta_section', array(
		'priority' => 4,
		'title' => esc_html__('Post Meta Display', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	// total entry meta remove
	$wp_customize->add_setting('colormag_all_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_all_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the post meta for the post totally, ie, remove all of the meta data.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_all_entry_meta_remove'
	));

	// author entry meta remove
	$wp_customize->add_setting('colormag_author_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_author_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the author only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_author_entry_meta_remove'
	));

	// date entry meta remove
	$wp_customize->add_setting('colormag_date_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_date_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the date only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_date_entry_meta_remove'
	));

	// category entry meta remove
	$wp_customize->add_setting('colormag_category_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_category_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the category only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_category_entry_meta_remove'
	));

	// comments entry meta remove
	$wp_customize->add_setting('colormag_comments_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_comments_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the comments only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_comments_entry_meta_remove'
	));

	// tags entry meta remove
	$wp_customize->add_setting('colormag_tags_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_tags_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the tags only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_tags_entry_meta_remove'
	));

	// post view entry meta remove
	$wp_customize->add_setting('colormag_post_view_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_post_view_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the post view only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_post_view_entry_meta_remove'
	));

	// edit button entry meta remove
	$wp_customize->add_setting('colormag_edit_button_entry_meta_remove', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_edit_button_entry_meta_remove', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable the edit button only in post meta section.', 'colormag'),
		'section' => 'colormag_entry_meta_section',
		'settings' => 'colormag_edit_button_entry_meta_remove'
	));

	// read more button text
	$wp_customize->add_section('colormag_read_more_text_section', array(
		'priority' => 5,
		'title' => __('Change Read More Text', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_read_more_text', array(
		'default' => __('Read more', 'colormag'),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	));

	$wp_customize->add_control('colormag_read_more_text', array(
		'label' => __('Change the Read more text as required for your site.', 'colormag'),
		'section' => 'colormag_read_more_text_section',
		'settings' => 'colormag_read_more_text'
	));

	// social share buttons
	$wp_customize->add_section('colormag_social_share_section', array(
		'priority' => 5,
		'title' => __('Social Share Button', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_social_share', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_social_share', array(
		'type' => 'checkbox',
		'label' => __('Check to activate social share buttons in single post', 'colormag'),
		'section' => 'colormag_social_share_section',
		'settings' => 'colormag_social_share'
	));

	// featured image popup check
	$wp_customize->add_section('colormag_featured_image_popup_setting', array(
		'priority' => 6,
		'title' => __('Image Lightbox', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_featured_image_popup', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_featured_image_popup', array(
		'type' => 'checkbox',
		'label' => __('Check to enable the lightbox for the featured images in single post', 'colormag'),
		'section' => 'colormag_featured_image_popup_setting',
		'settings' => 'colormag_featured_image_popup'
	));

	// Author Bio Social Profile Display Setting
	$wp_customize->add_section('colormag_author_bio_social_sites_show_setting', array(
		'priority' => 6,
		'title' => __('Social Profiles in Author Bio', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_author_bio_social_sites_show', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_author_bio_social_sites_show', array(
		'type' => 'checkbox',
		'label' => __('Check to show the Social Profiles in the Author Bio', 'colormag'),
		'section' => 'colormag_author_bio_social_sites_show_setting',
		'settings' => 'colormag_author_bio_social_sites_show'
	));

	// Author Bio url for pages in author bio section
	$wp_customize->add_section('colormag_author_bio_links_setting', array(
		'priority' => 6,
		'title' => __('Author URL In Author Bio', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_author_bio_links', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_author_bio_links', array(
		'type' => 'checkbox',
		'label' => __('Check to display the link to the author page in the Author Bio section', 'colormag'),
		'section' => 'colormag_author_bio_links_setting',
		'settings' => 'colormag_author_bio_links'
	));

	// Scroll to top button enable/disable option
	$wp_customize->add_section('colormag_scroll_to_top_setting', array(
		'priority' => 6,
		'title' => __('Scroll To Top Button', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$wp_customize->add_setting('colormag_scroll_to_top', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_scroll_to_top', array(
		'type' => 'checkbox',
		'label' => __('Check to disable the scroll to top button.', 'colormag'),
		'section' => 'colormag_scroll_to_top_setting',
		'settings' => 'colormag_scroll_to_top'
	));

	// footer editor section
	class COLORMAG_Footer_Control extends WP_Customize_Control {

		public $type = 'footer_control';

		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}

	}

	$wp_customize->add_section('colormag_footer_editor_setting', array(
		'priority' => 7,
		'title' => __('Footer Copyright Editor', 'colormag'),
		'panel' => 'colormag_additional_options'
	));

	$default_footer_value = __( 'Copyright &copy; ', 'colormag' ).' '.'[the-year] [site-link]. All rights reserved. '.'<br>'.__( 'Theme: ColorMag Pro by ', 'colormag' ).' '.'[tg-link]. '.__( 'Powered by ', 'colormag' ).' '.'[wp-link].';

	$wp_customize->add_setting('colormag_footer_editor', array(
		'default' => $default_footer_value,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_footer_editor_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Footer_Control($wp_customize, 'colormag_footer_editor', array(
		'label' => __('Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'colormag'),
		'section' => 'colormag_footer_editor_setting',
		'settings'=> 'colormag_footer_editor'
	)));
	// End of the Additional Options

	// Category Color Options
	$wp_customize->add_panel('colormag_category_color_panel', array(
		'priority' => 535,
		'title' => __('Category Color Options', 'colormag'),
		'capability' => 'edit_theme_options',
		'description' => __('Change the color of each category items as you want.', 'colormag')
	));

	$wp_customize->add_section('colormag_category_color_setting', array(
		'priority' => 1,
		'title' => __('Category Color Settings', 'colormag'),
		'panel' => 'colormag_category_color_panel'
	));

	$i = 1;
	$args = array(
		 'orderby' => 'id',
		 'hide_empty' => 0
	);
	$categories = get_categories( $args );
	$wp_category_list = array();
	foreach ($categories as $category_list ) {
		$wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

		$wp_customize->add_setting('colormag_category_color_'.get_cat_id($wp_category_list[$category_list->cat_ID]), array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
		));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'colormag_category_color_'.get_cat_id($wp_category_list[$category_list->cat_ID]), array(
			'label' => sprintf(__('%s', 'colormag'), $wp_category_list[$category_list->cat_ID] ),
			'section' => 'colormag_category_color_setting',
			'settings' => 'colormag_category_color_'.get_cat_id($wp_category_list[$category_list->cat_ID]),
			'priority' => $i
		)));
		$i++;
	}

	// Start of the Typography Option
	$wp_customize->add_panel('colormag_typography_options', array(
		'priority' => 525,
		'title' => __('Typography Options', 'colormag'),
		'description' => __('Change the Typography Settings from here as you want', 'colormag'),
		'capability' => 'edit_theme_options'
	));

	// google font options
	$wp_customize->add_section('colormag_google_fonts_settings', array(
		'priority' => 1,
		'title' => __('Google Font Options', 'colormag'),
		'panel' => 'colormag_typography_options'
	));

	$colormag_fonts = array(
		'colormag_site_title_font' => array(
			'id' => 'colormag_site_title_font',
			'default' => 'Open Sans',
			'title'=> __('Site title font. Default is "Open Sans"', 'colormag')
		),
		'colormag_site_tagline_font' => array(
			'id' => 'colormag_site_tagline_font',
			'default' => 'Open Sans',
			'title'=> __('Site tagline font. Default is "Open Sans"', 'colormag')
		),
		'colormag_primary_menu_font' => array(
			'id' => 'colormag_primary_menu_font',
			'default' => 'Open Sans',
			'title'=> __('Primary menu font. Default is "Open Sans"', 'colormag')
		),
		'colormag_all_titles_font' => array(
			'id' => 'colormag_all_titles_font',
			'default' => 'Open Sans',
			'title'=> __('All Titles font. Default is "Open Sans"', 'colormag')
		),
		'colormag_content_font' => array(
			'id' => 'colormag_content_font',
			'default' => 'Open Sans',
			'title'=> __('Content font and for others. Default is "Open Sans"', 'colormag')
		)
	);

	foreach ($colormag_fonts as $colormag_font) {

		$wp_customize->add_setting(
			$colormag_font['id'], array(
				'default' => $colormag_font['default'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'colormag_fonts_sanitization'
			)
		);

		global $colormag_google_font;

		$wp_customize->add_control(
			$colormag_font['id'], array(
				'label' => $colormag_font['title'],
				'type' => 'select',
				'settings' => $colormag_font['id'],
				'section' => 'colormag_google_fonts_settings',
				'choices' => $colormag_google_font
			)
		);

	}

	// header font size option
	$wp_customize->add_section('colormag_header_font_size_setting', array(
		'priority' => 2,
		'title' => __('Header font size Options', 'colormag'),
		'panel' => 'colormag_typography_options'
	));

	$wp_customize->add_setting('colormag_title_font_size', array(
		'priority' => 1,
		'default' => '46',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_title_font_size', array(
		'type' => 'select',
		'label' => __('Site title font size. Default is 46px', 'colormag'),
		'section' => 'colormag_header_font_size_setting',
		'settings' => 'colormag_title_font_size',
		'choices' => colormag_font_size_range_generator( 30, 90 )
	));

	$wp_customize->add_setting('colormag_tagline_font_size', array(
		'priority' => 2,
		'default' => '16',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_tagline_font_size', array(
		'type' => 'select',
		'label' => __('Site tagline font size. Default is 16px', 'colormag'),
		'section' => 'colormag_header_font_size_setting',
		'settings' => 'colormag_tagline_font_size',
		'choices' => colormag_font_size_range_generator( 10, 40 )
	));

	$wp_customize->add_setting('colormag_primary_menu_font_size', array(
		'priority' => 3,
		'default' => '14',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_primary_menu_font_size', array(
		'type' => 'select',
		'label' => __('Primary menu. Default is 14px', 'colormag'),
		'section' => 'colormag_header_font_size_setting',
		'settings' => 'colormag_primary_menu_font_size',
		'choices' => colormag_font_size_range_generator( 12, 30 )
	));

	$wp_customize->add_setting('colormag_primary_sub_menu_font_size', array(
		'priority' => 4,
		'default' => '14',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_primary_sub_menu_font_size', array(
		'type' => 'select',
		'label' => __('Primary sub menu. Default is 14px', 'colormag'),
		'section' => 'colormag_header_font_size_setting',
		'settings' => 'colormag_primary_sub_menu_font_size',
		'choices' => colormag_font_size_range_generator( 12, 30 )
	));

	// titles related font size option
	$wp_customize->add_section('colormag_titles_related_font_size_setting', array(
		'priority' => 5,
		'title' => __('Titles related font size options', 'colormag'),
		'panel' => 'colormag_typography_options'
	));

	$wp_customize->add_setting('colormag_heading_h1_font_size', array(
		'priority' => 1,
		'capability' => 'edit_theme_options',
		'default' => '42',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_heading_h1_font_size', array(
		'type' => 'select',
		'label' => __('Heading h1 tag. Default is 42px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_heading_h1_font_size',
		'choices' => colormag_font_size_range_generator( 34, 60 )
	));

	$wp_customize->add_setting('colormag_heading_h2_font_size', array(
		'priority' => 2,
		'capability' => 'edit_theme_options',
		'default' => '38',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_heading_h2_font_size', array(
		'type' => 'select',
		'label' => __('Heading h2 tag. Default is 38px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_heading_h2_font_size',
		'choices' => colormag_font_size_range_generator( 30, 56 )
	));

	$wp_customize->add_setting('colormag_heading_h3_font_size', array(
		'priority' => 3,
		'capability' => 'edit_theme_options',
		'default' => '34',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_heading_h3_font_size', array(
		'type' => 'select',
		'label' => __('Heading h3 tag. Default is 34px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_heading_h3_font_size',
		'choices' => colormag_font_size_range_generator( 26, 52 )
	));

	$wp_customize->add_setting('colormag_heading_h4_font_size', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'default' => '30',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_heading_h4_font_size', array(
		'type' => 'select',
		'label' => __('Heading h4 tag. Default is 30px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_heading_h4_font_size',
		'choices' => colormag_font_size_range_generator( 22, 48 )
	));

	$wp_customize->add_setting('colormag_heading_h5_font_size', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'default' => '26',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_heading_h5_font_size', array(
		'type' => 'select',
		'label' => __('Heading h5 tag. Default is 26px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_heading_h5_font_size',
		'choices' => colormag_font_size_range_generator( 18, 44 )
	));

	$wp_customize->add_setting('colormag_heading_h6_font_size', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'default' => '22',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_heading_h6_font_size', array(
		'type' => 'select',
		'label' => __('Heading h6 tag. Default is 22px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_heading_h6_font_size',
		'choices' => colormag_font_size_range_generator( 14, 40 )
	));

	$wp_customize->add_setting('colormag_post_title_font_size', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'default' => '32',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_post_title_font_size', array(
		'type' => 'select',
		'label' => __('Post Title. Default is 32px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_post_title_font_size',
		'choices' => colormag_font_size_range_generator( 22, 52 )
	));

	$wp_customize->add_setting('colormag_page_title_font_size', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'default' => '34',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_page_title_font_size', array(
		'type' => 'select',
		'label' => __('Page Title. Default is 34px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_page_title_font_size',
		'choices' => colormag_font_size_range_generator( 22, 52 )
	));

	$wp_customize->add_setting('colormag_widget_title_font_size', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'default' => '18',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_widget_title_font_size', array(
		'type' => 'select',
		'label' => __('Widget Title. Default is 18px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_widget_title_font_size',
		'choices' => colormag_font_size_range_generator( 18, 44 )
	));

	$wp_customize->add_setting('colormag_comment_title_font_size', array(
		'priority' => 11,
		'capability' => 'edit_theme_options',
		'default' => '22',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_comment_title_font_size', array(
		'type' => 'select',
		'label' => __('Comment Title. Default is 22px', 'colormag'),
		'section' => 'colormag_titles_related_font_size_setting',
		'settings' => 'colormag_comment_title_font_size',
		'choices' => colormag_font_size_range_generator( 12, 42 )
	));

	// content font size options
	$wp_customize->add_section('colormag_content_font_size_setting', array(
		'priority' => 6,
		'title' => __('Content font size options', 'colormag'),
		'panel' => 'colormag_typography_options'
	));

	$wp_customize->add_setting('colormag_content_font_size', array(
		'priority' => 1,
		'capability' => 'edit_theme_options',
		'default' => '18',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_content_font_size', array(
		'type' => 'select',
		'label' => __('Content font size, also applies to other text like in search fields, post comment button etc. Default is 18px', 'colormag'),
		'section' => 'colormag_content_font_size_setting',
		'settings' => 'colormag_content_font_size',
		'choices' => colormag_font_size_range_generator( 10, 36 )
	));

	$wp_customize->add_setting('colormag_post_meta_font_size', array(
		'priority' => 2,
		'capability' => 'edit_theme_options',
		'default' => '12',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_post_meta_font_size', array(
		'type' => 'select',
		'label' => __('Post meta font size. Default is 12px', 'colormag'),
		'section' => 'colormag_content_font_size_setting',
		'settings' => 'colormag_post_meta_font_size',
		'choices' => colormag_font_size_range_generator( 10, 36 )
	));

	$wp_customize->add_setting('colormag_button_text_font_size', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'default' => '12',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_button_text_font_size', array(
		'type' => 'select',
		'label' => __('Button text font size (Buttons like Read more, submit, post comment etc). Default is 12px', 'colormag'),
		'section' => 'colormag_content_font_size_setting',
		'settings' => 'colormag_button_text_font_size',
		'choices' => colormag_font_size_range_generator( 10, 28 )
	));

	// footer font size option
	$wp_customize->add_section('colormag_footer_font_size_setting', array(
		'priority' => 7,
		'title' => __('Footer font size options', 'colormag'),
		'panel' => 'colormag_typography_options'
	));

	$wp_customize->add_setting('colormag_footer_widget_title_font_size', array(
		'priority' => 1,
		'capability' => 'edit_theme_options',
		'default' => '15',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_footer_widget_title_font_size', array(
		'type' => 'select',
		'label' => __('Footer widget Titles. Default is 15px', 'colormag'),
		'section' => 'colormag_footer_font_size_setting',
		'settings' => 'colormag_footer_widget_title_font_size',
		'choices' => colormag_font_size_range_generator( 12, 46 )
	));

	$wp_customize->add_setting('colormag_footer_widget_content_font_size', array(
		'priority' => 2,
		'capability' => 'edit_theme_options',
		'default' => '14',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_footer_widget_content_font_size', array(
		'type' => 'select',
		'label' => __('Footer widget content font size. Default is 14px', 'colormag'),
		'section' => 'colormag_footer_font_size_setting',
		'settings' => 'colormag_footer_widget_content_font_size',
		'choices' => colormag_font_size_range_generator( 10, 30 )
	));

	$wp_customize->add_setting('colormag_footer_copyright_text_font_size', array(
		'priority' => 3,
		'capability' => 'edit_theme_options',
		'default' => '14',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_footer_copyright_text_font_size', array(
		'type' => 'select',
		'label' => __('Footer copyright text font size. Default is 14px', 'colormag'),
		'section' => 'colormag_footer_font_size_setting',
		'settings' => 'colormag_footer_copyright_text_font_size',
		'choices' => colormag_font_size_range_generator( 10, 24 )
	));

	$wp_customize->add_setting('colormag_footer_small_menu_font_size', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'default' => '14',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_footer_small_menu_font_size', array(
		'type' => 'select',
		'label' => __('Footer small menu. Default is 14px', 'colormag'),
		'section' => 'colormag_footer_font_size_setting',
		'settings' => 'colormag_footer_small_menu_font_size',
		'choices' => colormag_font_size_range_generator( 10, 24 )
	));
	// End of the Typography Option

	// Start of the Color Options
	$wp_customize->add_panel('colormag_color_options', array(
		'priority' => 530,
		'title' => __('Color Options', 'colormag'),
		'capabitity' => 'edit_theme_options',
		'description' => __('Change the Color Settings from here as you want', 'colormag'),
	));

	// header color options
	$wp_customize->add_section('colormag_header_color_settings', array(
		'priority' => 1,
		'title' => __('Header Color Options', 'colormag'),
		'panel' => 'colormag_color_options'
	));

	$colormag_header_color_options = array(
		'colormag_site_title_color' => array(
			'id' => 'colormag_site_title_color',
			'title' => __('Site Title.', 'colormag'),
			'default' => '#289dcc'
		),
		'colormag_site_tagline_color' => array(
			'id' => 'colormag_site_tagline_color',
			'title' => __('Site Tagline.', 'colormag'),
			'default' => '#666666'
		),
		'colormag_primary_menu_text_color' => array(
			'id' => 'colormag_primary_menu_text_color',
			'title' => __('Primary menu text color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_primary_menu_selected_hovered_text_color' => array(
			'id' => 'colormag_primary_menu_selected_hovered_text_color',
			'title' => __('Primary menu selected/hovered item color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_header_background_color' => array(
			'id' => 'colormag_header_background_color',
			'title' => __('Header background color.', 'colormag'),
			'default' => '#ffffff'
		)
	);

	$i = 1;

	foreach ($colormag_header_color_options as $colormag_header_color_option) {
		$wp_customize->add_setting($colormag_header_color_option['id'], array(
			'default' => $colormag_header_color_option['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
		));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $colormag_header_color_option['id'], array(
			'label' => $colormag_header_color_option['title'],
			'section' => 'colormag_header_color_settings',
			'settings' => $colormag_header_color_option['id'],
			'priority' => $i
		)));

		$i++;
	}

	// content part color option
	$wp_customize->add_section('colormag_content_part_color_setting', array(
		'priority' => 2,
		'title' => __('Content part color options', 'colormag'),
		'panel' => 'colormag_color_options'
	));

	$colormag_content_part_color_options = array(
		'colormag_content_part_title_color' => array(
			'id' => 'colormag_content_part_title_color',
			'title' => __('Content Part titles color (like h1, h2 in content section).', 'colormag'),
			'default' => '#333333'
		),
		'colormag_post_title_color' => array(
			'id' => 'colormag_post_title_color',
			'title' => __('Posts title color.', 'colormag'),
			'default' => '#333333'
		),
		'colormag_page_title_color' => array(
			'id' => 'colormag_page_title_color',
			'title' => __('Page title color.', 'colormag'),
			'default' => '#333333'
		),
		'colormag_content_text_color' => array(
			'id'=> 'colormag_content_text_color',
			'title' => __('Content text color.', 'colormag'),
			'default' => '#444444'
		),
		'colormag_post_meta_color' => array(
			'id' => 'colormag_post_meta_color',
			'title' => __('Post meta color.', 'colormag'),
			'default' => '#888888'
		),
		'colormag_button_text_color' => array(
			'id' => 'colormag_button_text_color',
			'title' => __('Button text color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_button_background_color' => array(
			'id' => 'colormag_button_background_color',
			'title' => __('Button background color.', 'colormag'),
			'default' => '#d40234'
		),
		'colormag_sidebar_widget_title_color' => array(
			'id' => 'colormag_sidebar_widget_title_color',
			'title' => __('Sidebar widget title color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_content_section_background_color' => array(
			'id' => 'colormag_content_section_background_color',
			'title' => __('Content section background color.', 'colormag'),
			'default' => '#ffffff'
		)
	);

	$i = 1;

	foreach ($colormag_content_part_color_options as $colormag_content_part_color_option) {
		$wp_customize->add_setting($colormag_content_part_color_option['id'], array(
			'default' => $colormag_content_part_color_option['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
		));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $colormag_content_part_color_option['id'], array(
			'label' => $colormag_content_part_color_option['title'],
			'section' => 'colormag_content_part_color_setting',
			'settings' => $colormag_content_part_color_option['id'],
			'priority' => $i
		)));

		$i++;
	}

	// footer part color options
	$wp_customize->add_section('colormag_footer_part_color_setting', array(
		'priority' => 4,
		'title' => __('Footer part color options', 'colormag'),
		'panel' => 'colormag_color_options'
	));

	$colormag_footer_part_color_options = array(
		'colormag_footer_widget_title_color' => array(
			'id' => 'colormag_footer_widget_title_color',
			'title' => __('Widget title color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_footer_widget_content_color' => array(
			'id' => 'colormag_footer_widget_content_color',
			'title' => __('Footer widget content color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_footer_widget_content_link_text_color' => array(
			'id' => 'colormag_footer_widget_content_link_text_color',
			'title' => __('Footer widget content link text color.', 'colormag'),
			'default' => '#ffffff'
		),
		'colormag_footer_widget_background_color' => array(
			'id' => 'colormag_footer_widget_background_color',
			'title' => __('Footer widget background color.', 'colormag'),
			'default' => ''
		),
		'colormag_footer_copyright_text_color' => array(
			'id' => 'colormag_footer_copyright_text_color',
			'title' => __('Footer copyright text color.', 'colormag'),
			'default' => '#b1b6b6'
		),
		'colormag_footer_copyright_link_text_color' => array(
			'id' => 'colormag_footer_copyright_link_text_color',
			'title' => __('Footer copyright link text color.', 'colormag'),
			'default' => '#b1b6b6'
		),
		'colormag_footer_small_menu_text_color' => array(
			'id' => 'colormag_footer_small_menu_text_color',
			'title' => __('Footer small menu text color.', 'colormag'),
			'default' => '#b1b6b6'
		),
		'colormag_footer_copyright_part_background_color' => array(
			'id' => 'colormag_footer_copyright_part_background_color',
			'title' => __('Footer copyright part background color.', 'colormag'),
			'default' => ''
		)
	);

	$i = 1;

	foreach ($colormag_footer_part_color_options as $colormag_footer_part_color_option) {
		$wp_customize->add_setting($colormag_footer_part_color_option['id'], array(
			'default' => $colormag_footer_part_color_option['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
		));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $colormag_footer_part_color_option['id'], array(
			'label' => $colormag_footer_part_color_option['title'],
			'section' => 'colormag_footer_part_color_setting',
			'settings' => $colormag_footer_part_color_option['id'],
			'priority' => $i
		)));

		$i++;
	}
	// End of the Color Options

	// sanitization works
	// radio/select buttons sanitization
	function colormag_radio_select_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// color sanitization
	function colormag_color_option_hex_sanitize($color) {
		if ($unhashed = sanitize_hex_color_no_hash($color))
			return '#' . $unhashed;

		return $color;
	}

	function colormag_color_escaping_option_sanitize($input) {
		$input = esc_attr($input);
		return $input;
	}

	// checkbox sanitization
	function colormag_checkbox_sanitize($input) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// sanitization of links
	function colormag_links_sanitize() {
		return false;
	}

	// footer section sanitization
	function colormag_footer_editor_sanitize( $input) {
		if( isset( $input ) ) {
			$input =  stripslashes( wp_filter_post_kses( addslashes ( $input ) ) );
		}
		return $input;
	}

	// google fonts sanitization
	function colormag_fonts_sanitization($input) {
		global $colormag_google_font;
		$valid_keys = $colormag_google_font;

		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function colormag_breaking_news_duration_setting_options_sanitize($input) {
		if( is_numeric( $input ) ) {
		  return intval( $input );
		}
		else
			return 4;
	}

	function colormag_breaking_news_speed_setting_options_sanitize($input) {
		if( is_numeric( $input ) ) {
		  return intval( $input );
		}
		else
			return 1;
	}

}

add_action('customize_register', 'colormag_customize_register');

// google font addition
$colormag_google_font = array(
	"ABeeZee" => "ABeeZee",
	"Abel" => "Abel",
	"Abril Fatface" => "Abril+Fatface",
	"Aclonica" => "Aclonica",
	"Acme" => "Acme",
	"Actor" => "Actor",
	"Adamina" => "Adamina",
	"Advent Pro" => "Advent+Pro",
	"Aguafina Script" => "Aguafina+Script",
	"Akronim" => "Akronim",
	"Aladin" => "Aladin",
	"Aldrich" => "Aldrich",
	"Alegreya" => "Alegreya",
	"Alegreya SC" => "Alegreya+SC",
	"Alex Brush" => "Alex+Brush",
	"Alfa Slab One" => "Alfa+Slab+One",
	"Alice" => "Alice",
	"Alike" => "Alike",
	"Alike Angular" => "Alike+Angular",
	"Allan" => "Allan",
	"Allerta" => "Allerta",
	"Allerta Stencil" => "Allerta+Stencil",
	"Allura" => "Allura",
	"Almendra" => "Almendra",
	"Almendra Display" => "Almendra+Display",
	"Almendra SC" => "Almendra+SC",
	"Amarante" => "Amarante",
	"Amaranth" => "Amaranth",
	"Amatic SC" => "Amatic+SC",
	"Amethysta" => "Amethysta",
	"Anaheim" => "Anaheim",
	"Andada" => "Andada",
	"Andika" => "Andika",
	"Angkor" => "Angkor",
	"Annie Use Your Telescope" => "Annie+Use+Your+Telescope",
	"Anonymous Pro" => "Anonymous+Pro",
	"Antic" => "Antic",
	"Antic Didone" => "Antic+Didone",
	"Antic Slab" => "Antic+Slab",
	"Anton" => "Anton",
	"Arapey" => "Arapey",
	"Arbutus" => "Arbutus",
	"Arbutus Slab" => "Arbutus+Slab",
	"Architects Daughter" => "Architects+Daughter",
	"Archivo Black" => "Archivo+Black",
	"Archivo Narrow" => "Archivo+Narrow",
	"Arimo" => "Arimo",
	"Arizonia" => "Arizonia",
	"Armata" => "Armata",
	"Artifika" => "Artifika",
	"Arvo" => "Arvo",
	"Asap" => "Asap",
	"Asset" => "Asset",
	"Astloch" => "Astloch",
	"Asul" => "Asul",
	"Atomic Age" => "Atomic+Age",
	"Aubrey" => "Aubrey",
	"Audiowide" => "Audiowide",
	"Autour One" => "Autour+One",
	"Average" => "Average",
	"Average Sans" => "Average+Sans",
	"Averia Gruesa Libre" => "Averia+Gruesa+Libre",
	"Averia Libre" => "Averia+Libre",
	"Averia Sans Libre" => "Averia+Sans+Libre",
	"Averia Serif Libre" => "Averia+Serif+Libre",
	"Bad Script" => "Bad+Script",
	"Balthazar" => "Balthazar",
	"Bangers" => "Bangers",
	"Basic" => "Basic",
	"Battambang" => "Battambang",
	"Baumans" => "Baumans",
	"Bayon" => "Bayon",
	"Belgrano" => "Belgrano",
	"Belleza" => "Belleza",
	"BenchNine" => "BenchNine",
	"Bentham" => "Bentham",
	"Berkshire Swash" => "Berkshire+Swash",
	"Bevan" => "Bevan",
	"Bigelow Rules" => "Bigelow+Rules",
	"Bigshot One" => "Bigshot+One",
	"Bilbo" => "Bilbo",
	"Bilbo Swash Caps" => "Bilbo+Swash+Caps",
	"Bitter" => "Bitter",
	"Black Ops One" => "Black+Ops+One",
	"Bokor" => "Bokor",
	"Bonbon" => "Bonbon",
	"Boogaloo" => "Boogaloo",
	"Bowlby One" => "Bowlby+One",
	"Bowlby One SC" => "Bowlby+One+SC",
	"Brawler" => "Brawler",
	"Bree Serif" => "Bree+Serif",
	"Bubblegum Sans" => "Bubblegum+Sans",
	"Bubbler One" => "Bubbler+One",
	"Buda" => "Buda",
	"Buenard" => "Buenard",
	"Butcherman" => "Butcherman",
	"Butterfly Kids" => "Butterfly+Kids",
	"Cabin" => "Cabin",
	"Cabin Condensed" => "Cabin+Condensed",
	"Cabin Sketch" => "Cabin+Sketch",
	"Caesar Dressing" => "Caesar+Dressing",
	"Cagliostro" => "Cagliostro",
	"Calligraffitti" => "Calligraffitti",
	"Cambo" => "Cambo",
	"Candal" => "Candal",
	"Cantarell" => "Cantarell",
	"Cantata One" => "Cantata+One",
	"Cantora One" => "Cantora+One",
	"Capriola" => "Capriola",
	"Cardo" => "Cardo",
	"Carme" => "Carme",
	"Carrois Gothic" => "Carrois+Gothic",
	"Carrois Gothic SC" => "Carrois+Gothic+SC",
	"Carter One" => "Carter+One",
	"Caudex" => "Caudex",
	"Cedarville Cursive" => "Cedarville+Cursive",
	"Ceviche One" => "Ceviche+One",
	"Changa One" => "Changa+One",
	"Chango" => "Chango",
	"Chau Philomene One" => "Chau+Philomene+One",
	"Chela One" => "Chela+One",
	"Chelsea Market" => "Chelsea+Market",
	"Chenla" => "Chenla",
	"Cherry Cream Soda" => "Cherry+Cream+Soda",
	"Cherry Swash" => "Cherry+Swash",
	"Chewy" => "Chewy",
	"Chicle" => "Chicle",
	"Chivo" => "Chivo",
	"Cinzel" => "Cinzel",
	"Cinzel Decorative" => "Cinzel+Decorative",
	"Clicker Script" => "Clicker+Script",
	"Coda" => "Coda",
	"Coda Caption" => "Coda+Caption",
	"Codystar" => "Codystar",
	"Combo" => "Combo",
	"Comfortaa" => "Comfortaa",
	"Coming Soon" => "Coming+Soon",
	"Concert One" => "Concert+One",
	"Condiment" => "Condiment",
	"Content" => "Content",
	"Contrail One" => "Contrail+One",
	"Convergence" => "Convergence",
	"Cookie" => "Cookie",
	"Copse" => "Copse",
	"Corben" => "Corben",
	"Courgette" => "Courgette",
	"Cousine" => "Cousine",
	"Coustard" => "Coustard",
	"Covered By Your Grace" => "Covered+By+Your+Grace",
	"Crafty Girls" => "Crafty+Girls",
	"Creepster" => "Creepster",
	"Crete Round" => "Crete+Round",
	"Crimson Text" => "Crimson+Text",
	"Croissant One" => "Croissant+One",
	"Crushed" => "Crushed",
	"Cuprum" => "Cuprum",
	"Cutive" => "Cutive",
	"Cutive Mono" => "Cutive+Mono",
	"Damion" => "Damion",
	"Dancing Script" => "Dancing+Script",
	"Dangrek" => "Dangrek",
	"Dawning of a New Day" => "Dawning+of+a+New+Day",
	"Days One" => "Days+One",
	"Delius" => "Delius",
	"Delius Swash Caps" => "Delius+Swash+Caps",
	"Delius Unicase" => "Delius+Unicase",
	"Della Respira" => "Della+Respira",
	"Denk One" => "Denk+One",
	"Devonshire" => "Devonshire",
	"Didact Gothic" => "Didact+Gothic",
	"Diplomata" => "Diplomata",
	"Diplomata SC" => "Diplomata+SC",
	"Domine" => "Domine",
	"Donegal One" => "Donegal+One",
	"Doppio One" => "Doppio+One",
	"Dorsa" => "Dorsa",
	"Dosis" => "Dosis",
	"Dr Sugiyama" => "Dr+Sugiyama",
	"Droid Sans" => "Droid+Sans",
	"Droid Sans Mono" => "Droid+Sans+Mono",
	"Droid Serif" => "Droid+Serif",
	"Duru Sans" => "Duru+Sans",
	"Dynalight" => "Dynalight",
	"EB Garamond" => "EB+Garamond",
	"Eagle Lake" => "Eagle+Lake",
	"Eater" => "Eater",
	"Economica" => "Economica",
	"Electrolize" => "Electrolize",
	"Elsie" => "Elsie",
	"Elsie Swash Caps" => "Elsie+Swash+Caps",
	"Emblema One" => "Emblema+One",
	"Emilys Candy" => "Emilys+Candy",
	"Engagement" => "Engagement",
	"Englebert" => "Englebert",
	"Enriqueta" => "Enriqueta",
	"Erica One" => "Erica+One",
	"Esteban" => "Esteban",
	"Euphoria Script" => "Euphoria+Script",
	"Ewert" => "Ewert",
	"Exo" => "Exo",
	"Expletus Sans" => "Expletus+Sans",
	"Fanwood Text" => "Fanwood+Text",
	"Fascinate" => "Fascinate",
	"Fascinate Inline" => "Fascinate+Inline",
	"Faster One" => "Faster+One",
	"Fasthand" => "Fasthand",
	"Federant" => "Federant",
	"Federo" => "Federo",
	"Felipa" => "Felipa",
	"Fenix" => "Fenix",
	"Finger Paint" => "Finger+Paint",
	"Fira Sans" => "Fira+Sans",
	"Fjalla One" => "Fjalla+One",
	"Fjord One" => "Fjord+One",
	"Flamenco" => "Flamenco",
	"Flavors" => "Flavors",
	"Fondamento" => "Fondamento",
	"Fontdiner Swanky" => "Fontdiner+Swanky",
	"Forum" => "Forum",
	"Francois One" => "Francois+One",
	"Freckle Face" => "Freckle+Face",
	"Fredericka the Great" => "Fredericka+the+Great",
	"Fredoka One" => "Fredoka+One",
	"Freehand" => "Freehand",
	"Fresca" => "Fresca",
	"Frijole" => "Frijole",
	"Fruktur" => "Fruktur",
	"Fugaz One" => "Fugaz+One",
	"GFS Didot" => "GFS+Didot",
	"GFS Neohellenic" => "GFS+Neohellenic",
	"Gabriela" => "Gabriela",
	"Gafata" => "Gafata",
	"Galdeano" => "Galdeano",
	"Galindo" => "Galindo",
	"Gentium Basic" => "Gentium+Basic",
	"Gentium Book Basic" => "Gentium+Book+Basic",
	"Geo" => "Geo",
	"Geostar" => "Geostar",
	"Geostar Fill" => "Geostar+Fill",
	"Germania One" => "Germania+One",
	"Gilda Display" => "Gilda+Display",
	"Give You Glory" => "Give+You+Glory",
	"Glass Antiqua" => "Glass+Antiqua",
	"Glegoo" => "Glegoo",
	"Gloria Hallelujah" => "Gloria+Hallelujah",
	"Goblin One" => "Goblin+One",
	"Gochi Hand" => "Gochi+Hand",
	"Gorditas" => "Gorditas",
	"Goudy Bookletter 1911" => "Goudy+Bookletter+1911",
	"Graduate" => "Graduate",
	"Grand Hotel" => "Grand+Hotel",
	"Gravitas One" => "Gravitas+One",
	"Great Vibes" => "Great+Vibes",
	"Griffy" => "Griffy",
	"Gruppo" => "Gruppo",
	"Gudea" => "Gudea",
	"Habibi" => "Habibi",
	"Hammersmith One" => "Hammersmith+One",
	"Hanalei" => "Hanalei",
	"Hanalei Fill" => "Hanalei+Fill",
	"Handlee" => "Handlee",
	"Hanuman" => "Hanuman",
	"Happy Monkey" => "Happy+Monkey",
	"Headland One" => "Headland+One",
	"Henny Penny" => "Henny+Penny",
	"Herr Von Muellerhoff" => "Herr+Von+Muellerhoff",
	"Holtwood One SC" => "Holtwood+One+SC",
	"Homemade Apple" => "Homemade+Apple",
	"Homenaje" => "Homenaje",
	"IM Fell DW Pica" => "IM+Fell+DW+Pica",
	"IM Fell DW Pica SC" => "IM+Fell+DW+Pica+SC",
	"IM Fell Double Pica" => "IM+Fell+Double+Pica",
	"IM Fell Double Pica SC" => "IM+Fell+Double+Pica+SC",
	"IM Fell English" => "IM+Fell+English",
	"IM Fell English SC" => "IM+Fell+English+SC",
	"IM Fell French Canon" => "IM+Fell+French+Canon",
	"IM Fell French Canon SC" => "IM+Fell+French+Canon+SC",
	"IM Fell Great Primer" => "IM+Fell+Great+Primer",
	"IM Fell Great Primer SC" => "IM+Fell+Great+Primer+SC",
	"Iceberg" => "Iceberg",
	"Iceland" => "Iceland",
	"Imprima" => "Imprima",
	"Inconsolata" => "Inconsolata",
	"Inder" => "Inder",
	"Indie Flower" => "Indie+Flower",
	"Inika" => "Inika",
	"Irish Grover" => "Irish+Grover",
	"Istok Web" => "Istok+Web",
	"Italiana" => "Italiana",
	"Italianno" => "Italianno",
	"Jacques Francois" => "Jacques+Francois",
	"Jacques Francois Shadow" => "Jacques+Francois+Shadow",
	"Jim Nightshade" => "Jim+Nightshade",
	"Jockey One" => "Jockey+One",
	"Jolly Lodger" => "Jolly+Lodger",
	"Josefin Sans" => "Josefin+Sans",
	"Josefin Slab" => "Josefin+Slab",
	"Joti One" => "Joti+One",
	"Judson" => "Judson",
	"Julee" => "Julee",
	"Julius Sans One" => "Julius+Sans+One",
	"Junge" => "Junge",
	"Jura" => "Jura",
	"Just Another Hand" => "Just+Another+Hand",
	"Just Me Again Down Here" => "Just+Me+Again+Down+Here",
	"Kameron" => "Kameron",
	"Karla" => "Karla",
	"Kaushan Script" => "Kaushan+Script",
	"Kavoon" => "Kavoon",
	"Keania One" => "Keania+One",
	"Kelly Slab" => "Kelly+Slab",
	"Kenia" => "Kenia",
	"Khmer" => "Khmer",
	"Kite One" => "Kite+One",
	"Knewave" => "Knewave",
	"Kotta One" => "Kotta+One",
	"Koulen" => "Koulen",
	"Kranky" => "Kranky",
	"Kreon" => "Kreon",
	"Kristi" => "Kristi",
	"Krona One" => "Krona+One",
	"La Belle Aurore" => "La+Belle+Aurore",
	"Lancelot" => "Lancelot",
	"Lato" => "Lato",
	"League Script" => "League+Script",
	"Leckerli One" => "Leckerli+One",
	"Ledger" => "Ledger",
	"Lekton" => "Lekton",
	"Lemon" => "Lemon",
	"Libre Baskerville" => "Libre+Baskerville",
	"Life Savers" => "Life+Savers",
	"Lilita One" => "Lilita+One",
	"Limelight" => "Limelight",
	"Linden Hill" => "Linden+Hill",
	"Lobster" => "Lobster",
	"Lobster Two" => "Lobster+Two",
	"Londrina Outline" => "Londrina+Outline",
	"Londrina Shadow" => "Londrina+Shadow",
	"Londrina Sketch" => "Londrina+Sketch",
	"Londrina Solid" => "Londrina+Solid",
	"Lora" => "Lora",
	"Love Ya Like A Sister" => "Love+Ya+Like+A+Sister",
	"Loved by the King" => "Loved+by+the+King",
	"Lovers Quarrel" => "Lovers+Quarrel",
	"Luckiest Guy" => "Luckiest+Guy",
	"Lusitana" => "Lusitana",
	"Lustria" => "Lustria",
	"Macondo" => "Macondo",
	"Macondo Swash Caps" => "Macondo+Swash+Caps",
	"Magra" => "Magra",
	"Maiden Orange" => "Maiden+Orange",
	"Mako" => "Mako",
	"Marcellus" => "Marcellus",
	"Marcellus SC" => "Marcellus+SC",
	"Marck Script" => "Marck+Script",
	"Margarine" => "Margarine",
	"Marko One" => "Marko+One",
	"Marmelad" => "Marmelad",
	"Marvel" => "Marvel",
	"Mate" => "Mate",
	"Mate SC" => "Mate+SC",
	"Maven Pro" => "Maven+Pro",
	"McLaren" => "McLaren",
	"Meddon" => "Meddon",
	"MedievalSharp" => "MedievalSharp",
	"Medula One" => "Medula+One",
	"Megrim" => "Megrim",
	"Meie Script" => "Meie+Script",
	"Merienda" => "Merienda",
	"Merienda One" => "Merienda+One",
	"Merriweather" => "Merriweather",
	"Merriweather Sans" => "Merriweather+Sans",
	"Metal" => "Metal",
	"Metal Mania" => "Metal+Mania",
	"Metamorphous" => "Metamorphous",
	"Metrophobic" => "Metrophobic",
	"Michroma" => "Michroma",
	"Milonga" => "Milonga",
	"Miltonian" => "Miltonian",
	"Miltonian Tattoo" => "Miltonian+Tattoo",
	"Miniver" => "Miniver",
	"Miss Fajardose" => "Miss+Fajardose",
	"Modern Antiqua" => "Modern+Antiqua",
	"Molengo" => "Molengo",
	"Molle" => "Molle",
	"Monda" => "Monda",
	"Monofett" => "Monofett",
	"Monoton" => "Monoton",
	"Monsieur La Doulaise" => "Monsieur+La+Doulaise",
	"Montaga" => "Montaga",
	"Montez" => "Montez",
	"Montserrat" => "Montserrat",
	"Montserrat Alternates" => "Montserrat+Alternates",
	"Montserrat Subrayada" => "Montserrat+Subrayada",
	"Moul" => "Moul",
	"Moulpali" => "Moulpali",
	"Mountains of Christmas" => "Mountains+of+Christmas",
	"Mouse Memoirs" => "Mouse+Memoirs",
	"Mr Bedfort" => "Mr+Bedfort",
	"Mr Dafoe" => "Mr+Dafoe",
	"Mr De Haviland" => "Mr+De+Haviland",
	"Mrs Saint Delafield" => "Mrs+Saint+Delafield",
	"Mrs Sheppards" => "Mrs+Sheppards",
	"Muli" => "Muli",
	"Mystery Quest" => "Mystery+Quest",
	"Neucha" => "Neucha",
	"Neuton" => "Neuton",
	"New Rocker" => "New+Rocker",
	"News Cycle" => "News+Cycle",
	"Niconne" => "Niconne",
	"Nixie One" => "Nixie+One",
	"Nobile" => "Nobile",
	"Nokora" => "Nokora",
	"Norican" => "Norican",
	"Nosifer" => "Nosifer",
	"Nothing You Could Do" => "Nothing+You+Could+Do",
	"Noticia Text" => "Noticia+Text",
	"Nova Cut" => "Nova+Cut",
	"Nova Flat" => "Nova+Flat",
	"Nova Mono" => "Nova+Mono",
	"Nova Oval" => "Nova+Oval",
	"Nova Round" => "Nova+Round",
	"Nova Script" => "Nova+Script",
	"Nova Slim" => "Nova+Slim",
	"Nova Square" => "Nova+Square",
	"Numans" => "Numans",
	"Nunito" => "Nunito",
	"Odor Mean Chey" => "Odor+Mean+Chey",
	"Offside" => "Offside",
	"Old Standard TT" => "Old+Standard+TT",
	"Oldenburg" => "Oldenburg",
	"Oleo Script" => "Oleo+Script",
	"Oleo Script Swash Caps" => "Oleo+Script+Swash+Caps",
	"Open Sans" => "Open+Sans",
	"Open Sans Condensed" => "Open+Sans+Condensed",
	"Oranienbaum" => "Oranienbaum",
	"Orbitron" => "Orbitron",
	"Oregano" => "Oregano",
	"Orienta" => "Orienta",
	"Original Surfer" => "Original+Surfer",
	"Oswald" => "Oswald",
	"Over the Rainbow" => "Over+the+Rainbow",
	"Overlock" => "Overlock",
	"Overlock SC" => "Overlock+SC",
	"Ovo" => "Ovo",
	"Oxygen" => "Oxygen",
	"Oxygen Mono" => "Oxygen+Mono",
	"PT Mono" => "PT+Mono",
	"PT Sans" => "PT+Sans",
	"PT Sans Caption" => "PT+Sans+Caption",
	"PT Sans Narrow" => "PT+Sans+Narrow",
	"PT Serif" => "PT+Serif",
	"PT Serif Caption" => "PT+Serif+Caption",
	"Pacifico" => "Pacifico",
	"Paprika" => "Paprika",
	"Parisienne" => "Parisienne",
	"Passero One" => "Passero+One",
	"Passion One" => "Passion+One",
	"Patrick Hand" => "Patrick+Hand",
	"Patrick Hand SC" => "Patrick+Hand+SC",
	"Patua One" => "Patua+One",
	"Paytone One" => "Paytone+One",
	"Peralta" => "Peralta",
	"Permanent Marker" => "Permanent+Marker",
	"Petit Formal Script" => "Petit+Formal+Script",
	"Petrona" => "Petrona",
	"Philosopher" => "Philosopher",
	"Piedra" => "Piedra",
	"Pinyon Script" => "Pinyon+Script",
	"Pirata One" => "Pirata+One",
	"Plaster" => "Plaster",
	"Play" => "Play",
	"Playball" => "Playball",
	"Playfair Display" => "Playfair+Display",
	"Playfair Display SC" => "Playfair+Display+SC",
	"Podkova" => "Podkova",
	"Poiret One" => "Poiret+One",
	"Poller One" => "Poller+One",
	"Poly" => "Poly",
	"Pompiere" => "Pompiere",
	"Pontano Sans" => "Pontano+Sans",
	"Port Lligat Sans" => "Port+Lligat+Sans",
	"Port Lligat Slab" => "Port+Lligat+Slab",
	"Prata" => "Prata",
	"Preahvihear" => "Preahvihear",
	"Press Start 2P" => "Press+Start+2P",
	"Princess Sofia" => "Princess+Sofia",
	"Prociono" => "Prociono",
	"Prosto One" => "Prosto+One",
	"Puritan" => "Puritan",
	"Purple Purse" => "Purple+Purse",
	"Quando" => "Quando",
	"Quantico" => "Quantico",
	"Quattrocento" => "Quattrocento",
	"Quattrocento Sans" => "Quattrocento+Sans",
	"Questrial" => "Questrial",
	"Quicksand" => "Quicksand",
	"Quintessential" => "Quintessential",
	"Qwigley" => "Qwigley",
	"Racing Sans One" => "Racing+Sans+One",
	"Radley" => "Radley",
	"Raleway" => "Raleway",
	"Raleway Dots" => "Raleway+Dots",
	"Rambla" => "Rambla",
	"Rammetto One" => "Rammetto+One",
	"Ranchers" => "Ranchers",
	"Rancho" => "Rancho",
	"Rationale" => "Rationale",
	"Redressed" => "Redressed",
	"Reenie Beanie" => "Reenie+Beanie",
	"Revalia" => "Revalia",
	"Ribeye" => "Ribeye",
	"Ribeye Marrow" => "Ribeye+Marrow",
	"Righteous" => "Righteous",
	"Risque" => "Risque",
	"Roboto:400,300,100" => "Roboto",
	"Roboto+Slab:700,400" => "Roboto+Slab",
	"Roboto Condensed" => "Roboto+Condensed",
	"Rochester" => "Rochester",
	"Rock Salt" => "Rock+Salt",
	"Rokkitt" => "Rokkitt",
	"Romanesco" => "Romanesco",
	"Ropa Sans" => "Ropa+Sans",
	"Rosario" => "Rosario",
	"Rosarivo" => "Rosarivo",
	"Rouge Script" => "Rouge+Script",
	"Ruda" => "Ruda",
	"Rufina" => "Rufina",
	"Ruge Boogie" => "Ruge+Boogie",
	"Ruluko" => "Ruluko",
	"Rum Raisin" => "Rum+Raisin",
	"Ruslan Display" => "Ruslan+Display",
	"Russo One" => "Russo+One",
	"Ruthie" => "Ruthie",
	"Rye" => "Rye",
	"Sacramento" => "Sacramento",
	"Sail" => "Sail",
	"Salsa" => "Salsa",
	"Sanchez" => "Sanchez",
	"Sancreek" => "Sancreek",
	"Sansita One" => "Sansita+One",
	"Sarina" => "Sarina",
	"Satisfy" => "Satisfy",
	"Scada" => "Scada",
	"Schoolbell" => "Schoolbell",
	"Seaweed Script" => "Seaweed+Script",
	"Sevillana" => "Sevillana",
	"Seymour One" => "Seymour+One",
	"Shadows Into Light" => "Shadows+Into+Light",
	"Shadows Into Light Two" => "Shadows+Into+Light+Two",
	"Shanti" => "Shanti",
	"Share" => "Share",
	"Share Tech" => "Share+Tech",
	"Share Tech Mono" => "Share+Tech+Mono",
	"Shojumaru" => "Shojumaru",
	"Short Stack" => "Short+Stack",
	"Siemreap" => "Siemreap",
	"Sigmar One" => "Sigmar+One",
	"Signika" => "Signika",
	"Signika Negative" => "Signika+Negative",
	"Simonetta" => "Simonetta",
	"Sintony" => "Sintony",
	"Sirin Stencil" => "Sirin+Stencil",
	"Six Caps" => "Six+Caps",
	"Skranji" => "Skranji",
	"Slackey" => "Slackey",
	"Smokum" => "Smokum",
	"Smythe" => "Smythe",
	"Sniglet" => "Sniglet",
	"Snippet" => "Snippet",
	"Snowburst One" => "Snowburst+One",
	"Sofadi One" => "Sofadi+One",
	"Sofia" => "Sofia",
	"Sonsie One" => "Sonsie+One",
	"Sorts Mill Goudy" => "Sorts+Mill+Goudy",
	"Source Code Pro" => "Source+Code+Pro",
	"Source Sans Pro" => "Source+Sans+Pro",
	"Special Elite" => "Special+Elite",
	"Spicy Rice" => "Spicy+Rice",
	"Spinnaker" => "Spinnaker",
	"Spirax" => "Spirax",
	"Squada One" => "Squada+One",
	"Stalemate" => "Stalemate",
	"Stalinist One" => "Stalinist+One",
	"Stardos Stencil" => "Stardos+Stencil",
	"Stint Ultra Condensed" => "Stint+Ultra+Condensed",
	"Stint Ultra Expanded" => "Stint+Ultra+Expanded",
	"Stoke" => "Stoke",
	"Strait" => "Strait",
	"Sue Ellen Francisco" => "Sue+Ellen+Francisco",
	"Sunshiney" => "Sunshiney",
	"Supermercado One" => "Supermercado+One",
	"Suwannaphum" => "Suwannaphum",
	"Swanky and Moo Moo" => "Swanky+and+Moo+Moo",
	"Syncopate" => "Syncopate",
	"Tangerine" => "Tangerine",
	"Taprom" => "Taprom",
	"Tauri" => "Tauri",
	"Telex" => "Telex",
	"Tenor Sans" => "Tenor+Sans",
	"Text Me One" => "Text+Me+One",
	"The Girl Next Door" => "The+Girl+Next+Door",
	"Tienne" => "Tienne",
	"Tinos" => "Tinos",
	"Titan One" => "Titan+One",
	"Titillium Web" => "Titillium+Web",
	"Trade Winds" => "Trade+Winds",
	"Trocchi" => "Trocchi",
	"Trochut" => "Trochut",
	"Trykker" => "Trykker",
	"Tulpen One" => "Tulpen+One",
	"Ubuntu" => "Ubuntu",
	"Ubuntu Condensed" => "Ubuntu+Condensed",
	"Ubuntu Mono" => "Ubuntu+Mono",
	"Ultra" => "Ultra",
	"Uncial Antiqua" => "Uncial+Antiqua",
	"Underdog" => "Underdog",
	"Unica One" => "Unica+One",
	"UnifrakturCook" => "UnifrakturCook",
	"UnifrakturMaguntia" => "UnifrakturMaguntia",
	"Unkempt" => "Unkempt",
	"Unlock" => "Unlock",
	"Unna" => "Unna",
	"VT323" => "VT323",
	"Vampiro One" => "Vampiro+One",
	"Varela" => "Varela",
	"Varela Round" => "Varela+Round",
	"Vast Shadow" => "Vast+Shadow",
	"Vibur" => "Vibur",
	"Vidaloka" => "Vidaloka",
	"Viga" => "Viga",
	"Voces" => "Voces",
	"Volkhov" => "Volkhov",
	"Vollkorn" => "Vollkorn",
	"Voltaire" => "Voltaire",
	"Waiting for the Sunrise" => "Waiting+for+the+Sunrise",
	"Wallpoet" => "Wallpoet",
	"Walter Turncoat" => "Walter+Turncoat",
	"Warnes" => "Warnes",
	"Wellfleet" => "Wellfleet",
	"Wendy One" => "Wendy+One",
	"Wire One" => "Wire+One",
	"Yanone Kaffeesatz" => "Yanone+Kaffeesatz",
	"Yellowtail" => "Yellowtail",
	"Yeseva One" => "Yeseva+One",
	"Yesteryear" => "Yesteryear",
	"Zeyada" => "Zeyada",
);
