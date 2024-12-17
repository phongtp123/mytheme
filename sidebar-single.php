<?php
    if ( is_active_sidebar('single-sidebar') ) :
        dynamic_sidebar('single-sidebar');
    else:
        _e('This is sidebar. You have to add some widgets','nguyenthanhphong');
    endif;
?>