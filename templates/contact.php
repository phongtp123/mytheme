<?php
    /*
        Template name: Contact
    */
?>
<?php get_header(); ?>
<div class ="content">
    <div id="main-content">
        <div class="contact-info">
            <h4> Present contact info </h4>
            <p> 21 Hoa An 10 , Cam Le District , Da Nang City </p>
            <p> (+84) 946-178-701 </p>
        </div>
        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="5290e5f" title="Contact form 1"]') ; ?>
        </div>
    </div>
    <div id="sidebar" >
            <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
