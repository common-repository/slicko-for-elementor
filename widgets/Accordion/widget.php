<?php
namespace Slicko_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class Slicko_Accordion extends Widget_Base {

	public function get_name() {
		return 'slicko-accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'slicko' );
	}

	public function get_icon() {
		return 'slicko eicon-accordion';
	}


	public function get_keywords() {
		return [ 'acc', 'faq', 'accordion', 'tab' ];
	}

   public function get_categories() {
		return [ 'slicko' ];
	}

	protected function register_controls() {

		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');

		
  		/**
  		 * Fd Addons Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'slicko_section_exclusive_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Contents', 'slicko' )
  			]
  		);

  		$repeater = new Repeater();

        $repeater->start_controls_tabs('slicko_accordion_item_tabs');

        $repeater->start_controls_tab('slicko_accordion_item_content_tab', ['label' => __('Content', 'slicko')]);

        $repeater->add_control(
			'slicko_exclusive_accordion_default_active', [
				'label'        => esc_html__( 'Active as Default', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $repeater->add_control(
			'slicko_exclusive_accordion_icon_show', [
				'label'        => esc_html__( 'Enable Title Icon', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'slicko' ),
				'label_off'    => __( 'Off', 'slicko' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);
		
		$repeater->add_control(
			'slicko_exclusive_accordion_title_icon',
			[
				'label'       => __( 'Icon', 'slicko' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'fa-regular'
				],
				'condition'   => [
					'slicko_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);

        $repeater->add_control(
			'slicko_exclusive_accordion_title', [
				'label'   => esc_html__( 'Title', 'slicko' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Accordion Title', 'slicko' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		
        $repeater->add_control(
			'slicko_exclusive_accordion_content', [
				'label'   => esc_html__( 'Content', 'slicko' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'slicko' )
			]
		);

        $repeater->add_control(
            'slicko_accordion_show_read_more_btn',
            [
                'label'        => esc_html__( 'Enable Button.', 'slicko' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'slicko' ),
				'label_off'    => __( 'Off', 'slicko' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'separator'	   => 'before'
            ]
        );  

        $repeater->add_control(
            'slicko_accordion_read_more_btn_text',
            [   
				'label'       => esc_html__( 'Button Text', 'slicko' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('See Details', 'slicko'),
				'default'     => esc_html__('See Details', 'slicko' ),
				'condition'   => [
                    '.slicko_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'slicko_accordion_read_more_btn_url',
            [   
                'label'         => esc_html__( 'Button Link', 'slicko' ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'           => '#',
                    'is_external'   => ''
                ],
                'show_external'     => true,
                'placeholder'       => __( 'http://your-link.com', 'slicko' ),
                'condition'     => [
                    '.slicko_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('slicko_accordion_item_image_tab', ['label' => __('Image', 'slicko')]);

        $repeater->add_control(
			'slicko_accordion_image', [
				'label' => esc_html__( 'Choose Image', 'slicko' ),
				'type'  => Controls_Manager::MEDIA
			]
		);

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('slicko_accordion_item_style_tab', ['label' => __('Style', 'slicko')]);

        $repeater->add_control(
            'slicko_accordion_each_item_container_style',
            [
				'label' => esc_html__( 'Container', 'slicko' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

		$repeater->add_control(
		    'slicko_accordion_each_item_container_bg_color',
		    [
		        'label'     => __( 'Background Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'slicko_accordion_number_color',
		    [
		        'label'     => __( 'Number Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item .slicko-accordion-number span' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'slicko_accordion_number_bg_color',
		    [
		        'label'     => __( 'Number Background Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item .slicko-accordion-number span' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'slicko_accordion_each_item_title_style',
            [
				'label'     => esc_html__( 'Title', 'slicko' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_control(
		    'slicko_accordion_each_item_title_color',
		    [
		        'label'     => __( 'Text Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item .slicko-accordion-title h3' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'slicko_accordion_each_item_title_bg_color',
		    [
		        'label'     => __( 'Background Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item .slicko-accordion-title' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'slicko_accordion_each_item_title_hover_color',
		    [
		        'label'     => __( 'Hover Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item .slicko-accordion-title:hover h3' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'slicko_accordion_each_item_title_hover_bg_color',
		    [
		        'label'     => __( 'Hover Background Color', 'slicko' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item .slicko-accordion-title:hover' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'slicko_accordion_each_item_content_style',
            [
				'label'     => esc_html__( 'Content', 'slicko' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_group_control(
		    Group_Control_Border::get_type(),
		    [
				'name'     => 'slicko_accordion_each_item_container_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slicko-accordion-single-item'
		    ]
		);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

  		$this->add_control(
			'slicko_exclusive_accordion_tab',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[ 
						'slicko_exclusive_accordion_title'          => esc_html__( 'Accordion Title 1', 'slicko' ),
						'slicko_exclusive_accordion_default_active' => 'yes'
					],
					[ 'slicko_exclusive_accordion_title' => esc_html__( 'Accordion Title 2', 'slicko' ) ],
					[ 'slicko_exclusive_accordion_title' => esc_html__( 'Accordion Title 3', 'slicko' ) ]
				],
				'title_field' => '{{slicko_exclusive_accordion_title}}'
			]
		);

        $this->add_control(
			'slicko_show_number',
			[
				'label'        => esc_html__( 'Show Number', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

        $this->add_control(
			'slicko_exclusive_accordion_tab_title_show_active_inactive_icon',
			[
				'label'        => esc_html__( 'Show Active/Inactive Icon?', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'	   => 'before' 
			]
		);

		$this->add_control(
			'slicko_exclusive_accordion_tab_title_active_icon',
			[
				'label'       => __( 'Active Icon', 'slicko' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'slicko_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'slicko_exclusive_accordion_tab_title_inactive_icon',
			[
				'label'       => __( 'Inactive Icon', 'slicko' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-down',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'slicko_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'slicko_section_exclusive_accordions_container_style',
			[
				'label'	=> esc_html__( 'Container', 'slicko' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);		
		$this->start_controls_tabs( 'slicko_accordion_active_inactive_container_tabs' );
		// normal state tab
		$this->start_controls_tab( 'slicko_accordion_container_style', [ 'label' => esc_html__( 'Normal', 'slicko' ) ] );

		$this->add_control(
			'slicko_accordion_container_background_color',
			[
				'label'		=> esc_html__( 'Background Color', 'slicko' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'slicko_accordion_container_box_shadow',
				'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item'
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'slicko_exclusive_accordion_container_border',
				'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item'
            ]
		);

        $this->add_responsive_control(
            'slicko_exclusive_accordion_container_padding',
            [
				'label'      => __('Padding', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'slicko_exclusive_accordion_container_margin',
            [
				'label'        => __('Margin', 'slicko'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
                'selectors'    => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'slicko_exclusive_accordion_container_border_radius',
            [
				'label'      => __('Border Radius', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		$this->end_controls_tab();
		
		// hover state tab
		$this->start_controls_tab( 'slicko_accordion_container_style_hover', [ 'label' => esc_html__( 'Active', 'slicko' ) ] );

		$this->add_control(
			'slicko_accordion_container_background_color_active',
			[
				'label'		=> esc_html__( 'Background Color', 'slicko' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item.wraper-active' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'slicko_accordion_container_box_shadow_active',
				'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item.wraper-active'
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'slicko_exclusive_accordion_container_border_active',
				'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item.wraper-active'
            ]
		);
		$this->add_responsive_control(
            'slicko_exclusive_accordion_container_border_radius_active',
            [
				'label'      => __('Border Radius', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item.wraper-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'slicko_exclusive_accordion_container_margin_active',
            [
				'label'      => __('Margin', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item.wraper-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'slicko_exclusive_accordion_container_padding_active',
            [
				'label'      => __('Padding', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item.wraper-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'slicko_acc_number',
			[
				'label' => esc_html__( 'Nmber', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'slicko_number_typography',
				'selector'        => '{{WRAPPER}} .slicko-accordion-number span',
				'fields_options'  => [
					'font_weight' => [
						'default' => '600',
					]
				]
			]
		);
		$this->add_responsive_control(
			'slicko_number_size',
			[
				'label'        => __( 'Size', 'slicko' ),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1
					]
				],
				'selectors'    => [
					'{{WRAPPER}} .slicko-accordion-number span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'numbar_color',
			[
				'label'		=> esc_html__( 'Text Color', 'slicko' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $accent_color,
				'selectors'	=> [
					'{{WRAPPER}} .slicko-accordion-number span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'numbar_border',
				'label'                 => __( 'Border', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-accordion-number span',
			]
		);
		$this->add_control(
			'numbar_background_color',
			[
				'label'		=> esc_html__( 'Background', 'slicko' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $secondary_color,
				'selectors'	=> [
					'{{WRAPPER}} .slicko-accordion-number span' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'slicko_number_border_radius',
			[
				'label'      => __('Border Radius', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .slicko-accordion-number span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'slicko_number_margin',
			[
				'label'      => __('Margin', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .slicko-accordion-number span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'slicko_number_padding',
			[
				'label'      => __('Padding', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .slicko-accordion-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'slicko_section_exclusive_accordions_tab_style',
			[
				'label' => esc_html__( 'Title', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->start_controls_tabs( 'slicko_exclusive_accordion_header_tabs' );

			# Normal State Tab
			$this->start_controls_tab( 'slicko_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'slicko' ) ] );
				
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'            => 'slicko_exclusive_accordion_title_typography',
					'selector'        => '{{WRAPPER}} .slicko-accordion-single-item h3',
					'fields_options'  => [
						'font_weight' => [
							'default' => '600'
						]
					]
				]
			);
	
			$this->add_control(
					'slicko_exclusive_accordion_tab_text_color',
					[
						'label'		=> esc_html__( 'Text Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> $secondary_color,
						'selectors'	=> [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item h3' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'slicko_exclusive_accordion_tab_color',
					[
						'label'     => esc_html__( 'Background Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title' => 'background-color: {{VALUE}};'
						]
					]
				);
				
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'slicko_exclusive_accordion_title_border',
						'fields_options'     => [
							'border' 	     => [
								'default'    => 'solid'
							],
							'width'  	     => [
								'default' 	 => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color' 	     => [
								'default'    => $secondary_color,
							]
						],
						'selector'           => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title'
					]
				);
				
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'slicko_accordion_title_box_shadow',
						'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title'
					]
				);
		
				$this->add_responsive_control(
					'slicko_exclusive_accordion_title_padding',
					[
						'label'      => __('Padding', 'slicko'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', '%'],
						'default'    => [
							'top'    => '20',
							'right'  => '20',
							'bottom' => '20',
							'left'   => '20'
						],
						'selectors'  => [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
		
				$this->add_responsive_control(
					'slicko_exclusive_accordion_title_margin',
					[
						'label'      => __('Margin', 'slicko'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', '%'],
						'default'    => [
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '0'
						],
						'selectors'  => [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
		
				$this->add_responsive_control(
					'slicko_accordion_title_border_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'slicko' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px'],
						'selectors'  => [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
			$this->end_controls_tab();

			#Hover State Tab
			$this->start_controls_tab( 'slicko_exclusive_accordion_header_hover', [ 'label' => esc_html__( 'Hover', 'slicko' ) ] );
				$this->add_control(
					'slicko_exclusive_accordion_tab_text_color_hover',
					[
						'label'		=> esc_html__( 'Text Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title:hover h3' => 'color: {{VALUE}};',
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active:hover h3' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'slicko_exclusive_accordion_tab_color_bg_hover',
					[
						'label'		=> esc_html__( 'Background Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			#Active State Tab
			$this->start_controls_tab( 'slicko_exclusive_accordion_header_active', [ 'label' => esc_html__( 'Active', 'slicko' ) ] );
				$this->add_control(
					'slicko_exclusive_accordion_tab_text_color_active',
					[
						'label'		=> esc_html__( 'Text Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active h3' => 'color: {{VALUE}} !important;'
						]
					]
				);

				$this->add_control(
					'slicko_exclusive_accordion_tab_color_bg_active',
					[
						'label'		=> esc_html__( 'Background Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		/**
		 * -------------------------------------------
		 * Icon Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'slicko_accordion_tab_title_icon_style',
			[
				'label'	=> esc_html__( 'Title Icon', 'slicko' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

        $this->start_controls_tabs( 'slicko_accordion_title_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'slicko_accordion_title_icon_general_style', [ 'label' => esc_html__( 'Normal', 'slicko' ) ] );

			$this->add_control(
				'slicko_accordion_tab_title_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'slicko' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'slicko_accordion_tab_title_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'slicko' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'slicko_accordion_title_icon_border',
					'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon'
				]
			);
	
			$this->add_responsive_control(
				'slicko_accordion_title_icon_size',
				[
					'label'        => __( 'Size', 'slicko' ),
					'type'         => Controls_Manager::SLIDER,
					'range'        => [
						'px'       => [
							'min'  => 10,
							'max'  => 150,
							'step' => 2
						]
					],
					'default'      => [
						'unit'     => 'px',
						'size'     => 20
					],
					'selectors'    => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
					]
				]
			);   
	
			$this->add_responsive_control(
				  'slicko_accordion_title_icon_width',
				  [
					'label'    => esc_html__( 'Width', 'slicko' ),
					'type'     => Controls_Manager::SLIDER,
					'default'  => [
						  'size' => 70
					],
					'range'    => [
						  'px'   => [
							  'max' => 100
						  ]
					],
					'selectors' => [
						  '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon' => 'width: {{SIZE}}px;'
					]
				  ]
			);
	
		
			$this->add_responsive_control(
				'slicko_accordion_title_icon_padding',
				[
					'label'      => __('Padding', 'slicko'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
	
			$this->add_responsive_control(
				'slicko_accordion_title_icon_margin',
				[
					'label'      => __('Margin', 'slicko'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title span.slicko-tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'slicko_accordion_title_icon_active_style', [ 'label' => esc_html__( 'Active', 'slicko' ) ] );

			$this->add_control(
				'slicko_accordion_title_icon_active_color',
				[
					'label'		=> esc_html__( 'Color', 'slicko' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active span.slicko-tab-title-icon i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'slicko_accordion_title_icon_active_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'slicko' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active span.slicko-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'slicko_accordion_active_inactive_icon_style',
			[
				'label'     => esc_html__( 'Active/Inactive Icon', 'slicko' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slicko_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

	    

        $this->start_controls_tabs( 'slicko_accordion_active_inactive_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'slicko_accordion_general_style', [ 'label' => esc_html__( 'Normal', 'slicko' ) ] );

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'slicko_accordion_active_inactive_icon_border',
						'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon'
					]
				);

				$this->add_control(
					'slicko_accordion_general_icon_color',
					[
						'label'		=> esc_html__( 'Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> $secondary_color,
						'selectors'	=> [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon svg' => 'color: {{VALUE}};',
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon svg path' => 'fill: {{VALUE}};',
							
						]
					]
				);

				$this->add_control(
					'slicko_accordion_general_icon_bg_color',
					[
						'label'		=> esc_html__( 'Background Color', 'slicko' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_responsive_control(
				'slicko_accordion_active_inactive_icon_size',
				[
					'label'        => esc_html__( 'Size', 'slicko' ),
					'type'         => Controls_Manager::SLIDER,
					'range'        => [
						'px'       => [
							'min'  => 10,
							'max'  => 150,
							'step' => 2
						]
					],
					'default'      => [
						'unit'     => 'px',
						'size'     => 20
					],
					'selectors'    => [
						'{{WRAPPER}}  .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}  .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->add_responsive_control(
				'slicko_accordion_active_inactive_icon_width',
				[
					'label'       => esc_html__( 'Width', 'slicko' ),
					'type'        => Controls_Manager::SLIDER,
					'default'     => [
						'size'    => 70
					],
					'range'       => [
						'px'      => [
							'max' => 100
						]
					],
					'selectors'   => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title .slicko-active-inactive-icon' => 'width: {{SIZE}}px;'
					]
				]
			);

       
			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'slicko_accordion_active_style', [ 'label' => esc_html__( 'Active', 'slicko' ) ] );

			$this->add_control(
				'slicko_accordion_active_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'slicko' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> $secondary_color,
					'selectors'	=> [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active .slicko-active-inactive-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active .slicko-active-inactive-icon svg' => 'color: {{VALUE}};',
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active .slicko-active-inactive-icon svg path' => 'fill: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'slicko_accordion_active_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'slicko' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-title.active .slicko-active-inactive-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
  		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'slicko_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content', 'slicko' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slicko_exclusive_accordion_content_typography',
				'selector' => '{{WRAPPER}} .slicko-accordion-single-item .slicko-accordion-text'
			]
		);

		$this->add_control(
			'slicko_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'slicko' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-content .slicko-accordion-content-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'slicko_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'slicko' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $primary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-accordion-single-item .slicko-accordion-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'                 => 'slicko_exclusive_accordion_content_border',
				'fields_options'       => [
                    'border' 	       => [
                        'default'      => 'solid'
                    ],
                    'width'  		   => [
                        'default' 	   => [
							'top'      => '0',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => false
                        ]
                    ],
                    'color' 		   => [
                        'default' 	   => $secondary_color
                    ]
                ],
                'selector'             => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-content .slicko-accordion-content-wrapper'
            ]
		);
        $this->add_responsive_control(
            'slicko_accordion_content_padding',
            [
				'label'      => __('Padding', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-content .slicko-accordion-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'slicko_accordion_content_margin',
            [
				'label'      => __('Margin', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-single-item .slicko-accordion-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->add_responsive_control(
            'slicko_accordion_content_border_radius',
            [
				'label'      => __('Border Radius', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-content .slicko-accordion-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

  		$this->end_controls_section();

		$this->start_controls_section(
			'slicko_section_accordion_tab_image_style',
			[
				'label'	=> esc_html__( 'Image', 'slicko' ),
				'tab'	=> Controls_Manager::TAB_STYLE

			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'slicko_accordion_image_size',
				'label'   => esc_html__( 'Image Type', 'slicko' ),
				'default' => 'medium'
            ]
        );

        $this->add_control(
            'slicko_accordion_image_align',
            [
                'label'         => esc_html__( 'Image Position', 'slicko' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'slicko' ),
                        'icon'  => 'eicon-angle-left'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'slicko' ),
                        'icon'  => 'eicon-angle-right'
                    ]
                ],
                'default'       => 'right'
            ]
        );

        $this->add_responsive_control(
            'slicko_accordion_image_padding',
            [
				'label'      => __('Padding', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'slicko_accordion_image_margin',
            [
				'label'      => __('Margin', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
		);

  		$this->end_controls_section();

		$this->start_controls_section(
            'slicko_accordion_details_btn_style_section',
            [
				'label' => esc_html__( 'Button', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'slicko_accordion_details_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'slicko_accordion_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'slicko' ) ] );
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'slicko_accordion_details_btn_typography',
					'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a'
				]
			);

            $this->add_control(
                'slicko_accordion_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'slicko' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'slicko_accordion_details_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'slicko' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $secondary_color,
                    'selectors' => [
                        '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );
			$this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'slicko_accordion_details_button_shadow',
                    'selector'  => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a'
                ]
            );

            $this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'               => 'slicko_accordion_details_btn_border',
					'fields_options'     => [
	                    'border' 	     => [
	                        'default'    => 'solid'
	                    ],
	                    'width'  	     => [
	                        'default'    => [
	                            'top'    => '1',
	                            'right'  => '1',
	                            'bottom' => '1',
	                            'left'   => '1'
	                        ]
	                    ],
	                    'color' 	     => [
	                        'default'    => $secondary_color
	                    ]
	                ],
                    'selector'           => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a'
                ]
            );
			
			$this->add_responsive_control(
				'slicko_accordion_details_btn_padding',
				[
					'label'      => esc_html__( 'Padding', 'slicko' ),
					'type'       => Controls_Manager::DIMENSIONS,           
					'size_units' => [ 'px', 'em', '%' ],
					'default'    => [
						'top'    => '15',
						'right'  => '40',
						'bottom' => '15',
						'left'   => '40'
					],
					'selectors'  => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
	
			$this->add_responsive_control(
				'slicko_accordion_details_btn_margin',
				[
					'label'      => esc_html__( 'Margin', 'slicko' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],   
					'default'    => [
						'top'    => '30',
						'right'  => '0',
						'bottom' => '0',
						'left'   => '0'
					],              
					'selectors'  => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'slicko_accordion_details_button_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'slicko' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'slicko_accordion_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'slicko' ) ] );

            $this->add_control(
                'slicko_accordion_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'slicko' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $secondary_color,
                    'selectors' => [
                        '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'slicko_accordion_details_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'slicko' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

			$this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'     => 'slicko_accordion_details_btn_hover_border',
					'selector' => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a:hover'
                ]
            );

			$this->add_responsive_control(
				'slicko_accordion_details_button_border_radius_hover',
				[
					'label'      => esc_html__( 'Border Radius', 'slicko' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'slicko_accordion_details_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .slicko-accordion-items .slicko-accordion-single-item .slicko-accordion-button a:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();  		

	}

    private function render_image( $accordion, $settings ) {
        $image_id   = $accordion['slicko_accordion_image']['id'];
        $image_size = $settings['slicko_accordion_image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'slicko_accordion_image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="'.Control_Media::get_image_alt( $accordion['slicko_accordion_image'] ).'" />', esc_url($image_src) );
    }

	protected function render() {

        $settings   = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'slicko_accordion_heading', 'class', 'slicko-accordion-heading' );
        $this->add_render_attribute( 'slicko_accordion_details', 'class', 'slicko-accordion-text' );
        $this->add_render_attribute( 'slicko_accordion_button', 'class', 'slicko-accordion-button' );

		$i = 1;
        echo '<div class="slicko-accordion-items">';
        	do_action('slicko_accordion_wrapper_before');
            foreach( $settings['slicko_exclusive_accordion_tab'] as $key => $accordion ) : 
			
            	do_action('slicko_accordion_each_item_wrapper_before');

			
                
                $accordion_item_setting_key = $this->get_repeater_setting_key('slicko_exclusive_accordion_title', 'slicko_exclusive_accordion_tab', $key);

                $accordion_class = ['slicko-accordion-title'];

                if ( $accordion['slicko_exclusive_accordion_default_active'] === 'yes' ) {
                    $accordion_class[] = 'active-default';
                }

                $this->add_render_attribute( $accordion_item_setting_key, 'class', $accordion_class );

				$has_image = !empty( $accordion['slicko_accordion_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

                echo '<div class="slicko-accordion-single-item '.$accordion['slicko_exclusive_accordion_default_active'].'  elementor-repeater-item-'. esc_attr($accordion['_id']).'">';
                    echo '<div '.$this->get_render_attribute_string($accordion_item_setting_key).'>';
						if($settings['slicko_show_number'] == 'yes' ):
						echo '<div class="slicko-accordion-number">';
							echo '<span>';
							echo $i++;
							echo '</span>';
						echo '</div>';
			            endif;

						if ( ! empty( $accordion['slicko_exclusive_accordion_title_icon']['value'] ) && 'yes' === $accordion['slicko_exclusive_accordion_icon_show'] ) :
							echo '<span class="slicko-tab-title-icon">';
								Icons_Manager::render_icon( $accordion['slicko_exclusive_accordion_title_icon'], [ 'aria-hidden' => 'true' ] );
							echo '</span>';
						endif; 

                        echo '<h3 '.$this->get_render_attribute_string( 'slicko_accordion_heading' ).'>'.$accordion['slicko_exclusive_accordion_title'].'</h3>';

                        if( 'yes' === $settings['slicko_exclusive_accordion_tab_title_show_active_inactive_icon']):
                            echo '<div class="slicko-active-inactive-icon">';
                                if(!empty($settings['slicko_exclusive_accordion_tab_title_active_icon']['value'])){
                                    echo '<span class="slicko-active-icon">';
                                        Icons_Manager::render_icon( $settings['slicko_exclusive_accordion_tab_title_active_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';                                 
                                }
                                if(!empty($settings['slicko_exclusive_accordion_tab_title_inactive_icon']['value'])){
                                    echo '<span class="slicko-inactive-icon">';
                                        Icons_Manager::render_icon( $settings['slicko_exclusive_accordion_tab_title_inactive_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';                                 
                                }
                            echo '</div>';
                        endif;
                    echo '</div>';

                    echo '<div class="slicko-accordion-content">';
                        echo '<div class="slicko-accordion-content-wrapper has-image-'.esc_attr($has_image).' image-position-'.esc_attr($settings['slicko_accordion_image_align']).'">';
                            echo '<div '.$this->get_render_attribute_string( 'slicko_accordion_details' ).'>';
                                echo '<div>'.wp_kses_post( $accordion['slicko_exclusive_accordion_content'] ).'</div>';
                                if( 'yes' === $accordion['slicko_accordion_show_read_more_btn']):
									if( $accordion['slicko_accordion_read_more_btn_url']['url'] ) {
									    $this->add_render_attribute( $link_key, 'href', esc_url( $accordion['slicko_accordion_read_more_btn_url']['url'] ) );
									    if( $accordion['slicko_accordion_read_more_btn_url']['is_external'] ) {
									        $this->add_render_attribute( $link_key, 'target', '_blank' );
									    }
									    if( $accordion['slicko_accordion_read_more_btn_url']['nofollow'] ) {
									        $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									    }
									}
                                    if ( ! empty( $accordion['slicko_accordion_read_more_btn_text'] ) ) :
                                        echo '<div '.$this->get_render_attribute_string( 'slicko_accordion_button' ).'>';
                                            echo '<a '.$this->get_render_attribute_string( $link_key ).'>';
                                            	echo esc_html( $accordion['slicko_accordion_read_more_btn_text'] );
                                            echo '</a>';
                                        echo '</div>'; 
                                    endif;
                                endif;
                            echo '</div>';

                            if ( ! empty( $accordion['slicko_accordion_image']['url'] ) ) {
                                echo '<div class="slicko-accordion-image">';
                                    echo $this->render_image( $accordion, $settings );
                                echo '</div>';                                   
                            }

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                do_action('slicko_accordion_each_item_wrapper_after');
            endforeach;
            do_action('slicko_accordion_wrapper_after');
        echo '</div>';
    }
}
$widgets_manager->register_widget_type( new \Slicko_Addons\Widgets\Slicko_Accordion() );