<?php 

// Demo Setup 
$theme = wp_get_theme(); // gets the current theme
if ( 'Slicko' == $theme->name || 'Slicko' == $theme->parent_theme ) {

    /* Theme demo data setup */
    function slicko_import_files()
    {
        return array(
            array(   
                'import_file_name' => 'Plumbaer',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/plumber/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/plumber/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/plumber/demo-data/customizer.dat',
                
                'import_preview_image_url' => 'https://plugins.wpgrids.net/plumber/plumber.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/plumber',
            ),

            array(   
                'import_file_name' => 'Yoga',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/yoga-trainer/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/yoga-trainer/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/yoga-trainer/demo-data/customizer.dat',
                
                'import_preview_image_url' => 'https://plugins.wpgrids.net/yoga-trainer/yoga-trainer.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/yoga-trainer/',
            ),

            array(   
                'import_file_name' => 'Solar',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/solar/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/solar/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/solar/demo-data/customizer.dat',
                
                'import_preview_image_url' => 'https://plugins.wpgrids.net/solar/solar.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/solar/',
            ),
            array(   
                'import_file_name' => 'IT Services',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/it-services/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/it-services/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/it-services/demo-data/customizer.dat',
                
                'import_preview_image_url' => 'https://plugins.wpgrids.net/it-services/it-services.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/it-services',
            ),

            array(   
                'import_file_name' => 'Seo',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/seo/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/seo/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/seo/demo-data/customizer.dat',
                'import_preview_image_url' => 'https://plugins.wpgrids.net/seo/seo.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/seo',
            ),

            array(   
                'import_file_name' => 'Insurance',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/insurance/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/insurance/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/insurance/demo-data/customizer.dat',
                'import_preview_image_url' => 'https://plugins.wpgrids.net/insurance/insurance.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/insurance',
            ),
			
			array(   
                'import_file_name' => 'Plantero',
                'categories' => array('Demos'),
                'import_file_url' => 'https://plugins.wpgrids.net/plantero/demo-data/content.xml',
                'import_widget_file_url' => 'https://plugins.wpgrids.net/plantero/demo-data/widgets.wie',
                'import_customizer_file_url' => 'https://plugins.wpgrids.net/plantero/demo-data/customizer.dat',
                'import_preview_image_url' => 'https://plugins.wpgrids.net/plantero/plantero.png',
                'import_notice' => __('After you import this demo, you will have to setup the nav menu.', 'slicko'),
                'preview_url' => 'https://demos.wpgrids.net/slicko/plantero',
            ),
        );
    }
    add_filter('pt-ocdi/import_files', 'slicko_import_files');
    
    //demo import widget condition plugin
    function slicko_register_plugins( $plugins ) {

            if (
                isset( $_GET['step'] ) &&
                $_GET['step'] === 'import' &&
                isset( $_GET['import'] )
            ) {
                
            if ( $_GET['import'] === '0' ) {
            $plugins[] = [
                    'name'     => 'Plumber Helper',
                    'slug'     => 'plumber-helper',
                    'source'   => 'https://plugins.wpgrids.net/plumber/plumber-helper.zip',
                    'required' => true,
                ];
            }

            if ( $_GET['import'] === '1' ) {
            $plugins[] = [
                    'name'     => 'Yoga Addons',
                    'slug'     => 'yoga-addons',
                    'source'   => 'https://plugins.wpgrids.net/yoga-trainer/yoga-addons.zip',
                    'required' => true,
                ];
            }

            if ( $_GET['import'] === '2' ) {
                $plugins[] = [
                    'name'     => 'Solar Addons',
                    'slug'     => 'solar-addons',
                    'source'   => 'https://plugins.wpgrids.net/solar/solar-addons.zip',
                    'required' => true,
                ];
            }

            if ( $_GET['import'] === '3' ) {
                $plugins[] = [
                    'name'     => 'IT Helper',
                    'slug'     => 'it-helper',
                    'source'   => 'https://plugins.wpgrids.net/it-services/it-helper.zip',
                    'required' => true,
                ];
            }
            if ( $_GET['import'] === '4' ) {
                $plugins[] = [
                    'name'     => 'Seo',
                    'slug'     => 'seo-addons',
                    'source'   => 'https://plugins.wpgrids.net/seo/seo-addons.zip',
                    'required' => true,
                ];
            }
            if ( $_GET['import'] === '5' ) {
                $plugins[] = [
                    'name'     => 'Insurance',
                    'slug'     => 'insurance-addons',
                    'source'   => 'https://plugins.wpgrids.net/insurance/Insurance-addons.zip',
                    'required' => true,
                ];
            }
				
			if ( $_GET['import'] === '6' ) {
                $plugins[] = [
                    'name'     => 'Plantero Helper',
                    'slug'     => 'plantero-addons',
                    'source'   => 'https://plugins.wpgrids.net/plantero/plantero-addons.zip',
                    'required' => true,
                ];
				
				$plugins[] = [
                    'name'     => 'WooCommerce',
                    'slug'     => 'woocommerce',
                    'required' => false,
                ];
            }
            
        }
            return $plugins ;
    }
    add_filter( 'ocdi/register_plugins', 'slicko_register_plugins' );



    function ocdi_after_import($selected_import)
    {
        $front_page_id = get_page_by_title('Home');
        $main_menu = get_term_by('name', 'main-menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
        ));

        $blog_page_id  = get_page_by_title('Blog');
        update_option('show_on_front', 'page');
        update_option('page_on_front',  $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);

        $elem_clear_cache = new \Elementor\Core\Files\Manager();

        $elem_clear_cache->clear_cache();

    }
    add_action('pt-ocdi/after_import', 'ocdi_after_import');

    
}