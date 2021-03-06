<?php
/**
 * Alpha Elementor Single Product Share Widget
 *
 * @author     FunnyWP
 * @package    Alpha Core Framework
 * @subpackage Core
 * @since      1.0
 */
defined( 'ABSPATH' ) || die;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class Alpha_Single_Product_Share_Elementor_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return ALPHA_NAME . '_sproduct_share';
	}

	public function get_title() {
		return esc_html__( 'Product Share', 'alpha-core' );
	}

	public function get_icon() {
		return 'alpha-elementor-widget-icon eicon-share';
	}

	public function get_categories() {
		return array( 'alpha_single_product_widget' );
	}

	public function get_keywords() {
		return array( 'single', 'custom', 'layout', 'product', 'woocommerce', 'shop', 'store', 'share' );
	}

	public function get_script_depends() {
		$depends = array();
		if ( alpha_is_elementor_preview() ) {
			$depends[] = 'alpha-elementor-js';
		}
		return $depends;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_product_share',
			array(
				'label' => esc_html__( 'Style', 'alpha-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_control(
				'sp_size',
				array(
					'type'      => Controls_Manager::SLIDER,
					'label'     => esc_html__( 'Size', 'alpha-core' ),
					'range'     => array(
						'px' => array(
							'step' => 1,
							'min'  => 1,
							'max'  => 40,
						),
					),
					'selectors' => array(
						'.elementor-element-{{ID}} .social-icons > .social-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: 2.5em; height: 2.5em;',
					),
				)
			);

			$this->start_controls_tabs( 'sp_tabs' );
				$this->start_controls_tab(
					'sp_normal_tab',
					array(
						'label' => esc_html__( 'Normal', 'alpha-core' ),
					)
				);

					$this->add_control(
						'sp_normal_color',
						array(
							'label'     => esc_html__( 'Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .social-icons > .social-icon' => 'color: {{VALUE}};',
							),
						)
					);

					$this->add_control(
						'sp_normal_bg_color',
						array(
							'label'     => esc_html__( 'Background Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .social-icons > .social-icon' => 'background-color: {{VALUE}};',
							),
						)
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						array(
							'name'     => 'sp_normal_border',
							'selector' => '.elementor-element-{{ID}} .social-icons > .social-icon',
						)
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'sp_hover_tab',
					array(
						'label' => esc_html__( 'Hover', 'alpha-core' ),
					)
				);

					$this->add_control(
						'sp_hover_color',
						array(
							'label'     => esc_html__( 'Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .social-icons > .social-icon:hover' => 'color: {{VALUE}};',
							),
						)
					);

					$this->add_control(
						'sp_hover_bg_color',
						array(
							'label'     => esc_html__( 'Background Color', 'alpha-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'.elementor-element-{{ID}} .social-icons > .social-icon:hover' => 'color: {{VALUE}};',
							),
						)
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						array(
							'name'     => 'sp_hover_border',
							'selector' => '.elementor-element-{{ID}} .social-icons > .social-icon:hover',
						)
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'sp_align',
				array(
					'label'     => esc_html__( 'Align', 'alpha-core' ),
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
					'separator' => 'before',
					'selectors' => array(
						'.elementor-element-{{ID}} .social-icons' => 'justify-content: {{VALUE}};',
					),
				)
			);

		$this->end_controls_section();
	}

	protected function render() {
		if ( apply_filters( 'alpha_single_product_builder_set_preview', false ) ) {
			woocommerce_template_single_sharing();
			do_action( 'alpha_single_product_builder_unset_preview' );
		}
	}
}
