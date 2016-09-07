
        <?php
        /** Plotagem do mapa * */
        $cont = 1;
        $markers = array();
        $address = "Rio de Janeiro, Rio de Janeiro, Brazil";
        $zoom = 8;
        $args = array(
            "post_type" => "programacao",
            "posts_per_page" => -1,
        );

        if (isset($_GET["oque"]) && $_GET["oque"] != "") {

            unset($args["category_name"]);

            if ($_GET["oque"] == "Todas")
                $args["cat"] = "";
            else
                $args["cat"] = $_GET["oque"];

        }

        if (isset($_GET["quando"]) && $_GET["quando"] != "") {

            if (!isset($args["meta_query"]))
                $args["meta_query"] = array(array());
            
            $args["meta_query"][] = array(
                'key' => 'wpcf-event-start-date',
                'value' => $_GET["quando"],
            );
        }

        if (isset($_GET["cidade"]) && $_GET["cidade"] != "") {

            if (!isset($args["meta_query"]))
                $args["meta_query"] = array(array());

            $args["meta_query"][] = array(
                'key' => 'wpcf-cidade',
                'value' => $_GET["cidade"],
            );
        }

        wp_reset_query();
        $my_posts = new WP_Query();
        $my_posts->query($args);

        while ($my_posts->have_posts()) {

            $my_posts->the_post();

            $latitude = do_shortcode("[types field='latitude']");
            $longitude = do_shortcode("[types field='longitude']");

            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listagem' );
            $url = $thumb['0'];

            $start_date = do_shortcode( "[types field='event-start-date']" );
            $start_time = do_shortcode( "[types field='event-start-date' format='H:i']" );

            $event_city = do_shortcode( "[types field='cidade']" );
            $event_address = do_shortcode( "[types field='event-address']" ) . ', ' . $event_city;

            if( !empty( $start_date ) ) {

                list( $day, $month, $year ) = explode( '/', $start_date );
                list( $hour, $minute ) = explode( ':', $start_time );

                $months = array(
                    'Jan', 'Fev', 'Mar', 'Abr',
                    'Mai', 'Jun', 'Jul', 'Ago',
                    'Set', 'Out', 'Nov', 'Dez'
                );

                $html = "<img class='img-mapa' src='" . $url . "' /><p><span class='map-dia'>" . $day . " " . $months[ (int)$month - 1 ] . "</span> <span class='maps-horario'>" . $start_time . "</span></p><p><a href='" . get_permalink() . "'>" . get_the_title() . "</a></p><p class='desc-map'>" . do_shortcode("[types field='event-venue']") . ", " . do_shortcode("[types field='cidade']") . "</p>";

                $markers[] = array("latitude" => $latitude, "longitude" => $longitude, "html" => $html);

            }
        
        }

        $mapa = array("address" => $address, "zoom" => $zoom, "markers" => $markers, "scrollwheel" => true);

        $json_encoded = json_encode( $mapa );

        ?>

        <script type="text/javascript">
            $(function(){
                
                $('#js-display-map').click(function(event) {
                    $.colorbox({
                        html: '<div class="map-canvas" style="width: 100%; height: 100%;"></div>',
                        width: '90%',
                        height: '90%',
                        scrolling: false,
                        onComplete: function() {
                            $('.map-canvas').gMap(<?php echo $json_encoded; ?>);
                        }
                    });
                    event.preventDefault();
                });

                

            });
        </script>