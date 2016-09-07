<?php /* Template Name: Cadastro de evento */ get_header("internas"); ?>

<div id="content">


    <?php include "acessibilidade.php"; ?>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>    


            <div id="post" class="cadastre-seu-evento">


                <h2>Integre a programa&ccedil;&atilde;o da II Semana Fluminense do Patrim&ocirc;nio 2012</h2>
                <p>Institui&ccedil;&otilde;es, organiza&ccedil;&otilde;es da sociedade civil, produtores e grupos culturais.</p>
                <span class="line-header"></span>


                <div class="entry">


                    <?php the_content(); ?>


                    <form method="post" action="<?php bloginfo("template_url"); ?>/report.php" enctype="multipart/form-data">

                        <h3>Dados para formul&aacute;rio de pr&eacute;-inscri&ccedil;&atilde;o de eventos</h3>
                        <p><span>*</span> Dados obrigat&oacute;rios</p>

                        <div id="todoform">


                            <div class="col1-fields">


                                <p> 
                                    <label for="nome_instituicao">Institui&ccedil;&atilde;o proponente:</label><br />
                                    <input type="text" size="60" name="nome_instituicao" />
                                </p>


                                <p>
                                    <label for="responsavel_instituicao">Respons&aacute;vel da institui&ccedil;&atilde;o:</label><br />
                                    <input type="text" size="60" name="responsavel_instituicao" />
                                </p>


                                <p>
                                    <label for="endereco">Endere&ccedil;o:</label><br />
                                    <input type="text" size="60" name="endereco" />
                                </p>







                                <p>
                                    <label for="site">Site:</label><br />
                                    <input type="text" size="60" name="site" />
                                </p>


                                <p>
                                    <label for="evento">Nome do evento:<strong> &nbsp;*</strong></label><br />
                                    <input type="text" size="60" name="evento" />
                                </p>






                                <p>
                                    <label for="instituicao_parceira">Institui&ccedil;&otilde;es/organiza&ccedil;&otilde;es/empresas parceiras:</label><br />
                                    <input type="text" size="60" name="instituicao_parceira" />
                                </p>











                                <p>
                                    <label for="local_evento">Local do evento:<strong> &nbsp;*</strong></label><br />
                                    <input type="text" size="60" name="local_evento" />
                                </p>



                            </div>




                            <div class="col2-fields">


                                <p>
                                    <label for="telefone">Telefone:<strong>&nbsp;*</strong></label><br />
                                    <input type="text" name="telefone" id="t1" maxlength="14" onkeypress="MaskDown(this)" onkeyup="MaskUp(this,event,'(##) ####-####')">
                                </p>


                                <p>
                                    <label for="email">E-mail:<strong> &nbsp;*</strong></label><br />
                                    <input type="text" size="60" name="email" />
                                </p>


                                <p>
                                    <label for="responsavel_evento">Respons&aacute;vel pelo evento:<strong> &nbsp;*</strong></label><br />
                                    <input type="text" size="60" name="responsavel_evento" />
                                </p>                           


                                <p>
                                    <label for="contato_responsavel_evento">Contato do respons&aacute;vel pelo evento:<strong> &nbsp;*</strong></label><br />
                                    <input type="text" size="60" name="contato_responsavel_evento" />
                                </p>                           


                                <p>
                                    <label for="hora_evento">Hora do evento:<strong> &nbsp;*</strong></label><br />
                                    <input type="text" name="hora_evento" onkeypress="mascara_hora(this.value)" maxlength="5"/>
                                </p>                           


                            </div>                            



                            <div style="clear:both;"></div>



                            <p>
                                <label for="data_evento">Data do evento:<strong> &nbsp;*</strong></label><br />

                                    <!-- <input type="text" name="data_evento" id="date1" maxlength="10" class="date-pick"/> -->

                                <textarea style="width:200px !important" cols="25" rows="10" id="datelist" name="data_evento" ></textarea>

                                <IMG SRC="<?php bloginfo("template_url"); ?>/imagens/site/cal.jpg" USEMAP="#MyMap" ALT="" BORDER="0">
                                <MAP NAME="MyMap">
                                    <AREA SHAPE=RECT COORDS="53,54,74,72" HREF="http://" ALT="" OnClick="addMsg('01/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="77,54,98,71" HREF="http://" ALT="" OnClick="addMsg('02/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="101,54,121,71" HREF="http://" ALT="" OnClick="addMsg('03/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="124,55,146,72" HREF="http://" ALT="" OnClick="addMsg('04/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="148,53,169,72" HREF="http://" ALT="" OnClick="addMsg('05/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="5,73,27,91" HREF="http://" ALT="" OnClick="addMsg('06/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="29,74,49,91" HREF="http://" ALT="" OnClick="addMsg('07/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="54,74,73,91" HREF="http://" ALT="" OnClick="addMsg('08/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="76,74,96,91" HREF="http://" ALT="" OnClick="addMsg('09/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="101,75,123,91" HREF="http://" ALT="" OnClick="addMsg('10/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="126,75,146,90" HREF="http://" ALT="" OnClick="addMsg('11/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="149,75,170,90" HREF="http://" ALT="" OnClick="addMsg('12/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="6,94,25,110" HREF="http://" ALT="" OnClick="addMsg('13/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="29,95,49,110" HREF="http://" ALT="" OnClick="addMsg('14/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="53,94,72,111" HREF="http://" ALT="" OnClick="addMsg('15/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="76,94,98,111" HREF="http://" ALT="" OnClick="addMsg('16/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="103,95,120,111" HREF="http://" ALT="" OnClick="addMsg('17/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="126,94,145,111" HREF="http://" ALT="" OnClick="addMsg('18/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="148,93,169,111" HREF="http://" ALT="" OnClick="addMsg('19/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="7,114,25,131" HREF="http://" ALT="" OnClick="addMsg('20/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="29,114,50,132" HREF="http://" ALT="" OnClick="addMsg('21/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="54,114,73,130" HREF="http://" ALT="" OnClick="addMsg('22/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="78,115,99,130" HREF="http://" ALT="" OnClick="addMsg('23/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="102,114,122,131" HREF="http://" ALT="" OnClick="addMsg('24/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="125,113,146,132" HREF="http://" ALT="" OnClick="addMsg('25/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="149,114,170,130" HREF="http://" ALT="" OnClick="addMsg('26/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="4,133,27,151" HREF="http://" ALT="" OnClick="addMsg('27/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="30,134,50,150" HREF="http://" ALT="" OnClick="addMsg('28/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="53,134,73,151" HREF="http://" ALT="" OnClick="addMsg('29/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="77,136,98,152" HREF="http://" ALT="" OnClick="addMsg('30/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                    <AREA SHAPE=RECT COORDS="101,133,123,153" HREF="http://" ALT="" OnClick="addMsg('31/08/2012','datelist'); return false;" OnMouseDown="" OnMouseUp="">
                                </MAP>

                            </p>                        


                            <div class="col3-fields">


                                <p>
                                    <label for="como_chegar">Como chegar:</label><br />
                                    <textarea cols="45" rows="5" name="como_chegar"></textarea><br />
                                </p>



                                <p>
                                    <label for="descricao_evento">Descri&ccedil;&atilde;o do evento:<strong> &nbsp;*</strong></label><br />
                                    <textarea cols="45" rows="5" name="descricao_evento"></textarea><br />
                                </p>


                                <p>
                                    <label for="publico">Caracteriza&ccedil;&atilde;o do p&uacute;blico alvo:</label><br />
                                    <textarea cols="45" rows="5" name="publico"></textarea><br />
                                </p>

                            </div>

                            <p>
                                <label for="fotografia">Fotografia: <span class="observacao">(Formatos aceitos: jpg. Tamanho m&aacute;ximo: 2MB)</span></label>
                                <!-- <input type="file" name="foto" id="foto"/> -->



                            <div id="div-input-file">
                                <input name="file-o" onchange="document.getElementById('file-f').value = this.value;" type="file" size="30" id="file-o"/>
                                <div id="div-input-f"><input name="file-f" type="text" id="file-f" /></div>
                            </div>                             


                            </p>


                            <p>
                                <label for="legenda">Legenda da foto:</label><br />
                                <input cols="45" rows="5" name="legenda" /><br />
                            </p>


                            <p>
                                <label for="creditos">Cr&eacute;ditos da foto:<strong> &nbsp;*</strong></label><br />
                                <input cols="45" rows="5" name="creditos" /><br />
                            </p>





                            <p>
                                <input type="submit" value="Enviar" name="submit" class="botao"/>
                            </p>



                        </div>
                    </form>   

                </div>











            <?php endwhile; ?>
        <?php else : ?>
            <h2>Nada encontrado</h2>
        <?php endif; ?>            





    </div>



</div>


<?php get_footer(); ?>
