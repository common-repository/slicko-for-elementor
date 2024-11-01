<?php
namespace Slicko\Widgets\Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Slicko\Elementor\Traits\Button_Markup;



class Slicko_Creative_Button extends Widget_Base {

	use Button_Markup;

    /**
     * Get widget name.
     */
    public function get_name() {
		return 'slicko-creative-button';
	}
    /**
     * Get widget title.
     */
    public function get_title() {
        return __( 'Creative Button', 'slicko' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
		return 'slicko eicon-button';
    }

    /**
     * Get widget category.
     */
    public function get_categories() {
		return [ 'slicko' ];
	}

    public function get_keywords() {
        return [ 'button', 'btn', 'advance', 'link', 'creative', 'creative-button', 'slicko' ];
    }

	/**
     * Register widget content controls
     */
    protected function register_controls() {
		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Creative Button', 'slicko' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Style', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hermosa',
				'options' => [
					'hermosa'   => __( 'Hermosa', 'slicko' ),
					'montino'   => __( 'Montino', 'slicko' ),
					'iconica'   => __( 'Iconica', 'slicko' ),
					'symbolab'   => __( 'Symbolab', 'slicko' ),
					'estilo'   => __( 'Estilo', 'slicko' ),
				],
			]
		);

		$this->add_control(
			'estilo_effect',
			[
				'label'   => __( 'Effects', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dissolve',
				'options' =>[
					'dissolve'   => __( 'Dissolve', 'slicko' ),
					'slide-down'   => __( 'Slide In Down', 'slicko' ),
					'slide-right'   => __( 'Slide In Right', 'slicko' ),
					'slide-x'   => __( 'Slide Out X', 'slicko' ),
					'cross-slider'   => __( 'Cross Slider', 'slicko' ),
					'slide-y'   => __( 'Slide Out Y', 'slicko' ),
				],
                'condition' => [
                    'btn_style' => 'estilo'
                ]
			]
		);

		$this->add_control(
			'symbolab_effect',
			[
				'label'   => __( 'Effects', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'back-in-right',
				'options' =>[
					'back-in-right'   => __( 'Back In Right', 'slicko' ),
					'back-in-left'   => __( 'Back In Left', 'slicko' ),
					'back-out-right'   => __( 'Back Out Right', 'slicko' ),
					'back-out-left'   => __( 'Back Out Left', 'slicko' ),
				],
                'condition' => [
                    'btn_style' => 'symbolab'
                ]
			]
		);

		$this->add_control(
			'iconica_effect',
			[
				'label'   => __( 'Effects', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide-in-down',
				'options' =>[
					'slide-in-down'   => __( 'Slide In Down', 'slicko' ),
					'slide-in-top'   => __( 'Slide In Top', 'slicko' ),
					'slide-in-right'   => __( 'Slide In Right', 'slicko' ),
					'slide-in-left'   => __( 'Slide In Left', 'slicko' ),
				],
                'condition' => [
                    'btn_style' => 'iconica'
                ]
			]
		);

		$this->add_control(
			'montino_effect',
			[
				'label'   => __( 'Effects', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'winona',
				'options' =>[
					'winona'   => __( 'Winona', 'slicko' ),
					'rayen'   => __( 'Rayen', 'slicko' ),
					'aylen'   => __( 'Aylen', 'slicko' ),
					'wapasha'   => __( 'Wapasha', 'slicko' ),
					'nina'   => __( 'Nina', 'slicko' ),
					'antiman'   => __( 'Antiman', 'slicko' ),
					'sacnite'   => __( 'Sacnite', 'slicko' ),
				],
                'condition' => [
                    'btn_style' => 'montino'
                ]
			]
		);

		$this->add_control(
			'hermosa_effect',
			[
				'label'   => __( 'Effects', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exploit',
				'options' =>[
					'exploit'   => __( 'Exploit', 'slicko' ),
					'upward'   => __( 'Upward', 'slicko' ),
					'newbie'   => __( 'Newbie', 'slicko' ),
					'render'   => __( 'Render', 'slicko' ),
					'reshape'   => __( 'Reshape', 'slicko' ),
					'expandable'   => __( 'Expandable', 'slicko' ),
					'downhill'   => __( 'Downhill', 'slicko' ),
					'bloom'   => __( 'Bloom', 'slicko' ),
					'roundup'   => __( 'Roundup', 'slicko' ),
				],
                'condition' => [
                    'btn_style' => 'hermosa'
                ]
			]
		);

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'slicko' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

		$this->add_control(
			'button_link',
			array(
				'label'         => __( 'Link', 'slicko' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'slicko' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				),
			)
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'slicko' ),
				'description' => __( 'Please set an icon for the button.', 'slicko' ),
				'label_block' => false,
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);

        $this->add_responsive_control(
            'align_x',
            [
                'label' => __( 'Alignment', 'slicko' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'slicko' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'slicko' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'slicko' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );


		$this->add_control(
            'magnetic_enable',
            [
                'label'        => __('Magnetic Effect', 'slicko'),
                'type'         => Controls_Manager::SWITCHER,
                'label_block'  => false,
                'return_value' => 'yes',
				'separator' => 'before'
            ]
        );

		$this->add_control(
			'threshold',
			[
				'label' => __( 'Threshold', 'slicko'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'condition' => [
                    'magnetic_enable' => 'yes'
				],
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn' => 'margin: {{VALUE}}px;',
                ],
			]
		);

	$this->end_controls_section();




	/**
	 * Style section for Estilo, Symbolab, Iconica
	 *
	 * @return void
	 */

        $this->start_controls_section(
            '_estilo_symbolab_iconica_style_section',
            [
                'label' => __( 'Common', 'slicko' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
			'button_item_width',
			[
				'label' => __('Size', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-creative-btn.slicko-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slicko-creative-btn.slicko-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slicko-creative-btn.slicko-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
				],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'downhill',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => __('Icon Size', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .slicko-creative-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
				'default' => $accent_color,
				'exclude' => ['color'], //remove border color
                'selector' => '{{WRAPPER}} .slicko-creative-btn, {{WRAPPER}} .slicko-creative-btn.slicko-eft--bloom div',
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'slicko' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--hermosa.slicko-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'button_hermosa_roundup_stroke_width',
			[
				'label' => __('Stroke Width', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-creative-btn.slicko-eft--roundup' => '--slicko-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
				],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);


		$this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'slicko' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--montino.slicko-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--montino.slicko-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--montino.slicko-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--montino.slicko-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--montino.slicko-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--montino.slicko-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--hermosa.slicko-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator' => 'before'
            ]
		);

		$conditions = [
			'terms' => [
				[
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'hermosa_effect',
							'operator' => '!=',
							'value' => 'roundup',
						],
					],
				],
				[
					'terms' => [
						[
							'name' => 'btn_style',
							'operator' => '!=',
							'value' => '',
						],
					],
				]
			]
		];
		$this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
		);

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'slicko' ),
				'default' => '#fff',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn' => '--slicko-ctv-btn-txt-clr: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'slicko' ),
                'type' => Controls_Manager::COLOR,
				'default' => $accent_color,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn' => '--slicko-ctv-btn-bg-clr: {{VALUE}}',
                ],
				'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'slicko' ),
                'type' => Controls_Manager::COLOR,
				'default' => $accent_color,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn' => '--slicko-ctv-btn-border-clr: {{VALUE}} ',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );

        $this->add_control(
            'button_roundup_circle_color',
            [
                'label' => __( 'Circle Color', 'slicko' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn.slicko-eft--roundup' => '--slicko-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .slicko-creative-btn'
            ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            '_tabs_button_hover',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
		);

		$this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'slicko' ),
				'default' => '#fff',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn' => '--slicko-ctv-btn-txt-hvr-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'slicko' ),
                'type' => Controls_Manager::COLOR,
				'default' => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn' => '--slicko-ctv-btn-bg-hvr-clr: {{VALUE}}',
                ],
				'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color v', 'slicko' ),
				'default' => $secondary_color,
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn' => '--slicko-ctv-btn-border-hvr-clr: {{VALUE}}',
                    '{{WRAPPER}} .slicko-creative-btn.slicko-stl--hermosa.slicko-eft--exploit:hover' => 'border-color: {{VALUE}} ',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );

        $this->add_control(
            'button_hover_roundup_circle_color',
            [
                'label' => __( 'Circle Color', 'slicko' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slicko-creative-btn-wrap .slicko-creative-btn.slicko-eft--roundup' => '--slicko-ctv-btn-border-hvr-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .slicko-creative-btn:hover'
            ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

    protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no' );
		$this->{'render_' . $settings['btn_style'] . '_markup'}($settings);

	}

}
$widgets_manager->register_widget_type(new \Slicko\Widgets\Elementor\Slicko_Creative_Button());