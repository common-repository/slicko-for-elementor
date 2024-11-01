<?php 
// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class SlickoCustomPosts {
    function __construct() {
        add_action( 'admin_menu', array( $this, 'slicko_header_footer_menu' ) );
        // Header
        add_action( 'init', array( $this, 'slicko_slide' ) );

        add_action( 'init', array( $this, 'slicko_header' ) );
        add_action( 'init', array( $this, 'slicko_footer' ) );
        add_action( 'init', array( $this, 'slicko_megamenu' ) );
        


      
    }
    public function slicko_header_footer_menu() {
        global $menu, $submenu;
        add_menu_page(
            'Slicko',
            'Slicko',
            'read',
            'Slicko',
            '',
            'dashicons-archive',
            40
        );
    }
    /**
     *
     * Slicko Header Footer Post Type
     *
     */
    public function slicko_header() {
        $labels = array(
            'name'               => _x( 'Header', 'post type general name', 'slicko-addons' ),
            'singular_name'      => _x( 'Header', 'post type singular name', 'slicko-addons' ),
            'menu_name'          => _x( 'Header', 'admin menu', 'slicko-addons' ),
            'name_admin_bar'     => _x( 'Header', 'add new on admin bar', 'slicko-addons' ),
            'add_new'            => __( 'Add New Header', 'slicko-addons' ),
            'add_new_item'       => __( 'Add New Header', 'slicko-addons' ),
            'new_item'           => __( 'New Header', 'slicko-addons' ),
            'edit_item'          => __( 'Edit Header', 'slicko-addons' ),
            'view_item'          => __( 'View Header', 'slicko-addons' ),
            'all_items'          => __( 'All Headers', 'slicko-addons' ),
            'search_items'       => __( 'Search Headers', 'slicko-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'slicko-addons' ),
            'not_found'          => __( 'No Headers found.', 'slicko-addons' ),
            'not_found_in_trash' => __( 'No Headers found in Trash.', 'slicko-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'slicko-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'show_in_menu'       => 'Slicko',
            'rewrite'            => array( 'slug' => 'header' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'slicko_header', $args );
    }
    public function slicko_footer() {
        $labels = array(
            'name'               => _x( 'Footer', 'post type general name', 'slicko-addons' ),
            'singular_name'      => _x( 'Footer', 'post type singular name', 'slicko-addons' ),
            'menu_name'          => _x( 'Footer', 'admin menu', 'slicko-addons' ),
            'name_admin_bar'     => _x( 'Footer', 'add new on admin bar', 'slicko-addons' ),
            'add_new'            => __( 'Add New Footer', 'slicko-addons' ),
            'add_new_item'       => __( 'Add New Footer', 'slicko-addons' ),
            'new_item'           => __( 'New Footer', 'slicko-addons' ),
            'edit_item'          => __( 'Edit Footer', 'slicko-addons' ),
            'view_item'          => __( 'View Footer', 'slicko-addons' ),
            'all_items'          => __( 'All Footers', 'slicko-addons' ),
            'search_items'       => __( 'Search Footers', 'slicko-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'slicko-addons' ),
            'not_found'          => __( 'No Footers found.', 'slicko-addons' ),
            'not_found_in_trash' => __( 'No Footers found in Trash.', 'slicko-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'slicko-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'footer' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_menu'       => 'Slicko',
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'slicko_footer', $args );
    }
    public function slicko_megamenu() {
        $labels = array(
            'name'               => _x( 'Mega Menu', 'post type general name', 'slicko-addons' ),
            'singular_name'      => _x( 'Mega Menu', 'post type singular name', 'slicko-addons' ),
            'menu_name'          => _x( 'Mega Menu', 'admin menu', 'slicko-addons' ),
            'name_admin_bar'     => _x( 'Mega Menu', 'add new on admin bar', 'slicko-addons' ),
            'add_new'            => __( 'Add New Mega Menu', 'slicko-addons' ),
            'add_new_item'       => __( 'Add New Mega Menu', 'slicko-addons' ),
            'new_item'           => __( 'New Mega Menu', 'slicko-addons' ),
            'edit_item'          => __( 'Edit Mega Menu', 'slicko-addons' ),
            'view_item'          => __( 'View Mega Menu', 'slicko-addons' ),
            'all_items'          => __( 'All Mega Menus', 'slicko-addons' ),
            'search_items'       => __( 'Search Mega Menus', 'slicko-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'slicko-addons' ),
            'not_found'          => __( 'No Mega Menus found.', 'slicko-addons' ),
            'not_found_in_trash' => __( 'No Mega Menus found in Trash.', 'slicko-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'slicko-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'megamenu' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_menu'       => 'Slicko',
            'supports'           => array( 'title', 'elementor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'slicko_megamenu', $args );
    }


    //SLide
    public function slicko_slide() {
        $labels = array(
            'name'               => _x( 'Slide', 'post type general name', 'slicko-addons' ),
            'singular_name'      => _x( 'Slide', 'post type singular name', 'slicko-addons' ),
            'menu_name'          => _x( 'Slide', 'admin menu', 'slicko-addons' ),
            'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'slicko-addons' ),
            'add_new'            => __( 'Add New Slide', 'slicko-addons' ),
            'add_new_item'       => __( 'Add New Slide', 'slicko-addons' ),
            'new_item'           => __( 'New Slide', 'slicko-addons' ),
            'edit_item'          => __( 'Edit Slide', 'slicko-addons' ),
            'view_item'          => __( 'View Slide', 'slicko-addons' ),
            'all_items'          => __( 'All Slide', 'slicko-addons' ),
            'search_items'       => __( 'Search Slide', 'slicko-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'slicko-addons' ),
            'not_found'          => __( 'No Slide found.', 'slicko-addons' ),
            'not_found_in_trash' => __( 'No Slide found in Trash.', 'slicko-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'slicko-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-slides',
            'rewrite'            => array( 'slug' => 'slicko_slide', 'with_front' => true, 'pages' => true, 'feeds' => true ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title','elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'slicko_slide', $args );
    }
  
}
$slickoCcases_stydyInstance = new SlickoCustomPosts;
