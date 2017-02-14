<?php get_header() ?>


				<?php

              if (have_posts()) : while (have_posts()) : the_post();
              // $args = array ( 'category' => ID, 'posts_per_page' => 5);
              // $myposts = get_posts( $args );
              // foreach( $myposts as $post ) :	setup_postdata($post);

							// SRC THUMB IMAGE
              $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
              $thumb = $src[0];
        ?>


				    <!-- HTML LOOP HERE -->

				<?php endwhile; ?>

				<?php wp_pagination(); ?>

				<?php else: ?>

					<h2><center>NO ONE POST</center></h2>

				<?php endif; ?>




<?php get_footer() ?>
