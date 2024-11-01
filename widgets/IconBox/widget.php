<?php
namespace Slicko_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Widget_Base;

class Slicko_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'slicko-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'slicko' );
	}

	public function get_icon() {
		return 'slicko eicon-icon-box';
	}

	public function get_categories() {
		return [ 'slicko' ];
	}

	public function get_keywords() {
		return [ 'info', 'box', 'icon' ];
	}

	protected function register_controls()
	{

        $primary_color = get_theme_mod('primary_color');
        $secondary_color = get_theme_mod('secondary_color');
        $accent_color = get_theme_mod('accent_color');

		/**
		 * Content tab
		 */
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'slicko'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon type', 'slicko'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'text'  => __('Text', 'slicko'),
					'icon' => __('Icon', 'slicko'),
					'image' => __('Image', 'slicko'),
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'slicko'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => ['icon_type' => 'icon']
			]
		);

		$this->add_control(
			'box_number',
			[
				'label' => __('Box Number', 'slicko'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => ['icon_type' => 'text']
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'slicko'),
				'type' => Controls_Manager::MEDIA,

				'condition' => ['icon_type' => 'image']
			]
		);

		$this->add_control(
			'position',
			[
				'label' => __( 'Icon Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __('Title', 'slicko'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Secure & Fast Payment', 'slicko')
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __('Description', 'slicko'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('The most secure and fast payment can be made through cyptrocurrency', 'slicko')
			]
		);
		$this->add_control(
			'enable_bottom_title',
			[
				'label' => __('Show Bottom Title', 'slicko'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'slicko'),
				'label_off' => __('Hide', 'slicko'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'bottom_title',
			[
				'label' => __('Title Bottom', 'slicko'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Jonathan Taylor', 'slicko'),
				'condition' => ['enable_bottom_title' => 'yes']
			]

		);
		$this->add_control(
			'enable_button',
			[
				'label' => __('Show Button', 'slicko'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'slicko'),
				'label_off' => __('Hide', 'slicko'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label' => __('Button Icon', 'slicko'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'slicko'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Learn more', 'slicko'),
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __('URL', 'slicko'),
				'type' =>  Controls_Manager::URL,
				// 'condition' => ['enable_button' => 'yes']
			]
		);


		$this->add_control(
			'content_align',
			[
				'label' => __('Align', 'slicko'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'slicko'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('top', 'slicko'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'slicko'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->end_controls_section();


		/**
		 * Style tab
		 */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __('Icon', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'enable_icon_box',
			[
				'label' => __('Enable Icon Box', 'slicko'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'slicko'),
				'label_off' => __('Hide', 'slicko'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->start_controls_tabs(
			'icon_hover_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __('Normal', 'slicko'),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __('Icon Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .slicko-addons-feature-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .slicko-addons-feature-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .slicko-addons-feature-box-item .icon-background-yes .slicko-addons-feature-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color_fill',
			[
				'label' => __('Icon  Fill Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
				'{{WRAPPER}} .slicko-addons-feature-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'enable_gradient_text',
			[
				'label' => __('Enable Gradient Text Color', 'slicko'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'slicko'),
				'label_off' => __('Hide', 'slicko'),
				'return_value' => 'gradient',
				'default' => 'no',
				'condition' => ['icon_type' => 'text']
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_text_gradient',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default'   => $secondary_color,
					]
				],

				'selector'  => '{{WRAPPER}} .slicko-addons-feature-icon.icon-type-text .gradient',
				'condition' => ['enable_gradient_text' => 'gradient']
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label' => __('Icon Background', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .icon-background-yes .slicko-addons-feature-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'enable_icon_box' => 'yes',
					'enable_gradient!' => 'yes'
				],
			]
		);

		$this->add_control(
            'enable_gradient',
            [
                'label' => __('Enable Gradient Background', 'slicko'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'slicko'),
                'label_off' => __('No', 'slicko'),
                'return_value' => 'yes',
                'default' => 'no',
				'condition' => ['enable_icon_box' => 'yes']
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background_gradient',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default'   => $secondary_color,
					]
				],
				'condition' => ['enable_gradient' => 'yes'],
				'selector'  => '{{WRAPPER}} .icon-background-yes .slicko-addons-feature-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'label' => __('Icon Shadow', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-icon',
			]
		);

		
		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __('Icon Border', 'slicko'),
                'selector' => '{{WRAPPER}}  span.slicko-addons-feature-icon',
            ]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __('Hover', 'slicko'),
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __('Icon Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .slicko-addons-feature-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .slicko-addons-feature-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .slicko-addons-feature-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}}:hover .slicko-addons-feature-icon.icon-type-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_color_fill_hover',
			[
				'label' => __('Icon  Stroke Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
				'{{WRAPPER}}:hover .slicko-addons-feature-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_background',
			[
				'label' => __('Icon Background', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-background-yes .slicko-addons-feature-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow_hover',
				'label' => __('Icon Shadow', 'slicko'),
				'selector' => '{{WRAPPER}}:hover .slicko-addons-feature-icon',
			]
		);
		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border_hover',
                'label' => __('Icon Border', 'slicko'),
                'selector' => '{{WRAPPER}}  .slicko-addons-feature-box-item:hover span.slicko-addons-feature-icon',
            ]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_text_typo',
				'label' => __('Icon Text Typography', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-icon',
				'condition' => ['icon_type' => 'text']
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-icon svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'icon',
				]
			]
		);


		$this->add_responsive_control(
			'image_width',
			[
				'label' => __('Image Width', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-image img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => __('Image Height', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-image img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);


		$this->add_responsive_control(
			'icon_box_size',
			[
				'label' => __('Icon Box Size', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-box-item .icon-background-yes .slicko-addons-feature-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __('Icon Border Radius', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50'
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .icon-background-yes .slicko-addons-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .slicko-addons-feature-box-item .icon-background-yes .slicko-addons-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);

		$this->add_responsive_control(
			'space_between_icon',
			[
				'label' => __('Gap', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .slicko-addons-feature-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'space_between_title_border',
			[
				'label' => __('Icon Gap', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-icon.icon-type-icon svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['position' => 'left']
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Icon Align', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'start' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);



		$this->end_controls_section();
		$this->start_controls_section(
			'content_style',
			[
				'label' => __('Content', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'content_tabs'
		);

		$this->start_controls_tab(
			'content_normal_tab',
			[
				'label' => __('Normal', 'slicko'),
			]
		);

		$this->add_control(
			'title_br',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => ['enable_box_number' => 'yes']
			]
		);
		$this->add_responsive_control(
			'title_gap',
			[
				'label' => __('Title Gap', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Title Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-title' => 'color: {{VALUE}}',
				],
			]
		);




		$this->add_control(
			'bottom_title_color',
			[
				'label' => __('Bottom Title Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-bottom-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bottom_heading_typography',
				'label' => __('Bottom Title Typography', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-bottom-title',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Title Typography', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-title',
			]
		);

		$this->add_control(
            'heading_bg',
            [
                'label' => __('Heading Background Color', 'slicko'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-title' => 'background: {{VALUE}}',
                ],
            ]
        );


		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'title_border',
                'label'    => __( 'Title Border', 'slicko' ),
                'selector' => '{{WRAPPER}} .slicko-addons-feature-title',
            ]
        );

    $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_box_shadow',
                'label' => __( 'Title Box Shadow', 'massmix-ts' ),
                'selector' => '{{WRAPPER}} .slicko-addons-feature-title',
            ]
        );



$this->add_responsive_control(
            'title_border_radius',
            [
                'label'      => __( 'Title Border Radius', 'slicko' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-addons-feature-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'title_padding',
            [
                'label' => __('Title Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'bottom_title_padding',
            [
                'label' => __('Bottom Title Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-bottom-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		$this->add_control(
			'desc_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);


		$this->add_responsive_control(
			'desc_gap',
			[
				'label' => __('Description Gap', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']

			]
		);

		$this->add_control(
			'desscription_color',
			[
				'label' => __('Description Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $primary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-content p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __('Description Typography', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-content p',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __('Content Padding', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .slicko-addons-feature-content p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
            'main_content_align',
            [
                'label'     => __( 'Content Alignment', 'slicko' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'    => [
                        'title' => __( 'Start', 'slicko' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'slicko' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'slicko' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-box-item p'  => 'align-items: {{VALUE}};',
                ],
            ]
        );




		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_hover_tab',
			[
				'label' => __('Hover', 'slicko'),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Title Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}}:hover .slicko-addons-feature-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desscription_color_hover',
			[
				'label' => __('Description Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $primary_color,
				'selectors' => [
					'{{WRAPPER}}:hover .slicko-addons-feature-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		$this->start_controls_section(
			'button_style',
			[
				'label' => __('Button', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->start_controls_tabs(
            'btn_style_tabs'
        );

        $this->start_controls_tab(
            'btn_style_normal_tab',
            [
                'label' => __('Normal', 'slicko'),
            ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'label' => __( 'Border', 'slicko' ),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Button Typography', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn',
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __('Button Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn' => 'color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_control(
			'button_background',
			[
				'label' => __('Button Background Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

        $this->add_control(
            'btn_icon_color',
            [
                'label' => __('Icon Color', 'slicko'),
                'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slicko-addons-feature-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_fill_color',
            [
                'label' => __('SVG Fill Color', 'slicko'),
                'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );

		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __('Button width', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label' => __('Button Icon Size', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .slicko-addons-feature-btn svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_responsive_control(
			'space_between_btn',
			[
			   'label' => __('Button Icon Gap', 'slicko'),
			   'type' => Controls_Manager::DIMENSIONS,
			   'size_units' => ['px', 'em', '%'],
			   'default'   => [
				  'top' => '20',
				  'right' => '0',
				  'bottom' => '0',
				  'left' => '0'
			   ],
			   'selectors' => [
				  '{{WRAPPER}} .slicko-addons-feature-btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  'body.rtl {{WRAPPER}} .slicko-addons-feature-btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
			   ],
			   'condition' => ['enable_button' => 'yes']
			]
		 );

		$this->end_controls_tab();

        $this->start_controls_tab(
            'btn_style_hover_tab',
            [
                'label' => __('Hover', 'slicko'),
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_hover',
				'label' => __( 'Border', 'slicko' ),
				'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn:hover',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __('Button Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn:hover' => 'color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label' => __('Button Background Color', 'slicko'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);


        $this->add_control(
            'btn_icon_color_hover',
            [
                'label' => __('Icon Color', 'slicko'),
                'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-btn:hover .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slicko-addons-feature-btn:hover .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_fill_color_hover',
            [
                'label' => __('SVG Fill Color', 'slicko'),
                'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-btn:hover .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
		);

		$this->add_control(
            'disable_hover_effect',
            [
                'label' => __('Disable Deafault Hover Effect', 'slicko'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'slicko'),
                'label_off' => __('No', 'slicko'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

		$this->add_responsive_control(
			'space_between_btn_hover',
			[
				'label' => __('Button Icon Gap', 'slicko'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .slicko-addons-feature-btn:hover .btn-icon' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
					'body.rtl {{WRAPPER}}  .slicko-addons-feature-btn:hover .btn-icon' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'btn_hover_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Button Padding', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '20',
					'right' => '0',
					'bottom' => '0',
					'left' => '0'
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __('Button Border Radius', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .slicko-addons-feature-box-item .slicko-addons-feature-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->end_controls_section();


        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __( 'Box', 'fastland-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'box_style_tabs'
        );

        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __( 'Normal', 'fastland-hp' ),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'fastland-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-box-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Hover Shadow', 'fastland-hp' ),
                'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item',
            ]
        );
		$this->add_responsive_control(
			'box-width',
			[
				'label' => __( 'Width', 'slicko' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box-height',
			[
				'label' => __( 'Height', 'slicko' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .slicko-addons-feature-box-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __( 'Box Radius', 'fastland-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-addons-feature-box-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'fastland-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-addons-feature-box-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __( 'Hover', 'fastland-hp' ),
            ]
        );

        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'fastland-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'defautl'   => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .slicko-addons-feature-box-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __( 'Box Radius', 'fastland-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-addons-feature-box-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __( 'Box Hover Shadow', 'fastland-hp' ),
                'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .slicko-addons-feature-box-item:hover ',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$target = isset($settings['button_url']['is_external']) ? ' target="_blank"' : '';
		$nofollow = isset($settings['button_url']['nofollow']) ? ' rel="nofollow"' : '';
		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('description', 'basic');
		$enable_iconb_box = ($settings['enable_icon_box']) ? 'yes' : 'no';
		$gt = $settings['enable_gradient_text'];
?>
			<!-- box link  -->
			<?php if('yes' != $settings['enable_button'] && !empty($settings['button_url']['url'] )){
				echo '<a class="d-block" href="'.$settings['button_url']['url'].'" '.$nofollow, $target.'>';
			} ?>
			<!-- box link  -->
		<div class="slicko-addons-feature-box-item <?php printf("slicko-addons-feature-icon-%s slicko-addons-icon-position-%s",  esc_attr( $settings['content_align'] ), esc_attr( $settings['position'] ) ) ?>">

			<?php if ( ! empty( $settings["icon"]['value'] ) || !empty($settings['image']) || !empty($settings['box_number']) ): ?>
			<div class="slicko-addons-feature-icon-wrap <?php printf("icon-background-%s align-items-%s", esc_attr( $enable_iconb_box ) , esc_attr( $settings['icon_align'] ) ) ?>">
				<span class="slicko-addons-feature-icon icon-type-<?php echo $settings['icon_type']?>">
					<?php
					if ('text' == $settings['icon_type']) {
						?>
							<div class=" <?php echo esc_attr($gt); ?>"><?php echo esc_html($settings['box_number']); ?></div>
						<?php
					} elseif ('image' == $settings['icon_type']) {
						echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings);
					} else {
						\Elementor\Icons_Manager::render_icon($settings["icon"], ['aria-hidden' => 'true']);
					}

					?>
				</span>
			</div>
			<?php endif; ?>

			<div class="slicko-addons-feature-content-wrap">
				<div class="slicko-addons-feature-content">
					<?php if(!empty(  $settings['title'] )): ?>
						<h4 class="slicko-addons-feature-title"><?php echo esc_html( $settings['title'] ) ?></h4>
					<?php endif; ?>

					<?php if(!empty(  $settings['description'] )): ?>
					<p><?php echo $settings['description'] ?></p>
					<?php endif; ?>

					<?php if(!empty(  $settings['bottom_title'] )): ?>
					 <h4 class="slicko-addons-feature-bottom-title"><?php echo $settings['bottom_title'] ?></h4>
					<?php endif; ?>

				</div>
				<?php if ('yes' == $settings['enable_button']) { ?>
					<a <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?> class="slicko-addons-feature-btn slicko-addons-btn btn-type-boxed d-inline-block <?php printf('disable-default-hover-%s', $settings['disable_hover_effect']); ?>">
						<?php echo $settings['button_text'];?>
						<span class="btn-icon">
							<?php \Elementor\Icons_Manager::render_icon($settings["btn_icon"], ['aria-hidden' => 'true']); ?>
						</span>
				</a>
				<?php } ?>
			</div>

		</div>
		<!-- box link  -->
		<?php if('yes' != $settings['enable_button'] && !empty($settings['button_url']['url'] )){
			echo "</a>";
		}
		?>
			<!-- box link  -->
<?php
	}
	protected function content_template() {

	}

}
$widgets_manager->register_widget_type( new \Slicko_Addons\Widgets\Slicko_Icon_Box() );