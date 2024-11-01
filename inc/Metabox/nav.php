<?php
/**
 * Add custom fields to menu item
 *
 * This will allow us to play nicely with any other plugin that is adding the same hook
 *
 * @param  int $item_id
 * @params obj $item - the menu item
 * @params array $args
 */
function slicko_nav_fields( $item_id, $item ) {
    wp_nonce_field( 'slicko_menu_meta_nonce', 'slicko_menu_meta_nonce_name' );
    $slicko_menu_meta = get_post_meta( $item_id, 'slicko_select_megamenu', true );
    $dropdown_args    = [
        'post_type'        => 'slicko_megamenu',
        'echo'             => 1,
        'show_option_none' => __( 'Select megamenu', 'slicko' ),
        'name'             => 'slicko_select_megamenu[' . $item_id . ']',
        'selected'         => $slicko_menu_meta,
    ];
    // check if megamenu is exist
    $megamenu = get_posts( [
        'post_type'      => 'slicko_megamenu',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ] );
    if ( !empty( $megamenu ) ) {

        ?>
    <div class="field-slicko_menu_meta description-wide" style="margin: 5px 0;">
        <span class="description"><?php _e( "Select Megamenu", 'slicko' );?></span>
        <br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id; ?>" />
        <div class="logged-input-holder">
            <!-- <input type="text" name="slicko_menu_meta[<?php echo $item_id; ?>]" id="slicko-for-<?php echo $item_id; ?>" value="<?php echo esc_attr( $slicko_menu_meta ); ?>" /> -->
            <?php wp_dropdown_pages( $dropdown_args )?>
        </div>
    </div>
    <?php
}
}
add_action( 'wp_nav_menu_item_custom_fields', 'slicko_nav_fields', 10, 2 );
/**
 * Save the menu item meta
 *
 * @param int $menu_id
 * @param int $menu_item_db_id
 */
function slicko_nav_update( $menu_id, $menu_item_db_id ) {
    // Verify this came from our screen and with proper authorization.
    if ( !isset( $_POST['slicko_menu_meta_nonce_name'] ) || !wp_verify_nonce( $_POST['slicko_menu_meta_nonce_name'], 'slicko_menu_meta_nonce' ) ) {
        return $menu_id;
    }
    if ( isset( $_POST['slicko_select_megamenu'][$menu_item_db_id] ) ) {
        $sanitized_data = sanitize_text_field( $_POST['slicko_select_megamenu'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, 'slicko_select_megamenu', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, 'slicko_select_megamenu' );
    }
}
add_action( 'wp_update_nav_menu_item', 'slicko_nav_update', 10, 2 );
/**
 * Displays text on the front-end.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @return string
 */
function slicko_nav_menu_title( $title, $item ) {
    if ( is_object( $item ) && isset( $item->ID ) ) {
        $slicko_menu_meta = get_post_meta( $item->ID, '_slicko_menu_meta', true );
        if ( !empty( $slicko_menu_meta ) ) {
            $title .= ' - ' . $slicko_menu_meta;
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'slicko_nav_menu_title', 10, 2 );