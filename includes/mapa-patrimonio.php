
        <?php
        /** Plotagem do mapa * */
        $cont = 1;
        $markers = array();
        $address = "Rio de Janeiro, Rio de Janeiro, Brazil";
        $zoom = 8;
        $args = array(
            "post_type" => "patrimonio-cultural",
            "posts_per_page" => -1,
        );

        // if (isset($_GET["oque"]) && $_GET["oque"] != "") {

        //     unset($args["category_name"]);

        //     if ($_GET["oque"] == "Todas")
        //         $args["cat"] = "";
        //     else
        //         $args["cat"] = $_GET["oque"];

        // }

        // if (isset($_GET["quando"]) && $_GET["quando"] != "") {

        //     if (!isset($args["meta_query"]))
        //         $args["meta_query"] = array(array());
            
        //     $args["meta_query"][] = array(
        //         'key' => 'wpcf-event-start-date',
        //         'value' => $_GET["quando"],
        //     );
        // }

        // if (isset($_GET["cidade"]) && $_GET["cidade"] != "") {

        //     if (!isset($args["meta_query"]))
        //         $args["meta_query"] = array(array());

        //     $args["meta_query"][] = array(
        //         'key' => 'wpcf-cidade',
        //         'value' => $_GET["cidade"],
        //     );
        // }

        wp_reset_query();
        $my_posts = new WP_Query();
        $my_posts->query($args);

        while ($my_posts->have_posts()) {

            $my_posts->the_post();

            $latitude = do_shortcode("[types field='latitude']");
            $longitude = do_shortcode("[types field='longitude']");

            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listagem' );
            $url = $thumb['0'];

            
            $p_city = do_shortcode( "[types field='cidade']" );
            $p_address = do_shortcode("[types field='endereco']");
            $p_address = (!empty($p_address)) ? $p_address. ',': null;
            $p_address =   $p_address.  $p_city;

                $html = "<img class='img-mapa' src='" . $url . "' /><a href='" . get_permalink() . "'>" . get_the_title() . "</a></p><p class='desc-map'>" . $p_address . "</p>";

                $markers[] = array("latitude" => $latitude, "longitude" => $longitude, "html" => $html);

            
        
        }
        wp_reset_query();
        $mapa = array("address" => $address, "zoom" => $zoom, "markers" => $markers, "scrollwheel" => true);

        $json_encoded = json_encode( $mapa );

        ?>

        <script type="text/javascript">
            $(function(){
                
                $('#js-display-map-patrimonio').click(function(event) {
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