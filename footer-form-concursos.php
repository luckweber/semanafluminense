</div>

<div id="footer">

    <div class="content-footer-menu">

        <div class="content-f">
            <div class="cols col1">
                <?php wp_nav_menu(array('before' => '', 'after' => '', 'container' => 'false','menu' => 'menu-rodape-col1', 'items_wrap' => '<ul id="footer-menu">%3$s</ul>')); ?>
            </div>

            <div class="cols col2">
                <?php wp_nav_menu(array('before' => '', 'after' => '', 'container' => 'false','menu' => 'menu-rodape-col2', 'items_wrap' => '<ul id="footer-menu">%3$s</ul>')); ?>           
            </div>

            <div class="cols col3">
                <?php wp_nav_menu(array('before' => '', 'after' => '', 'container' => 'false','menu' => 'menu-rodape-col3', 'items_wrap' => '<ul id="footer-menu">%3$s</ul>')); ?>                  
            </div>   


        </div>

    </div>

    <div class="content-footer-copyright">

        <div class="content-f">

            <img src="<?php bloginfo("template_url"); ?>/imagens/site/logos-parceiros.png" alt="Parceiros">           

            <p class="semana">Semana Fluminense do Patrim&ocirc;nio &copy; <?php echo Date('Y'); ?> - Todos os direitos reservados  |  <a title="Pol&iacute;tica de Privacidade" href="#">Pol&iacute;tica de Privacidade</a></p>


        </div>

    </div>

</div>


<script type="text/javascript" src="<?php bloginfo('template_url') ?>/form-concursos/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/form-concursos/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/form-concursos/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/form-concursos/js/messages_ptbr.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/form-concursos/js/mask.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/form-concursos/js/functions.js"></script>
<script src="<?php bloginfo("template_url"); ?>/js/jquery.bxslider.min.js" type="text/javascript"></script>
        
<!-- BX SLider Home -->
<script type="text/javascript">
$(document).ready(function(){

    if( $('.js-top-menu-slider') ) {
        $('.js-top-menu-slider').bxSlider({
            auto: true,
            captions: true,
            controls: false,
            mode: 'horizontal',
            pager: true

        });
    }

    if( $("#outro") ) {
        $("#outro").click(function(){
            if($(this).is(":checked")){
                $("label.st").show();
            }else{
                $("label.st").hide();
            }
        });
    }
});
</script>

<script type="text/javascript">

     var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-33711026-1']);
     _gaq.push(['_trackPageview']);

     (function() {
           var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
           ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
           var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

</script>

</body>

</html>