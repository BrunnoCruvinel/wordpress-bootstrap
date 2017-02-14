<?php
/*
Template Name: Search
*/
?>
<?php get_header(); ?>


        <?php
          $args = array( 'post_type' => 'post', 'posts_per_page' => -1, "s" => $_GET['s']);
           query_posts($args); $i = 1 ;

           if ( have_posts() ): while (have_posts()) : the_post();
           $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
           $thumb = $src[0];
         ?>

               <!-- HTML LOOP HERE -->

        <?php endwhile; ?>

					<?php wp_pagination(); ?>



				<?php	else: ?>

	          <h2><center>NO POST FOUND</center></h2>

        <?php endif ?>






<?php get_footer(); ?>
