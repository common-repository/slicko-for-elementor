<?php
namespace Slicko_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Slicko_Modal_Popup extends Widget_Base {

	public function get_name() {
		return 'slicko-video-button';
	}

	public function get_title() {
		return esc_html__( 'Modal Popup', 'slicko' );
	}

	public function get_icon() {
		return 'slicko eicon-video-camera';
	}

	public function get_categories() {
		return [ 'slicko' ];
	}

	public function get_keywords() {
		return [ 'slicko', 'lightbox', 'popup', 'quickview', 'video', 'btn', 'button' ];
	}

	protected function register_controls() {

		$primary_color = get_theme_mod('primary_color',);
        $secondary_color = get_theme_mod('secondary_color');
        $accent_color = get_theme_mod('accent_color', '#FD4C5C');

		/**
		 * Modal Popup Content section
		 */
		$this->start_controls_section(
			'slicko_modal_content_section',
			[
				'label' => __( 'Contents', 'slicko' )
			]
		);

		$this->add_control(
			'slicko_modal_content',
			[
				'label'   => __( 'Type of Modal', 'slicko' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
					'image'          => __( 'Image', 'slicko' ),
					'image-gallery'  => __( 'Image Gallery', 'slicko' ),
					'html_content'   => __( 'HTML Content', 'slicko' ),
					'youtube'        => __( 'Youtube Video', 'slicko' ),
					'vimeo'          => __( 'Vimeo Video', 'slicko' ),
					'external-video' => __( 'Self Hosted Video', 'slicko' ),
					'external_page'  => __( 'External Page', 'slicko' ),
					'shortcode'      => __( 'ShortCode', 'slicko' )
				]
			]
		);

		/**
		 * Modal Popup image section
		 */
		$this->add_control(
			'slicko_modal_image',
			[
				'label'      => __( 'Image', 'slicko' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' 	 => Utils::get_placeholder_image_src()
				],
				'dynamic'    => [
					'active' => true
                ],
                'condition'  => [
                    'slicko_modal_content' => 'image'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
                    'slicko_modal_content' => 'image'
                ]
			]
		);

		/**
		 * Modal Popup image gallery
		 */

		$this->add_control(
			'slicko_modal_image_gallery_column',
			[
				'label'   => __( 'Column', 'slicko' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'column-three',
                'options' => [
					'column-one'   => __( 'Column 1', 'slicko' ),
					'column-two'   => __( 'Column 2', 'slicko' ),
					'column-three' => __( 'Column 3', 'slicko' ),
					'column-four'  => __( 'Column 4', 'slicko' ),
					'column-five'  => __( 'Column 5', 'slicko' ),
					'column-six'   => __( 'Column 6', 'slicko' )
				],
				'condition' => [
					'slicko_modal_content' => 'image-gallery'
				]
			]
		);

		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'slicko_modal_image_gallery',
			[
				'label'   => __( 'Image', 'slicko' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$image_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
			]
		);

		$image_repeater->add_control(
			'slicko_modal_image_gallery_text',
			[
				'label' => __( 'Description', 'slicko' ),
				'type'  => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'slicko_modal_image_gallery_repeater',
			[
				'label'   => esc_html__( 'Image Gallery', 'slicko' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $image_repeater->get_controls(),
				'default' => [
					[ 'slicko_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'slicko_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'slicko_modal_image_gallery' => Utils::get_placeholder_image_src() ]
				],
				'condition' => [
					'slicko_modal_content' => 'image-gallery'
				]
			]
		);
		/**
		 * Modal Popup html content section
		 */
		$this->add_control(
			'slicko_modal_html_content',
			[
				'label'     => __( 'Add your content here (HTML/Shortcode)', 'slicko' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your popup content here', 'slicko' ),
				'dynamic'   => [ 'active' => true ],
				'condition' => [
				  	'slicko_modal_content' => 'html_content'
			  	]
			]
		);

		/**
		 * Modal Popup video section
		 */

		$this->add_control(
            'slicko_modal_youtube_video_url',
            [
				'label'       => __( 'Provide Youtube Video URL', 'slicko' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
				'placeholder' => __( 'Place Youtube Video URL', 'slicko' ),
				'title'       => __( 'Place Youtube Video URL', 'slicko' ),
				'condition'   => [
                    'slicko_modal_content' => 'youtube'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );


        $this->add_control(
            'slicko_modal_vimeo_video_url',
            [
				'label'       => __( 'Provide Vimeo Video URL', 'slicko' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/347565673',
				'placeholder' => __( 'Place Vimeo Video URL', 'slicko' ),
				'title'       => __( 'Place Vimeo Video URL', 'slicko' ),
				'condition'   => [
                    'slicko_modal_content' => 'vimeo'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
		);

		/**
		 * Modal Popup external video section
		 */
		$this->add_control(
			'slicko_modal_external_video',
			[
				'label'      => __( 'External Video', 'slicko' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic' => [
					'active' => true,
				],
				'condition'  => [
                    'slicko_modal_content' => 'external-video'
                ]
			]
		);

		$this->add_control(
            'slicko_modal_external_page_url',
            [
				'label'       => __( 'Provide External URL', 'slicko' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://slickodevs.com',
				'placeholder' => __( 'Place External Page URL', 'slicko' ),
				'condition'   => [
                    'slicko_modal_content' => 'external_page'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_responsive_control(
            'slicko_modal_video_width',
            [
				'label'        => __( 'Content Width', 'slicko' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 720
                ],
                'selectors'    => [
					'{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element iframe,
					{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slicko-modal-item' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'slicko_modal_content' => [ 'youtube', 'vimeo', 'external_page', 'external-video' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'slicko_modal_video_height',
            [
				'label'        => __( 'Content Height', 'slicko' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
						'min'  => 0,
						'max'  => 100
                    ]
                ],
                'default'      => [
					'unit'     => 'px',
					'size'     => 400
                ],
                'selectors'    => [
                    '{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slicko-modal-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'slicko_modal_content' => [ 'youtube', 'vimeo', 'external_page' ]
                ]
            ]
        );

        $this->add_control(
            'slicko_modal_shortcode',
            [
				'label'       => __( 'Enter your shortcode', 'slicko' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( '[gallery]', 'slicko' ),
				'condition'   => [
                    'slicko_modal_content' => 'shortcode'
                ]
            ]
		);

		$this->add_responsive_control(
			'slicko_modal_content_width',
			[
				'label' => __( 'Content Width', 'slicko' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-item' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
                    'slicko_modal_content' => [ 'image', 'image-gallery', 'html_content', 'shortcode' ]
                ]
			]
		);

		$this->add_control(
			'slicko_modal_btn_text',
			[
				'label'       => __( 'Button Text', 'slicko' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'slicko' ),
				'dynamic'     => [
					'active'  => true
				]
			]
		);

		$this->add_control(
			'slicko_modal_btn_icon',
			[
				'label'       => __( 'Button Icon', 'slicko' ),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-brands'
                ]
			]
		);
		$this->add_control(
			'show_btn_after_text',
			[
				'label' => esc_html__( 'Button After text', 'slicko-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slicko-addons' ),
				'label_off' => esc_html__( 'Hide', 'slicko-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'btn_after_title',
			[
				'label' => esc_html__( 'After Title', 'slicko-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'slicko-addons' ),
				'condition'    => [
					'show_btn_after_text' => 'yes'
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup settings section
		 */
		$this->start_controls_section(
			'slicko_modal_setting_section',
			[
				'label' => __( 'Settings', 'slicko' )
			]
		);

		$this->add_control(
			'slicko_modal_button_overlay',
			[
				'label'        => __( 'Button Animaion overlay', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'slicko' ),
				'label_off'    => __( 'Hide', 'slicko' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'slicko_modal_button_overlay_color',
			[
				'label'     => __( 'Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
				'{{WRAPPER}} .slicko-modal-button::after' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'slicko_modal_button_overlay' => 'yes'
				]
			]
		);


		

		$this->add_control(
			'slicko_modal_overlay',
			[
				'label'        => __( 'Background overlay', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'slicko' ),
				'label_off'    => __( 'Hide', 'slicko' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'slicko_modal_overlay_click_close',
			[
				'label'     => __( 'Close While Clicked Outside', 'slicko' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'ON', 'slicko' ),
				'label_off' => __( 'OFF', 'slicko' ),
				'default'   => 'yes',
				'condition' => [
					'slicko_modal_overlay' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup button style
		 */

		$this->start_controls_section(
			'slicko_modal_display_settings',
			[
				'label' => __( 'Button', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		/**
		 * display settings for button normal and hover
		 */
		$this->start_controls_tabs( 'slicko_modal_btn_typhography_color', ['separator' => 'before' ] );

			$this->start_controls_tab( 'slicko_modal_btn_typhography_color_normal_tab', [ 'label' => esc_html__( 'Normal', 'slicko' )] );

				$this->add_control(
					'slicko_modal_btn_typhography_color_normal',
					[
						'label'     => __( 'Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action span' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'slicko_modal_btn_background_normal',
					[
						'label'     => __( 'Background Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $accent_color,
						'selectors' => [
							'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_responsive_control(
					'slicko_modal_btn_align',
					[
						'label'         => __( 'Alignment', 'slicko' ),
						'type'          => Controls_Manager::CHOOSE,
						'default'       => 'center',
						'toggle'        => false,
						'separator'     => 'before',
						'options'       => [
							'left'      => [
								'title' => __( 'Left', 'slicko' ),
								'icon'  => 'eicon-text-align-left'
							],
							'center'    => [
								'title' => __( 'Center', 'slicko' ),
								'icon'  => 'eicon-text-align-center'
							],
							'right'     => [
								'title' => __( 'Right', 'slicko' ),
								'icon'  => 'eicon-text-align-right'
							]
						],
						'selectors'     => [
							'{{WRAPPER}} .slicko-modal-button' => 'text-align: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'slicko_modal_btn_typhography',
						'label'     => __( 'Button Typography', 'slicko' ),
						'selector'  => '{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action span'
					]
				);

				$this->add_control(
					'slicko_modal_btn_enable_fixed_width_height',
					[
						'label' => __( 'Enable Fixed Height & Width?', 'slicko' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'slicko' ),
						'label_off' => __( 'Hide', 'slicko' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_control(
					'slicko_modal_btn_fixed_width_height',
					[
						'label' => __( 'Fixed Height & Width', 'slicko' ),
						'type' => Controls_Manager::POPOVER_TOGGLE,
						'label_off' => __( 'Default', 'slicko' ),
						'label_on' => __( 'Custom', 'slicko' ),
						'return_value' => 'yes',
						'default' => 'yes',
						'condition' => [
							'slicko_modal_btn_enable_fixed_width_height' => 'yes'
						]
					]
				);

				$this->start_popover();

					$this->add_responsive_control(
						'slicko_modal_btn_fixed_width',
						[
							'label'      => esc_html__( 'Width', 'slicko' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'

							],
							'condition' => [
								'slicko_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

					$this->add_responsive_control(
						'slicko_modal_btn_fixed_height',
						[
							'label'      => esc_html__( 'Height', 'slicko' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'
							],
							'condition' => [
								'slicko_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

				$this->end_popover();

				$this->add_responsive_control(
					'slicko_modal_btn_width',
					[
						'label'        => esc_html__( 'Width', 'slicko' ),
						'type'         => Controls_Manager::SLIDER,
						'size_units'   => [ 'px', '%' ],
						'range'        => [
							'px'       => [
								'min'  => 0,
								'max'  => 500,
								'step' => 1
							],
							'%'        => [
								'min'  => 0,
								'max'  => 100
							]
						],
						'default'      => [
							'unit'     => 'px',
							'size'     => 70
						],
						'selectors'    => [
							'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'
						],
						'condition' => [
							'slicko_modal_btn_enable_fixed_width_height!' => 'yes'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'slicko_modal_btn_border_normal',
						'selector'           => '{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action'
					]
				);

				$this->add_responsive_control(
					'slicko_modal_btn_radius',
					[
						'label'      => __( 'Border Radius', 'slicko' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'default'    => [
							'top'    => '50',
							'right'  => '50',
							'bottom' => '50',
							'left'   => '50',
							'unit'   => 'px'
						],
						'selectors'  => [
							'{{WRAPPER}} .slicko-modal-image-action, {{WRAPPER}} .slicko-modal-image-action::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

				$this->add_responsive_control(
					'slicko_modal_btn_padding',
					[
						'label'        => __( 'Padding', 'slicko' ),
						'type'         => Controls_Manager::DIMENSIONS,
						'size_units'   => [ 'px', '%' ],
						'default'      => [
							'top'      => '20',
							'right'    => '0',
							'bottom'   => '20',
							'left'     => '0',
							'unit'     => 'px',
							'isLinked' => false
						],
						'selectors'    => [
							'{{WRAPPER}} .slicko-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'slicko_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'slicko' ) ] );

				$this->add_control(
					'slicko_modal_btn_color_hover',
					[
						'label'     => __( 'Text Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#fff',
						'selectors' => [
							'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action:hover span' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'slicko_modal_btn_background_hover',
					[
						'label'     => __( 'Background Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $secondary_color,
						'selectors' => [
							'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'slicko_modal_btn_border_hover',
						'selector' => '{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action:hover'
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();

		/**
		 * Modal Popup Icon section
		 */
		$this->start_controls_section(
			'slicko_modal_icon_section',
			[
				'label' => __( 'Icon', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
				]
		);
		$this->start_controls_tabs( 'slicko_modal_icon_tabs', ['separator' => 'before' ] );
		$this->start_controls_tab( 'icon_normal', [ 'label' => esc_html__( 'Normal', 'slicko' )] );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => '',
				'selector'  => '{{WRAPPER}} .slicko-modal-image-action span i',
			]
		);

		$this->add_control(
			'slicko_modal_btn_icon_color',
			[
				'label'     => __( 'Icon Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action span i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'slicko_modal_btn_icon_background_color',
			[
				'label'     => __( 'Background Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
					'{{WRAPPER}} .slicko-video-btn' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'slicko_modal_icon_border',
				'selector' => '{{WRAPPER}} .slicko-video-btn'
			]
		);

		$this->add_control(
			'slicko_modal_btn_icon_align',
			[
				'label'     => __( 'Icon Position', 'slicko' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'slicko' ),
					'right' => __( 'After', 'slicko' )
				],
				'condition' => [
                    'slicko_modal_btn_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'slicko_modal_btn_icon_size',
			[
				'label'       => __( 'Icon Box Size', 'slicko' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .slicko-video-btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					
				],
				'condition'   => [
                    'slicko_modal_btn_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'slicko_modal_btn_icon_indent',
			[
				'label'       => __( 'Icon Spacing', 'slicko' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action span.slicko-modal-action-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slicko-modal-button .slicko-modal-image-action span.slicko-modal-action-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
                    'slicko_modal_btn_icon[value]!' => ''
                ]
			]
		);
		$this->add_responsive_control(
			'slicko_modal_btn_icon_radius',
			[
				'label'      => __( 'Border Radius', 'slicko' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .slicko-video-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();

			$this->start_controls_tab( 'icon_hover', [ 'label' => esc_html__( 'Hover', 'slicko' )] );
				$this->add_control(
					'slicko_modal_btn_icon_background_hover_color',
					[
						'label'     => __( 'Background Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222',
						'selectors' => [
							'{{WRAPPER}} .slicko-video-btn:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_control(
					'slicko_modal_btn_icon_hover_color',
					[
						'label'     => __( 'Color', 'slicko' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222',
						'selectors' => [
							'{{WRAPPER}} .slicko-video-btn:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'slicko_modal_icon_border_hover',
						'selector' => '{{WRAPPER}} .slicko-video-btn:hover'
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Modal Popup Container section
		 */
		$this->start_controls_section(
			'slicko_modal_container_section',
			[
				'label' => __( 'Container', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'slicko_modal_content_align',
			[
				'label'     => __( 'Alignment', 'slicko' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'center',
				'options'   => [
					'left'  => [
						'title' => __( 'Left', 'slicko' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'slicko' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'slicko' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element' => 'text-align: {{VALUE}};'
				],
				'condition' => [
					'slicko_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_responsive_control(
			'slicko_modal_content_height',
			[
				'label' => __( 'Contant Height for Tablet & Mobile', 'slicko' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'slicko_modal_image_gallery_description_typography',
				'selector'  => '{{WRAPPER}} .slicko-modal-content .slicko-modal-element .slicko-modal-element-card .slicko-modal-element-card-body p',
				'condition' => [
					'slicko_modal_content' => [ 'image-gallery' ]
				]
			]
		);

		$this->add_control(
			'slicko_modal_image_gallery_description_color',
			[
				'label'     => __( 'Description Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-content .slicko-modal-element .slicko-modal-element-card .slicko-modal-element-card-body p'  => 'color: {{VALUE}};'
				],
				'condition' => [
					'slicko_modal_content' => [ 'image-gallery' ]
				]
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'slicko_modal_content_border',
				'selector' => '{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element'
			]
		);

		$this->add_control(
			'slicko_modal_image_gallery_bg',
			[
				'label'     => __( 'Background Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'slicko_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_control(
			'slicko_modal_image_gallery_padding',
			[
				'label'      => __( 'Padding', 'slicko' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element .slicko-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'slicko_modal_content' => [ 'image-gallery', 'html_content' ]
				]
			]
		);

        $this->add_responsive_control(
            'slicko_modal_image_gallery_description_margin',
            [
                'label'      => __('Margin(Description)', 'slicko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slicko-modal-item .slicko-modal-content .slicko-modal-element .slicko-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'condition'  => [
					'slicko_modal_content' => [ 'image-gallery' ]
				]
            ]
        );

		$this->add_control(
			'slicko_modal_overlay_overflow_x',
			[
				'label'        => __( 'Overflow X', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'slicko' ),
				'label_off'    => __( 'No', 'slicko' ),
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'slicko_modal_overlay_overflow_y',
			[
				'label'        => __( 'Overflow Y', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'slicko' ),
				'label_off'    => __( 'No', 'slicko' ),
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slicko_modal_animation_tab',
			[
				'label' => __( 'Animation', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'slicko_modal_transition',
			[
				'label'   => __( 'Style', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'    => __( 'Top To Middle', 'slicko' ),
					'bottom-to-middle' => __( 'Bottom To Middle', 'slicko' ),
					'right-to-middle'  => __( 'Right To Middle', 'slicko' ),
					'left-to-middle'   => __( 'Left To Middle', 'slicko' ),
					'zoom-in'          => __( 'Zoom In', 'slicko' ),
					'zoom-out'         => __( 'Zoom Out', 'slicko' ),
					'left-rotate'      => __( 'Rotation', 'slicko' )
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup overlay style
		 */

		$this->start_controls_section(
			'slicko_modal_overlay_tab',
			[
				'label'     => __( 'Overlay', 'slicko' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slicko_modal_overlay' => 'yes'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'slicko_modal_overlay_color',
                'types'           => [ 'classic' ],
                'selector'        => '{{WRAPPER}} .slicko-modal-overlay',
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => 'rgba(0,0,0,.5)'
                    ]
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * Modal Popup Close button style
		 */

		$this->start_controls_section(
			'slicko_modal_close_btn_style',
			[
				'label' => __( 'Close Button', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'slicko_modal_close_btn_position',
			[
				'label' => __( 'Close Button Position', 'slicko' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'slicko' ),
				'label_on' => __( 'Custom', 'slicko' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->start_popover();

            $this->add_responsive_control(
                'slicko_modal_close_btn_position_x_offset',
                [
                    'label' => __( 'X Offset', 'slicko' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'slicko_modal_close_btn_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'slicko' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

		$this->add_responsive_control(
            'slicko_modal_close_btn_icon_size',
            [
				'label'      => __( 'Icon Size', 'slicko' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
                    'px'       => [
						'min'  => 0,
						'max'  => 30,
                    ],
                ],
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 20
                ],
                'selectors' => [
					'{{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_control(
			'slicko_modal_close_btn_color',
			[
				'label'     => __( 'Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn span::before, {{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'slicko_modal_close_btn_bg_color',
			[
				'label'    => __( 'Background Color', 'slicko' ),
				'type'     => Controls_Manager::COLOR,
				'default'  => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .slicko-modal-item.modal-vimeo .slicko-modal-content .slicko-close-btn'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings            = $this->get_settings_for_display();

		if( 'youtube' === $settings['slicko_modal_content'] ){
			$url = $settings['slicko_modal_youtube_video_url'];

			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

			$youtube_id = $matches[1];
		}

		if( 'vimeo' === $settings['slicko_modal_content'] ){
			$vimeo_url       = $settings['slicko_modal_vimeo_video_url'];
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode( '&', str_replace('https://vimeo.com', '', end($vimeo_id_select) ) );
			$vimeo_id        = $vidid[0];
		}

		$this->add_render_attribute( 'slicko_modal_action', [
			'class'             => 'slicko-modal-image-action image-modal',
			'data-slicko-modal'   => '#slicko-modal-' . $this->get_id(),
			'data-slicko-overlay' => esc_attr( $settings['slicko_modal_overlay'] )
		] );

		$this->add_render_attribute( 'slicko_modal_overlay', [
			'class'                         => 'slicko-modal-overlay',
			'data-slicko_overlay_click_close' => $settings['slicko_modal_overlay_click_close']
		] );
		
		$this->add_render_attribute('slicko_modal_btn_after_title', 'class', 'slicko-modal-btn_after_title');
		$this->add_render_attribute( 'slicko_modal_item', 'class', 'slicko-modal-item' );
		$this->add_render_attribute( 'slicko_modal_item', 'class', 'modal-vimeo' );
		$this->add_render_attribute( 'slicko_modal_item', 'class', $settings['slicko_modal_transition'] );
		$this->add_render_attribute( 'slicko_modal_item', 'class', $settings['slicko_modal_content'] );
		$this->add_render_attribute( 'slicko_modal_item', 'class', esc_attr('slicko-content-overflow-x-' . $settings['slicko_modal_overlay_overflow_x'] ) );
		$this->add_render_attribute( 'slicko_modal_item', 'class', esc_attr('slicko-content-overflow-y-' . $settings['slicko_modal_overlay_overflow_y'] ) );

         $rdevs_overly = $settings['slicko_modal_button_overlay'];

		 $overly = '';
		 if('yes' == $rdevs_overly ){
			$overly = 'slicko-modal-overly-button';
		 }else{
			$overly = '';
		 }
	
		?>

		<div class="slicko-modal">
			<div class="slicko-modal-wrapper">

				<div class="slicko-modal-button <?php echo esc_attr( $overly ); ?>    slicko-modal-btn-fixed-width-<?php echo esc_attr($settings['slicko_modal_btn_enable_fixed_width_height']);?>">
					<a href="#" <?php echo $this->get_render_attribute_string('slicko_modal_action');?> >
						<span class="slicko-video-btn slicko-modal-action-icon-<?php echo esc_attr($settings['slicko_modal_btn_icon_align']);?>">
							<?php if( 'left' === $settings['slicko_modal_btn_icon_align'] && !empty( $settings['slicko_modal_btn_icon']['value'] ) ) {
								Icons_Manager::render_icon( $settings['slicko_modal_btn_icon'], [ 'aria-hidden' => 'true' ] );
							}
							echo esc_html( $settings['slicko_modal_btn_text'] );
							if( 'right' === $settings['slicko_modal_btn_icon_align'] && !empty( $settings['slicko_modal_btn_icon']['value'] ) ) {
								Icons_Manager::render_icon( $settings['slicko_modal_btn_icon'], [ 'aria-hidden' => 'true' ] );
							} ;?>
						</span>

						<?php if ( 'yes' === $settings['show_btn_after_text'] ): ?>
						<span <?php echo $this->get_render_attribute_string('slicko_modal_btn_after_title'); ?>><?php echo esc_html( $settings['btn_after_title']); ?></span>
						<?php endif; ?>	
					</a>
				</div>

				<div id="slicko-modal-<?php echo esc_attr( $this->get_id() );?>" <?php echo $this->get_render_attribute_string('slicko_modal_item') ;?> >
					<div class="slicko-modal-content">
						<div class="slicko-modal-element <?php echo esc_attr( $settings['slicko_modal_image_gallery_column'] );?>">
							<?php if ( 'image' === $settings['slicko_modal_content'] ) {
								echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'slicko_modal_image' );
							}

							if ( 'image-gallery' === $settings['slicko_modal_content'] ) {
								foreach ( $settings['slicko_modal_image_gallery_repeater'] as $gallery ) : ?>
									<div class="slicko-modal-element-card">
										<div class="slicko-modal-element-card-thumb">
											<?php echo Group_Control_Image_Size::get_attachment_image_html( $gallery, 'thumbnail', 'slicko_modal_image_gallery' );?>
										</div>
										<?php if ( !empty( $gallery['slicko_modal_image_gallery_text'] ) ) {?>
											<div class="slicko-modal-element-card-body">
												<p><?php echo wp_kses_post( $gallery['slicko_modal_image_gallery_text'] );?></p>
											</div>
										<?php } ;?>
									</div>
								<?php
								endforeach;
							}

							if ( 'html_content' === $settings['slicko_modal_content'] ) { ?>
								<div class="slicko-modal-element-body">
									<p><?php echo wp_kses_post( $settings['slicko_modal_html_content'] );?></p>
								</div>
							<?php }

							if ( 'youtube' === $settings['slicko_modal_content'] ) { ?>
								<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id );?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ( 'vimeo' === $settings['slicko_modal_content'] ) { ?>
								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'external-video' === $settings['slicko_modal_content'] ) { ?>
								<video class="slicko-video-hosted" src="<?php echo esc_url( $settings['slicko_modal_external_video']['url'] );?>" controls="" controlslist="nodownload">
								</video>
							<?php }

							if ( 'external_page' === $settings['slicko_modal_content'] ) { ?>
								<iframe src="<?php echo esc_url( $settings['slicko_modal_external_page_url'] );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'shortcode' === $settings['slicko_modal_content'] ) {
								echo do_shortcode( $settings['slicko_modal_shortcode'] );
							} ;?>

							<div class="slicko-close-btn">
								<span></span>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div <?php echo $this->get_render_attribute_string('slicko_modal_overlay');?>></div>
		</div>
	<?php
	}
}
$widgets_manager->register_widget_type( new \Slicko_Addons\Widgets\Slicko_Modal_Popup() );