<?php 
/** 
@ Khai bao hang gia tri
    @ THEME_URL = Lay duong dan thu muc theme
    @ CORE = lay duong dan cua thu muc /core
**/
define('THEME_URL', get_stylesheet_directory() );
define( 'CORE' , THEME_URL . "/core" ) ;

/**
@ Nhung file /core/init.php
 **/
require_once( CORE."/init.php" );

/** 
@ Thiet lap chieu rong noi dung 
**/
if (  ! isset( $content_width ) ) {
    $content_width = 640;
}

/** 
@ Khai bao chuc nang cua theme
**/
if ( ! function_exists( 'mytheme_theme_setup' ) ) {
    function  mytheme_theme_setup() {
        
        /* Thiet lap textdomain */
        $language_folder = THEME_URL. '/languages';
        load_theme_textdomain('nguyenthanhphong' , $language_folder);

        /* Tu dong them link RSS len <head> */
        add_theme_support(  'automatic-feed-links' );

        /* Them post thumpnail */
        add_theme_support( 'post-thumbnails' );

        /* Them post format  */
        add_theme_support( 'post-formats',array(
            'image',
            'video',
            'link', 
        ));

        /* Them Title-Tags  */
        add_theme_support( 'title-tag' );

        /* Them custom background  */
        $default_background = array(
            'default-color' => '#e8e8e8',
        );
        add_theme_support( 'custom-background' ,  $default_background );


        /* Them menu  */
        register_nav_menu( 'primary-menu' , __( 'Primary Menu', 'nguyenthanhphong' ) );

        /* Tao sidebar  */
        $sidebar = array(
            'name' => __( 'Main Sidebar', 'nguyenthanhphong' ),
            'id'=> 'main-sidebar',
            'description'=> __( 'Default Sidebar' ),
            'class'=> 'main-sidebar',
            'before_title'=> '<h3 class="widgettitle">',
            'after_title'=> '</h3>'
            );
        $single_sidebar = array(
            'name' => __( 'Posts Sidebar', 'nguyenthanhphong' ),
            'id'=> 'single-sidebar',
            'description'=> __( 'Default Sidebar' ),
            'class'=> 'single-sidebar',
            'before_title'=> '<h3 class="widgettitle">',
            'after_title'=> '</h3>'
             );
        register_sidebar( $sidebar );
        register_sidebar( $single_sidebar );
    }
    add_action( 'init' , 'mytheme_theme_setup' );

}

/* Theme site function */
if ( ! function_exists('site_header') ) {
    function site_header() {  ?>

        <div  class="site-name">

            <?php 
                if ( is_home() ) {
                    printf ('<h1><a href="%1$s" title= "%2$s">%3$s</a></h1>',
            get_bloginfo('url'),
                    get_bloginfo('description'),
                    get_bloginfo('sitename') );
                }
                else {
                    printf ('<p><a href="%1$s" title= "%2$s">%3$s</a></p>',
            get_bloginfo('url'),
                    get_bloginfo('description'),
                    get_bloginfo('sitename') );
                }
            ?>
        </div>

        <div  class="site-description">
            <?php bloginfo('description'); ?>
        </div>
        <?php
    }
}

/* Thiet lap menu */
if ( ! function_exists('header_menu') ) {
    function header_menu($menu){
        $menu = array(
            'theme_location'  => $menu,
            'container'        => 'nav',
            'container_class'   => $menu
            );
            wp_nav_menu($menu);
     }  
}

/* Ham tao phan trang */
if ( !function_exists('mytheme_pagination') ) {
    function mytheme_pagination() {
        if  ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return '';
        } ?>
        <nav  class="pagination" role="navigation" >
            <?php if  ( get_next_posts_link() ) : ?>
                <div class="prev"><?php next_posts_link(__('Older Posts', 'nguyenthanhphong') ); ?></div>
            <?php endif; ?>
            <?php if   ( get_previous_posts_link() ) : ?>
                <div class="next"><?php previous_posts_link(__('Newer Posts', 'nguyenthanhphong') ); ?></div>
            <?php endif; ?>
        </nav>
    <?php }
 }

 /* Ham hien thi thumpnail  */
 if ( !function_exists('mytheme_thumbnail') ) {
    function mytheme_thumbnail($size){
        if (!is_single() && has_post_thumbnail() &&  !post_password_required() || has_post_format('image') ) : ?>
            <figure  class="post-thumbnail"><?php  the_post_thumbnail($size); ?></figure>
        <?php endif; ?>
    <?php }
 }

 /*  Ham hien thi thong tin post entry_header() và entry_meta() */
 if ( !function_exists('mytheme_entry_header') ) {
    function mytheme_entry_header(){ ?>
        <?php  if ( is_single() ) : ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
        <?php  else : ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <?php  endif; ?>

    <?php }
 }

 if ( !function_exists('mytheme_entry_meta') ) {
    function mytheme_entry_meta() {  ?>
        <?php if ( !is_page() ) : ?>
            <div class="entry-meta">
                <?php
                printf( '<span class="author">Post by %1$s at %2$s<br> Category %3$s</span><br>',
                get_the_author(),
                        get_the_date(),
                        get_the_category_list(',')
                    );

                if (comments_open()):
                    echo  '<span class="meta-reply">';
                    comments_popup_link(__('Leave a comment :)', 'nguyenthanhphong'),
                                        __('1 comment', 'nguyenthanhphong'),
                                        __('% comments', 'nguyenthanhphong'),
                                        __('Read all comments', 'nguyenthanhphong'));
                    echo   '</span>';
                endif;
                ?>
            </div>
        <?php endif ; ?>

    <?php }
 }

 /*   Ham hien thi thong tin post entry_content() */
 if ( !function_exists('mytheme_entry_content') ) {
    function mytheme_entry_content() { 
        if  ( !is_single() && !is_page() ) {
            the_excerpt();
        }
        else {
            the_content();
            /*Phan trang trong single*/
            $link_page = array(
                'before' => __('<p>Page: ', 'nguyenthanhphong'),
                'after' => '</p>',
                'nextpagelink' => __('Next Page', 'nguyenthanhphong'),
                'previouspagelink' => __('Previous Page', 'nguyenthanhphong')
            );
            wp_link_pages($link_page);
        }
    }
 }

function read_more(){
    return  '<a class="read-more" href="' . get_permalink(get_the_ID()) . '">'.__('...xem thêm.','nguyenthanhphong').'</a>';  
}
add_filter('excerpt_more', 'read_more');

/*Ham hien thi tag entry_tag() */
if (  !function_exists('mytheme_entry_tag') ) {
    function mytheme_entry_tag() {
        if( has_tag()) :
            echo '<div  class="entry-tag">';
            printf (__('Tagged in %1$s','nguyenthanhphong'),get_the_tag_list( '',',')) ;
            echo '</div>';
        endif;
    }
}

/* Nhung file style.css  */
function mytheme_style(){
    wp_register_style('main-style', get_template_directory_uri() ."/style.css",'all') ;
    wp_enqueue_style('main-style');
}
add_action('wp_enqueue_scripts','mytheme_style');


