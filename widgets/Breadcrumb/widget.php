<?php
namespace Slicko_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Utils;
use Slicko_Addons\Slicko_Addons_Breadcrumb_Trail;

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Slicko_Addons_Breadcrumb extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'slicko-breadcrumb';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Breadcrumb', 'slicko');
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'slicko eicon-yoast';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['slicko'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');

		//Display Text
		$this->start_controls_section(
			'_section_breadcrumbs_display',
			[
				'label' => __('Display Text', 'slicko'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'home',
			[
				'label'                 => __( 'Homepage', 'slicko' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __( 'Home', 'slicko' ),
			]
		);

		$this->add_control(
			'page_title',
			[
				'label'                 => __( 'Pages', 'slicko' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __( 'Pages', 'slicko' ),
			]
		);

		$this->add_control(
			'search',
			[
				'label'                 => __( 'Search', 'slicko' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __( 'Search results for:', 'slicko' ),
			]
		);

		$this->add_control(
			'error_404',
			[
				'label'                 => __( 'Error 404', 'slicko' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __( '404 Not Found', 'slicko' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_breadcrumbs',
			[
				'label' => __('Breadcrumbs', 'slicko'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'home_icon',
			[
				'label'					=> __( 'Home Icon', 'slicko' ),
				'label_block'			=> false,
				'type'					=> Controls_Manager::ICONS,
				'default'				=> [
					'value'		=> 'fas fa-home',
					'library'	=> 'fa-solid',
				],
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
			]
		);

		$this->add_control(
			'separator_type',
			[
				'label'                 => __( 'Separator Type', 'slicko' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'icon',
				'options'               => [
					'text'          => __( 'Text', 'slicko' ),
					'icon'          => __( 'Icon', 'slicko' ),
				],
			]
		);

		$this->add_control(
			'separator_text',
			[
				'label'                 => __( 'Separator', 'slicko' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __( '>', 'slicko' ),
				'condition'             => [
					'separator_type'    => 'text'
				],
			]
		);

		$this->add_control(
			'separator_icon',
			[
				'label'					=> __( 'Separator', 'slicko' ),
				'label_block'			=> false,
				'type'					=> Controls_Manager::ICONS,
				'default'				=> [
					'value'		=> 'fas fa-angle-right',
					'library'	=> 'fa-solid',
				],
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
				'condition'             => [
					'separator_type'    => 'icon'
				],
			]
		);

		$this->add_control(
			'show_on_front',
			[
				'label' => __( 'Show on front page', 'slicko' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_before_page',
			[
				'label' => __( 'Show on Menu page', 'slicko' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show last item', 'slicko' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'                 => __( 'Alignment', 'slicko' ),
				'type'                  => Controls_Manager::CHOOSE,
				'default'               => '',
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'slicko' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'slicko' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'slicko' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs'   => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Breadcrumbs Style
		$this->start_controls_section(
			'_section_breadcrumbs_style',
			[
				'label' => __('Breadcrumbs', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'breadcrumbs_background',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'breadcrumbs_border',
				'label'                 => __( 'Border', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs',
			]
		);

		$this->add_control(
			'breadcrumbs_border_radius',
			[
				'label'                 => __( 'Border Radius', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'breadcrumbs_shadow',
				'label' => __( 'Box Shadow', 'slicko' ),
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs',
			]
		);

		$this->add_responsive_control(
			'breadcrumbs_margin',
			[
				'label'                 => __( 'Margin', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'breadcrumbs_padding',
			[
				'label'                 => __( 'Padding', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Common Style
		$this->start_controls_section(
			'_section_common_style',
			[
				'label' => __('Common', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'common_spacing',
			[
				'label'                 => __( 'Spacing', 'slicko' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' 	=> [
						'max' => 50,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slicko-breadcrumbs li:last-child' => 'margin-right: 0;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_common_style' );

		$this->start_controls_tab(
			'tab_common_normal',
			[
				'label'                 => __( 'Normal', 'slicko' ),
			]
		);

		$this->add_control(
			'common_color',
			[
				'label'                 => __( 'Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => $secondary_color,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'common_background_color',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'common_typography',
				'label'                 => __( 'Typography', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'common_border',
				'label'                 => __( 'Border', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text',
			]
		);

		$this->add_control(
			'common_border_radius',
			[
				'label'                 => __( 'Border Radius', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_common_hover',
			[
				'label'                 => __( 'Hover', 'slicko' ),
			]
		);

		$this->add_control(
			'common_color_hover',
			[
				'label'                 => __( 'Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => $accent_color,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'common_background_color_hover',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'common_typography_hover',
				'label'                 => __( 'Typography', 'slicko' ),
				'exclude' => [
					'font_family',
					'font_size',
					'text_transform',
					'font_style',
					'line_height',
					'letter_spacing',
				],
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text:hover',
			]
		);

		$this->add_control(
			'common_border_color_hover',
			[
				'label'                 => __( 'Border Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'common_shadow',
				'label' => __( 'Box Shadow', 'slicko' ),
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text',
			]
		);

		$this->add_responsive_control(
			'common_padding',
			[
				'label'                 => __( 'Padding', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Home Style
		$this->start_controls_section(
			'_section_home_style',
			[
				'label' => __('Home', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_home_style' );

		$this->start_controls_tab(
			'tab_home_normal',
			[
				'label'                 => __( 'Normal', 'slicko' ),
			]
		);

		$this->add_control(
			'home_color',
			[
				'label'                 => __( 'Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'home_icon_color',
			[
				'label'                 => __( 'Home Icon Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text .slicko-breadcrumbs-home-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'home_background_color',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'home_typography',
				'label'                 => __( 'Typography', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'home_border',
				'label'                 => __( 'Border', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text',
			]
		);

		$this->add_control(
			'home_border_radius',
			[
				'label'                 => __( 'Border Radius', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_home_hover',
			[
				'label'                 => __( 'Hover', 'slicko' ),
			]
		);

		$this->add_control(
			'home_color_hover',
			[
				'label'                 => __( 'Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'home_icon_color_hover',
			[
				'label'                 => __( 'Home Icon Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text:hover .slicko-breadcrumbs-home-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text .slicko-breadcrumbs-home-icon' => '-webkit-transition: all .4s;transition: all .4s;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'home_background_color_hover',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'home_typography_hover',
				'label'                 => __( 'Typography', 'slicko' ),
				'exclude' => [
					'font_family',
					'font_size',
					'text_transform',
					'font_style',
					'line_height',
					'letter_spacing',
				],
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text:hover',
			]
		);

		$this->add_control(
			'home_border_color_hover',
			[
				'label'                 => __( 'Border Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-start span.slicko-breadcrumbs-text:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'home_spacing',
			[
				'label'                 => __( 'Home Icon Spacing', 'slicko' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' 	=> [
						'max' => 50,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li span.slicko-breadcrumbs-home-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator'             => 'before',
			]
		);

		$this->end_controls_section();

		//Separator Style
		$this->start_controls_section(
			'_section_separator_style',
			[
				'label' => __('Separator', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'                 => __( 'Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => $secondary_color,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'separator_background_color',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon, {{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'separator_typography',
				'label'                 => __( 'Typography', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon, {{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'separator_border',
				'label'                 => __( 'Border', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon, {{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon',
			]
		);

		$this->add_control(
			'separator_border_radius',
			[
				'label'                 => __( 'Border Radius', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'separator_padding',
			[
				'label'                 => __( 'Padding', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-separator span.slicko-breadcrumbs-separator-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Current Style
		$this->start_controls_section(
			'_section_current_style',
			[
				'label' => __('Current', 'slicko'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'current_color',
			[
				'label'                 => __( 'Color', 'slicko' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => $accent_color,
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-item.slicko-breadcrumbs-end span.slicko-breadcrumbs-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'current_background_color',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-item.slicko-breadcrumbs-end span.slicko-breadcrumbs-text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'current_typography',
				'label'                 => __( 'Typography', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-item.slicko-breadcrumbs-end span.slicko-breadcrumbs-text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'current_border',
				'label'                 => __( 'Border', 'slicko' ),
				'selector'              => '{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-item.slicko-breadcrumbs-end span.slicko-breadcrumbs-text',
			]
		);

		$this->add_control(
			'current_border_radius',
			[
				'label'                 => __( 'Border Radius', 'slicko' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .slicko-breadcrumbs li.slicko-breadcrumbs-item.slicko-breadcrumbs-end span.slicko-breadcrumbs-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$home_icon = '';
		if($settings['home_icon']['value']){
			$home_icon = sprintf( '<%1$s class="%2$s" aria-hidden="true"></%1$s>', tag_escape( 'i' ), esc_attr( $settings['home_icon']['value'] ) );
		}

		$separator = '';
		if( 'icon' === $settings['separator_type'] && $settings['separator_icon']['value'] ){
			$icon = sprintf( '<%1$s class="%2$s" aria-hidden="true"></%1$s>', tag_escape( 'i' ), esc_attr( $settings['separator_icon']['value'] ) );
			$attributes = 'class="slicko-breadcrumbs-separator-icon"';
			$separator = sprintf( '<%1$s %2$s>%3$s</%1$s>', tag_escape( 'span' ), $attributes, $icon );
		}elseif( 'text' === $settings['separator_type'] && $settings['separator_text'] ){
			$attributes = 'class="slicko-breadcrumbs-separator-text"';
			$separator = sprintf( '<%1$s %2$s>%3$s</%1$s>', tag_escape( 'span' ), $attributes, esc_html( $settings['separator_text'] ) );
		}

		$labels = array(
			'home' => $settings['home'] ? esc_html( $settings['home'] ) : '',
			'page_title' => $settings['page_title'] ? esc_html( $settings['page_title'] ) : '',
			'search' => $settings['search'] ? esc_html( $settings['search'] ).' %s' : '%s',
			'error_404' => $settings['error_404'] ? esc_html( $settings['error_404'] ) : '',
		);

		$args = array(
			'list_class'      => 'slicko-breadcrumbs',
			'item_class'      => 'slicko-breadcrumbs-item',
			'separator'      => $separator,
			'separator_class' => 'slicko-breadcrumbs-separator',
			'home_icon' => $home_icon,
			'home_icon_class' => 'slicko-breadcrumbs-home-icon',
			'labels' => $labels,
			'show_on_front' => 'yes' === $settings['show_on_front'] ? true : false,
			'show_title' => 'yes' === $settings['show_title'] ? true : false,
		);

		$breadcrumb = new Slicko_Addons_Breadcrumb_Trail( $args );
		echo $breadcrumb->trail();
	}

}
$widgets_manager->register_widget_type( new \Slicko_Addons\Widgets\Slicko_Addons_Breadcrumb() );