<?php
    /** Template Name: Dự Án */   
    get_header(  );
    global $post;
    $banner = (get_field('banner_header_du_an')) ? get_field('banner_header_du_an') : '';
    $number_post = (get_field('number_post_display')) ? get_field('number_post_display') : 5;
?>
<div class="sub-banner overview-bgi" style = "background: rgba(0, 0, 0, 0.04) url(<?php echo (!empty($banner['url'])) ? $banner['url'] : ''; ?>) top left repeat;">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1><?php echo get_the_title( $post->ID )?></h1>
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="container-block-du-an">
        <div class="row">
            <div class="col-md-9">
                
                <?php 
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $query = new WP_Query( array( 
                        'post_type' =>'du-an' ,
                        'posts_per_page' => $number_post,
                        'paged' => $paged
                    )  ); ?>
                <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="property clearfix wow fadeInUp delay-03s" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                            <!-- Property img -->
                            <div class="property-img">
                                <a href="<?php the_permalink(  ) ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full') ?>" alt="<?php the_title() ?>" class="img-responsive hp-1">
                                </a>  
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                            <!-- title -->
                            <h3 class="title tpl-du-an-page">
                                <a href="<?php the_permalink(  ) ?>"><?php echo wp_trim_words(get_the_title(), 20, '') ?></a>
                            </h3>
                            <!-- Property address -->
                            <!-- Facilities List -->
                            <ul class="facilities-list clearfix">
                                <li>Giá: <?php echo get_field('gia_du_an', $post->ID); ?></li>
                                <li>Địa Chỉ: <?php echo get_field('dia_chi_du_an', $post->ID); ?></li>
                                <li>Diện Tích: <?php echo get_field('dien_tich_du_an', $post->ID); ?></li>
                            </ul>
                        
                        </div>
                    </div>

                <?php endwhile; 
                wp_reset_postdata();
                else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; ?>
                <div class="custom-navigation-page">

                        <?php
                            $big = 999999999; // need an unlikely integer

                            echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $query->max_num_pages,
                                'type' => 'list',
                                'prev_text' => '<<',
                                'next_text' => '>>',
                            ) );
                        ?>
                </div>
                
            </div>
            
            <div class="col-md-3">
                <?php get_sidebar() ?>
            </div>
        </div>
    </div>
</div>

 <?php get_footer(); ?>