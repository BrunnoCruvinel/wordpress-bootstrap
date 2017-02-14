
						<?php
						// ##################  POST TYPES  ##################

							// FIRST MODEL
							// $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
							// foreach ($posts as $post):
							//
							//
							// endforeach;

							// SECOND TYPE
							// wp_reset_query();
							// $args = array( 'post_type' => 'post', 'numberposts'=>10,'order'=>'DESC');
							// query_posts($args);
							// while (have_posts()) : the_post();

							//endwhile;
						?>



					<?php
					// *********************   MOST READ  *********************
						// wp_reset_query();
						// $nova_consulta = new WP_Query(
						// 		array(
						// 				'posts_per_page'      => 5,
						// 				'no_found_rows'       => true,
						// 				'post_status'         => 'publish',
						// 				'ignore_sticky_posts' => true,
						// 				'orderby'             => 'meta_value_num',
						// 				'meta_key'            => 'tp_post_counter',
						// 				'order'               => 'DESC'            
						// 		)
						// );

					?>

						<?php
						//  if ( $nova_consulta->have_posts() ): while ( $nova_consulta->have_posts() ):
				    //         $nova_consulta->the_post();
				    //         $tp_post_counter = get_post_meta( $post->ID, 'tp_post_counter', true );
						?>

						<?php //endwhile;endif ?>




						<?php
						// ##################  CATEGORIES  ##################
								// $categories = get_categories();
								// foreach ($categories as $c => $cat) :
						?>
						<!-- <a href="<?php echo DOMAIN."/categories/".$cat->slug ?>"><?php echo $cat->name ?></a> -->
						<?php //endforeach ?>
