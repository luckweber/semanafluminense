<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js" type="text/javascript">
    
</script>
<?php
w
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}


    echo get_client_ip_server();
     $seila = new WP_Analytify_Simple();

echo "Vote: <img class='rate_icon' src='".plugins_url('../images/like-fill.png', __FILE__)."'>";
     echo '<p>aaaaaaaaaaaaaaaaaaaa</p>';
     
   


?>
<?php
echo '
<script>

    jQuery(document).ready(function( $ ) {
        
        $("body").on("click", ".rate_icon", function(){
             $(this).each(function(){
                 $(this).attr("src", "'.plugins_url('../images/like.png', __FILE__).'");
                 
             });
        });
 
 
            
  });

</script>
';
?>