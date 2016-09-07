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
<div id="content" class="etapas-internas tema">

    <div class="cont">

        <div class="principal-categoria">

            <h2>Concurso Cultural</h2>
            <h3 class="categoria"><?php echo $modalidade_nome; ?> <?php echo $categoria_nome; ?> <span><?php echo $idade; ?></span></h3>

            <div class="info-concurso">

                <p>
                    Nessa etapa você escolhe um dos três temas relacionados. Será aceita apenas 1 (uma) inscrição 

de cada participante em cada um dos temas (“O patrimônio da região Norte Fluminense”, “Cultura 

em ação” e “Por onde andei”) de cada uma das modalidades (fotografia e poesia). Mais de uma 

inscrição no mesmo tema/categoria implicará na desclassificação automática do candidato no 

concurso.
                </p>

            </div>

            <div class="assuntos">

                <h4>Conhe&ccedil;a os temas</h4>

                <div class="temas">

                    <?php foreach ($_SESSION['temas'] as $tema) : $i = 1; ?>
                    <div class="tema<?php echo $i; ?>">
                        <h5><?php echo $tema->name; ?></h5>
                        <p><?php echo apply_filters( 'the_content', $tema->description ); ?></p>
                    </div>
                    <?php $i++; endforeach; ?>

                </div>

            </div>


        </div>

        <div class="etapas">

            <div>
                <strong>Escolha o tema</strong>
            </div>

            <ol>
                <li class="etapa1 completa1">Escolha a modalidade e a categoria</li>
                <li class="etapa2">Escolha o assunto</li>
                <li class="etapa3">Preencha seus dados</li>
                <li class="etapa4">Envie seu trabalho</li>
            </ol>

        </div>


    </div>

    <form id="form-tema" name="for-tema" action="<?php echo $next_page; ?>" method="post">

        <div class="dados escolha-assunto">

            <div class="assunto">

                <fieldset>
                    <legend><span class="esc-tema">Escolha o tema para continuar</span></legend>

                    <div class="select">
                        <select id="tema" name="tema">
                            <?php foreach( $_SESSION['temas'] as $tema ) : ?>
                            <option value="<?php echo $tema->term_id; ?>"><?php echo $tema->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    

                    <div class="botoes">
                        <a href="<?php echo $prev_page; ?>" class="voltar st" title="Voltar">Voltar</a>
                        <input class="continuar st" type="submit" value="Continuar" />
                    </div>

                </fieldset>


            </div>

        </div>
    </form>

    
</div>