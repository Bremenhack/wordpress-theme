<?php
/*
Template Name: Front
*/
get_header(); ?>

<div class="hero animated fadeIn" role="banner">
  <div class="hero__wrapper">
    <h2 class="hero__headline"><?php the_field('hero_text'); ?></h2>

    <?php if( get_field('hero_button_url') ): ?>
      <a class="hero__button button large" href="<?php the_field('hero_button_url'); ?>"><?php the_field('hero_button_text'); ?></a>
    <?php endif; ?>
  </div>
</div>

<div class="about animated fadeIn">
  <div class="about__wrapper">
    <div class="about__text">
      <h2><?php the_field('about_headline'); ?></h2>
      <h4><?php the_field('about_subheadline'); ?></h4>

      <?php the_field('about_textfield'); ?>
    </div>

    <div class="about__media">
      <div class="responsive-embed widescreen">
        <?php the_field('about_mediainput'); ?>
      </div>
    </div>
  </div>
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
  <div class="recent-projects__more">
    <?php
      $category_id = get_cat_ID( 'projekte' );
      $category_link = get_category_link( $category_id );
    ?>
    <a class="button primary large" href="<?php echo esc_url( $category_link ); ?>">Alle Projekte zeigen</a>
  </div>
</div>

<div class="section-divider">
  <h2 class="section-divider__headline"><?php the_field('sponsoring_headline'); ?></h2>
  <h4 class="section-divider__subheadline"><?php the_field('sponsoring_subheadline'); ?></h4>
</div>

<?php if( have_rows('sponsoring') ): ?>
  <div class="sponsoring">
    <?php while( have_rows('sponsoring') ): the_row(); 
      $image = get_sub_field('sponsor_image');
      $link = get_sub_field('sponsor_link');
    ?>
    <div class="sponsoring__element">
      <?php if( $link ): ?>
        <a href="<?php echo $link; ?>">
      <?php endif; ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
      <?php if( $link ): ?>
        </a>
      <?php endif; ?>
    </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php get_footer();
