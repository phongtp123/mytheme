<?php get_header(); ?>
<div class ="content">
    <div id="main-content">
        <?php
            _e('<h2> 404 NOT FOUND </h2>' , 'nguyenthanhphong');
            _e('<p> The article you were looking for was not found </p>', 'nguyenthanhphong');
            get_search_form();
            _e('<h3> Content Category: </h3>','nguyenthanhphong');

            echo '<div class="404-cat-list">';
            wp_list_categories(array('title-list' => ''));
            echo '</div>';

            _e('Tag Cloud','nguyenthanhphong');
            wp_tag_cloud();
        ?>
    </div>
    <div id="sidebar" >
            <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>