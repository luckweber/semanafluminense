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
<div id="content" class="etapas-internas upload">
    <form action="<?php echo $next_page; ?>" id="form-upload-foto" name="form-upload-foto" method="post" enctype="multipart/form-data">

        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>

        <input type="hidden" name="submitted" id="submitted" value="true" />

        <div class="cont">
            <div class="formulario-cadastro">

                <h2>Concurso Cultural</h2>
                <h3 class="categoria"><?php echo $modalidade_nome; ?> <?php echo $categoria_nome; ?> <span><?php echo $idade; ?></span></h3>

                <div class="form-avisos">

                    <div class="formulario-upload">



                        <fieldset>

                            <legend>Dados da sua foto</legend>

                            <p>
                                <label>T&iacute;tulo da foto<br />
                                    <input type="text" name="foto_titulo" id="foto_titulo" />
                                </label>
                            </p>

                            <div class="clear"></div>

                            <p>
                                <label>Local retratado<br />
                                    <input type="text" id="foto_local" name="foto_local" />
                                </label>
                            </p>

                            <div class="clear"></div>

                            <p>
                                <label>data da foto <span>(ex: 00/00/0000)</span><br />
                                    <input type="text" id="foto_data" name="foto_data" class="data" />
                                </label>
                            </p>

                            <div class="clear"></div>

                            <p>
                                <label>Anexar <br />
                                    <input type="file" name="foto_anexo" id="foto_anexo" />
                                </label>
                            </p>

                            <div class="clear"></div>

                            <p>
                                <span>Seu arquivo deve ser nomeado com o t&iacute;tulo da fotografia sem espa&ccedil;os, evitando-se caracteres especiais como ?, !, #, @ etc.</span>
                            </p>

                            <div class="clear"></div>

                            <p>
                                <strong>Aguarde a conclus&atilde;o do upload para enviar.</strong>
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
                            <li>as obras inscritas devem ser in&eacute;ditas;</li>
                            <li>podem ser coloridas ou em preto e branco;</li>
                            <li>n&atilde;o devem apresentar qualquer tipo de montagem</li>
                            <li>A foto deverá ter, no máximo, 10Mb</li> 
                            <li>os arquivos devem ser em formato digital (jpeg) na resolu&ccedil;&atilde;o mínima de 300 dpi</li>
                        </ul>

                          <a class="regulamento" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2013/edital2013.pdf" title="Leia o edital" target="_blank">Leia o edital</a>                            

                    </div>

                </div>

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
                        <input class="continuar st" type="submit" value="Continuar"/>
                    </div>

                </fieldset>

            </div>


        </div>


        

    </form>
</div>