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
$selected = '';

$estados = array( "AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO" );

?>
<div id="content" class="adulto">

    <div class="dados-usuario">

        <div class="cadastro">

            <div class="titulo-categoria">

                <h2>Concurso Cultural</h2>
                <h3 class="categoria"><?php echo $modalidade_nome; ?> <?php echo $categoria_nome; ?> <span><?php echo $idade; ?></span></h3>

            </div>

                <form id="form-adulto" name="form-adulto" action="<?php echo $next_page; ?>" method="post">


                    <fieldset>

                        <legend>Preencha seus dados</legend>
                        <p class="obrigatorio">(&Eacute; obrigat&oacute;rio o preenchimento de todos os campos)</p>


                        <div class="clear linha"></div>

                            <div class="campos1">
                                <p>
                                    <label>Nome do participante</label><br />
                                    <input type="text" id="adulto_nome" name="adulto_nome" />
                                </p>
                            </div>

                            <div class="campos3 m">
                                <p>
                                    <label>Data de nascimento</label><br />
                                    <input type="text" id="adulto_nascimento" name="adulto_nascimento" class="data" />
                                </p>
                            </div>

                        <div class="clear linha"></div>


                            <div class="campos1">
                                <p>
                                    <label>Naturalidade</label><br />
                                    <input type="text" id="adulto_naturalidade" name="adulto_naturalidade" />
                                </p>
                            </div>

                            <div class="campos2 m">
                                <p>
                                    <label>Sexo</label><br />
                                    <select name="adulto_sexo" id="adulto_sexo">
                                        <option value="m">Masculino</option>
                                        <option value="f">Feminino</option>
                                    </select>
                                </p>
                            </div>

                        <div class="clear linha"></div>


                        <div class="campos1">
                            <p>
                                <label>Endere&ccedil;o</label><br />
                                <input type="text" id="adulto_endereco" name="adulto_endereco" />
                            </p>
                        </div>

                        <div class="campos2">
                            <p>
                                <label>Bairro</label><br />
                                <input type="text" id="adulto_adulto_bairro" name="adulto_bairro" />
                            </p>
                        </div>

                        <div class="clear linha"></div>


                        <div class="campos1">
                            <p>
                                <label>Cidade</label><br />
                                <input type="text" id="adulto_cidade" name="adulto_cidade" />
                            </p>
                        </div>

                        <div class="campos2 m">
                            <p>
                                <label>Estado</label><br />
                                <select id="adulto_uf" name="adulto_uf">
                                    <?php foreach($estados as $estado) : ?>
                                    <?php $selected = ( $estado == 'RJ' ) ? ' selected="selected"' : ''; ?>
                                    <option value="<?php echo $estado; ?>"<?php echo $selected; ?>><?php echo $estado; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </p>
                        </div>


                        <div class="clear linha"></div>

                        <div class="campos3">
                            <p>
                                <label>CEP</label><br />
                                <input type="text" id="adulto_cep" name="adulto_cep" class="cep" />
                            </p>
                        </div>

                        <div class="campos3">
                            <p>
                                <label>Telefone</label><br />
                                <input type="text" id="adulto_telefone" name="adulto_telefone" class="telefone" />
                            </p>
                        </div>

                        <div class="campos3 m">
                            <p>
                                <label>Celular</label><br />
                                <input type="text" id="adulto_celular" name="adulto_celular" class="telefone" />
                            </p>
                        </div>


                        <div class="clear linha"></div>


                        <div class="campos4">
                            <p>
                                <label>CPF</label><br />
                                <input type="text" id="adulto_cpf" name="adulto_cpf" class="cpf" />
                            </p>
                        </div>

                        <div class="campos3">
                            <p>
                                <label>RG</label><br />
                                <input type="text" id="adulto_rg" name="adulto_rg" />
                            </p>
                        </div>

                        <div class="campos5 m">
                            <p>
                                <label>&Oacute;rg&atilde;o expedidor</label><br />
                                <input type="text" id="adulto_expedidor" name="adulto_expedidor" />
                            </p>
                        </div>


                        <div class="clear linha"></div>


                        <div class="campos1">
                            <p>
                                <label>Email pessoal</label><br />
                                <input type="text" id="adulto_email" name="adulto_email" />
                            </p>
                        </div>

                    </fieldset>

            </div>

            <div class="etapas">

                <div>
                    <strong>Falta pouco, preencha para continuar</strong>
                </div>

                <ol>
                    <li class="etapa1 completa1">Escolha a modalidade e a categoria</li>
                    <li class="etapa2 completa2">Escolha o assunto</li>
                    <li class="etapa3">Preencha seus dados</li>
                    <li class="etapa4">Envie seu trabalho</li>
                </ol>

            </div>


        </div>



        <div class="dados escolha-assunto">

            <div class="assunto">

                <fieldset>
                    <legend><span>Assunto escolhido</span></legend>

                    <div class="select">
                        <select name="tema" id="tema" disabled="">
                            <?php foreach ($_SESSION['temas'] as $tema) : ?>
                            <?php $selected = ( $tema->term_id == $_SESSION['tema']) ? ' selected="selected"' : ''; ?>
                            <option value="<?php echo $tema->term_id; ?>"<?php echo $selected; ?>><?php echo $tema->name; ?></option>
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