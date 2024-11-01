<?php
/**
 * Slide
 *
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\DIVIDER;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\utils;
use Elementor\Widget_Base;
if (!defined('ABSPATH')) {
    exit;
}
class Slicko_Advanced_Slides extends \Elementor\Widget_Base {
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'slicko-advance-slide';
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Slicko Advance Slides', 'slicko-addons');
    } 
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slides';
    }
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['slicko-addons'];
    }
    public function get_keywords() {
        return ['slides', 'slide', 'slicko-addons', 'banner', 'hero'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Slides', 'slicko-addons'),
            ]
        );
        //Start Repetare Content  slide one
        $repeater = new Repeater();
        $repeater->add_control(
            'active_slides',
            [
                'label'     => __('Active Item', 'slicko-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('No', 'slicko-addons'),
                'label_off' => __('yes', 'slicko-addons'),
                'default' => 'no',
            ]
        );
        $repeater->add_control(
			'selected_template',
			[
				'label' => __( 'Select Template', 'slicko-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => slicko_cpt_slug_and_id('slicko_slide'),
			]
		);
        //End Repeater Control field
        $this->add_control(
            'slides',
            [
                'label'        => __('Slide List', 'slicko-addons'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),

            ]
        );
        $this->end_controls_section();

        //Slider Setting
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Settings', 'slicko-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'slicko-addons'),
                'type' => Controls_Manager::SELECT,
                'default'            => 1,
                'tablet_default'     => 1,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'slicko-addons'),
                'label_off' => __('Hide', 'slicko-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'slicko-addons'),
                'label_off' => __('Hide', 'slicko-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'slicko-addons'),
                'label_off' => __('Hide', 'slicko-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'slicko-addons'),
                'label_off' => __('Hide', 'slicko-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'slicko-addons'),
                'label_off' => __('Hide', 'slicko-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'slicko-addons'),
                'label_off' => __('Hide', 'slicko-addons'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'slicko-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'slicko-addons'),
                    '2000'  => __('2 Second', 'slicko-addons'),
                    '3000'  => __('3 Second', 'slicko-addons'),
                    '4000'  => __('4 Second', 'slicko-addons'),
                    '5000'  => __('5 Second', 'slicko-addons'),
                    '6000'  => __('6 Second', 'slicko-addons'),
                    '7000'  => __('7 Second', 'slicko-addons'),
                    '8000'  => __('8 Second', 'slicko-addons'),
                    '9000'  => __('9 Second', 'slicko-addons'),
                    '10000' => __('10 Second', 'slicko-addons'),
                    '11000' => __('11 Second', 'slicko-addons'),
                    '12000' => __('12 Second', 'slicko-addons'),
                    '13000' => __('13 Second', 'slicko-addons'),
                    '14000' => __('14 Second', 'slicko-addons'),
                    '15000' => __('15 Second', 'slicko-addons'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'slicko-addons'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __('Next Icon', 'slicko-addons'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        Dots
       */
      $this->start_controls_section(
        'dots_navigation',
        [
            'label' => __('Navigation - Dots', 'slicko-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'dots' => 'yes'
            ],
        ]
    );
    $this->start_controls_tabs('_tabs_dots');

    $this->start_controls_tab(
        '_tab_dots_normal',
        [
            'label' => __('Normal', 'slicko-addons'),
        ]
    );

    $this->add_control(
        'dots_color',
        [
            'label' => __('Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_align',
        [
            'label' => __('Alignment', 'slicko-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => __('Left', 'slicko-addons'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'slicko-addons'),
                    'icon' => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => __('Right', 'slicko-addons'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list' => 'justify-content: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_box_width',
        [
            'label' => __('Width', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_box_height',
        [
            'label' => __('Height', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_margin',
        [
            'label'          => __('Gap Right', 'slicko-addons'),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
                'unit' => 'px',
            ],
            'range'          => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors'      => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .slicko-testimonial-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'dots_min_margin',
        [
            'label'      => __('Margin', 'slicko-addons'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'dots_border_radius',
        [
            'label'      => __('Border Radius', 'slicko-addons'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .slicko-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        '_tab_dots_active',
        [
            'label' => __('Active', 'slicko-addons'),
        ]
    );
    $this->add_control(
        'dots_color_active',
        [
            'label' => __('Active Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_dots_box_active_width',
        [
            'label' => __('Width', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_dots_box_active_height',
        [
            'label' => __('Height', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
            ],
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->end_controls_section();

    /*
    *
        Arrows
    */
    $this->start_controls_section(
        'arrows_navigation',
        [
            'label' => __('Navigation - Arrow', 'slicko-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'arrows' => 'yes',
            ],
        ]
    );

    $this->start_controls_tabs('_tabs_arrow');

    $this->start_controls_tab(
        '_tab_arrow_normal',
        [
            'label' => __('Normal', 'slicko-addons'),
        ]
    );

    $this->add_control(
        'arrow_color',
        [
            'label' => __('Arrow Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button svg path' => 'stroke: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_color_fill',
        [
            'label' => __('Arrow Line Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button' => 'color: {{VALUE}};',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_color',
        [
            'label' => __('Background Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button' => 'background-color: {{VALUE}} !important;',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'arrow_shadow',
            'label' => __('Shadow', 'fd-addons'),
            'selector' => '{{WRAPPER}} .slicko-testimonial-slider-arrow button ',
        ]
    );

    $this->add_control(
        'arrow_position_toggle',
        [
            'label' => __('Position', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off' => __('None', 'slicko-addons'),
            'label_on' => __('Custom', 'slicko-addons'),
            'return_value' => 'yes',
        ]
    );
    $this->start_popover();

    /*
    Arrow Position
    */
    $start = is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');
    $end = !is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');

    /* tobol */
    $this->add_control(
        'offset_orientation_v',
        [
            'label' => __('Vertical Orientation', 'elementor'),
            'type' => Controls_Manager::CHOOSE,
            'toggle' => false,
            'default' => 'start',
            'options' => [
                'top' => [
                    'title' => __('Top', 'elementor'),
                    'icon' => 'eicon-v-align-top',
                ],
                'bottom' => [
                    'title' => __('Bottom', 'elementor'),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'render_type' => 'ui',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow' => '{{VALUE}}: 0;',
            ],

        ]
    );

    $this->add_responsive_control(
        'arrow_position_top',
        [
            'label' => __('Vertical', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
            ],
            'condition' => [
                'offset_orientation_v' => 'top',
            ],
        ]
    );


    $this->add_responsive_control(
        'arrow_position_bottom',
        [
            'label' => __('Vertical', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
            ],
            'condition' => [
                'offset_orientation_v' => 'bottom',
            ],
        ]
    );


    $this->add_control(
        'arrow_horizontal_position',
        [
            'label'             => __('Horizontal Position', 'slicko-addons'),
            'type'              => Controls_Manager::SELECT,
            'default'           => 'default',
            'options'           => [
                'default'    =>   __('Default',    'slicko-addons'),
                'space_between'    =>   __('Space Between',    'slicko-addons'),
            ],
            'separator' => 'after',
        ]
    );
    $this->add_responsive_control(
        'arrow_position_x_prev',
        [
            'label' => __('Horizontal Prev', 'happy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 2000,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}  .slicko-testimonial-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'space_between',
            ],

        ]
    );



    // default == arrow gap
    // space-between == left position, right position

    $this->add_responsive_control(
        'arrow_position_right',
        [
            'label' => __('Horizontal Next', 'happy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => -2000,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'space_between',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_gap_',
        [
            'label' => __('Arrow Gap', 'happy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'max' => 1000,
                ],
                '%' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'default',
            ],
        ]
    );

    $this->add_responsive_control(
        'align_arrow',
        [
            'label' => __('Alignment', 'slicko-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'slicko-addons'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'slicko-addons'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'slicko-addons'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'default',
            ],
        ]
    );

    $this->end_popover();

    $this->add_responsive_control(
        'arrow_icon_size',
        [
            'label' => __('Icon Size', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}  .slicko-testimonial-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}}  .slicko-testimonial-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_size_box',
        [
            'label' => __('Size', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 20,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
            ],
        ]

    );

    $this->add_responsive_control(
        'arrow_size_line_height',
        [
            'label' => __('Line Height', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
            ],
        ]

    );
    $this->add_group_control(
       Group_Control_Border::get_type(),
        [
            'name'     => 'btn_border',
            'label'    => __( 'Button border', 'slicko-addons' ),
            'selector' => '{{WRAPPER}} .slicko-testimonial-slider-arrow button',
        ]
    );

    $this->add_responsive_control(
        'arrows_border_radius',
        [
            'label'      => __('Border Radius', 'slicko-addons'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .slicko-testimonial-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        '_tab_arrow_hover',
        [
            'label' => __('Hover', 'slicko-addons'),
        ]
    );

    $this->add_control(
        'arrow_hover_color',
        [
            'label' => __('Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
            ],
        ]
    );

    $this->add_control(
        'arrow_hover_fill_color',
        [
            'label' => __('Line Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_hover_color',
        [
            'label' => __('Background Color Hover', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
         [
             'name'     => 'btn_hover_border',
             'label'    => __( 'Button border', 'slicko-addons' ),
             'selector' => '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover',
         ]
     );

     $this->add_responsive_control(
         'arrows_hover_border_radius',
         [
             'label'      => __('Border Radius', 'slicko-addons'),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => ['px'],
             'selectors'  => [
                 '{{WRAPPER}} .slicko-testimonial-slider-arrow button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 'body.rtl {{WRAPPER}} .slicko-testimonial-slider-arrow button:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
             ],
         ]
     );

    $this->end_controls_tab();

    $this->start_controls_tab(
        '_tab_arrow_active',
        [
            'label' => __('Active', 'slicko-addons'),
        ]
    );

    $this->add_control(
        'arrow_active_color',
        [
            'label' => __('Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
            ],
        ]
    );

    $this->add_control(
        'arrow_active_fill_color',
        [
            'label' => __('Line Color', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_active_color',
        [
            'label' => __('Background Color Hover', 'slicko-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
         [
             'name'     => 'btn_active_border',
             'label'    => __( 'Button border', 'slicko-addons' ),
             'selector' => '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active button',
         ]
     );

     $this->add_responsive_control(
         'arrows_active_border_radius',
         [
             'label'      => __('Border Radius', 'slicko-addons'),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => ['px'],
             'selectors'  => [
                 '{{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 'body.rtl {{WRAPPER}} .slicko-testimonial-slider-arrow .slick-active button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
             ],
         ]
     );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();
     
    }
    //End Repetare Content
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();



        $slider_extraSetting = array(
            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );

        $jasondecode = wp_json_encode($slider_extraSetting);
        $this->add_render_attribute('slicko_slider_version', 'class', array('slicko-addons--slide-content-wrap'));
        $this->add_render_attribute('slicko_slider_version', 'data-settings', $jasondecode);
      

        ?>
            <div class="slicko-addons-slide-wrapper">
                <div <?php echo $this->get_render_attribute_string('slicko_slider_version'); ?>>
                <?php foreach ($settings['slides'] as $value):
                        $active = $value['active_slides'] == 'yes' ? 'current' : '';
                        ?>
	                    <div id="slide-<?php echo esc_attr($value['_id']) ?>" class="slicko-addons-slide-content-single   
                        <?php echo esc_attr($active) ?>">
                            <?php
                            if($value['selected_template'] && \Elementor\Plugin::$instance->editor->is_edit_mode()){
                                echo '<div class="slicko-addons-elm-edit-wrap"><a href="'.\Elementor\Plugin::$instance->documents->get( $value['selected_template'] )->get_edit_url().'" class="slicko-addons-elm-edit">'.esc_html__('Edit Template', 'slicko-addons').'</a></div>';
                            }
                            ?>
	                        <?php echo slicko_layout_content($value['selected_template']) ?>
	                    </div>
	                <?php endforeach;?>
                </div>
            </div>
            <?php if ('yes' == $settings['arrows']) : ?>
                <div class="slicko-testimonial-slider-arrow">
                    <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                        <button type="button" class="slick-prev prev slick-arrow slick-active">
                            <?php Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>
                    <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                        <button type="button" class="slick-next next slick-arrow ">
                            <?php Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
	<?php
}
}
$widgets_manager->register_widget_type(new \Slicko_Advanced_Slides());
