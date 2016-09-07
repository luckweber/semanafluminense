<?php

/*
Template Name: Inscrição Concurso Cultural - Passo 4
*/

?>
<?php get_header("form-concursos"); ?>

    <!-- Formulário de Trabalho - Fotografia ou Poesia -->
    
    <?php if( $modalidade === 'Fotografia' ) : ?>

        <?php get_template_part('form-fotografia'); ?>

    <?php else : ?>

        <?php get_template_part('form-poesia'); ?>

    <?php endif; ?>

<?php get_footer("form-concursos"); ?>