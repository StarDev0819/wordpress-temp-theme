<?php
defined( 'ABSPATH' ) || die;

/**
 * Alpha Image Gallery Widget
 *
 * Alpha Widget to display image.
 *
 * @author     FunnyWP
 * @package    WP Alpha Core FrameWork
 * @subpackage Core
 * @since      1.0
 */

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

class Alpha_Image_Gallery_Elementor_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return ALPHA_NAME . '_widget_imagegallery';
	}

	public function get_title() {
		return esc_html__( 'Image Gallery', 'alpha-core' );
	}

	public function get_icon() {
		return 'alpha-elementor-widget-icon eicon-slider-push';
	}

	public function get_categories() {
		return array( 'alpha_widget' );
	}

	public function get_keywords() {
		return array( 'image', 'slider', 'carousel', 'gallery', 'grid' );
	}

	public function get_script_depends() {
		return array( 'swiper' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_image_carousel',
			array(
				'label' => esc_html__( 'Images', 'alpha-core' ),
			)
		);

		$this->add_control(
			'images',
			array(
				'label'      => esc_html__( 'Add Images', 'alpha-core' ),
				'type'       => Controls_Manager::GALLERY,
				'default'    => array(),
				'show_label' => false,
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'separator' => 'none',
				'exclude'   => [ 'custom' ],
			)
		);

		$this->add_control(
			'caption_type',
			array(
				'label'   => esc_html__( 'Caption', 'alpha-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''            => esc_html__( 'None', 'alpha-core' ),
					'title'       => esc_html__( 'Title', 'alpha-core' ),
					'caption'     => esc_html__( 'Caption', 'alpha-core' ),
					'description' => esc_html__( 'Description', 'alpha-core' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			array(
				'label' => esc_html__( 'Layout', 'alpha-core' ),
			)
		);

		$this->add_control(
			'layout_type',
			array(
				'label'   => esc_html__( 'Layout', 'alpha-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'alpha-core' ),
					'slider'   => esc_html__( 'Slider', 'alpha-core' ),
					'creative' => esc_html__( 'Creative', 'alpha-core' ),
				),
			)
		);

		alpha_elementor_grid_layout_controls( $this, 'layout_type', true, 'has_rows' );

		$this->add_control(
			'slider_vertical_align',
			array(
				'label'     => esc_html__( 'Vertical Align', 'alpha-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'top'         => array(
						'title' => esc_html__( 'Top', 'alpha-core' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle'      => array(
						'title' => esc_html__( 'Middle', 'alpha-core' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom'      => array(
						'title' => esc_html__( 'Bottom', 'alpha-core' ),
						'icon'  => 'eicon-v-align-bottom',
					),
					'same-height' => array(
						'title' => esc_html__( 'Stretch', 'alpha-core' ),
						'icon'  => 'eicon-v-align-stretch',
					),
				),
				'condition' => array(
					'layout_type' => 'slider',
				),
			)
		);

		$this->add_control(
			'slider_image_expand',
			array(
				'label'     => esc_html__( 'Image Full Width', 'alpha-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'layout_type' => 'slider',
				),
			)
		);

		$this->add_control(
			'slider_horizontal_align',
			array(
				'label'     => esc_html__( 'Horizontal Align', 'alpha-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'alpha-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'alpha-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'alpha-core' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'.elementor-element-{{ID}} .slider-slide figure' => 'justify-content:{{VALUE}}',
				),
				'condition' => array(
					'slider_image_expand' => '',
					'layout_type'         => 'slider',
				),
			)
		);

		$this->add_control(
			'grid_vertical_align',
			array(
				'label'     => esc_html__( 'Vertical Align', 'alpha-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'alpha-core' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => esc_html__( 'Middle', 'alpha-core' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Bottom', 'alpha-core' ),
						'icon'  => 'eicon-v-align-bottom',
					),
					'stretch'    => array(
						'title' => esc_html__( 'Stretch', 'alpha-core' ),
						'icon'  => 'eicon-v-align-stretch',
					),
				),
				'selectors' => array(
					'.elementor-element-{{ID}} figure' => 'display: flex; align-items:{{VALUE}};',
				),
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_control(
			'grid_image_expand',
			array(
				'label'     => esc_html__( 'Image Full Width', 'alpha-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => array(
					'.elementor-element-{{ID}} .image-wrap img' => 'width: 100%;',
				),
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_control(
			'grid_horizontal_align',
			array(
				'label'     => esc_html__( 'Horizontal Align', 'alpha-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'alpha-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'alpha-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'alpha-core' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'.elementor-element-{{ID}} figure' => 'display: flex; justify-content:{{VALUE}}',
				),
				'condition' => array(
					'grid_image_expand' => '',
					'layout_type'       => 'grid',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'gallery_style',
			array(
				'label' => esc_html__( 'Image', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'img_max_height',
			array(
				'label'      => esc_html__( 'Max Width', 'alpha-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array(
					'px',
					'rem',
					'%',
					'vh',
				),
				'selectors'  => array(
					'.elementor-element-{{ID}} img' => 'max-width:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'gallery_image_border',
			array(
				'label'      => esc_html__( 'Border Radius', 'alpha-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'rem', '%' ),
				'selectors'  => array(
					'.elementor-element-{{ID}} .image-gallery img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		alpha_elementor_slider_style_controls( $this, 'layout_type' );
	}

	protected function render() {
		$atts = $this->get_settings_for_display();
		require alpha_core_framework_path( ALPHA_CORE_FRAMEWORK_PATH . '/widgets/image-gallery/render-image-gallery-elementor.php' );
	}
}
