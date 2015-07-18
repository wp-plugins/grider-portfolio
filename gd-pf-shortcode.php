<?php

/*
 * Gridder Portfolio Shortcode
 */

if (!function_exists('gd_pf_shortcode')) {

          function gd_pf_shortcode() {

                    $args = array(
                        'post_type' => 'gd_post_types',
                        'posts_per_page' => -1
                    );

                    // Query the posts:
                    $grid_post_types_query = new WP_Query($args);
                    if ($grid_post_types_query->have_posts()) {
                              $grid_img = '';
                              $grid_details = '';
                              $i = 1;
                              while ($grid_post_types_query->have_posts()) : $grid_post_types_query->the_post();
                                        $thumb = get_post_thumbnail_id();
                                        $img_url = wp_get_attachment_url($thumb, 'full');
                                        $content = wpautop(get_the_content());
                                        $grid_img .= ' <li class="gridder-list" data-griddercontent="#gridder-content-' . $i . '">
                    <img src="' . $img_url . '" class="img-responsive" />
                </li>';
                                        $grid_details .= '<div id="gridder-content-' . $i . '" class="gridder-content">
                <div class="row">
                    <div class="col-sm-6">
                        <img src=" ' . $img_url . '" class="img-responsive" />
                    </div>
                    <div class="col-sm-6">
                     ' . $content . '
                    </div>
                </div>
            </div>';
                                        $i++;
                              endwhile;
                              $output = '<div class="container griddercontainer"><ul class="gridder"> ' . $grid_img . '</ul>' . $grid_details . '</div>';
                    }else {
                              $output = __('No portfolio found', 'wpb_fp');
                    }
                    wp_reset_postdata();
                    wp_reset_query();
                    return $output;
          }

          add_shortcode('gid_portfolio', 'gd_pf_shortcode');
}