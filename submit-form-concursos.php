<?php

	foreach ($_SESSION['categorias'] as $categoria) {
	    if( $categoria->term_id == $_SESSION['categoria'] ) {
	        $idade = $categoria->description; 
	        $categoria_nome = $categoria->name;
	        $categoria_slug = $categoria->slug;
	    }
	}

	foreach ($_SESSION['modalidades'] as $modalidade) {
	    if( $modalidade->term_id == $_SESSION['modalidade'] ) {
	        $modalidade_nome = $modalidade->name;
	        $modalidade_slug = $modalidade->slug;
	    }
	}

	if( $categoria_nome == 'Adulto' ) {

		// Dados do Autor
		$nome 			= $_SESSION['adulto_nome'];

		$nascimento 	= str_replace( '/', '-', $_SESSION['adulto_nascimento'] );
        $nascimento 	= strtotime( $nascimento . 'T00:00' );

		$naturalidade 	= $_SESSION['adulto_naturalidade'];
		$sexo 			= $_SESSION['adulto_sexo'];
		$endereço 		= $_SESSION['adulto_endereco'];
		$bairro 		= $_SESSION['adulto_bairro'];
		$cidade 		= $_SESSION['adulto_cidade'];
		$uf 			= $_SESSION['adulto_uf'];
		$cep 			= $_SESSION['adulto_cep'];
		$telefone 		= $_SESSION['adulto_telefone'];
		$celular 		= $_SESSION['adulto_celular'];
		$cpf 			= $_SESSION['adulto_cpf'];
		$rg 			= $_SESSION['adulto_rg'];
		$expedidor 		= $_SESSION['adulto_expedidor'];
		$email 			= $_SESSION['adulto_email'];

	} else {

		// Dados do Autor
		$nome 			= $_SESSION['juvenil_nome'];

		$nascimento 	= str_replace( '/', '-', $_SESSION['juvenil_nascimento'] );
        $nascimento 	= strtotime( $nascimento . 'T00:00' );

		$naturalidade 	= $_SESSION['juvenil_naturalidade'];
		$sexo 			= $_SESSION['juvenil_sexo'];
		$endereço 		= $_SESSION['juvenil_endereco'];
		$bairro 		= $_SESSION['juvenil_bairro'];
		$cidade 		= $_SESSION['juvenil_cidade'];
		$uf 			= $_SESSION['juvenil_uf'];
		$cep 			= $_SESSION['juvenil_cep'];
		$telefone 		= $_SESSION['juvenil_telefone'];
		$celular 		= $_SESSION['juvenil_celular'];
		$email 			= $_SESSION['juvenil_email'];

		// Dados do Responsavel
		$nome_resp 		= $_SESSION['juvenil_responsavel'];
		$email_resp 	= $_SESSION['juvenil_email_responsavel'];
		$parentesco		= $_SESSION['juvenil_parentesco'];
		$cpf 			= $_SESSION['juvenil_cpf'];
		$rg 			= $_SESSION['juvenil_rg'];
		$expedidor 		= $_SESSION['juvenil_expedidor'];

		// Dados Educacionais
		$inst_nome		= $_SESSION['juvenil_instituicao'];
		$inst_tipo 		= $_SESSION['juvenil_tipo_instituicao'];
		$inst_curso		= $_SESSION['juvenil_curso'];
		$inst_nivel 	= $_SESSION['juvenil_nivel'];
		$inst_cidade	= $_SESSION['instituicao_cidade'];
		$inst_uf		= $_SESSION['instituicao_uf'];

	}
	$referencia 	= ( $_SESSION['referencia'][0] != 'Outro' ) ? $_SESSION['referencia'][0] : $_SESSION['referencia'][1];

	if( $modalidade_slug == 'fotografias' ) {

		// Dados da Fotografia
		$post_title 	= wp_strip_all_tags( $_POST['foto_titulo'] );
		$post_content 	= '';
		$foto_local 	= $_POST['foto_local'];

		$foto_data 	= str_replace( '/', '-', $_POST['foto_data'] );
        $foto_data 	= strtotime( $foto_data . 'T00:00' );

		$foto_imagem 	= $_FILES['foto_anexo']['tmp_name'];
		$foto_nome 		= $_FILES['foto_anexo']['name'];

	} else {

		// Dados da Poesia
		$post_title 	= $_POST['poesia_titulo'];
		$post_content 	= $_POST['poesia_conteudo'];
		$poesia_tipo 	= $_POST['poesia_tipo'];

	}

	if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {

		// ADD THE FORM INPUT TO $new_post ARRAY
	    $new_post = array(
	        'post_title'    =>  $post_title,
	        'post_content'	=> 	$post_content,
	        'post_status'   =>  'pending', // Should be sent to review before publish
	        'post_type'     =>  $modalidade_slug,  // fotografias ou poesias
	    );

	    $cat_categorias    = get_term_by( 'slug', 'categorias', 'category' );
		$cat_modalidades   = get_term_by( 'slug', 'modalidades', 'category' );
		$cat_temas         = get_term_by( 'slug', 'temas', 'category' );
		$cat_trova         = get_term_by( 'slug', 'trova', 'category' );

	    $categories = array(
	    	$cat_categorias->term_id,
	    	$cat_modalidades->term_id,
			$cat_temas->term_id,	    	
	    	$_SESSION['categoria'],
	    	$_SESSION['modalidade'],
			$_SESSION['tema']	    	
	    );

		// Se for Trova, adiciona a respectiva categoria à poesia
	    if( isset( $poesia_tipo ) && $poesia_tipo == $cat_trova->term_id ) {
	    	array_push( $categories , $poesia_tipo);
	    }

	    // SAVE THE POST
	    $pid = wp_insert_post($new_post);

	    if( isset( $pid ) && $pid > 0 ) {

	        // Set Post Categories
	        if( isset( $categories ) && count( $categories ) > 0 )
	            wp_set_post_categories($pid, $categories);

			// Dados do Autor
			add_post_meta( $pid, 'wpcf-nome',						$nome, true );
			add_post_meta( $pid, 'wpcf-data-nascimento',			$nascimento, true );
			add_post_meta( $pid, 'wpcf-naturalidae',				$naturalidade, true );
			add_post_meta( $pid, 'wpcf-sexo',						$sexo, true );
			add_post_meta( $pid, 'wpcf-endereco',					$endereço, true );
			add_post_meta( $pid, 'wpcf-bairro',						$bairro, true );
			add_post_meta( $pid, 'wpcf-cidade',						$cidade, true );
			add_post_meta( $pid, 'wpcf-estado',						$uf, true );
			add_post_meta( $pid, 'wpcf-cep',						$cep, true );
			add_post_meta( $pid, 'wpcf-telefone',					$telefone, true );
			add_post_meta( $pid, 'wpcf-celular',					$celular, true );
			add_post_meta( $pid, 'wpcf-email',						$email, true );

			if( $categoria_nome == 'Adulto' ) {

				add_post_meta( $pid, 'wpcf-cpf',					$cpf, true );
				add_post_meta( $pid, 'wpcf-rg',						$rg, true );
				add_post_meta( $pid, 'wpcf-orgao',					$expedidor, true );

			}

			if( isset( $nome_resp ) && $nome_resp != '' ) {

				// Dados do Responsavel
				add_post_meta( $pid, 'wpcf-responsavel-nome',		$nome_resp, true );
				add_post_meta( $pid, 'wpcf-responsavel-email',		$email_resp, true );
				add_post_meta( $pid, 'wpcf-responsavel-parentesco',	$parentesco, true );
				add_post_meta( $pid, 'wpcf-cpf',					$cpf, true );
				add_post_meta( $pid, 'wpcf-rg',						$rg, true );
				add_post_meta( $pid, 'wpcf-orgao',					$expedidor, true );

				// Dados Educacionais
				add_post_meta( $pid, 'wpcf-instituicao-nome',		$inst_nome, true );
				add_post_meta( $pid, 'wpcf-instituicao-tipo',		$inst_tipo, true );
				add_post_meta( $pid, 'wpcf-instituicao-curso',		$inst_curso, true );
				add_post_meta( $pid, 'wpcf-instituicao-nivel',		$inst_nivel, true );
				add_post_meta( $pid, 'wpcf-instituicao-cidade',		$inst_cidade, true );
				add_post_meta( $pid, 'wpcf-instituicao-estado',		$inst_uf, true );

			}

	        if( $modalidade_slug == 'fotografias' ) {

				// Dados da Fotografia
				add_post_meta( $pid, 'wpcf-concurso-foto-local',	$foto_local, true );
				add_post_meta( $pid, 'wpcf-concurso-foto-autor',	$nome, true );
				add_post_meta( $pid, 'wpcf-concurso-foto-data',		$foto_data, true );

	        }

	        // Handle Image Upload
	        if( isset( $foto_imagem ) && !empty( $foto_imagem ) ) {

	            $upload_dir = wp_upload_dir();

	            $upload_file = $upload_dir['path'] . '/' . basename( $foto_nome );

	            $copy_file = copy( $foto_imagem, $upload_file);

	            if( $copy_file ) {

	                $wp_filetype = wp_check_filetype( basename( $foto_nome ), null );

	                $attachment = array(
	                    'guid' => $upload_dir['url'] . '/' . basename( $foto_nome ), 
	                    'post_mime_type' => $wp_filetype['type'],
	                    'post_title' => preg_replace('/\.[^.]+$/', '', basename( $foto_nome ) ),
	                    'post_content' => '',
	                    'post_status' => 'inherit'
	                );

	                $attach_id = wp_insert_attachment( $attachment, $upload_file, $pid );

	                if( $attach_id > 0 ) {

		                // Set Featured Image
		                set_post_thumbnail( $pid, $attach_id );
		                
		                // you must first include the image.php file
		                // for the function wp_generate_attachment_metadata() to work
		                require_once(ABSPATH . 'wp-admin/includes/image.php');
		                
		                $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_file );
		                
		                wp_update_attachment_metadata( $attach_id, $attach_data );

		            }

	            }

	        }

	    ?>

<div id="content" class="confirmacao">

    <div class="dados-usuario">

        <div class="cadastro">

            <div class="titulo-categoria">

                <h2>Concurso Cultural</h2>
                <h3 class="categoria"><?php echo $modalidade_nome; ?> <?php echo $categoria_nome; ?> | <span><?php echo $idade; ?></span></h3>

            </div>



            <div class="confirmacao-inscricao">
                <strong>Envio feito com sucesso. Aguarde a confirmação da sua inscrição através de e-mail.</strong>
            </div>


            <div class="aviso">
                <p>Ser&atilde;o descartadas as obras que n&atilde;o se enquadrem nas modalidades e temas propostos neste edital;</p>
                <p>Consultas e confirma&ccedil;&atilde;o da inscri&ccedil;&atilde;o podem ser feitas pelo e-mail</p>
                <p><a href="mailto:olharespatrimonio@gmail.com" title="">olharespatrimonio@gmail.com</a></p>
            </div>


           


        </div>

        <div class="etapas">

            <div>
                <strong>Falta pouco, preencha para continuar</strong>
            </div>

            <ol>
                <li class="etapa1 completa1">Escolha a modalidade e a categoria</li>
                <li class="etapa2 completa2">Escolha o assunto</li>
                <li class="etapa3 completa3">Preencha seus dados</li>
                <li class="etapa4 completa4">Envie seu trabalho</li>
            </ol>

        </div>


    </div>

</div>

	    <?php

	    } // end if

	} // end if
?>