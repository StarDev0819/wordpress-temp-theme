<?php
defined( 'ABSPATH' ) || die;

/**
 * Alpha Categories Widget
 *
 * Alpha Widget to display product categories.
 *
 * @author     FunnyWP
 * @package    WP Alpha Core FrameWork
 * @subpackage Core
 * @since      1.0
 */

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Alpha_Controls_Manager;

class Alpha_Categories_Elementor_Widget extends \Elementor\Widget_Base {

	// Showing Link Conditions
	private $show_link_conditions = array( 'icon', 'badge' );

	// Showing Count Conditions
	private $show_cnt_conditions = array( '', 'badge', 'banner', 'icon', 'ellipse', 'group-2', 'center' );

	public function get_name() {
		return ALPHA_NAME . '_widget_categories';
	}

	public function get_title() {
		return esc_html__( 'Product Categories', 'alpha-core' );
	}

	public function get_categories() {
		return array( 'alpha_widget' );
	}

	public function get_keywords() {
		return array( 'product categories', 'shop', 'woocommerce', 'filter' );
	}

	public function get_icon() {
		return 'alpha-elementor-widget-icon eicon-product-categories';
	}

	public function get_script_depends() {
		$depends = array( 'swiper', 'isotope-pkgd' );
		if ( alpha_is_elementor_preview() ) {
			$depends[] = 'alpha-elementor-js';
		}
		return $depends;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_categories_selector',
			array(
				'label' => esc_html__( 'Categories Selector', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'category_ids',
				array(
					'label'       => esc_html__( 'Select Categories', 'alpha-core' ),
					'type'        => Alpha_Controls_Manager::AJAXSELECT2,
					'options'     => 'product_cat',
					'label_block' => true,
					'multiple'    => true,
				)
			);

			$this->add_control(
				'run_as_filter',
				array(
					'type'        => Controls_Manager::SWITCHER,
					'label'       => esc_html__( 'Filter Products', 'alpha-core' ),
					'description' => esc_html__( 'In a same section, this will interact with products widget so taht you\'ll be able to filter products by category.', 'alpha-core' ),
				)
			);

			$this->add_control(
				'show_all_filter',
				array(
					'type'      => Controls_Manager::SWITCHER,
					'label'     => esc_html__( 'Show \'All\'', 'alpha-core' ),
					'condition' => array(
						'run_as_filter' => 'yes',
					),
				)
			);

			$this->add_control(
				'run_as_filter_shop',
				array(
					'type'        => Controls_Manager::SWITCHER,
					'label'       => esc_html__( 'Filter Products in Shop', 'alpha-core' ),
					'description' => esc_html__( 'You\'ll be able to filter products by category in shop page in case that ajax filter is enabled in theme options.', 'alpha-core' ),
				)
			);

			$this->add_control(
				'show_subcategories',
				array(
					'type'  => Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Show Subcategories', 'alpha-core' ),
				)
			);

			$this->add_control(
				'hide_empty',
				array(
					'type'  => Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Hide Empty', 'alpha-core' ),
				)
			);

			$this->add_control(
				'count',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Category Count', 'alpha-core' ),
					'range'       => array(
						'px' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 24,
						),
					),
					'description' => esc_html__( '0 value will show all categories.', 'alpha-core' ),
				)
			);

			$this->add_control(
				'orderby',
				array(
					'type'    => Controls_Manager::SELECT,
					'label'   => esc_html__( 'Order By', 'alpha-core' ),
					'default' => '',
					'options' => array(
						''            => esc_html__( 'Default', 'alpha-core' ),
						'name'        => esc_html__( 'Name', 'alpha-core' ),
						'id'          => esc_html__( 'ID', 'alpha-core' ),
						'slug'        => esc_html__( 'Slug', 'alpha-core' ),
						'modified'    => esc_html__( 'Modified', 'alpha-core' ),
						'count'       => esc_html__( 'Product Count', 'alpha-core' ),
						'parent'      => esc_html__( 'Parent', 'alpha-core' ),
						'description' => esc_html__( 'Description', 'alpha-core' ),
						'term_group'  => esc_html__( 'Term Group', 'alpha-core' ),
					),
				)
			);

