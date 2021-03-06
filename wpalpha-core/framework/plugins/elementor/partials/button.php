<?php
/**
 * Button Partial
 *
 * @author     FunnyWP
 * @package    WP Alpha Core FrameWork
 * @subpackage Core
 * @since      1.0
 */
defined( 'ABSPATH' ) || die;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

/**
 * Register elementor layout controls for button.
 *
 * @since 1.0
 */
if ( ! function_exists( 'alpha_elementor_button_layout_controls' ) ) {
	function alpha_elementor_button_layout_controls( $self, $condition_key = '', $condition_value = 'yes', $name_prefix = '', $repeater = false ) {

		$left  = is_rtl() ? 'right' : 'left';
		$right = 'left' == $left ? 'right' : 'left';

		$self->add_control(
			$name_prefix . 'button_type',
			array(
				'label'     => esc_html__( 'Type', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''             => esc_html__( 'Default', 'alpha-core' ),
					'btn-gradient' => esc_html__( 'Gradient', 'alpha-core' ),
					'btn-solid'    => esc_html__( 'Solid', 'alpha-core' ),
					'btn-outline'  => esc_html__( 'Outline', 'alpha-core' ),
					'btn-link'     => esc_html__( 'Link', 'alpha-core' ),
				),
				'condition' => $condition_key ? array( $condition_key => $condition_value ) : '',
			)
		);

		$self->add_control(
			$name_prefix . 'button_size',
			array(
				'label'     => esc_html__( 'Size', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					'btn-sm' => esc_html__( 'Small', 'alpha-core' ),
					'btn-md' => esc_html__( 'Medium', 'alpha-core' ),
					''       => esc_html__( 'Normal', 'alpha-core' ),
					'btn-lg' => esc_html__( 'Large', 'alpha-core' ),
				),
				'condition' => $condition_key ? array( $condition_key => $condition_value ) : '',
			)
		);

		$self->add_control(
			$name_prefix . 'link_hover_type',
			array(
				'label'     => esc_html__( 'Hover Underline', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''                 => esc_html__( 'None', 'alpha-core' ),
					'btn-underline sm' => esc_html__( 'Underline1', 'alpha-core' ),
					'btn-underline '   => esc_html__( 'Underline2', 'alpha-core' ),
					'btn-underline lg' => esc_html__( 'Underline3', 'alpha-core' ),
				),
				'condition' => $condition_key ? array(
					$condition_key               => $condition_value,
					$name_prefix . 'button_type' => 'btn-link',
				) : array(
					$name_prefix . 'button_type' => 'btn-link',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'shadow',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Box Shadow', 'alpha-core' ),
				'default'   => '',
				'options'   => array(
					''              => esc_html__( 'None', 'alpha-core' ),
					'btn-shadow-sm' => esc_html__( 'Shadow 1', 'alpha-core' ),
					'btn-shadow'    => esc_html__( 'Shadow 2', 'alpha-core' ),
					'btn-shadow-lg' => esc_html__( 'Shadow 3', 'alpha-core' ),
				),
				'condition' => $condition_key ? array(
					$condition_key                => $condition_value,
					$name_prefix . 'button_type!' => array( 'btn-link', 'btn-outline' ),
				) : array(
					$name_prefix . 'button_type!' => array( 'btn-link', 'btn-outline' ),
				),
			)
		);

		$self->add_control(
			$name_prefix . 'button_border',
			array(
				'label'     => esc_html__( 'Border Style', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''            => esc_html__( 'Square', 'alpha-core' ),
					'btn-rounded' => esc_html__( 'Rounded', 'alpha-core' ),
					'btn-ellipse' => esc_html__( 'Ellipse', 'alpha-core' ),
				),
				'condition' => $condition_key ? array(
					$condition_key                => $condition_value,
					$name_prefix . 'button_type!' => 'btn-link',
				) : array(
					$name_prefix . 'button_type!' => 'btn-link',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'button_skin',
			array(
				'label'     => esc_html__( 'Skin', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'btn-primary',
				'options'   => array(
					''              => esc_html__( 'Default', 'alpha-core' ),
					'btn-primary'   => esc_html__( 'Primary', 'alpha-core' ),
					'btn-secondary' => esc_html__( 'Secondary', 'alpha-core' ),
					'btn-warning'   => esc_html__( 'Warning', 'alpha-core' ),
					'btn-danger'    => esc_html__( 'Danger', 'alpha-core' ),
					'btn-success'   => esc_html__( 'Success', 'alpha-core' ),
					'btn-dark'      => esc_html__( 'Dark', 'alpha-core' ),
					'btn-white'     => esc_html__( 'White', 'alpha-core' ),
				),
				'condition' => $condition_key ? array(
					$condition_key                => $condition_value,
					$name_prefix . 'button_type!' => 'btn-gradient',
				) : array(
					$name_prefix . 'button_type!' => 'btn-gradient',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'button_gradient_skin',
			array(
				'label'       => esc_html__( 'Skin', 'alpha-core' ),
				'description' => esc_html__( 'Choose gradient color skin of gradient buttons.', 'alpha-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'btn-gra-default',
				'options'     => array(
					'btn-gra-default' => esc_html__( 'Default', 'alpha-core' ),
					'btn-gra-blue'    => esc_html__( 'Blue', 'alpha-core' ),
					'btn-gra-orange'  => esc_html__( 'Orange', 'alpha-core' ),
					'btn-gra-pink'    => esc_html__( 'Pink', 'alpha-core' ),
					'btn-gra-green'   => esc_html__( 'Green', 'alpha-core' ),
					'btn-gra-dark'    => esc_html__( 'Dark', 'alpha-core' ),
				),
				'condition'   => $condition_key ? array(
					$condition_key               => $condition_value,
					$name_prefix . 'button_type' => 'btn-gradient',
				) : array(
					$name_prefix . 'button_type' => 'btn-gradient',
				),
			)
		);

		if ( ALPHA_NAME . '_widget_button' == $self->get_name() ) {
			$self->add_control(
				$name_prefix . 'line_break',
				array(
					'label'     => esc_html__( 'Disable Line-break', 'alpha-core' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'nowrap',
					'options'   => array(
						'nowrap' => array(
							'title' => esc_html__( 'On', 'alpha-core' ),
							'icon'  => 'eicon-h-align-right',
						),
						'normal' => array(
							'title' => esc_html__( 'Off', 'alpha-core' ),
							'icon'  => 'eicon-v-align-bottom',
						),
					),
					'selectors' => array(
						'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' . ( $name_prefix ? '.btn-' . $name_prefix : '' ) . ' span' => 'white-space: {{VALUE}};',
					),
					'condition' => $condition_key ? array( $condition_key => $condition_value ) : '',
				)
			);

			$self->add_control(
				$name_prefix . 'btn_class',
				array(
					'label'     => esc_html__( 'Custom Class', 'alpha-core' ),
					'type'      => Controls_Manager::TEXT,
					'condition' => $condition_key ? array( $condition_key => $condition_value ) : '',
				)
			);
		}

		$self->add_control(
			$name_prefix . 'show_icon',
			array(
				'label'     => esc_html__( 'Show Icon?', 'alpha-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => $condition_key ? array( $condition_key => $condition_value ) : '',
			)
		);

			$self->add_control(
				$name_prefix . 'show_label',
				array(
					'label'     => esc_html__( 'Show Label?', 'alpha-core' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => $condition_key ? array(
						$condition_key                => $condition_value,
						$name_prefix . 'show_icon'    => 'yes',
						$name_prefix . 'icon[value]!' => '',
					) : array(
						$name_prefix . 'show_icon'    => 'yes',
						$name_prefix . 'icon[value]!' => '',
					),
				)
			);

		$self->add_control(
			$name_prefix . 'icon',
			array(
				'label'     => esc_html__( 'Icon', 'alpha-core' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => ALPHA_ICON_PREFIX . '-icon-long-arrow-right',
					'library' => 'alpha-icons',
				),
				'condition' => $condition_key ? array(
					$condition_key             => $condition_value,
					$name_prefix . 'show_icon' => 'yes',
				) : array(
					$name_prefix . 'show_icon' => 'yes',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'icon_pos',
			array(
				'label'     => esc_html__( 'Icon Position', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After', 'alpha-core' ),
					'before' => esc_html__( 'Before', 'alpha-core' ),
				),
				'condition' => $condition_key ? array(
					$condition_key             => $condition_value,
					$name_prefix . 'show_icon' => 'yes',
				) : array(
					$name_prefix . 'show_icon' => 'yes',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'icon_hover_effect_infinite',
			array(
				'label'     => esc_html__( 'Animation Infinite', 'alpha-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => $condition_key ? array(
					$condition_key                      => $condition_value,
					$name_prefix . 'show_icon'          => 'yes',
					$name_prefix . 'icon_hover_effect!' => array( '', 'btn-reveal-left', 'btn-reveal-right' ),
				) : array(
					$name_prefix . 'show_icon'          => 'yes',
					$name_prefix . 'icon_hover_effect!' => array( '', 'btn-reveal-left', 'btn-reveal-right' ),
				),
			)
		);

		$self->add_control(
			$name_prefix . 'icon_hover_effect',
			array(
				'label'     => esc_html__( 'Icon Hover Effect', 'alpha-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''                 => esc_html__( 'none', 'alpha-core' ),
					'btn-slide-left'   => esc_html__( 'Slide Left', 'alpha-core' ),
					'btn-slide-right'  => esc_html__( 'Slide Right', 'alpha-core' ),
					'btn-slide-up'     => esc_html__( 'Slide Up', 'alpha-core' ),
					'btn-slide-down'   => esc_html__( 'Slide Down', 'alpha-core' ),
					'btn-reveal-left'  => esc_html__( 'Reveal Left', 'alpha-core' ),
					'btn-reveal-right' => esc_html__( 'Reveal Right', 'alpha-core' ),
				),
				'condition' => $condition_key ? array(
					$condition_key             => $condition_value,
					$name_prefix . 'show_icon' => 'yes',
				) : array(
					$name_prefix . 'show_icon' => 'yes',
				),
			)
		);
	}
}


/**
 * Register elementor style controls for button.
 *
 * @since 1.0
 */
if ( ! function_exists( 'alpha_elementor_button_style_controls' ) ) {
	function alpha_elementor_button_style_controls( $self, $name_prefix = '', $repeater = false ) {
		$left  = is_rtl() ? 'right' : 'left';
		$right = 'left' == $left ? 'right' : 'left';
		$self->start_controls_section(
			$name_prefix . 'section_button_style',
			array(
				'label' => esc_html__( 'Button Style', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$self->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => $name_prefix . 'button_typography',
				'label'    => esc_html__( 'Label Typography', 'alpha-core' ),
				'selector' => '.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn',
			)
		);

		$self->add_responsive_control(
			$name_prefix . 'btn_min_width',
			array(
				'label'      => esc_html__( 'Min Width', 'alpha-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 50,
					),
				),
				'size_units' => array(
					'px',
					'%',
					'rem',
				),
				'selectors'  => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$self->add_responsive_control(
			$name_prefix . 'btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'alpha-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array(
					'px',
					'%',
					'em',
				),
				'selectors'  => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$self->add_responsive_control(
			$name_prefix . 'btn_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'alpha-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array(
					'px',
					'%',
					'em',
				),
				'selectors'  => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$self->add_responsive_control(
			$name_prefix . 'btn_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'alpha-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array(
					'px',
					'%',
					'em',
				),
				'selectors'  => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; border-style: solid;',
				),
			)
		);

		$self->start_controls_tabs( $name_prefix . 'tabs_btn_cat' );

		$self->start_controls_tab(
			$name_prefix . 'tab_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'alpha-core' ),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_color',
			array(
				'label'     => esc_html__( 'Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'color: {{VALUE}};',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_back_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn' => 'border-color: {{VALUE}};',
				),
			)
		);

		$self->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => $name_prefix . 'btn_box_shadow',
				'selector' => '.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn',
			)
		);

		$self->end_controls_tab();

		$self->start_controls_tab(
			$name_prefix . 'tab_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'alpha-core' ),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_color_hover',
			array(
				'label'     => esc_html__( 'Hover Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_back_color_hover',
			array(
				'label'     => esc_html__( 'Hover Background Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_border_color_hover',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$self->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => $name_prefix . 'btn_box_shadow_hover',
				'label'    => esc_html__( 'Hover Box Shadow', 'alpha-core' ),
				'selector' => '.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:hover',
			)
		);

		$self->end_controls_tab();

		$self->start_controls_tab(
			$name_prefix . 'tab_btn_active',
			array(
				'label' => esc_html__( 'Active', 'alpha-core' ),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_color_active',
			array(
				'label'     => esc_html__( 'Active Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:not(:focus):active, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_back_color_active',
			array(
				'label'     => esc_html__( 'Active Background Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:not(:focus):active, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'btn_border_color_active',
			array(
				'label'     => esc_html__( 'Active Border Color', 'alpha-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:not(:focus):active, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$self->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => $name_prefix . 'btn_box_shadow_active',
				'label'    => esc_html__( 'Active Box Shadow', 'alpha-core' ),
				'selector' => '.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:active, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn:focus',
			)
		);

		$self->end_controls_tab();

		$self->end_controls_tabs();

		$self->end_controls_section();

		$self->start_controls_section(
			$name_prefix . 'section_button_icon_style',
			array(
				'label'     => esc_html__( 'Button Icon Style', 'alpha-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					$name_prefix . 'show_icon' => 'yes',
				),
			)
		);

		$self->add_control(
			$name_prefix . 'icon_space',
			array(
				'label'     => esc_html__( 'Icon Spacing (px)', 'alpha-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 30,
					),
				),
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn-icon-left:not(.btn-reveal-left)' . ( $name_prefix ? '.btn-' . $name_prefix : '' ) . ' i' => "margin-{$right}: {{SIZE}}px; margin-{$left}: 0;",
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ' .btn-icon-right:not(.btn-reveal-right)' . ( $name_prefix ? '.btn-' . $name_prefix : '' ) . ' i'  => "margin-{$left}: {{SIZE}}px;",
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : ' ' ) . '.btn-reveal-left:hover i, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : ' ' ) . '.btn-reveal-left:active i, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : ' ' ) . '.btn-reveal-left:focus i'  => "margin-{$right}: {{SIZE}}px;",
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : ' ' ) . '.btn-reveal-right:hover i, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : ' ' ) . '.btn-reveal-right:active i, .elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : ' ' ) . '.btn-reveal-right:focus i'  => "margin-{$left}: {{SIZE}}px;",
				),
			)
		);

		$self->add_control(
			$name_prefix . 'icon_size',
			array(
				'label'     => esc_html__( 'Icon Size (px)', 'alpha-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 50,
					),
				),
				'selectors' => array(
					'.elementor-element-{{ID}}' . ( $repeater ? ' {{CURRENT_ITEM}}' : '' ) . ( $name_prefix ? ' .btn-' . $name_prefix : '' ) . ' i' => 'font-size: {{SIZE}}px;',
				),
			)
		);

		$self->end_controls_section();
	}
}

function alpha_elementor_button_template() {
	?>
	function alpha_widget_button_get_class(settings, prefix = '') {
		var ret = [];
		if ( prefix ) {
			ret.push( 'btn-' + prefix );
		}
		if ( settings[ prefix + 'button_type' ] ) {
			ret.push( settings[ prefix + 'button_type' ] );
		}
		if ( settings[ prefix + 'link_hover_type' ] ) {
			ret.push( settings[ prefix + 'link_hover_type' ] );
		}
		if ( settings[ prefix + 'button_size' ] ) {
			ret.push( settings[ prefix + 'button_size' ] );
		}
		if ( settings[ prefix + 'shadow' ] ) {
			ret.push( settings[ prefix + 'shadow' ] );
		}
		if ( settings[ prefix + 'button_border' ] ) {
			ret.push( settings[ prefix + 'button_border' ] );
		}
		if ( ( ! settings[ prefix + 'button_type' ] || 'btn-gradient' != settings[ prefix + 'button_type' ] ) && settings[ prefix + 'button_skin' ]  ) {
			ret.push( settings[ prefix + 'button_skin' ] );
		}
		if ( settings[ prefix + 'button_type' ] && 'btn-gradient' == settings[ prefix + 'button_type' ] && settings[ prefix + 'button_gradient_skin' ] ) {
			ret.push( settings[ prefix + 'button_gradient_skin' ] );
		}
		if ( settings[ prefix + 'btn_class' ] ) {
			ret.push( settings[ prefix + 'btn_class' ] );
		}
		if ( 'yes' == settings[ prefix + 'icon_hover_effect_infinite' ] ) {
			ret.push( 'btn-infinite' );
		}

		if ( settings[ prefix + 'icon' ] && settings[ prefix + 'icon' ]['value'] ) {
			if ( settings[ prefix + 'show_label' ] && ! settings[ prefix + 'show_label' ] ) {
				ret.push( 'btn-icon' );
			} else if ( 'before' == settings[ prefix + 'icon_pos' ] ) {
				ret.push( 'btn-icon-left' );
			} else {
				ret.push( 'btn-icon-right' );
			}
			if ( settings[ prefix + 'icon_hover_effect' ] ) {
				ret.push( settings[ prefix + 'icon_hover_effect' ] );
			}
		}
		return ret;
	}

	function alpha_widget_button_get_label( settings, self, label, inline_key = '', prefix = '' ) {
		label = '<span' +  ( inline_key ? ( ' ' + self.getRenderAttributeString( inline_key ) ) : '' ) + '>' + label + '</span>';
		if (  'yes' == settings[ prefix + 'show_icon' ] && settings[ prefix + 'icon' ] && settings[ prefix + 'icon' ]['value'] ) {
			if ( 'yes' != settings[ prefix + 'show_label' ] ) {
				label = '<i class="' + settings[ prefix + 'icon' ]['value'] + '"></i>';
			} else if ( 'before' == settings[ prefix + 'icon_pos' ] ) {
				label = '<i class="' + settings[ prefix + 'icon' ]['value'] + '"></i>' + label;
			} else {
				label += '<i class="' + settings[ prefix + 'icon' ]['value'] + '"></i>';
			}
		}
		return label;
	}
	<?php
}

