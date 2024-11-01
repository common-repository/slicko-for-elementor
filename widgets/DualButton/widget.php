<?php
namespace Slicko_Addons\Widgets;
if ( ! defined( 'ABSPATH' ) ) exit;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
class Slicko_Dual_Button extends Widget_Base {
	public function get_name() {
		return 'slicko-dual-button';
	}
	public function get_title() {
		return esc_html__( 'Dual Button', 'slicko-addons' );
	}
	public function get_icon() {
		return 'eicon-dual-button';
	}
	public function get_categories() {
		return [ 'slicko-addons' ];
	}
    public function get_keywords() {
        return [ 'slicko', 'multiple', 'dual', 'anchor', 'link', 'btn', 'double' ];
    }
	protected function register_controls() {
        /*
        * Slicko Dual Button Content
        */
        $this->start_controls_section(
            'slicko_content_section',
            [
                'label' => esc_html__( 'Content', 'slicko-addons' )
            ]
        );
        $this->start_controls_tabs( 'slicko_dual_button_content_tabs' );
            $this->start_controls_tab( 'slicko_dual_button_primary_button_content', [ 'label' => esc_html__( 'Primary', 'slicko-addons' ) ] );
                $this->add_control(
                    'slicko_dual_button_primary_button_text',
                    [
                        'label'       => esc_html__( 'Text', 'slicko-addons' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'VIEW DEMO', 'slicko-addons' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_url',
                    [
                        'label'         => esc_html__( 'Link', 'slicko-addons' ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'placeholder'   => __( 'https://your-link.com', 'slicko-addons' ),
                        'show_external' => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => true
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_icon',
                    [
                        'label'   => esc_html__( 'Icon', 'slicko-addons' ),
                        'type'    => Controls_Manager::ICONS,
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_icon_position',
                    [
                        'label'     => __( 'Icon Position', 'slicko-addons' ),
                        'type'      => Controls_Manager::CHOOSE,
                        'toggle'    => false,
                        'options'   => [
                            'slicko-icon-pos-left'  => [
                                'title' => __( 'Left', 'slicko-addons' ),
                                'icon'  => 'eicon-angle-left'
                            ],
                            'slicko-icon-pos-right' => [
                                'title' => __( 'Right', 'slicko-addons' ),
                                'icon'  => 'eicon-angle-right'
                            ]
                        ],
                        'default'   => 'slicko-icon-pos-left',
                        'condition' => [
                            'slicko_dual_button_primary_button_icon[value]!' => ''
                        ]
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab( 'slicko_dual_button_connector_content', [ 'label' => esc_html__( 'Connector', 'slicko-addons' ) ] );
                $this->add_control(
                    'slicko_dual_button_connector_switch',
                    [
                        'label'        => esc_html__( 'Connector Show/Hide', 'slicko-addons' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __( 'Show', 'slicko-addons' ),
                        'label_off'    => __( 'Hide', 'slicko-addons' ),
                        'return_value' => 'yes',
                        'default'      => 'no'
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_connector_type',
                    [
                        'label'     => esc_html__( 'Type', 'slicko-addons' ),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'icon',
                        'options'   => [
                            'icon'  => __( 'Icon', 'slicko-addons' ),
                            'text'  => __( 'Text', 'slicko-addons' )
                        ],
                        'condition' => [
                            'slicko_dual_button_connector_switch' => 'yes'
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_connector_text',
                    [
                        'label'     => esc_html__( 'Text', 'slicko-addons' ),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => esc_html__( 'OR', 'slicko-addons' ),
                        'condition' => [
                            'slicko_dual_button_connector_switch' => 'yes',
                            'slicko_dual_button_connector_type'   => 'text'
                        ],
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_connector_icon',
                    [
                        'label'       => esc_html__( 'Icon', 'slicko-addons' ),
                        'type'        => Controls_Manager::ICONS,
                        'default'     => [
                            'value'   => 'fas fa-star',
                            'library' => 'fa-solid'
                        ],
                        'condition'   => [
                            'slicko_dual_button_connector_switch' => 'yes',
                            'slicko_dual_button_connector_type'   => 'icon'
                        ]
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab( 'slicko_dual_button_secondary_button_content', [ 'label' => esc_html__( 'Secondary', 'slicko-addons' ) ] );
                $this->add_control(
                    'slicko_dual_button_secondary_button_text',
                    [
                        'label'       => esc_html__( 'Text', 'slicko-addons' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'ORDER NOW', 'slicko-addons' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_url',
                    [
                        'label'         => esc_html__( 'Link', 'slicko-addons' ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'placeholder'   => __( 'https://your-link.com', 'slicko-addons' ),
                        'show_external' => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => true
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_icon',
                    [
                        'label'   => esc_html__( 'Icon', 'slicko-addons' ),
                        'type'    => Controls_Manager::ICONS,
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_icon_position',
                    [
                        'label'     => __( 'Icon Position', 'slicko-addons' ),
                        'type'      => Controls_Manager::CHOOSE,
                        'toggle'    => false,
                        'options'   => [
                            'slicko-icon-pos-left'  => [
                                'title' => __( 'Left', 'slicko-addons' ),
                                'icon'  => 'eicon-angle-left'
                            ],
                            'slicko-icon-pos-right' => [
                                'title' => __( 'Right', 'slicko-addons' ),
                                'icon'  => 'eicon-angle-right'
                            ]
                        ],
                        'default'   => 'slicko-icon-pos-left',
                        'condition' => [
                            'slicko_dual_button_secondary_button_icon[value]!' => ''
                        ]
                    ]
                );
            $this->end_controls_tab();
	    $this->end_controls_tabs();
        $this->end_controls_section();
        /*
        * Slicko Dual Button Container Style
        */
        $this->start_controls_section(
            'slicko_container_style_section',
            [
                'label' => esc_html__( 'Container', 'slicko-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'slicko_dual_button_container_alignment',
			[
                'label'   => __( 'Alignment', 'slicko-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
					'slicko-dual-button-align-left'   => [
                        'title' => __( 'Left', 'slicko-addons' ),
                        'icon'  => 'eicon-text-align-left'
					],
					'slicko-dual-button-align-center' => [
                        'title' => __( 'Center', 'slicko-addons' ),
                        'icon'  => 'eicon-text-align-center'
					],
					'slicko-dual-button-align-right'  => [
                        'title' => __( 'Right', 'slicko-addons' ),
                        'icon'  => 'eicon-text-align-right'
					]
				],
                'default' => 'slicko-dual-button-align-center'
			]
        );
        $this->add_responsive_control(
			'slicko_dual_button_container_button_margin',
			[
                'label'      => __( 'Space Between Buttons', 'slicko-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'     => [
						'min' => -3,
						'max' => 100
					]
                ],
                'default'  => [
					'unit' => 'px',
					'size' => 10
				],
				'selectors' => [
                    '{{WRAPPER}} .slicko-dual-button-primary'                             => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slicko-dual-button-primary .slicko-dual-button-connector' => 'right: calc( 0px - {{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .slicko-dual-button-secondary'                           => 'margin-left: {{SIZE}}{{UNIT}};'
				]
			]
		);
        $this->add_responsive_control(
			'slicko_dual_button_padding',
			[
                'label'      => __( 'Padding', 'slicko-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '12',
                    'right'    => '45',
                    'bottom'   => '12',
                    'left'     => '45',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .slicko-dual-button-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );
        $this->end_controls_section();
        /*
        * Slicko Dual Button Primary Button Style
        */
        $this->start_controls_section(
            'slicko_container_primary_button_style',
            [
                'label' => esc_html__( 'Primary Button', 'slicko-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs( 'slicko_dual_button_primary_button_tabs' );
            $this->start_controls_tab( 'slicko_dual_button_primary_button_noemal', [ 'label' => esc_html__( 'Normal', 'slicko-addons' ) ] );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'     => 'slicko_container_primary_button_typography',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-primary span'
                    ]
                );
                $this->add_responsive_control(
                    'slicko_dual_button_primary_button_icon_margin',
                    [
                        'label'       => __( 'Icon Space', 'slicko-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 3
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 10
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} .slicko-dual-button-primary .slicko-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .slicko-dual-button-primary .slicko-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
                        ],
                        'condition'   => [
                            'slicko_dual_button_primary_button_icon[value]!' => ''
                        ]
                    ]
                );
                $this->add_responsive_control(
                    'slicko_container_primary_button_padding',
                    [
                        'label'      => __( 'Padding', 'slicko-addons' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'default'    => [
                            'top'      => '',
                            'right'    => '',
                            'bottom'   => '',
                            'left'     => '',
                            'unit'     => 'px',
                            'isLinked' => false
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .slicko-dual-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
                $this->add_responsive_control(
                    'slicko_container_primary_button_margin',
                    [
                        'label'      => __( 'Margin', 'slicko-addons' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'default'    => [
                            'top'      => '',
                            'right'    => '',
                            'bottom'   => '',
                            'left'     => '',
                            'unit'     => 'px',
                            'isLinked' => false
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .slicko-dual-button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
                $this->add_responsive_control(
                    'slicko_dual_button_primary_button_radius',
                    [
                        'label'      => __( 'Border radius', 'slicko-addons' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'default'    => [
                            'top'    => '3',
                            'right'  => '3',
                            'bottom' => '3',
                            'left'   => '3',
                            'unit'   => 'px'
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .slicko-dual-button-primary,
                            {{WRAPPER}} .slicko-dual-button-primary.effect-1::before,
                            {{WRAPPER}} .slicko-dual-button-primary.effect-2::before,
                            {{WRAPPER}} .slicko-dual-button-primary.effect-3::before,
                            {{WRAPPER}} .slicko-dual-button-primary.effect-4::before,
                            {{WRAPPER}} .slicko-dual-button-primary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_normal_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-primary' => 'color: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_normal_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#4243DC',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-1' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-2' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-3' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-4' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-5' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-6' => 'background: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'slicko_dual_button_primary_button_normal_border',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-primary'
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'slicko_dual_button_primary_button_normal_box_shadow',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-primary'
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab( 'slicko_dual_button_primary_button_hover', [ 'label' => esc_html__( 'Hover', 'slicko-addons' ) ] );
                $this->add_control(
                    'slicko_dual_button_primary_button_animation',
                    [
                        'label'   => esc_html__( 'Hover Effect', 'slicko-addons' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'effect-5',
                        'options' => [
                            'effect-1' => __( 'Effect 1', 'slicko-addons' ),
                            'effect-2' => __( 'Effect 2', 'slicko-addons' ),
                            'effect-3' => __( 'Effect 3', 'slicko-addons' ),
                            'effect-4' => __( 'Effect 4', 'slicko-addons' ),
                            'effect-5' => __( 'Effect 5', 'slicko-addons' ),
                            'effect-6' => __( 'Effect 6', 'slicko-addons' )
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_hover_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-primary:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_primary_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#5543dc',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-1::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-2::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-3::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-4::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-5:hover'   => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-primary.effect-6::before' => 'background: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'slicko_dual_button_primary_button_hover_border',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-primary:hover'
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'slicko_dual_button_primary_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-primary:hover'
                    ]
                );
            $this->end_controls_tab();
	    $this->end_controls_tabs();
        $this->end_controls_section();
        /*
        * Slicko Dual Button Connector Style
        */
        $this->start_controls_section(
            'slicko_dual_button_connector_style',
            [
                'label'     => esc_html__( 'Connector', 'slicko-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slicko_dual_button_connector_switch' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'      => 'slicko_dual_button_connector_typoghrphy',
                'selector'  => '{{WRAPPER}} .slicko-dual-button-connector span',
                'condition' => [
                    'slicko_dual_button_connector_type' => 'text'
                ]
			]
        );
        $this->add_responsive_control(
			'slicko_dual_button_connector_icon_size',
			[
                'label'      => __( 'Icon Size', 'slicko-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 40
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 14
				],
				'selectors'  => [
					'{{WRAPPER}} .slicko-dual-button-connector span' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'slicko_dual_button_connector_type'         => 'icon',
                    'slicko_dual_button_connector_icon[value]!' => ''
                ]
			]
		);
        $this->add_control(
            'slicko_dual_button_connector_background',
            [
                'label'     => esc_html__( 'Background Color', 'slicko-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slicko-dual-button-connector' => 'background: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'slicko_dual_button_connector_color',
            [
                'label'     => esc_html__( 'Color', 'slicko-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-dual-button-connector span' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control(
			'slicko_dual_button_connector_height',
			[
                'label'      => __( 'Height', 'slicko-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'  => [
					'unit' => 'px',
					'size' => 30
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-dual-button-connector' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
        );
        $this->add_responsive_control(
			'slicko_dual_button_connector_width',
			[
                'label'      => __( 'Width', 'slicko-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 30
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-dual-button-connector' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
        $this->add_responsive_control(
			'slicko_dual_button_connector_radius',
			[
                'label'      => __( 'Border radius', 'slicko-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px'
                ],
				'selectors'  => [
					'{{WRAPPER}} .slicko-dual-button-connector' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'slicko_dual_button_connector_border',
                'selector' => '{{WRAPPER}} .slicko-dual-button-connector'
			]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'slicko_dual_button_connector_box_shadow',
                'selector' => '{{WRAPPER}} .slicko-dual-button-connector'
			]
		);
        $this->end_controls_section();
        /*
        * Slicko Dual Button secondary Button Style
        */
        $this->start_controls_section(
            'slicko_container_secondary_button_style',
            [
                'label' => esc_html__( 'Secondary Button', 'slicko-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs( 'slicko_dual_button_secondary_button_tabs' );
            $this->start_controls_tab( 'slicko_dual_button_secondary_button_noemal', [ 'label' => esc_html__( 'Normal', 'slicko-addons' ) ] );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'     => 'slicko_container_secondary_button_typography',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-secondary span'
                    ]
                );
                $this->add_responsive_control(
                    'slicko_dual_button_secondary_button_icon_margin',
                    [
                        'label'       => __( 'Icon Space', 'slicko-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 3
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 10
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} .slicko-dual-button-secondary .slicko-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary .slicko-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
                        ],
                        'condition'   => [
                            'slicko_dual_button_secondary_button_icon[value]!' => ''
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_normal_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-secondary' => 'color: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_normal_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#EF2469',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-1' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-2' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-3' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-4' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-5' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-6' => 'background: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'slicko_dual_button_secondary_button_normal_border',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-secondary'
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'slicko_dual_button_secondary_button_normal_box_shadow',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-secondary'
                    ]
                );
                $this->add_responsive_control(
                    'slicko_container_secondary_button_padding',
                    [
                        'label'      => __( 'Padding', 'slicko-addons' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'default'    => [
                            'top'      => '',
                            'right'    => '',
                            'bottom'   => '',
                            'left'     => '',
                            'unit'     => 'px',
                            'isLinked' => false
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .slicko-dual-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
                $this->add_responsive_control(
                    'slicko_container_secondary_button_margin',
                    [
                        'label'      => __( 'Margin', 'slicko-addons' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'default'    => [
                            'top'      => '',
                            'right'    => '',
                            'bottom'   => '',
                            'left'     => '',
                            'unit'     => 'px',
                            'isLinked' => false
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .slicko-dual-button-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
                $this->add_responsive_control(
                    'slicko_dual_button_secondary_button_radius',
                    [
                        'label'      => __( 'Border radius', 'slicko-addons' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'default'    => [
                            'top'    => '3',
                            'right'  => '3',
                            'bottom' => '3',
                            'left'   => '3',
                            'unit'   => 'px'
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .slicko-dual-button-secondary, {{WRAPPER}} .slicko-dual-button-secondary.effect-1::before, {{WRAPPER}} .slicko-dual-button-secondary.effect-2::before, {{WRAPPER}} .slicko-dual-button-secondary.effect-3::before, {{WRAPPER}} .slicko-dual-button-secondary.effect-4::before, {{WRAPPER}} .slicko-dual-button-secondary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab( 'slicko_dual_button_secondary_button_hover', [ 'label' => esc_html__( 'Hover', 'slicko-addons' ) ] );
                $this->add_control(
                    'slicko_dual_button_secondary_button_animation',
                    [
                        'label'   => esc_html__( 'Hover Effect', 'slicko-addons' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'effect-5',
                        'options' => [
                            'effect-1' => __( 'Effect 1', 'slicko-addons' ),
                            'effect-2' => __( 'Effect 2', 'slicko-addons' ),
                            'effect-3' => __( 'Effect 3', 'slicko-addons' ),
                            'effect-4' => __( 'Effect 4', 'slicko-addons' ),
                            'effect-5' => __( 'Effect 5', 'slicko-addons' ),
                            'effect-6' => __( 'Effect 6', 'slicko-addons' )
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_hover_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-secondary:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_control(
                    'slicko_dual_button_secondary_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'slicko-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#EF2469',
                        'selectors' => [
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-1::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-2::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-3::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-4::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-5:hover'   => 'background: {{VALUE}};',
                            '{{WRAPPER}} .slicko-dual-button-secondary.effect-6::before' => 'background: {{VALUE}};'
                        ]
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'slicko_dual_button_secondary_button_hover_border',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-secondary:hover'
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'slicko_dual_button_secondary_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .slicko-dual-button-secondary:hover'
                    ]
                );
            $this->end_controls_tab();
	    $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function render() {
        $settings                = $this->get_settings_for_display();
        $secondary_btn_icon_pos = $settings['slicko_dual_button_secondary_button_icon_position'];
        $primary_btn_icon_pos   = $settings['slicko_dual_button_primary_button_icon_position'];
        $this->add_render_attribute(
            'slicko_dual_button',
            [
                'class' => [
                    'slicko-dual-button',
                    esc_attr( $settings['slicko_dual_button_container_alignment'] )
                ]
            ]
        );
        $this->add_render_attribute(
            'slicko_dual_button_primary_button_url',
            [
                'class' => [
                    'slicko-dual-button-primary slicko-dual-button-action',
                    esc_attr( $settings['slicko_dual_button_primary_button_animation'] )
                ]
            ]
        );
        $this->add_render_attribute(
            'slicko_dual_button_secondary_button_url',
            [
                'class' => [
                    'slicko-dual-button-secondary slicko-dual-button-action',
                    esc_attr( $settings['slicko_dual_button_secondary_button_animation'] )
                ]
            ]
        );
        if( $settings['slicko_dual_button_primary_button_url']['url'] ) {
            $this->add_render_attribute( 'slicko_dual_button_primary_button_url', 'href', esc_url( $settings['slicko_dual_button_primary_button_url']['url'] ) );
            if( $settings['slicko_dual_button_primary_button_url']['is_external'] ) {
                $this->add_render_attribute( 'slicko_dual_button_primary_button_url', 'target', '_blank' );
            }
            if( $settings['slicko_dual_button_primary_button_url']['nofollow'] ) {
                $this->add_render_attribute( 'slicko_dual_button_primary_button_url', 'rel', 'nofollow' );
            }
        }
        if( $settings['slicko_dual_button_secondary_button_url']['url'] ) {
            $this->add_render_attribute( 'slicko_dual_button_secondary_button_url', 'href', esc_url( $settings['slicko_dual_button_secondary_button_url']['url'] ) );
            if( $settings['slicko_dual_button_secondary_button_url']['is_external'] ) {
                $this->add_render_attribute( 'slicko_dual_button_secondary_button_url', 'target', '_blank' );
            }
            if( $settings['slicko_dual_button_secondary_button_url']['nofollow'] ) {
                $this->add_render_attribute( 'slicko_dual_button_secondary_button_url', 'rel', 'nofollow' );
            }
        }
        $this->add_inline_editing_attributes( 'slicko_dual_button_primary_button_text', 'none' );
        $this->add_inline_editing_attributes( 'slicko_dual_button_connector_text', 'none' );
        $this->add_inline_editing_attributes( 'slicko_dual_button_secondary_button_text', 'none' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'slicko_dual_button' ); ?>>
            <div class="slicko-dual-button-wrapper">
                <a <?php echo $this->get_render_attribute_string( 'slicko_dual_button_primary_button_url' ); ?>>
                    <span class="<?php echo esc_attr( $primary_btn_icon_pos ); ?>">
                    <?php
                        if ( 'slicko-icon-pos-left' === $primary_btn_icon_pos && !empty( $settings['slicko_dual_button_primary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['slicko_dual_button_primary_button_icon'] );
                        }
                    ?>
                        <span <?php echo $this->get_render_attribute_string( 'slicko_dual_button_primary_button_text' ); ?>>
                            <?php echo esc_html( $settings['slicko_dual_button_primary_button_text'] ); ?>
                        </span>
                        <?php
                        if ( 'slicko-icon-pos-right' === $primary_btn_icon_pos && !empty( $settings['slicko_dual_button_primary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['slicko_dual_button_primary_button_icon'] );
                        }
                        ?>
                    </span>
                    <?php
                    if ( 'yes' === $settings['slicko_dual_button_connector_switch'] ) { ?>
                        <div class="slicko-dual-button-connector">
                        <?php if ( 'text' === $settings['slicko_dual_button_connector_type'] ) { ?>
                            <span <?php echo $this->get_render_attribute_string( 'slicko_dual_button_connector_text' ); ?>>
                                <?php echo esc_html( $settings['slicko_dual_button_connector_text'] ); ?>
                            </span>
                            <?php
                            }
                            if ( 'icon' === $settings['slicko_dual_button_connector_type'] && !empty( $settings['slicko_dual_button_connector_icon']['value'] ) ) { ?>
                                <span>
                                    <?php Icons_Manager::render_icon( $settings['slicko_dual_button_connector_icon'] ); ?>
                                </span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </a>
                <a <?php echo $this->get_render_attribute_string( 'slicko_dual_button_secondary_button_url' ); ?>>
                    <span class="<?php echo esc_attr( $secondary_btn_icon_pos ); ?>">
                    <?php
                        if ( 'slicko-icon-pos-left' === $secondary_btn_icon_pos && !empty( $settings['slicko_dual_button_secondary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['slicko_dual_button_secondary_button_icon'] );
                        }
                        ?>
                        <span <?php echo $this->get_render_attribute_string( 'slicko_dual_button_secondary_button_text' ); ?>>
                            <?php echo esc_html( $settings['slicko_dual_button_secondary_button_text'] ); ?>
                        </span>
                        <?php
                        if ( 'slicko-icon-pos-right' === $secondary_btn_icon_pos && !empty( $settings['slicko_dual_button_secondary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['slicko_dual_button_secondary_button_icon'] );
                        }
                        ?>
                    </span>
                </a>
            </div>
        </div>
        <?php
    }
}
$widgets_manager->register_widget_type( new \Slicko_Addons\Widgets\Slicko_Dual_Button() );