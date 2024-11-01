<?php
namespace Slicko\Widgets\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Slicko\Elementor\Traits\Slicko_Inline_Button_Markup;

class Slicko_Inline_Button extends Widget_Base {
	use Slicko_Inline_Button_Markup;
    /**
     * Get widget name.
     */
    public function get_name() {
		return 'slicko-inline-button';
	}
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Inline Button', 'slicko-addons' );
	}
	/**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-button';
    }
    /**
     * Get widget category.
     */
    public function get_categories() {
		return [ 'slicko-addons' ];
	}
	public function get_keywords() {
		return ['link', 'hover', 'animation', 'slicko', 'inline'];
	}
	/**
     * Register widget content controls
     */
	protected function register_controls() {
		$this->start_controls_section(
			'_section_title',
			[
				'label' => __( 'Button Content', 'slicko-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'animation_style',
			[
				'label'   => __( 'Animation Style', 'slicko-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carpo',
				'options' => [
					'carpo'   => __( 'Carpo', 'slicko-addons' ),
					'carme'   => __( 'Carme', 'slicko-addons' ),
					'dia'     => __( 'Dia', 'slicko-addons' ),
					'eirene'  => __( 'Eirene', 'slicko-addons' ),
					'elara'   => __( 'Elara', 'slicko-addons' ),
					'ersa'    => __( 'Ersa', 'slicko-addons' ),
					'helike'  => __( 'Helike', 'slicko-addons' ),
					'herse'   => __( 'Herse', 'slicko-addons' ),
					'io'      => __( 'Io', 'slicko-addons' ),
					'iocaste' => __( 'Iocaste', 'slicko-addons' ),
					'kale'    => __( 'Kale', 'slicko-addons' ),
					'leda'    => __( 'Leda', 'slicko-addons' ),
					'metis'   => __( 'Metis', 'slicko-addons' ),
					'mneme'   => __( 'Mneme', 'slicko-addons' ),
					'thebe'   => __( 'Thebe', 'slicko-addons' ),
                ],
            ]
		);
		$this->add_control(
			'link_text',
			[
				'label'       => __( 'Title', 'slicko-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Inline Button', 'slicko-addons' ),
				'placeholder' => __( 'Type Link Title', 'slicko-addons' ),
				'dynamic'     => [
					'active' => true,
                ],
            ]
		);
		$this->add_responsive_control(
            'link_align',
            [
                'label' => __( 'Alignment', 'slicko-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'slicko-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'slicko-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'slicko-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slicko_content__item' => '{{VALUE}}'
                ]
            ]
        );
		$this->add_control(
			'link_url',
			[
				'label'         => __( 'Link', 'slicko-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'slicko-addons' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
                ],
            ]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'_section_media_style',
			[
				'label' => __( 'Button Content', 'slicko-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Content Box Padding', 'slicko-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .slicko_content__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Link Color', 'slicko-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-link' => 'color: {{VALUE}};',
                ],
            ]
		);
        $this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Link Hover Color', 'slicko-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-link:hover' => 'color: {{VALUE}};',
                ],
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'slicko-addons' ),
				'selector' => '{{WRAPPER}} .slicko-link',
				'scheme'   => Typography::TYPOGRAPHY_2,
            ]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		self::{'render_' . $settings['animation_style'] . '_markup'}( $settings );
	}
}
$widgets_manager->register_widget_type(new \Slicko\Widgets\Elementor\Slicko_Inline_Button());