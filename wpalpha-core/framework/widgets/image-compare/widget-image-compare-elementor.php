<?php
defined( 'ABSPATH' ) || die;

/**
 * Alpha Highlight Widget
 *
 * Alpha Widget to display WC breadcrumb.
 *
 * @author     FunnyWP
 * @package    Alpha Core FrameWork
 * @subpackage Core
 * @since      1.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Box_Shadow;

class Alpha_Image_Compare_Elementor_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return ALPHA_NAME . '_widget_image_compare';
	}

	public function get_title() {
		return esc_html__( 'Image Compare', 'alpha-core' );
	}

	public function get_categories() {
		return array( 'alpha_widget' );
	}

	public function get_icon() {
		return 'alpha-elementor-widget-icon eicon-animated-headline';
	}

	public function get_keywords() {
		return array( 'image', 'compare', 'gallery', 'media', 'alpha' );
	}

	public function get_script_depends() {
		wp_register_script( 'alpha-image-compare', alpha_core_framework_uri( '/widgets/image-compare/image-compare' . ALPHA_JS_SUFFIX ), array( 'jquery-core' ), ALPHA_CORE_VERSION, true );
		return array( 'alpha-image-compare' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_images',
			array(
				'label' => esc_html__( 'Images', 'alpha-core' ),
			)
		);

		$this->add_control(
			'text_before',
			array(
				'label'   => esc_html__( 'Before Image Label', 'alpha-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Before', 'alpha-core' ),
			)
		);

		$this->add_control(
			'image_before',
			array(
				'label'   => esc_html__( 'Before Image', 'alpha-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'text_after',
			array(
				'label'   => esc_html__( 'After Image Label', 'alpha-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'After', 'alpha-core' ),
			)
		);

		$this->add_control(
			'image_after',
			array(
				'label'   => esc_html__( 'After Image', 'alpha-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image',
				'exclude' => array( 'custom' ),
				'default' => 'large',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			array(
				'label' => esc_html__( 'Settings', 'alpha-core' ),
			)
		);

		$this->add_control(
			'show_label',
			array(
				'label'   => esc_html__( 'Show Labels', 'alpha-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'labels_pos',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Labels Position', 'alpha-core' ),
				'default'   => 'center',
				'options'   => array(
					'center'  => esc_html__( 'Image Centered', 'alpha-core' ),
					'stretch' => esc_html__( 'Image Up & Down', 'alpha-core' ),
				),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'direction',
			array(
				'label'   => esc_html__( 'Direction', 'alpha-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => array(
						'title' => esc_html__( 'Horizontal', 'alpha-core' ),
						'icon'  => 'eicon-h-align-stretch',
					),
					'vertical'   => array(
						'title' => esc_html__( 'Vertical', 'alpha-core' ),
						'icon'  => 'eicon-v-align-stretch',
					),
				),
				'toggle'  => false,
			)
		);

		$this->add_control(
			'handle_type',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Handle Type', 'alpha-core' ),
				'default' => 'rect',
				'options' => array(
					'none'    => esc_html__( 'None', 'alpha-core' ),
					'line'    => esc_html__( 'Line', 'alpha-core' ),
					'circle'  => esc_html__( 'Circle', 'alpha-core' ),
					'rect'    => esc_html__( 'Rectangle', 'alpha-core' ),
					'arrow'   => esc_html__( 'Arrow', 'alpha-core' ),
					'diamond' => esc_html__( 'Diamond', 'alpha-core' ),
				),
			)
		);

		$this->add_control(
			'handle_control',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Handle Control', 'alpha-core' ),
				'default' => 'drag_click',
				'options' => array(
					'drag'       => esc_html__( 'Drag', 'alpha-core' ),
					'drag_click' => esc_html__( 'Drag & Click', 'alpha-core' ),
					'hover'      => esc_html__( 'Hover', 'alpha-core' ),
				),
			)
		);

		$this->add_control(
			'handle_offset',
			array(
				'label'      => esc_html__( 'Handle Offset', 'alpha-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'step' => 1,
						'min'  => 0,
						'max'  => 100,
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_images_style',
			array(
				'label' => esc_html__( 'Image Compare', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_heading',
			array(
				'label' => esc_html__( 'Image', 'alpha-core' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'alpha-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.elementor-element-{{ID}} .icomp-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden',
				),
			)
		);

		$this->add_control(
			'handle_heading',
			array(
				'label'     => esc_html__( 'Handle', 'alpha-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'handle_size',
			array(
				'label'      => esc_html__( 'Handle Size', 'alpha-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'.elementor-element-{{ID}} .icomp-handle' => 'font-size: {{SIZE}}px;',
					'.elementor-element-{{ID}} .icomp-handle:before, .elementor-element-{{ID}} .icomp-handle:after' => 'border-width: {{SIZE}}px',
				),
			)
		);

		$this->add_control(
			'handle_color',
			array(
				'label'     => esc_html__( 'Handle Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}} .icomp-handle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'handle_bg_color',
			array(
				'label'     => esc_html__( 'Handle Background Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}} .icomp-handle:before, .elementor-element-{{ID}} .icomp-handle:after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'handle_type' => array( 'line', 'circle', 'rect' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'handle_box_shadow',
				'selector' => '.elementor-element-{{ID}} .icomp-handle',
			)
		);

		$this->add_control(
			'text_heading',
			array(
				'label'     => esc_html__( 'Label', 'alpha-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}} .icomp-overlay>div:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'text_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}} .icomp-overlay>div:before' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_typo',
				'selector'  => '.elementor-element-{{ID}} .icomp-overlay>div:before',
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$atts = $this->get_settings_for_display();
		require ALPHA_CORE_FRAMEWORK_PATH . '/widgets/image-compare/render-image-compare-elementor.php';
	}

	protected function content_template() {
		?>
		<div class="icomp-container icomp-{{{  ( 'circle' == settings.handle_type || 'rect' == settings.handle_type ) ? ( settings.handle_type + ' icomp-arrow icomp-has-bg' ) : settings.handle_type }}} icomp-labels-{{{ settings.labels_pos }}}" data-icomp-options="{'before_label':'{{{ settings.text_before }}}','after_label': '{{{ settings.text_after }}}','orientation': '{{{ 'vertical' == settings.direction ? 'vertical' : 'horizontal' }}}','no_overlay': '{{{ settings.show_label ? '' : 1 }}}','click_to_move': {{{ 'drag_click' == settings.handle_control ? true : false }}},'move_with_handle_only': {{{ 'drag' == settings.handle_control ? true : false }}},'move_slider_on_hover': {{{ 'hover' == settings.handle_control ? true : false }}},'default_offset_pct': {{{ '' !== settings.handle_offset.size ? settings.handle_offset.size / 100 : 0.5 }}}}">
			<#
			var image_before = {
				id: settings.image_before.id,
				url: settings.image_before.url,
				size: settings.image_size,
				model: view.getEditModel()
			};
			var image_before_url = elementor.imagesManager.getImageUrl( image_before );

			var image_after = {
				id: settings.image_after.id,
				url: settings.image_after.url,
				size: settings.image_size,
				model: view.getEditModel()
			};
			var image_after_url = elementor.imagesManager.getImageUrl( image_after );

			if ( image_before_url && image_after_url ) {
				#>
				<img src="{{ image_before_url }}"/>
				<img src="{{ image_after_url }}"/>
				<#
			}
			#>
		</div>
		<?php
	}
}
