<?php

namespace Slicko_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Border;
use \Elementor\Icons_Manager;

class Slicko_Search_Form extends Widget_Base
{

	public function get_name()
	{
		return 'slicko-search-form';
	}

	public function get_title()
	{
		return __('Search Form', 'slicko');
	}

	public function get_icon()
	{
		return 'eicon-search';
	}

	public function get_categories()
	{
		return ['slicko'];
	}

	public function get_keywords()
	{
		return ['search', 'form'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __('Search Box', 'slicko'),
			]
		);
		$this->add_control(
			'search_icon',
			[
				'label'   => __('Search Icon', 'slicko'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-search',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'cross_icon',
			[
				'label'   => __('Cross Icon', 'slicko'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-times',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'search_icon_align',
			[
				'label'   => esc_html__('Search Icon Alignment', 'slicko'),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => true,
				'options' => [
					'flex-start'   => [
						'title' => __('Left', 'slicko'),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __('Center', 'slicko'),
						'icon'  => 'eicon-text-align-center'
					],
					'flex-end'  => [
						'title' => __('Right', 'slicko'),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left',
				'selectors'     => [
					'{{WRAPPER}} .search-icon' => 'justify-content: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'enable_icon',
			[
				'label'        => __('Enable Icon', 'slicko'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'       => __('Placeholder', 'slicko'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Search', 'slicko') . '...'
			]
		);

		$this->add_control(
			'search_button',
			[
				'label'     => __('Button', 'slicko'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'button_type',
			[
				'label'   => __('Type', 'slicko'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __('Icon', 'slicko'),
					'text' => __('Text', 'slicko')
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'     => __('Text', 'slicko'),
				'type'      => Controls_Manager::TEXT,
				'default'   => __('Search', 'slicko'),
				'condition' => [
					'button_type' => 'text'
				]
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'   => __('Icon', 'slicko'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'eicon-search',
				'options' => [
					'eicon-search'    => [
						'title' => __('Search', 'slicko'),
						'icon'  => 'eicon-search'
					],
					'eicon-arrow-right'     => [
						'title' => __('Arrow', 'slicko'),
						'icon'  => 'eicon-arrow-right'
					]
				],
				'condition'       => [
					'button_type' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label'       => __('Size', 'slicko'),
				'type'        => Controls_Manager::SLIDER,
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-container' => 'min-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .slicko-search-submit'      => 'min-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .slicko-search-form-input' => 'padding-left: calc({{SIZE}}{{UNIT}} / 5); padding-right: calc({{SIZE}}{{UNIT}} / 5)'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Register Search Style Controls.
		 *
		 * @since 1.5.0
		 * @access protected
		 */

		$this->start_controls_section(
			'search_icon_Overly',
			[
				'label'      => __('Background Overly', 'slicko'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'breadcrumbs_background',
				'label' => __( 'Background', 'slicko' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slicko-search-overly',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'search_icon_style',
			[
				'label'      => __('Search Icon', 'slicko'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'search_icon_size',
			[
				'label'       => __('Icon Size', 'slicko'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'size'    => '16',
					'unit'    => 'px'
				],
				'selectors'   => [
					'{{WRAPPER}} .search-icon i' => 'font-size: {{SIZE}}{{UNIT}}'
				],

			]
		);


		$this->add_control(
			'search_icon_color',
			[
				'label'     => __('Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon i' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'search_icon_background_color',
			[
				'label'     => __('Background Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon i' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'search_icon_border',
				'label' => __('Border', 'slicko'),
				'selector' => '{{WRAPPER}} .search-icon i',
			]
		);
		$this->add_responsive_control(
			'search_icon_border_radius',
			[
				'label'      => __('Border Radius', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .search-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);



		$this->add_responsive_control(
			'search_icon_padding',
			[
				'label' => __('Padding', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .search-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_icon_margin',
			[
				'label' => __('Margin', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .search-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'cross_icon_style',
			[
				'label'      => __('Cross Icon', 'slicko'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'cross_icon_size',
			[
				'label'       => __('Icon Size', 'slicko'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'size'    => '16',
					'unit'    => 'px'
				],
				'selectors'   => [
					'{{WRAPPER}} .cross-icon i' => 'font-size: {{SIZE}}{{UNIT}}'
				],

			]
		);


		$this->add_control(
			'cross_icon_color',
			[
				'label'     => __('Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cross-icon i' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'cross_icon_background_color',
			[
				'label'     => __('Background Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cross-icon i' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cross_icon_border',
				'label' => __('Border', 'slicko'),
				'selector' => '{{WRAPPER}} .cross-icon i',
			]
		);
		$this->add_responsive_control(
			'cross_icon_border_radius',
			[
				'label'      => __('Border Radius', 'slicko'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .cross-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);



		$this->add_responsive_control(
			'cross_icon_padding',
			[
				'label' => __('Padding', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .cross-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cross_icon_margin',
			[
				'label' => __('Margin', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .cross-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __('Input', 'slicko'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_typography',
				'selector' => '{{WRAPPER}} input[type="search"].slicko-search-form-input'
			]
		);

		$this->add_control(
			'slicko_search_input_padding',
			[
				'label' => __('Padding', 'slicko'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .slicko-search-form-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_input_colors');

		$this->start_controls_tab(
			'input_normal',
			[
				'label'       => __('Normal', 'slicko'),
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label'       => __('Text Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-input' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'input_placeholder_color',
			[
				'label'       => __('Placeholder Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-input::placeholder' => 'color: {{VALUE}}'
				],
				'default'     => '#cccccc'
			]
		);

		$this->add_control(
			'input_background_color',
			[
				'label'       => __('Background Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'default'     => '#ededed',
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-input' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'        => 'input_box_shadow',
				'selector'    => '{{WRAPPER}} .slicko-search-form-container, {{WRAPPER}} input.slicko-search-form-input'
			]
		);

		$this->add_control(
			'border_style',
			[
				'label'       => __('Border Style', 'slicko'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'    => __('None', 'slicko'),
					'solid'   => __('Solid', 'slicko'),
					'double'  => __('Double', 'slicko'),
					'dotted'  => __('Dotted', 'slicko'),
					'dashed'  => __('Dashed', 'slicko')
				],
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-container' => 'border-style: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'       => __('Border Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'condition'   => [
					'border_style!' => 'none'
				],
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-container' => 'border-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'       => __('Border Width', 'slicko'),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => ['px'],
				'default'     => [
					'top'     => '1',
					'bottom'  => '1',
					'left'    => '1',
					'right'   => '1',
					'unit'    => 'px'
				],
				'condition'   => [
					'border_style!' => 'none'
				],
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'       => __('Border Radius', 'slicko'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 200
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-form-container' => 'border-radius: {{SIZE}}{{UNIT}}'
				],
				'separator'   => 'before'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'input_focus',
			[
				'label'       => __('Focus', 'slicko')
			]
		);

		$this->add_control(
			'input_text_color_focus',
			[
				'label'       => __('Text Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .slicko-input-focus .slicko-search-form-input:focus, {{WRAPPER}} .slicko-search-button-wrapper input[type=search]:focus' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'input_placeholder_color_focus',
			[
				'label'     => __('Placeholder Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-search-form-input:focus::placeholder' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'input_background_color_focus',
			[
				'label'       => __('Background Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .slicko-input-focus .slicko-search-form-input:focus, {{WRAPPER}} .slicko-search-form-input:focus' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'input_box_shadow_focus',
				'selector'       =>
				'{{WRAPPER}} .slicko-search-button-wrapper.slicko-input-focus .slicko-search-form-container,
				 {{WRAPPER}} .slicko-search-button-wrapper.slicko-input-focus input.slicko-search-form-input'
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label'       => __('Border Color', 'slicko'),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .slicko-input-focus .slicko-search-form-container,
					 {{WRAPPER}} .slicko-input-focus .slicko-search-icon-toggle .slicko-search-form-input' => 'border-color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		$this->start_controls_section(
			'button_style',
			[
				'label'      => __('Button', 'slicko'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'       => __('Icon Size', 'slicko'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'size'    => '16',
					'unit'    => 'px'
				],
				'selectors'   => [
					'{{WRAPPER}} .slicko-search-submit i' => 'font-size: {{SIZE}}{{UNIT}}'
				],
				'condition'   => [
					'button_type' => 'icon'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'selector'  => '{{WRAPPER}} .slicko-search-form-container.button-type-text .slicko-search-submit',
				'condition' => [
					'button_type' => 'text'
				]
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label'        => __('Width', 'slicko'),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'max'  => 500,
						'step' => 5
					]
				],
				'selectors'    => [
					'{{WRAPPER}} .slicko-search-form-container .slicko-search-submit' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .slicko-close-icon-yes button#clear_with_button' => 'right: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->start_controls_tabs('button_style_tabs');

		$this->start_controls_tab(
			'button_normal',
			[
				'label' => __('Normal', 'slicko')
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __('Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} button.slicko-search-submit' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => __('Background Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .slicko-search-submit' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'slicko_search_button_border',
				'label' => __('Border', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-search-submit',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover',
			[
				'label' => __('Hover', 'slicko')
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label'     => __('Text Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-search-submit:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'button_background_color_hover',
			[
				'label'     => __('Background Color', 'slicko'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slicko-search-submit:hover' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'slicko_search_button_border_hover',
				'label' => __('Border', 'slicko'),
				'selector' => '{{WRAPPER}} .slicko-search-submit:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'input',
			[
				'placeholder' => $settings['placeholder'],
				'class' => 'slicko-search-form-input',
				'type' => 'search',
				'name' => 's',
				'title' => __('Search', 'slicko'),
				'value' => get_search_query()
			]
		);

		$this->add_render_attribute(
			'wrapper',
			[
				'class' => 'slicko-search-form-container button-type-' . esc_attr($settings['button_type']),
				'role'  => 'tablist'
			]
		);

		$this->add_render_attribute('form', 'class', 'slicko-search-button-wrapper');

		$this->add_render_attribute(
			'form',
			[
				'class' => 'slicko-search-type-text',
				'role' => 'search',
				'action' => get_home_url(),
				'method' => 'get'
			]
		);

?>
		<div class="search-main-wrapper">
			<div class="search-icon <?php printf($settings['search_icon_align']) ?>" id="search_icon">
				<?php Icons_Manager::render_icon($settings['search_icon'], ['aria-hidden' => 'true']); ?>
			</div>
			<div class="cross-icon" id="cross_icon">
				<?php Icons_Manager::render_icon($settings['cross_icon'], ['aria-hidden' => 'true']); ?>
			</div>
			<form <?php echo $this->get_render_attribute_string('form'); ?>>
				<div <?php echo wp_kses_post($this->get_render_attribute_string('wrapper')); ?>>
					<input <?php echo $this->get_render_attribute_string('input'); ?>>
					<button class="slicko-search-submit" type="submit">
						<?php if ('icon' === $settings['button_type']) : ?>
							<i class="<?php echo esc_attr($settings['button_icon']); ?>" aria-hidden="true"></i>
						<?php elseif (!empty($settings['button_text'])) : ?>
							<?php echo esc_html($settings['button_text']); ?>
						<?php endif; ?>
					</button>
				</div>
			</form>
			<div class="slicko-search-overly "></div>
		</div>
<?php
	}
}
$widgets_manager->register_widget_type(new \Slicko_Addons\Widgets\Slicko_Search_Form());
