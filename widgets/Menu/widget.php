<?php
namespace Slicko_Addons\Widgets;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Slicko_Main_Menu extends Widget_Base {
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
    public function get_name() {
        return 'slicko-main-menu';
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
    public function get_title() {
        return __( 'Primary Menu', 'slicko' );
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
    public function get_icon() {
        return 'slicko eicon-nav-menu';
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
    public function get_categories() {
        return ['slicko'];
    }
    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.3.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus() {
        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) {
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $secondary_color = get_theme_mod('secondary_color');
        $accent_color = get_theme_mod('accent_color');
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __( 'Content', 'slicko' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'use_main_menu',
            [
                'label'        => __( 'Use Main Menu', 'slicko' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'slicko' ),
                'label_off'    => __( 'No', 'slicko' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $menus = $this->get_available_menus();
        if ( !empty( $menus ) ) {
            $this->add_control(
                'primary_menu',
                [
                    'label'        => __( 'Menu', 'header-footer-elementor' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
                    'condition'    => [
                        'use_main_menu!' => 'yes',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->add_control(
            'menu_style',
            [
                'label'   => __( 'Menu Style', 'slicko' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline' => __( 'Inline', 'slicko' ),
                    'flyout' => __( 'Flyout', 'slicko' ),
                ],
            ]
        );

        $this->add_control(
            'mobile_menu_style',
            [
                'label'   => __( 'Mobile Menu Style', 'slicko' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'Style 1', 'slicko' ),
                    '2' => __( 'Style 2', 'slicko' ),
                    '3' => __( 'Style 3', 'slicko' ),
                    '4' => __( 'Style 4', 'slicko' ),
                ],
            ]
        );

        $this->add_control(
			'menu_logo',
            [
                'label' => __( 'Menu Logo', 'slicko' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slicko-menu-logo' => 'background-image: url({{URL}});',
                ],

                'condition' => [
                    'mobile_menu_style' => '4',
                ],
            ]
		);



        $this->add_control(
            'trigger_label',
            [
                'label' => __( 'Trigger Label', 'slicko' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'trigger_open_icon',
            [
                'label'   => __( 'Trigger Icon', 'slicko' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fa fa-align-justify',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'trigger_close_icon',
            [
                'label'   => __( 'Trigger Close Icon', 'slicko' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'far fa-window-close',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_align',
            [
                'label'     => __( 'Align', 'slicko' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __( 'Left', 'slicko' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'top', 'slicko' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'slicko' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'flex-end',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .navbar' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'header_infos_section',
            [
                'label'     => __( 'Header Info', 'slicko' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'menu_style' => 'flyout',
                ],
            ]
        );
        $this->add_control(
            'show_infos',
            [
                'label'        => __( 'Show Title', 'slicko' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'slicko' ),
                'label_off'    => __( 'Hide', 'slicko' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition'    => [
                    'menu_style' => 'flyout',
                ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'info_title',
            [
                'label'       => __( 'Title', 'slicko' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'info Title', 'slicko' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'info_content',
            [
                'label'      => __( 'Content', 'slicko' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'info Content', 'slicko' ),
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            'info_url',
            [
                'label'         => __( 'Link', 'slicko' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'slicko' ),
                'show_external' => true,
            ]
        );
        $this->add_control(
            'header_infos',
            [
                'label'       => __( 'Repeater info', 'slicko' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'info_title'   => __( 'Call us:', 'slicko' ),
                        'info_content' => __( '(234) 567 8901', 'slicko' ),
                    ],
                ],
                'title_field' => '{{{ info_title }}}',
                'condition'   => [
                    'show_infos' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_menu_style',
            [
                'label'     => __( 'Menu Style', 'slicko' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ],
            ]
        );
        $this->start_controls_tabs(
            'menu_items_tabs'
        );
        $this->start_controls_tab(
            'menu_normal_tab',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'label'    => __( 'Menu Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a',
            ]
        );
        $this->add_control(
            'menu_color',
            [
                'label'     => __( 'Item Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle'                    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __( 'Item Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => __( 'Menu Gap', 'slicko' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'       => 'margin-right: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __( 'Item Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'                      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'                            => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_readius',
            [
                'label'      => __( 'Item Radius', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'       => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'menu_hover_tab',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
        );
        $this->add_control(
            'menu_hover_color',
            [
                'label'     => __( 'Menu Hover Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a:hover,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav li.current-menu-item>a'                                      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .sub-menu:not(.slicko-megamenu-builder-content-wrap) a .menu-item-text:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_hover_color',
            [
                'label'     => __( 'Item Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li:hover>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'dropdown_style',
            [
                'label'     => __( 'Dropdown Style', 'slicko' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ],
            ]
        );
        $this->start_controls_tabs(
            'dropdown_items_tabs'
        );
        $this->start_controls_tab(
            'dropdown_normal_tab',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dripdown_typography',
                'label'    => __( 'Menu Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li .sub-menu:not(.slicko-megamenu-builder-content-wrap) a',
            ]
        );
        $this->add_control(
            'dropdown_item_color',
            [
                'label'     => __( 'Item Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a,
                        {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_color',
            [
                'label'     => __( 'Item Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ddown_menu_border_color',
            [
                'label'     => __( 'Menu Border Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu,
                    {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:before' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_radius',
            [
                'label'      => __( 'Menu radius', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu'      => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_padding',
            [
                'label'      => __( 'Item Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_padding',
            [
                'label'      => __( 'Menu Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children:not(.slicko-mega-menu) .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'dropdown_hover_tab',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
        );
        $this->add_control(
            'dropdown_item_hover_color',
            [
                'label'     => __( 'Item Hover Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a:hover, {{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) li.current-menu-item> a,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_hover_color',
            [
                'label'     => __( 'Item Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a:hover, {{WRAPPER}} .main-navigation ul.navbar-nav .sub-menu li.current-menu-item>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_flyout_style',
            [
                'label' => __( 'Flyout/Mobile Menu Style', 'slicko' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'flyout_items_tabs'
        );
        $this->start_controls_tab(
            'flyout_menu_normal_tab',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'flyout_menu_typography',
                'label'    => __( 'Item Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a',
            ]
        );
        $this->add_control(
            'flyout_menu_color',
            [
                'label'     => __( 'Item Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle'                    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_item_padding',
            [
                'label'      => __( 'Item Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a'                      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a'                            => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_menu_padding',
            [
                'label'      => __( 'Menu Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flyout_menu_hover_tab',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
        );
        $this->add_control(
            'flyout_menu_hover_color',
            [
                'label'     => __( 'Menu Hover Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav>li>a:hover,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav li.current-menu-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'flyout_dropdown_style',
            [
                'label' => __( 'Flyout/Mobile Dropdown Style', 'slicko' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'flyout_dropdown_items_tabs'
        );
        $this->start_controls_tab(
            'flyout_dropdown_normal_tab',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'flyout_dripdown_typography',
                'label'    => __( 'Dropdown Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu:not(.slicko-megamenu-builder-content-wrap) a',
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_color',
            [
                'label'     => __( 'Item Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a,
                        {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_bg_color',
            [
                'label'     => __( 'Item Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_dropdown_item_padding',
            [
                'label'      => __( 'Item Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flyout_dropdown_hover_tab',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_hover_color',
            [
                'label'     => __( 'Item Hover Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a:hover,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_bg_hover_color',
            [
                'label'     => __( 'Item Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) a:hover,
                    {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.slicko-megamenu-builder-content-wrap) .sub-menu li.current-menu-item>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'trigger_style',
            [
                'label' => __( 'Trigger Style', 'slicko' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'trigger_style_tabs'
        );
        $this->start_controls_tab(
            'trigger_style_normal_tab',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trigger_typography',
                'label'    => __( 'Trigger Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );
        $this->add_control(
            'trigger_color',
            [
                'label'     => __( 'Trigger Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu,{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon'         => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navbar-toggler.open-menu svg,{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_background',
            [
                'label'     => __( 'Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trigger_border',
                'label'    => __( 'Border', 'slicko' ),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );
        $this->add_control(
            'trigger_icon_size',
            [
                'label'      => __( 'Icon size', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'trigger_icon_gap',
            [
                'label'      => __( 'Icon Gap', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'trigger_radius',
            [
                'label'      => __( 'Border Radius', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->add_responsive_control(
            'trigger_padding',
            [
                'label'      => __( 'Button Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'trigger_style_hover_tab',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
        );
        $this->add_control(
            'trigger_hover_color',
            [
                'label'     => __( 'Trigger Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_hover_background',
            [
                'label'     => __( 'Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trigger_hover_border',
                'label'    => __( 'Border', 'slicko' ),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu:hover',
            ]
        );
        $this->add_control(
            'trigger_hover_animation',
            [
                'label' => __( 'Hover Animation', 'slicko' ),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_responsive_control(
            'trigger_hover_radius',
            [
                'label'      => __( 'Border Radius', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'infos_style_section',
            [
                'label'     => __( 'Info Style', 'slicko' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_infos' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs(
            'info_style_tabs'
        );
        $this->start_controls_tab(
            'info_style_normal_tab',
            [
                'label' => __( 'Normal', 'slicko' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_title_typography',
                'label'    => __( 'Title Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .header-info span',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_typography',
                'label'    => __( 'Info Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .header-info h3 ',
            ]
        );
        $this->add_control(
            'info_title_color',
            [
                'label'     => __( 'Info Title Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-info span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'info_color',
            [
                'label'     => __( 'Info Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .header-info h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'info_box_border',
                'label'    => __( 'Box Border', 'slicko' ),
                'selector' => '{{WRAPPER}} .slicko-header-infos',
            ]
        );
        $this->add_control(
            'info_title_gap',
            [
                'label'      => __( 'Info Title Gap', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .header-info span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ifno_item_padding',
            [
                'label'      => __( 'Info item Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .header-info'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .header-info' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'info_style_hover_tab',
            [
                'label' => __( 'Hover', 'slicko' ),
            ]
        );
        $this->add_control(
            'info_title_color_hover',
            [
                'label'     => __( 'Info Title Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-info:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'info_color_hover',
            [
                'label'     => __( 'Info Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .header-info:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'panel_style',
            [
                'label' => __( 'Panel Style', 'slicko' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'panel_label_typography',
                'label'    => __( 'Label Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler',
            ]
        );
        $this->add_control(
            'panel_label_color',
            [
                'label'     => __( 'Label Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_trigger_color',
            [
                'label'     => __( 'Close Trigger Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler i'        => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_trigger_fill_color',
            [
                'label'     => __( 'Close Trigger Fill Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_label_background',
            [
                'label'     => __( 'Label Background Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.close-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'panel_background',
            [
                'label'     => __( 'Panel Color', 'slicko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_cloxe_icon_size',
            [
                'label'      => __( 'Close Icon size', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'panel_shadow',
                'label'    => __( 'Panel Shadow', 'slicko' ),
                'selector' => '{{WRAPPER}}  .navbar-inner',
            ]
        );
        $this->add_responsive_control(
            'close_label_padding',
            [
                'label'      => __( 'Label Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .menu-style-flyout .navbar-toggler.close-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .navbar-toggler.close-menu'           => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'panel_padding',
            [
                'label'      => __( 'Panel Padding', 'slicko' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner'           => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout  .navbar-inner' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'megamenu_style',
            [
                'label' => __( 'Megamenu Settings', 'slicko' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'megamenu_items_tabs'
        );
        $this->start_controls_tab(
            'megamenu_normal_tab',
            [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'megamenu_title_typography',
                'label'    => __( 'Heading Typography', 'slicko' ),
                'selector' => '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu>li.megamenu-heading>a',
            ]
        );
        $this->add_control(
            'megamenu_title_color',
            [
                'label'     => __( 'Heading Color', 'slicko' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu>li.megamenu-heading>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'mega_menu_bg_color',
            [
                'label'     => __( 'Menu Background Color', 'slicko' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'megamenu_parent',
            [
                'label'        => __( 'Menu Parent', 'slicko' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 'container',
                'options'      => [
                    'container' => __( 'Container', 'slicko' ),
                    'current'   => __( 'Current', 'slicko' ),
                ],
                'prefix_class' => 'slicko-megamenu-position-',
            ]
        );
        $this->add_control(
            'megamenu_panel_width',
            [
                'label'      => __( 'Menu Width', 'slicko' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'megamenu_builder_margin',
            [
                'label'      => __( 'Megamenu Builder Margin', 'slicko' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.slicko-megamenu-builder-parent>ul.slicko-megamenu-builder-content-wrap.sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'megamenu_padding',
            [
                'label'      => __( 'Menu Padding', 'slicko' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'megamenu_hover_tab',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'megamenu_title_color_hover',
            [
                'label'     => __( 'Heading Color', 'slicko' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu>li.megamenu-heading>a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $popular_post_key       = array();
        $popular_meta_value_num = array();
        $settings               = $this->get_settings_for_display();
        if ( 'yes' == $settings['use_main_menu'] ) {
            $args = [
                'theme_location'  => 'main-menu',
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'navbar-nav',
                'container_class' => 'slicko-menu-container',
            ];
        } else {
            $args = [
                'menu'            => $settings['primary_menu'],
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'navbar-nav',
                'container_class' => 'slicko-menu-container',
            ];
        }
        ?>
        <div class="slicko-main-menu-wrap navbar <?php printf( 'menu-style-%s mobile-menu-style-%s  ', esc_attr( $settings['menu_style'] ), esc_attr( $settings['mobile_menu_style'] ) )?>">
            <button class="navbar-toggler open-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <?php Icons_Manager::render_icon( $settings['trigger_open_icon'], ['aria-hidden' => 'true'] );?>
                </span>
                <?php if ( !empty( $settings['trigger_label'] ) ) {
            printf( '<span cla ss="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '' );
        }?>
                </button>
                <!-- end of Nav toggler -->
                <div class="navbar-inner">

                <a href="<?php echo home_url(  ) ?>" class="slicko-menu-logo"></a>

                    <?php

// check mobile menu style if not 3 then show the toggler button;
        if ( '3' != $settings['mobile_menu_style'] ) {
            ?>
             <button class="navbar-toggler close-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                 <?php if ( !empty( $settings['trigger_label'] ) ) {
                printf( '<span cla ss="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '' );
            }?>
             <span class="navbar-toggler-icon close">
             <?php Icons_Manager::render_icon( $settings['trigger_close_icon'], ['aria-hidden' => 'true'] );?>
             </span>
         </button>

                        <?php
}
        ?>
                <nav id="site-navigation" class="main-navigation ">
                    <?php wp_nav_menu( $args );?>
                </nav><!-- #site-navigation -->
                <?php if ( 'yes' == $settings['show_infos'] ): ?>
                       <div class="slicko-header-infos">
                           <?php
foreach ( $settings['header_infos'] as $info ):
            $target        = $info['info_url']['is_external'] ? ' target="_blank"' : '';
            $nofollow      = $info['info_url']['nofollow'] ? ' rel="nofollow"' : '';
            $info_url_attr = $info['info_url']['url'] ? "href='{$info['info_url']['url']}' {$target} {$nofollow}" : '';
            $info_tag      = !empty( $info['info_url']['url'] ) ? 'a' : 'div';
            printf( '<%1$s %2$s class="header-info">
	                            <span> %3$s </span>
	                            <h3>  %4$s</h3>
	                            </%1$s>',
                $info_tag,
                $info_url_attr,
                esc_html( $info['info_title'] ),
                esc_html( $info['info_content'] )
            )
            ?>
	                        <?php endforeach;?>
                       </div>
                <?php endif;?>
            </div>
        </div>
<?php
}
}
$widgets_manager->register_widget_type( new \Slicko_Addons\Widgets\Slicko_Main_Menu() );