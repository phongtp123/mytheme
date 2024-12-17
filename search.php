<?php get_header(); ?>
<div class ="content">
    <div id="main-content">
        <div class="search-info">
            <?php
                $search_query = new WP_Query('s ='.$s.'&showpost = -1') ;
                $search_keyword = wp_specialchars($s,1);
                $search_count = $search_query->post_count;
                printf(__('Found %1$s results for the keyword: %2$s', 'nguyenthanhphong'), $search_count, $search_keyword);

            ?>
        </div>
        <?php if(have_posts()) : while (have_posts()) : the_post(); ?>

            <?php get_template_part('content',get_post_format()); ?> 
            

        <?php endwhile ?>

        <?php mytheme_pagination(); ?>

        <?php else: ?>
            <?php  get_template_part('content', 'none'); ?>
        <?php endif ?>
    </div>
    <div id="sidebar" >
            <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>