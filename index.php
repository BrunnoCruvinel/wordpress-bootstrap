<?php get_header() ?>


      <?php
        // ###########  BANNERS  ###########
        $args = array( 'post_type' => 'banner');
        query_posts($args); $i = 1;
        while (have_posts()) : the_post();
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        $thumb = $src[0];

        // CUSTOM FIELDS
        // $CUSTOM_FIELD = get_post_meta($post->ID, 'FIELD NAME', true);

        // DEFAULT

        // ECHO FUNCTIONS   GET FUNCTIONS
        // the_title();     get_the_title();
        // the_content();   get_the_content();
        // the_excerpt();   get_the_excerpt();
        // the_permalink(); get_the_permalink();
        // the_category();  get_the_category();
      ?>


        <!-- HTML LOOP HERE -->


      <?php $i++;endwhile; ?>




      <?php
      // ###########  POSTS  #############
       $args = array( 'post_type' => 'post', 'posts_per_page' => 3);
       query_posts($args);  $i = 1;
       while (have_posts()) : the_post();
       $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
       $thumb = $src[0];
     ?>

     <!-- HTML LOOP HERE -->


     <?php $i++;endwhile; ?>


<?php get_footer() ?>
