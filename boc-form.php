<?php
/**
 * Plugin Name: Fitness Plugin
 * Description: A plugin for fitness 
 * Version: 1.0.0
 * Author: Tanvirul Karim
 */
 


include('ajax-actions.php');
//cmb2
include('metabox/init.php');
include('metabox/functions.php');


add_action('wp_enqueue_scripts','plugin_css_jsscripts');
function plugin_css_jsscripts() {
    // CSS
    wp_enqueue_style( 'style-css', plugins_url( '/style.css', __FILE__ ));
    // wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' );

    // JavaScript
    wp_enqueue_script( 'script-js', plugins_url( '/script.js', __FILE__ ),array('jquery'));
    // wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.5.3', true );

    // Pass ajax_url to script.js
    wp_localize_script( 'script-js', 'plugin_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}



// Add the fitness Form menu page
function fitness_form_menu_page() {
    add_menu_page(
        'BOS Form',          // Page title
        'Fitness Plugin' ,          // Menu title
        'manage_options',    // Capability required to access the page
        'fitness-form-page',     // Menu slug
        'fitness_form_page_content', // Callback function to render the page content
        'dashicons-admin-plugins', // Icon for the menu item
        30 // Position of the menu item
    );


    // Add the submenu page for manual input
       add_submenu_page(
        'fitness-form-page',    // Parent menu slug
        'Manual Registration',     // Page title
        'Manual Registration',     // Menu title
        'manage_options',   // Capability required to access the page
        'manual-registration',     // Menu slug
        'fitness_manual_registration' // Callback function to render the page content
    );

        // Add the submenu page for view users data
       add_submenu_page(
        'fitness-form-page',    // Parent menu slug
        'Users Data',     // Page title
        '',     // Menu title
        'manage_options',   // Capability required to access the page
        'view-fitness-member',     // Menu slug
        'fitness_view_user_data' // Callback function to render the page content
         );

  

}
add_action('admin_menu', 'fitness_form_menu_page');




//create post type for doctors 

function create_doctors_post_type() {
    $labels = array(
        'name'               => _x('Doctors', 'post type general name', 'your-text-domain'),
        'singular_name'      => _x('Doctor', 'post type singular name', 'your-text-domain'),
        'menu_name'          => _x('Doctors', 'admin menu', 'your-text-domain'),
        'name_admin_bar'     => _x('Doctor', 'add new on admin bar', 'your-text-domain'),
        'add_new'            => _x('Add New', 'doctor', 'your-text-domain'),
        'add_new_item'       => __('Add New Doctor', 'your-text-domain'),
        'new_item'           => __('New Doctor', 'your-text-domain'),
        'edit_item'          => __('Edit Doctor', 'your-text-domain'),
        'view_item'          => __('View Doctor', 'your-text-domain'),
        'all_items'          => __('All Doctors', 'your-text-domain'),
        'search_items'       => __('Search Doctors', 'your-text-domain'),
        'parent_item_colon'  => __('Parent Doctors:', 'your-text-domain'),
        'not_found'          => __('No doctors found.', 'your-text-domain'),
        'not_found_in_trash' => __('No doctors found in Trash.', 'your-text-domain')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-id',
        'query_var'          => true,
        'rewrite'            => array('slug' => 'doctors'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
    );

    register_post_type('doctors', $args);
}
add_action('init', 'create_doctors_post_type');



function create_questions_post_type() {
    $labels = array(
        'name'               => _x('Questions', 'post type general name', 'your-text-domain'),
        'singular_name'      => _x('Question', 'post type singular name', 'your-text-domain'),
        'menu_name'          => _x('Questions', 'admin menu', 'your-text-domain'),
        'name_admin_bar'     => _x('Question', 'add new on the admin bar', 'your-text-domain'),
        'add_new'            => _x('Add New', 'question', 'your-text-domain'),
        'add_new_item'       => __('Add New Question', 'your-text-domain'),
        'new_item'           => __('New Question', 'your-text-domain'),
        'edit_item'          => __('Edit Question', 'your-text-domain'),
        'view_item'          => __('View Question', 'your-text-domain'),
        'all_items'          => __('All Questions', 'your-text-domain'),
        'search_items'       => __('Search Questions', 'your-text-domain'),
        'parent_item_colon'  => __('Parent Questions:', 'your-text-domain'),
        'not_found'          => __('No questions found.', 'your-text-domain'),
        'not_found_in_trash' => __('No questions found in Trash.', 'your-text-domain')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-lightbulb',
        'query_var'          => true,
        'rewrite'            => array('slug' => 'questions'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'thumbnail', 'custom-fields'),
    );

    register_post_type('questions', $args);

    // Define the custom taxonomy 'question_category'
    $taxonomy_args = array(
        'labels' => array(
            'name' => _x('Question Categories', 'taxonomy general name', 'your-text-domain'),
            'singular_name' => _x('Question Category', 'taxonomy singular name', 'your-text-domain'),
            'search_items' => __('Search Question Categories', 'your-text-domain'),
            'all_items' => __('All Question Categories', 'your-text-domain'),
            'parent_item' => __('Parent Question Category', 'your-text-domain'),
            'parent_item_colon' => __('Parent Question Category:', 'your-text-domain'),
            'edit_item' => __('Edit Question Category', 'your-text-domain'),
            'update_item' => __('Update Question Category', 'your-text-domain'),
            'add_new_item' => __('Add New Question Category', 'your-text-domain'),
            'new_item_name' => __('New Question Category Name', 'your-text-domain'),
            'menu_name' => __('Question Categories', 'your-text-domain'),
        ),
        'hierarchical' => true,
        'rewrite' => array('slug' => 'question-category'),
    );

    register_taxonomy('question_category', 'questions', $taxonomy_args);
}
add_action('init', 'create_questions_post_type');


// Callback function to render the page content
function fitness_form_page_content() {   
    include(plugin_dir_path(__FILE__) . 'templates/fitness-form-page.php');
}


function frontend_form(){
    ob_start();
    include 'templates/frontend-form.php';
    return ob_get_clean(); 
}
add_shortcode('frontend_registration', 'frontend_form'); 



function show_life_member(){
    ob_start();
    include 'templates/life-member.php';
    return ob_get_clean(); 
}
add_shortcode('show_life_member_shortcode', 'show_life_member'); 


function show_general_member(){
    ob_start();
    include 'templates/general-member.php';
    return ob_get_clean(); 
}
add_shortcode('show_general_member_shortcode', 'show_general_member'); 

function show_member_details_frontend($templates) {
    $templates['member-details.php'] = 'Member Details';
    return $templates;
}
add_filter('theme_page_templates', 'show_member_details_frontend');


function show_member_details_frontend_shortcode($atts) {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'templates/member-details.php');
    return ob_get_clean();
}
add_shortcode('member_details_shortcode', 'show_member_details_frontend_shortcode');


// smtp details 

