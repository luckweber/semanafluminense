<?php
/**
 * get youtube video ID from URL
 *
 * @param string $url
 * @return string Youtube video id or FALSE if none found. 
 */
function youtube_id_from_url($url) {
    $pattern = 
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
        ;
    $result = preg_match($pattern, $url, $matches);
    if (false !== $result) {
        return $matches[1];
    }
    return false;
}
?>
<div class="box slider-videos slider">
    <h3>Vídeos</h3>
    <div class="box-content">
        <ul class="js-video-slider">
            <?php $temp_query = $wp_query; ?>
            <?php query_posts('post_type=videos&showposts=4'); ?>
            <?php while ( have_posts() ) : the_post();
                
                $youtube_url = str_replace(array('[embed]','[/embed]'), '', $post->post_content);
                
                // verifica qual tipo de url esta usando, a completa ou a curta
               
                $video_id = youtube_id_from_url($youtube_url);

                // print_r($video_id);
                
                $thumbnail_url = 'http://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg'
             ?>
            <li>

                <?php echo '<a target="_blank" href=http://www.youtube.com/watch?v='.$video_id.'>' ?>
                    <img src="<?php echo $thumbnail_url;?>">
                <?php echo '</a>' ?>
                <div class="slider-label">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
            </li>
            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>
    <div class="mais-link">
        <a href="<?php bloginfo( 'url' );?>/videos/">Ver todos os vídeos</a>
    </div>
</div>
