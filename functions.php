<?php


if (!is_admin()) {
    add_action("wp_enqueue_scripts", "scouting_nl_enqueue_scripts", 11);
}

function scouting_nl_enqueue_scripts() {
    wp_deregister_script('jquery');

    wp_register_script('scouting-jquery', "https://code.jquery.com/jquery-3.1.0.min.js", false, null);
    wp_register_script('scouting-bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js", false, null);

    wp_enqueue_script('scouting-jquery');
    wp_enqueue_script('scouting-bootstrap');

    wp_enqueue_style('scouting-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('style-scouting', get_stylesheet_uri());
}

function scouting_nl_setup() {
    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'primary'   => __('Primary Menu', 'scouting' )
    ) );
}
add_action( 'after_setup_theme', 'scouting_nl_setup' );

function create_bootstrap_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        global $wp;
        $current_url = add_query_arg( '', '', home_url( $wp->request ) );
        $menu_list  = '<nav class="navbar navbar-custom">' ."\n";
        $menu_list .= '<div class="container-fluid">' ."\n";
        $menu_list .= '<!-- Brand and toggle get grouped for better mobile display -->' ."\n";
        $menu_list .= '<div class="navbar-header">' ."\n";
        $menu_list .= '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">' ."\n";
        $menu_list .= '<span class="sr-only">Toggle navigation</span>' ."\n";
        $menu_list .= '<span class="icon-bar"></span>' ."\n";
        $menu_list .= '<span class="icon-bar"></span>' ."\n";
        $menu_list .= '<span class="icon-bar"></span>' ."\n";
        $menu_list .= '</button>' ."\n";
        $menu_list .= '</div>' ."\n";

        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list .= '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">' ."\n";
        $menu_list .= '<ul class="nav navbar-nav">' ."\n";

        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                $parent = $menu_item->ID;
                $menu_array = array();
                $isActive = false;
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        if ($isActive === false ){
                            $isActive = $submenu->url == $current_url . '/';
                        }
                        $menu_array[] = '<li><a href="' . $submenu->url . '" ' . ($submenu->url == $current_url . '/' ? 'class="active"' : '') . '>' . $submenu->title . '</a></li>' ."\n";
                    }
                }
                if( $bool == true && count( $menu_array ) > 0 ) {
                    $menu_list .= '<li class="dropdown ' . ($isActive ? 'active' : '') . '">' ."\n";
                    $menu_list .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>' ."\n";
                    $menu_list .= '<ul class="dropdown-menu">' ."\n";
                    $menu_list .= implode( "\n", $menu_array );
                    $menu_list .= '</ul>' ."\n";
                } else {
                    $menu_list .= '<li>' ."\n";
                    $menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
                }
            }

            $menu_list .= '</li>' ."\n";
        }

        $menu_list .= '</ul>' ."\n";
        $menu_list .= '</div>' ."\n";
        $menu_list .= '</nav>' ."\n";
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo $menu_list;
}

add_theme_support('widgets');

function twentysixteen_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'scouting' ),
        'id'            => 'sidebar',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'scouting' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

add_theme_support('custom-header', [
    'width' => 1200,
    'flex-width' => true,
    'height' => 200,
    'default-image' => get_template_directory_uri() . '/img/header.jpg',
    'uploads' => true,
]);

show_admin_bar( true );

require get_template_directory() . '/inc/template-tags.php';