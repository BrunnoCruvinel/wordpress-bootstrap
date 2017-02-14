<?php get_header() ?>



			<?php
					while ( have_posts() ) : the_post();
						$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$thumb = $src[0];
			?>





				<!--
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="fx" title="Compartilhar no Facebook"><img src="<?php echo FILES ?>img/share_face.png"  /></a>
					<a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank" class="fx" title="Compartilhar no Twitter"><img src="<?php echo FILES?>img/share_twitter.png"  /></a>
					<a href="https://www.linkedin.com/cws/share?url=<?php the_permalink(); ?>" target="_blank" class="fx" title="Compartilhar no Linked-in"><img src="<?php echo FILES?>img/share_linked.png"  /></a>
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="fx" title="Compartilhar no Google Plus"><img src="<?php echo FILES?>img/share_gplus.png"  /></a>
				-->

			<?php endwhile; ?>

<?php get_footer() ?>
