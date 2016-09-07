<?php

foreach ($_SESSION['categorias'] as $categoria) {
    if( $categoria->term_id == $_SESSION['categoria'] ) {
        $idade = $categoria->description; 
        $categoria_nome = $categoria->name;
    }
}

foreach ($_SESSION['modalidades'] as $modalidade) {
    if( $modalidade->term_id == $_SESSION['modalidade'] ) {
        $modalidade_nome = $modalidade->name;
    }
}

global $prev_page;
global $next_page;

?>
<div id="content" class="etapas-internas upload poesia">
    <form action="<?php echo $next_page; ?>" id="form-upload-poesia" name="form-upload-poesia" method="post">

        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>

        <input type="hidden" name="submitted" id="submitted" value="true" />

        <div class="cont">
            <div class="formulario-cadastro">



                <h2>Concurso Cultural</h2>
                <h3 class="categoria"><?php echo $modalidade_nome; ?> <?php echo $categoria_nome; ?> <span><?php echo $idade; ?></span></h3>

                <div class="form-avisos">

                    <div class="formulario-upload">



                        <fieldset>

                            <legend>Dados da sua poesia</legend>

                            <p>
                                <label>T&iacute;tulo<br />
                                    <input type="text" name="poesia_titulo" id="poesia_titulo" />
                                </label>
                            </p>


                            <p class="escreva">
                                <label>Escreva aqui<br />
                                    <textarea cols="" rows="" id="poesia_conteudo" name="poesia_conteudo"></textarea>
                                </label>
                            </p>


                            <p class="poesia-input">
                                <strong>Sua obra &eacute; poesia ou trova?</strong>
                                <?php foreach( $_SESSION['modalidades'] as $modalidades ) : ?>
                                <?php   if( $modalidades->slug != 'fotografias' ) : ?>
                                <label><input type="radio" name="poesia_tipo" value="<?php echo $modalidades->term_id; ?>" /><?php echo $modalidades->name; ?></label>
                                <?php   endif; ?>
                                <?php endforeach; ?>
                            </p>

                        </fieldset>




                    </div>


                    <div class="avisos">

                        <h3>Dicas</h3>
                        <p>
                            Busque vincula&ccedil;&atilde;o com o tema;<br />
                            Mostre qualidade t&eacute;cnica e art&iacute;stica;<br />
                            Surpreenda com originalidade;
                        </p>

                        <h3>N&atilde;o esque&ccedil;a</h3>
                        <ul>
                            <li>as obras pode ser poesias ou trovas;</li>
                            <li>Devem ser digitadas em L&iacute;ngua Portuguesa;</li>
                            <li>n&atilde;o devem apresentar qualquer tipo de montagem</li>
                            <li>Devem ter no m&aacute;ximo 14 (quatorze) versos (linhas), contendo no m&aacute;ximo 45 toques cada verso.</li>
                        </ul>

                         <a class="regulamento" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2013/edital2013.pdf" title="Leia o edital" target="_blank">Leia o edital</a> 

                    </div>

                </div>

            </div>


            <div class="etapas">
                <div>
                    <strong>Pronto, agora &eacute; s&oacute; anexar seu trabalho</strong>
                </div>

                <ol>
                    <li class="etapa1 completa1">Escolha a modalidade e a categoria</li>
                    <li class="etapa2 completa2">Escolha o assunto</li>
                    <li class="etapa3 completa3">Preencha seus dados</li>
                    <li class="etapa4">Envie seu trabalho</li>
                </ol>

            </div>


        </div>





        <div class="escolha-assunto">

            <div class="upload-foto">

                <fieldset>
                    <legend><span>Como soube do concurso?</span></legend>
                    <p>
                        <label><input type="checkbox" class="option-referencia" name="referencia[]" value="Jornais/Revistas" />Jornais/Revistas</label>
                        <label><input type="checkbox" class="option-referencia" name="referencia[]" value="Site" />Site</label>
                        <label><input type="checkbox" class="option-referencia" name="referencia[]" value="Amigos" />Amigos</label>
                        <label><input id="outro" type="checkbox" class="option-referencia" name="referencia[]" value="Outro" />Outro</label>
                        <label class="st" style="display: none;"><span>Onde?</span><input class="onde option-referencia" name="referencia[]" id="onde" type="text" value="" /></label>
                        <span class="erro-referencia" style="display: none;">Este campo é requerido.</span>
                    </p>


                    <div class="botoes">
                        <a href="<?php echo $prev_page; ?>" class="voltar st" title="Voltar">Voltar</a>
                        <input class="continuar st" type="submit" value="Continuar" />
                    </div>

                </fieldset>

            </div>


        </div>


        

    </form>
</div>