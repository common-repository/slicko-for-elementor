<?php

/**
 * Get Pages
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'slicko_get_all_pages' ) ) {
    function slicko_get_all_pages($posttype = 'page')
    {
        $args = array(
            'post_type' => $posttype, 
            'post_status' => 'publish', 
            'posts_per_page' => -1
        );

        $page_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $page_list[$key->ID] = $key->post_title;
            }
        }
        return  $page_list;
    }
}

/**
 * Meta Output
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'slicko_get_meta' ) ) {
    function slicko_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

/**
 * Get a list of all CF7 forms
 *
 * @return array
 */
if ( ! function_exists( 'slicko_get_cf7_forms' ) ) {
    function slicko_get_cf7_forms() {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $forms ) ) {
            return wp_list_pluck( $forms, 'post_title', 'ID' );
        }
        return [];
    }
}
 /**
 * Check if contact form 7 is activated
 *
 * @return bool
 */
if ( ! function_exists( 'slicko_is_cf7_activated' ) ) {
   
    function slicko_is_cf7_activated() {
        return class_exists( 'WPCF7' );
    }
}

if ( ! function_exists( 'slicko_do_shortcode' ) ) {
    function slicko_do_shortcode( $tag, array $atts = array(), $content = null ) {
        global $shortcode_tags;
        if ( ! isset( $shortcode_tags[ $tag ] ) ) {
            return false;
        }
        return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
    }
}

function slicko_layout_content( $post_id ) {

    return Elementor\Plugin::instance()->frontend->get_builder_content( $post_id, true );
}

function slicko_cpt_slug_and_id( $post_type ) {
    $the_query = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ) );
    $cpt_posts = [];
    while ( $the_query->have_posts() ): $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}