			$this->add_control(
				'orderway',
				array(
					'type'    => Controls_Manager::SELECT,
					'label'   => esc_html__( 'Order Way', 'alpha-core' ),
					'options' => array(
						'ASC' => esc_html__( 'Ascending', 'alpha-core' ),
						''    => esc_html__( 'Descending', 'alpha-core' ),
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_categories_layout',
			array(
				'label' => esc_html__( 'Layout', 'alpha-core' ),
			)
		);

			$this->add_control(
				'layout_type',
				array(
					'label'   => esc_html__( 'Categories Layout', 'alpha-core' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'grid',
					'options' => array(
						'grid'     => esc_html__( 'Grid', 'alpha-core' ),
						'slider'   => esc_html__( 'Slider', 'alpha-core' ),
						'creative' => esc_html__( 'Creative Grid', 'alpha-core' ),
					),
				)
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				array(
					'name'    => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`
					'exclude' => [ 'custom' ],
					'default' => 'woocommerce_thumbnail',
				)
			);

			alpha_elementor_grid_layout_controls( $this, 'layout_type', true, 'has_rows' );

			alpha_elementor_slider_layout_controls( $this, 'layout_type' );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_type',
			array(
				'label' => esc_html__( 'Category Type', 'alpha-core' ),
			)
		);
			$this->add_control(
				'follow_theme_option',
				array(
					'label'   => esc_html__( 'Follow Theme Option', 'alpha-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				)
			);

			$this->add_control(
				'category_type',
				array(
					'label'     => esc_html__( 'Category Type', 'alpha-core' ),
					'type'      => Alpha_Controls_Manager::IMAGE_CHOOSE,
					'default'   => '',
					'options'   => apply_filters(
						'alpha_pc_types',
						array(
							''          => 'assets/images/categories/category-1.jpg',  // @feature: fs_pct_default
							'frame'     => 'assets/images/categories/category-2.jpg',  // @feature: fs_pct_frame
							'banner'    => 'assets/images/categories/category-3.jpg',  // @feature: fs_pct_banner
							'simple'    => 'assets/images/categories/category-4.jpg',  // @feature: fs_pct_simple
							'icon'      => 'assets/images/categories/category-5.jpg',  // @feature: fs_pct_icon
							'classic'   => 'assets/images/categories/category-6.jpg',  // @feature: fs_pct_classic
							'classic-2' => 'assets/images/categories/category-7.jpg',  // @feature: fs_pct_classic-2
							'ellipse'   => 'assets/images/categories/category-8.jpg',  // @feature: fs_pct_ellipse
							'ellipse-2' => 'assets/images/categories/category-9.jpg',  // @feature: fs_pct_ellipse-2
							'group'     => 'assets/images/categories/category-10.jpg', // @feature: fs_pct_group
							'group-2'   => 'assets/images/categories/category-11.jpg', // @feature: fs_pct_group-2
							'label'     => 'assets/images/categories/category-12.jpg', // @feature: fs_pct_label
						),
						'elementor'
					),
					'condition' => array(
						'follow_theme_option' => '',
					),
					'width'     => 1,
				)
			);

			$this->add_responsive_control(
				'active_border_width',
				array(
					'label'     => esc_html__( 'Active Border Width', 'alpha-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 20,
						),
					),
					'selectors' => array(
						'.elementor-element-{{ID}} .product-category:hover figure, .elementor-element-{{ID}} .product.active figure' => 'border-width:{{SIZE}}{{UNIT}};',
					),
					'condition' => array(
						'category_type' => 'ellipse-2',
					),
				)
			);

			$this->add_control(
				'show_icon',
				array(
					'label'     => esc_html__( 'Show Icon', 'alpha-core' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => '',
					'condition' => array(
						'category_type'       => array( 'group', 'group-2', 'label' ),
						'follow_theme_option' => '',
					),
				)
			);

			$this->add_control(
				'subcat_cnt',
				array(
					'label'     => esc_html__( 'Subcategory Count', 'alpha-core' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5,
					'condition' => array(
						'category_type'       => array( 'group', 'group-2' ),
						'follow_theme_option' => '',
					),
				)
			);

			$this->add_control(
				'overlay',
				array(
					'type'       => Controls_Manager::SELECT,
					'label'      => esc_html__( 'Overlay Effect', 'alpha-core' ),
					'options'    => array(
						''           => esc_html__( 'No', 'alpha-core' ),
						'light'      => esc_html__( 'Light', 'alpha-core' ),
						'dark'       => esc_html__( 'Dark', 'alpha-core' ),
						'zoom'       => esc_html__( 'Zoom', 'alpha-core' ),
						'zoom_light' => esc_html__( 'Zoom and Light', 'alpha-core' ),
						'zoom_dark'  => esc_html__( 'Zoom and Dark', 'alpha-core' ),
					),
					'conditions' => array(
						'relation' => 'and',
						'terms'    => array(
							array(
								'name'     => 'follow_theme_option',
								'operator' => '==',
								'value'    => '',
							),
							array(
								'relation' => 'or',
								'terms'    => array(
									array(
										'name'     => 'show_icon',
										'operator' => '==',
										'value'    => '',
									),
									array(
										'name'     => 'category_type',
										'operator' => '!in',
										'value'    => array( 'icon', 'group', 'group-2' ),
									),
								),
							),
						),
					),
				)
			);

		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'section_style_cat',
		// 	array(
		// 		'label' => esc_html__( 'Category ', 'alpha-core' ),
		// 		'tab'   => Controls_Manager::TAB_STYLE,
		// 	)
		// );
		// 	$this->add_responsive_control(
		// 		'cat_padding',
		// 		array(
		// 			'label'      => esc_html__( 'Padding', 'alpha-core' ),
		// 			'type'       => Controls_Manager::DIMENSIONS,
		// 			'size_units' => array( 'px', 'em', '%' ),
		// 			'selectors'  => array(
		// 				'.elementor-element-{{ID}} .product-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 			),
		// 		)
		// 	);

		// 	$this->add_responsive_control(
		// 		'category_min_height',
		// 		array(
		// 			'label'      => esc_html__( 'Min Height', 'alpha-core' ),
		// 			'type'       => Controls_Manager::SLIDER,
		// 			'default'    => array(
		// 				'unit' => 'px',
		// 			),
		// 			'size_units' => array(
		// 				'px',
		// 				'rem',
		// 				'%',
		// 				'vh',
		// 			),
		// 			'range'      => array(
		// 				'px' => array(
		// 					'step' => 1,
		// 					'min'  => 0,
		// 					'max'  => 700,
		// 				),
		// 			),
		// 			'selectors'  => array(
		// 				'.elementor-element-{{ID}} .product-category img' => 'min-height:{{SIZE}}{{UNIT}}; object-fit: cover;',
		// 			),
		// 		)
		// 	);

		// 	$this->add_control(
		// 		'cat_bg',
		// 		array(
		// 			'label'     => esc_html__( 'Background Color', 'alpha-core' ),
		// 			'type'      => Controls_Manager::COLOR,
		// 			'selectors' => array(
		// 				'.elementor-element-{{ID}} .product-category' => 'background-color: {{VALUE}};',
		// 			),
		// 		)
		// 	);

		// 	$this->add_control(
		// 		'cat_color',
		// 		array(
		// 			'label'     => esc_html__( 'Color', 'alpha-core' ),
		// 			'type'      => Controls_Manager::COLOR,
		// 			'selectors' => array(
		// 				'.elementor-element-{{ID}} .product-category' => 'color: {{VALUE}};',
		// 			),
		// 		)
		// 	);

		// $this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			array(
				'label'     => esc_html__( 'Category Icon', 'alpha-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_icon' => 'yes',
				),
			)
		);

			$this->add_responsive_control(
				'icon_margin',
				array(
					'label'      => esc_html__( 'Margin', 'alpha-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'.elementor-element-{{ID}} figure i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_responsive_control(
				'icon_padding',
				array(
					'label'      => esc_html__( 'Padding', 'alpha-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'.elementor-element-{{ID}} figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'icon_typography',
					'selector' => '.elementor-element-{{ID}} figure i',
				)
			);

			$this->add_control(
				'icon_color',
				array(
					'label'     => esc_html__( 'Color', 'alpha-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.elementor-element-{{ID}} figure i' => 'color: {{VALUE}};',
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			array(
				'label' => esc_html__( 'Category Content', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_responsive_control(
				'content_padding',
				array(
					'label'      => esc_html__( 'Padding', 'alpha-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .category-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_responsive_control(
				'content_align',
				array(
					'label'   => esc_html__( 'Content Align', 'alpha-core' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => array(
						'content-left'   => array(
							'title' => esc_html__( 'Left', 'alpha-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'content-center' => array(
							'title' => esc_html__( 'Center', 'alpha-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'content-right'  => array(
							'title' => esc_html__( 'Right', 'alpha-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
				)
			);

			$this->add_control(
				'content_pos_heading',
				array(
					'label'     => esc_html__( 'Position', 'alpha-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->add_control(
				'content_origin',
				array(
					'label'     => esc_html__( 'Origin X, Y', 'alpha-core' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => array(
						''     => esc_html__( 'Default Default', 'alpha-core' ),
						't-m'  => esc_html__( 'Default Center', 'alpha-core' ),
						't-c'  => esc_html__( 'Center Default', 'alpha-core' ),
						't-mc' => esc_html__( 'Center Center', 'alpha-core' ),
					),
					'default'   => '',
					'condition' => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->start_controls_tabs( 'content_position_tabs' );

			$this->start_controls_tab(
				'content_pos_left_tab',
				array(
					'label'     => esc_html__( 'Left', 'alpha-core' ),
					'condition' => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->add_responsive_control(
				'content_left',
				array(
					'label'      => esc_html__( 'Left Offset', 'alpha-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array(
						'px',
						'rem',
						'%',
						'vw',
					),
					'range'      => array(
						'px'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 500,
						),
						'rem' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'%'   => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'vw'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
					),
					'default'    => array(
						'size' => '3.7',
						'unit' => 'rem',
					),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .category-content' => sprintf( 'left: %s', ! ( '{{SIZE}}' ) ? 'auto' : '{{SIZE}}{{UNIT}}' ),
					),
					'condition'  => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'content_pos_top_tab',
				array(
					'label'     => esc_html__( 'Top', 'alpha-core' ),
					'condition' => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->add_responsive_control(
				'content_top',
				array(
					'label'      => esc_html__( 'Top Offset', 'alpha-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array(
						'px',
						'rem',
						'%',
						'vw',
					),
					'range'      => array(
						'px'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 500,
						),
						'rem' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'%'   => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'vw'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
					),
					'default'    => array(
						'size' => '3.8',
						'unit' => 'rem',
					),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .category-content' => 'top:{{SIZE}}{{UNIT}};',
					),
					'condition'  => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'content_pos_right_tab',
				array(
					'label'     => esc_html__( 'Right', 'alpha-core' ),
					'condition' => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->add_responsive_control(
				'content_right',
				array(
					'label'      => esc_html__( 'Right Offset', 'alpha-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array(
						'px',
						'rem',
						'%',
						'vw',
					),
					'range'      => array(
						'px'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 500,
						),
						'rem' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'%'   => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'vw'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
					),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .category-content' => 'right:{{SIZE}}{{UNIT}};',
					),
					'condition'  => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'content_pos_bottom_tab',
				array(
					'label'     => esc_html__( 'Bottom', 'alpha-core' ),
					'condition' => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->add_responsive_control(
				'content_bottom',
				array(
					'label'      => esc_html__( 'Bottom Offset', 'alpha-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array(
						'px',
						'rem',
						'%',
						'vw',
					),
					'range'      => array(
						'px'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 500,
						),
						'rem' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'%'   => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'vw'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
					),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .category-content' => 'bottom:{{SIZE}}{{UNIT}};',
					),
					'condition'  => array(
						'category_type' => 'banner',
					),
				)
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => esc_html__( 'Category Name', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'title_typography',
					'selector' => '.elementor-element-{{ID}} .product-category .woocommerce-loop-category__title',
				)
			);

			$this->start_controls_tabs( 'tabs_cat_name_style' );

				$this->start_controls_tab(
					'tab_cat_name_normal',
					array(
						'label' => esc_html__( 'Normal', 'alpha-core' ),
					)
				);
					$this->add_control(
						'title_color',
						array(
							'label'     => esc_html__( 'Normal Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .woocommerce-loop-category__title' => 'color: {{VALUE}};',
							),
						)
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_cat_name_hover',
					array(
						'label' => esc_html__( 'Hover', 'alpha-core' ),
					)
				);
					$this->add_control(
						'title_color_hover',
						array(
							'label'     => esc_html__( 'Hover Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category:hover .woocommerce-loop-category__title, .elementor-element-{{ID}} .product.active .woocommerce-loop-category__title' => 'color: {{VALUE}};',
							),
						)
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'title_margin',
				array(
					'label'      => esc_html__( 'Margin', 'alpha-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .woocommerce-loop-category__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_count',
			array(
				'label' => esc_html__( 'Products Count', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_control(
				'count_color',
				array(
					'label'     => esc_html__( 'Color', 'alpha-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.elementor-element-{{ID}} .product-category mark' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'count_typography',
					'selector' => '.elementor-element-{{ID}} .product-category mark',
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => esc_html__( 'Button', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'typography',
					'selector' => '.elementor-element-{{ID}} .product-category .btn',
				)
			);

			$this->start_controls_tabs( 'tabs_button_style' );

				$this->start_controls_tab(
					'tab_button_normal',
					array(
						'label' => esc_html__( 'Normal', 'alpha-core' ),
					)
				);

					$this->add_control(
						'btn_color',
						array(
							'label'     => esc_html__( 'Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .btn' => 'color: {{VALUE}};',
							),
						)
					);

					$this->add_control(
						'btn_bg_color',
						array(
							'label'     => esc_html__( 'Background Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .btn' => 'background-color: {{VALUE}};',
							),
						)
					);

					$this->add_control(
						'btn_border_color',
						array(
							'label'     => esc_html__( 'Border Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .btn' => 'border-color: {{VALUE}};',
							),
						)
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_button_hover',
					array(
						'label' => esc_html__( 'Hover', 'alpha-core' ),
					)
				);

					$this->add_control(
						'btn_hover_color',
						array(
							'label'     => esc_html__( 'Hover Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .btn:hover, .elementor-element-{{ID}} .product-category .btn:focus' => 'color: {{VALUE}};',
							),
						)
					);

					$this->add_control(
						'btn_hover_bg_color',
						array(
							'label'     => esc_html__( 'Hover Background Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .btn:hover, .elementor-element-{{ID}} .product-category .btn:focus' => 'background-color: {{VALUE}};',
							),
						)
					);

					$this->add_control(
						'btn_hover_border_color',
						array(
							'label'     => esc_html__( 'Hover Border Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .product-category .btn' => 'border-color: {{VALUE}};',
							),
						)
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'button_margin',
				array(
					'label'      => esc_html__( 'Margin', 'alpha-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'separator'  => 'before',
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_responsive_control(
				'button_padding',
				array(
					'label'      => esc_html__( 'Padding', 'alpha-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'.elementor-element-{{ID}} .product-category .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

		$this->end_controls_section();

		alpha_elementor_slider_style_controls( $this, 'layout_type' );
	}

	protected function render() {
		$atts = $this->get_settings_for_display();
		if ( ! empty( $atts['category_ids'] ) && is_array( $atts['category_ids'] ) ) {
			$atts['category_ids'] = sanitize_text_field( implode( ',', $atts['category_ids'] ) );
		}
		require alpha_core_framework_path( ALPHA_CORE_FRAMEWORK_PATH . '/widgets/categories/render-categories.php' );
	}

	protected function content_template() {}
}
