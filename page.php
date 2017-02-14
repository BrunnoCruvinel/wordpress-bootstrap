<?php get_header() ?>


    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <!-- HTML LOOP HERE -->

    <?php endwhile;else: ?>

      	<h2><center>NO ONE POST</center></h2>

    <?php endif ?>



<?php get_footer() ?>
