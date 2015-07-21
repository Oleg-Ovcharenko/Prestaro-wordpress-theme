<?php

/**
 * Отключение не нужнных функций
 * */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

/**
 * Подключение стилей
 * */

show_admin_bar(false);

function load_style_script(){
    wp_enqueue_script('my_jq', get_template_directory_uri() . '/js/jquery-2.1.4.min.js');
    wp_enqueue_script('jquery.flexslider-min', get_template_directory_uri() . '/js/jquery.flexslider-min.js');
    wp_enqueue_script('masonry.pkgd.min', get_template_directory_uri() . '/js/masonry.pkgd.min.js');
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js');
    wp_enqueue_style('font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css');
    wp_enqueue_style('style_main_ready', get_template_directory_uri() . '/css/style.min.css');
    wp_enqueue_style('style_main_theme', get_template_directory_uri() . '/style.css');
}


add_action('wp_enqueue_scripts', 'load_style_script');

function jquery_another_version() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.1.4.min.js', array(), '2.1.4' );
}
add_action('wp_enqueue_scripts', 'jquery_another_version');

/**
 * Добавление и настройка миниатюры
 * */

add_theme_support('post-thumbnails');
add_image_size( 'index-page-size', 300, 194, array( 'center', 'center') );
add_action('after_setup_theme','index-page-size');
add_image_size( 'page-size', 940, 340, array( 'center', 'center') );
add_action('after_setup_theme','page-size');
add_image_size( 'slider-size', 700, 240, array( 'center', 'center') );
add_action('after_setup_theme','slider-size');
add_image_size( 'similar-size', 300, 160, array( 'center', 'center') );
add_action('after_setup_theme','similar-size');
add_image_size( 'category-size', 700, 200, array( 'center', 'center') );
add_action('after_setup_theme','category-size');

/**
 * Добавление меню
 * */

register_nav_menu( 'menu', 'menu' );

/**
 * Добавление виджетов
 * */

function social_widget_init() {
    register_sidebar( array(
        'name'          => 'Социальные сети',
        'id'            => 'social',
        'description'   => 'Здесь размещайте виджет сайдбара',
        'before_title'  => '<span class="hidden">',
        'after_title'   => '</span>',
        'before_widget' => '<div class="social">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'social_widget_init' );

function category_widget_init() {
    register_sidebar( array(
        'name'          => 'Список категорий',
        'id'            => 'category_vidget',
        'description'   => 'Здесь размещается виджет категорий',
        'before_title'  => '<span class="hidden">',
        'after_title'   => '</span>',
        'before_widget' => '<div class="category_vidget">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'category_widget_init' );

/**
 * Настройка вывода цитат
 * */

function new_excerpt_more($more) {
    return ' ';
}
add_filter('excerpt_more', 'new_excerpt_more');

function new_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

/**
 * Склонения
 * */

function plural_form($number, $after) {
    $cases = array (2, 0, 1, 1, 1, 2);
    echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

/**
 * Слайдер
 * */

add_action('init', 'slider');
function slider(){
    register_post_type('slider', array(
        'public' => true,
        'exclude_from_search' => false,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
        'labels' => array(
            'name' => 'Cлайдер',
            'all_items' => 'Все слайды',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавление слайда'
        ),
        'taxonomies' => array('category', 'post_tag')
    ));
}

/**
 * Количество просмотров
 **/

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

