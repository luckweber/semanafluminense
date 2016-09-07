<?php

/*
Template Name: Inscrição Concurso Cultural
*/

$pages = get_pages( 'child_of=' . $post->post_parent );

$prev_page = '';
$next_page = '';
$total_pages = count( $pages );
for ($i = 0; $i < $total_pages; $i++) {
    if( $pages[$i]->ID == get_the_ID() ) {
        if( ( $i > 0 ) && $pages[$i-1] ) {
            $prev_page = get_permalink( $post->post_parent ) . '/' . $pages[$i-1]->post_name;
        }
        if( ( $i < $total_pages - 1 ) && $pages[$i+1] ) {
            $next_page = get_permalink( $post->post_parent ) . '/' . $pages[$i+1]->post_name;
        }
    }
}

if( $post->post_name === 'passo-1' ) {
    if( session_start() ) {
        session_destroy();
    }
}

if( isset( $_POST ) && count( $_POST ) > 0 ) {

    if( !session_id() ) {
        session_start();
    }

    foreach( $_POST as $key => $value ) {
        session_register( $key );
        $_SESSION[ $key ] = $value;
    }
}

$categorias     = get_term_by( 'slug', 'categorias', 'category' );
$categorias     = get_terms( 'category', 'hide_empty=0&child_of=' . $categorias->term_id );

$modalidades    = get_term_by( 'slug', 'modalidades', 'category' );
$modalidades    = get_terms( 'category', 'hide_empty=0&child_of=' . $modalidades->term_id );

$temas          = get_term_by( 'slug', 'temas', 'category' );
$temas          = get_terms( 'category', 'hide_empty=0&child_of=' . $temas->term_id );

session_register('categorias');
session_register('modalidades');
session_register('temas');

$_SESSION['categorias']     = $categorias;
$_SESSION['modalidades']    = $modalidades;
$_SESSION['temas']          = $temas;

if( isset( $_SESSION['categoria'] ) ) {
    foreach ($_SESSION['categorias'] as $categoria) {
        if( $categoria->term_id == $_SESSION['categoria'] ) {
            $idade = $categoria->description; 
            $categoria_nome = $categoria->name;
        }
    }
}

if( isset( $_SESSION['modalidade'] ) ) {
    foreach ($_SESSION['modalidades'] as $modalidade) {
        if( $modalidade->term_id == $_SESSION['modalidade'] ) {
            $modalidade_nome = $modalidade->name;
        }
    }
}

?>
<?php get_header("form-concursos"); ?>

<?php if( $post->post_name === 'passo-1' ) : ?>

<!-- Escolha de Categoria e Modalidade -->

<div id="content" class="con inicio">

    <div class="concurso">

        <div class="colunas-etapas">

            <div class="cols">
                
                <?php get_template_part('acessibilidade'); ?>

                <h2>Concurso Cultural</h2>
                
                <?php while( have_posts() ) : the_post(); ?>
                <div class="conteudo">
                <?php the_content(); ?>
                </div>
                <?php endwhile; ?>

            </div>

        </div>



        <div class="etapas">

            <div>
                <strong>Veja como &eacute; f&aacute;cil participar</strong>
            </div>

            <ol>
                <li class="etapa1">Escolha a modalidade e a categoria</li>
                <li class="etapa2">Escolha o assunto</li>
                <li class="etapa3">Preencha seus dados</li>
                <li class="etapa4">Envie seu trabalho</li>
            </ol>

        </div>

        

    <div class="escolha-assunto principal">

        <form action="<?php echo $next_page; ?>" id="form-index" name="form-index" method="post">

            <fieldset>
                <legend><span>Comece por aqui !</span> A inscri&ccedil;&atilde;o e gr&aacute;tis</legend>

                <label>Escolha a modalidade<br />
                    <div class="select">
                        <select name="modalidade" id="modalidade">
                            <?php foreach ($modalidades as $modalidade) : ?>
                            <?php   if( $modalidade->slug != 'trova' ) : ?>
                            <option value="<?php echo $modalidade->term_id; ?>"><?php echo $modalidade->name; ?></option>
                            <?php   endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </label>

                <label class="second">Escolha a categoria<br />
                    <div class="select">
                        <select name="categoria" id="categoria">
                            <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria->term_id; ?>"><?php echo $categoria->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </label>

                <div class="regulamento-continuar">

                    <label id="label-regulamento">
                        <input id="regulamento" name="regulamento" type="checkbox" value="1" />
                        <span>Declaro que li e concordo com o edital</span>
                    </label>

                    <input class="continuar st" type="submit" value="Continuar" />

                </div>

            </fieldset>


        </form>

      
    </div>



    </div>
</div>

<?php elseif( $post->post_name === 'passo-2' ) : ?>

    <!-- Escolha do Tema -->

    <?php get_template_part('form-tema'); ?>

<?php elseif( $post->post_name === 'passo-3' ) : ?>

    <!-- Formulário de Categoria - Adulto ou Infanto-Juvenil -->
    
    <?php if( $categoria_nome === 'Adulto' ) : ?>

        <?php get_template_part('form-adulto'); ?>

    <?php else : ?>

        <?php get_template_part('form-infanto-juvenil'); ?>

    <?php endif; ?>

<?php elseif( $post->post_name === 'passo-4' ) : ?>

    <!-- Formulário de Trabalho - Fotografia ou Poesia -->
    
    <?php if( $modalidade_nome === 'Fotografias' ) : ?>

        <?php get_template_part('form-fotografia'); ?>

    <?php else : ?>

        <?php get_template_part('form-poesia'); ?>

    <?php endif; ?>

<?php elseif( $post->post_name === 'passo-5' ) : ?>

    <?php get_template_part('submit-form-concursos'); ?>

<?php else : ?>

<div id="content" class="con inicio">

    <div class="concurso">

        <h2>Inscrição Concurso Cultural</h2>

        <p>A página que você está tentando acessar não existe.<br /> Caso queira se inscrever no concurso, <strong><a href="passo-1">clique aqui</a></strong>.</p>

    </div>
</div>

<?php endif; ?>

<?php get_footer("form-concursos"); ?>