<?php
get_header();
include("inc/content.php");
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;
get_footer();