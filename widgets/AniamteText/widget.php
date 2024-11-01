<?php
namespace Slicko_Addons\Widgets\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class Slicko_Animated_Text extends Widget_Base {
	public function get_name() {
		return 'slicko-animated';
	}
	public function get_title() {
		return esc_html__( 'Animated Text', 'slicko' );
	}
	public function get_icon() {
		return 'slicko eicon-animated-headline';
	}
   	public function get_categories() {
		return [ 'slicko' ];
	}
	public function get_keywords() {
        return [ 'slicko', 'fancy', 'heading', 'animate', 'animation' ];
    }
	protected function register_controls() {
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');
	    /*
	    * Animated Text Content
	    */
	    $this->start_controls_section(
	        'slicko_section_animated_text_content',
	        [
	            'label' => esc_html__( 'Content', 'slicko' )
	        ]
		);
		$this->add_control(
	        'slicko_animated_text_before_text',
	        [
				'label'   => esc_html__( 'Before Text', 'slicko' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'This is', 'slicko' ),
				'dynamic'     => [ 'active' => true ],
	        ]
		);
		$this->add_control(
			'slicko_animated_text_animated_heading',
			[
				'label'       => esc_html__( 'Animated Text', 'slicko' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your animated text with comma separated.', 'slicko' ),
				'description' => __( '<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'slicko' ),
				'default'     => esc_html__( 'Slicko, Addons, Elementor', 'slicko' ),
				'dynamic'     => [ 'active' => true ]
			]
		);
		$this->add_control(
	        'slicko_animated_text_after_text',
	        [
				'label'   => esc_html__( 'After Text', 'slicko' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'For You.', 'slicko' ),
				'dynamic'     => [ 'active' => true ],
	        ]
		);
		$this->add_control(
			'slicko_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'slicko' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'slicko' ),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'slicko' ),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'slicko' ),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'slicko' ),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'slicko' ),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'slicko' ),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'slicko' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => true,
				'options' => [
					'left'   => [
						'title' => __( 'Left', 'slicko' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __( 'Center', 'slicko' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'  => [
						'title' => __( 'Right', 'slicko' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left',
				'selectors'     => [
                    '{{WRAPPER}} .slicko-animated-text-align' => 'text-align: {{VALUE}};'
                ]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Container Style
	    */
	    $this->start_controls_section(
	        'slicko_section_animated_text_animation_tyle',
	        [
				'label' => esc_html__( 'Animation', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_control(
			'slicko_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__( 'Animation Type', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slicko-typed-animation',
				'options' => [
					'slicko-typed-animation'   => __( 'Typed', 'slicko' ),
					'slicko-morphed-animation' => __( 'Animate', 'slicko' )
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__( 'Animation Style', 'slicko' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __( 'Fade In', 'slicko' ),
					'fadeInUp'          => __( 'Fade In Up', 'slicko' ),
					'fadeInDown'        => __( 'Fade In Down', 'slicko' ),
					'fadeInLeft'        => __( 'Fade In Left', 'slicko' ),
					'fadeInRight'       => __( 'Fade In Right', 'slicko' ),
					'zoomIn'            => __( 'Zoom In', 'slicko' ),
					'zoomInUp'          => __( 'Zoom In Up', 'slicko' ),
					'zoomInDown'        => __( 'Zoom In Down', 'slicko' ),
					'zoomInLeft'        => __( 'Zoom In Left', 'slicko' ),
					'zoomInRight'       => __( 'Zoom In Right', 'slicko' ),
					'slideInDown'       => __( 'Slide In Down', 'slicko' ),
					'slideInUp'         => __( 'Slide In Up', 'slicko' ),
					'slideInLeft'       => __( 'Slide In Left', 'slicko' ),
					'slideInRight'      => __( 'Slide In Right', 'slicko' ),
					'bounce'            => __( 'Bounce', 'slicko' ),
					'bounceIn'          => __( 'Bounce In', 'slicko' ),
					'bounceInUp'        => __( 'Bounce In Up', 'slicko' ),
					'bounceInDown'      => __( 'Bounce In Down', 'slicko' ),
					'bounceInLeft'      => __( 'Bounce In Left', 'slicko' ),
					'bounceInRight'     => __( 'Bounce In Right', 'slicko' ),
					'flash'             => __( 'Flash', 'slicko' ),
					'pulse'             => __( 'Pulse', 'slicko' ),
					'rotateIn'          => __( 'Rotate In', 'slicko' ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', 'slicko' ),
					'rotateInDownRight' => __( 'Rotate In Down Right', 'slicko' ),
					'rotateInUpRight'   => __( 'rotate In Up Right', 'slicko' ),
					'rotateIn'          => __( 'Rotate In', 'slicko' ),
					'rollIn'            => __( 'Roll In', 'slicko' ),
					'lightSpeedIn'      => __( 'Light Speed In', 'slicko' )
				],
				'condition' => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-morphed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Settings
	    */
	    $this->start_controls_section(
	        'slicko_section_animated_text_settings',
	        [
				'label' => esc_html__( 'Settings', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_control(
			'slicko_animated_text_animation_speed',
			[
				'label'     => __( 'Animation Speed', 'slicko' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-morphed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_type_speed',
			[
				'label'   => __( 'Type Speed', 'slicko' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_start_delay',
			[
				'label'     => __( 'Start Delay', 'slicko' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_back_type_speed',
			[
				'label'     => __( 'Back Type Speed', 'slicko' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_back_delay',
			[
				'label'     => __( 'Back Delay', 'slicko' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_loop',
			[
				'label'        => __( 'Loop', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'slicko' ),
				'label_off'    => __( 'OFF', 'slicko' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_show_cursor',
			[
				'label'        => __( 'Show Cursor', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'slicko' ),
				'label_off'    => __( 'OFF', 'slicko' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_fade_out',
			[
				'label'        => __( 'Fade Out', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'slicko' ),
				'label_off'    => __( 'OFF', 'slicko' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_smart_backspace',
			[
				'label'        => __( 'Smart Backspace', 'slicko' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'slicko' ),
				'label_off'    => __( 'OFF', 'slicko' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'slicko_animated_text_animated_heading_animated_type' => 'slicko-typed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text pre animated Text Style
		*/
	    $this->start_controls_section(
	        'slicko_pre_animated_text_style',
	        [
				'label'     => esc_html__( 'Pre Animated text', 'slicko' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slicko_animated_text_before_text!' => ''
				]
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slicko_pre_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .slicko-animated-text-pre-heading',
			]
		);
		$this->add_control(
			'slicko_pre_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text animated Text Style
	    */
	    $this->start_controls_section(
	        'slicko_animated_text_style',
	        [
				'label' => esc_html__( 'Animated text', 'slicko' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slicko_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .slicko-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);
		$this->add_control(
			'slicko_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'slicko_animated_text_spacing',
			[
				'label'      => __( 'Spacing', 'slicko' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
                    'unit'   => 'px',
                    'size'   => 8
                ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .slicko-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text post animated Text Style
	    */
	    $this->start_controls_section(
	        'slicko_post_animated_text_style',
	        [
				'label'     => esc_html__( 'Post Animated text', 'slicko' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slicko_animated_text_after_text!' => ''
				]
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slicko_post_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .slicko-animated-text-post-heading'
			]
		);
		$this->add_control(
			'slicko_post_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'slicko' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .slicko-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$id            = substr( $this->get_id_int(), 0, 3 );
		$type_heading  = explode( ',', $settings['slicko_animated_text_animated_heading'] );
		$before_text   = $settings['slicko_animated_text_before_text'];
		$heading_text  = $settings['slicko_animated_text_animated_heading'];
		$after_text    = $settings['slicko_animated_text_after_text'];
		$heading_tag   = $settings['slicko_animated_text_animated_heading_tag'];
		$heading_align = $settings['slicko_animated_text_animated_heading_alignment'];
		$this->add_render_attribute( 'slicko_typed_animated_string', 'class', 'slicko-typed-strings' );
		$this->add_render_attribute( 'slicko_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr( $settings['slicko_animated_text_animated_heading_animated_type'] )
			]
		);
		if($settings['slicko_animated_text_animated_heading_animated_type'] === 'slicko-typed-animation'){
			$this->add_render_attribute( 'slicko_typed_animated_string',
				[
					'data-type_speed'      => esc_attr( $settings['slicko_animated_text_type_speed'] ),
					'data-back_type_speed' => esc_attr( $settings['slicko_animated_text_back_type_speed'] ),
					'data-loop'            => esc_attr( $settings['slicko_animated_text_loop'] ),
					'data-show_cursor'     => esc_attr( $settings['slicko_animated_text_show_cursor'] ),
					'data-fade_out'        => esc_attr( $settings['slicko_animated_text_fade_out'] ),
					'data-smart_backspace' => esc_attr( $settings['slicko_animated_text_smart_backspace'] ),
					'data-start_delay'     => esc_attr( $settings['slicko_animated_text_start_delay'] ),
					'data-back_delay'      => esc_attr( $settings['slicko_animated_text_back_delay'] )
				]
			);
		}
		if($settings['slicko_animated_text_animated_heading_animated_type'] === 'slicko-morphed-animation'){
			$this->add_render_attribute( 'slicko_typed_animated_string',
				[
					'data-animation_style' => esc_attr( $settings['slicko_animated_text_animated_heading_animation_style'] ),
					'data-animation_speed' => esc_attr( $settings['slicko_animated_text_animation_speed'] )
				]
			);
		}
		$this->add_render_attribute( 'slicko_animated_text_animated_heading',
			[
				'id'    => 'slicko-animated-text-'.$id,
				'class' => 'slicko-animated-text-animated-heading'
			]
		);
		$this->add_render_attribute( 'slicko_animated_text_before_text', 'class', 'slicko-animated-text-pre-heading' );
        $this->add_inline_editing_attributes( 'slicko_animated_text_before_text' );
		$this->add_render_attribute( 'slicko_animated_text_after_text', 'class', 'slicko-animated-text-post-heading' );
        $this->add_inline_editing_attributes( 'slicko_animated_text_after_text' );
		echo '<div class="slicko-animated-text-align">';
			do_action( 'slicko_animated_text_wrapper_before' );
			echo '<'.esc_attr($heading_tag).' '.$this->get_render_attribute_string( 'slicko_typed_animated_string' ).'>';
				do_action( 'slicko_animated_text_content_before' );
				$before_text ? printf( '<span '.$this->get_render_attribute_string( 'slicko_animated_text_before_text' ).'>%s</span>', wp_kses_post($before_text) ) : '';
				if( 'slicko-typed-animation' === $settings['slicko_animated_text_animated_heading_animated_type'] ) {
					echo '<span id="slicko-animated-text-'.esc_attr($id).'" class="slicko-animated-text-animated-heading"></span>';
				}
				if( 'slicko-morphed-animation' === $settings['slicko_animated_text_animated_heading_animated_type'] ) {
					echo '<span '.$this->get_render_attribute_string( 'slicko_animated_text_animated_heading' ).'>'.wp_kses_post($heading_text).'</span>';
				}
				$after_text ? printf( '<span '.$this->get_render_attribute_string( 'slicko_animated_text_after_text' ).'>%s</span>', wp_kses_post($after_text) ) : '';
				do_action( 'slicko_animated_text_content_after' );
			echo '</'.esc_attr($heading_tag).'>';
			do_action( 'slicko_animated_text_wrapper_after' );
		echo '</div>';
	}
}
$widgets_manager->register_widget_type(new \Slicko_Addons\Widgets\Elementor\Slicko_Animated_Text());