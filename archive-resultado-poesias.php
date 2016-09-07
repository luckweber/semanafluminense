<?php 

/*
 * Template name: Resultado Poesias
 */

get_header("concursopoesia-resultado");

?>

<div id="content">
	<?php 
	/**
	 * Ano [Ultimo ano]
	 * - Categoria
	 * --- Tema
	 * ----- Juri
	 * ----- Voto Popular
	 * ----- Mença Honrosa
	 */
	
	// Breadcrumb
	get_template_part('acessibilidade');


	// Categorias
	$cat_adulto = get_category_by_slug( 'adulto-categorias' );
	$cat_juvenil = get_category_by_slug( 'infanto-juvenil' );

    // Modalidades / Tema
	$cat_tema_fragmentos = get_category_by_slug( 'fatos-e-feitos' );
	$cat_tema_memoria = get_category_by_slug( 'memoria-transformada' );
	$cat_tema_patrimonio = get_category_by_slug( 'o-patrimonio-da-regiao-da-costa-verde-fluminense' );

    // Votos - Juri
	$cat_juri = get_category_by_slug( 'juri' );

    // Votos - Voto Popular
	$cat_voto_popular = get_category_by_slug( 'voto-popular' );

    // Menção Honrosa
	$cat_mencao = get_category_by_slug( 'mencao-honrosa' );

	$array_place = array(
		'1' => '1º Lugar',
		'2' => '2º Lugar',
		'3' => '3º Lugar'
	);

	?>

	

	<?php

		$bloco_afj = bloco_poesia($cat_adulto,$cat_tema_fragmentos, $cat_juri);
		$bloco_afp = bloco_poesia($cat_adulto,$cat_tema_fragmentos, $cat_voto_popular);

		$bloco_amj = bloco_poesia($cat_adulto,$cat_tema_memoria, $cat_juri);
		$bloco_amp = bloco_poesia($cat_adulto,$cat_tema_memoria, $cat_voto_popular);

		$bloco_apj = bloco_poesia($cat_adulto,$cat_tema_patrimonio, $cat_juri);
		$bloco_app = bloco_poesia($cat_adulto,$cat_tema_patrimonio, $cat_voto_popular);
	?>


	<?php if($bloco_afj || $bloco_afp || $bloco_amj || $bloco_amp || $bloco_apj || $bloco_app):	?>

	<h1 class="category-title">Categoria: <span class="category-title-name"><?php echo $cat_adulto->cat_name ;?></span></h1>
	
		<?php if($bloco_afj || $bloco_afp):?>
			<h1 class="category-title no-border">Tema: <span class="category-title-name"><?php echo $cat_tema_fragmentos->cat_name ;?></span></h1>
			<?php
				echo $bloco_afj;
				echo $bloco_afp
			?>
		<?php endif;?>
	
		<?php if($bloco_amj || $bloco_amp):?>
			<h1 class="category-title no-border">Tema: <span class="category-title-name"><?php echo $cat_tema_memoria->cat_name ;?></span></h1>
			<?php
				echo $bloco_amj;
				echo $bloco_amp;
			?>
		<?php endif;?>

		<?php if($bloco_apj || $bloco_app): ?>
			<h1 class="category-title no-border">Tema: <span class="category-title-name"><?php echo $cat_tema_patrimonio->cat_name ;?></span></h1>
			<?php
				echo $bloco_apj;
				echo $bloco_app;
			?>
		<?php endif; ?>

	<?php endif; ?>


	<!-- Juvenil -->
	<?php 

		$bloco_jfj = bloco_poesia($cat_juvenil,$cat_tema_fragmentos, $cat_juri);
		$bloco_jfp = bloco_poesia($cat_juvenil,$cat_tema_fragmentos, $cat_voto_popular);

		$bloco_jmj = bloco_poesia($cat_juvenil,$cat_tema_memoria, $cat_juri);
		$bloco_jmp = bloco_poesia($cat_juvenil,$cat_tema_memoria, $cat_voto_popular);

		$bloco_jpj = bloco_poesia($cat_juvenil,$cat_tema_patrimonio, $cat_juri);
		$bloco_jpp = bloco_poesia($cat_juvenil,$cat_tema_patrimonio, $cat_voto_popular);
	?>


	<?php if($bloco_jfj || $bloco_jfp || $bloco_jmj || $bloco_jmp || $bloco_jpj || $bloco_jpp):?>
		<h1 class="category-title">Categoria: <span class="category-title-name"><?php echo $cat_juvenil->cat_name ;?></span></h1>
	
		<?php if($bloco_jfj || $bloco_jfp):?>
			<h1 class="category-title no-border">Tema: <span class="category-title-name"><?php echo $cat_tema_fragmentos->cat_name ;?></span></h1>
			<?php
				echo $bloco_jfj;
				echo $bloco_jfp;
			?>
		<?php endif; ?>

		<?php if($bloco_jmj || $bloco_jmp):?>
			<h1 class="category-title no-border">Tema: <span class="category-title-name"><?php echo $cat_tema_memoria->cat_name ;?></span></h1>
			<?php
				echo $bloco_jmj;
				echo $bloco_jmp;
			?>
		<?php endif; ?>

		<?php if($bloco_jpj || $bloco_jpp):?>
			<h1 class="category-title no-border">Tema: <span class="category-title-name"><?php echo $cat_tema_patrimonio->cat_name ;?></span></h1>
			<?php
				echo $bloco_jpj;
				echo $bloco_jpp;
			?>
		<?php endif; ?>
	<?php endif; ?>






<?php get_footer(); ?>