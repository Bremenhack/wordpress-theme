<?php
/*
Template Name: Front
*/
get_header(); ?>

<div class="hero" role="banner">
  <h2 class="hero__headline"><?php the_field('hero_text'); ?></h2>
</div>

<div class="section-divider">
  <h2 class="section-divider__headline"><?php the_field('recent_projects_headline'); ?></h2>
  <h4 class="section-divider__subheadline"><?php the_field('recent_projects_subheadline'); ?></h4>
</div>

<div class="recent-projects">
  <?php
     // the query
     $the_query = new WP_Query( array(
       'category_name' => 'projekte',
        'posts_per_page' => 3,
     ));
  ?>

  <?php if ( $the_query->have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

      <article class="recent-projects__post">
        <header>
          <a href="<?php the_permalink(); ?>">
            <div class="recent-projects__thumbnail">
              <?php the_post_thumbnail(); ?>
            </div>
          </a>
        </header>
        <section>
          <?php the_excerpt(); ?>
        </section>
    </article>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

  <?php else : ?>
    <p><?php __('No News'); ?></p>
  <?php endif; ?>
</div>


<?php get_footer();
