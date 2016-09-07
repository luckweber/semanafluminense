<div class="menu-principal">

	<div class="menu-pages">
		<ul id="menu">
			<?php wp_nav_menu( array( 'depth' => '1', 'sort_column' => 'menu_order', 'container_class' => 'top-menu-class', 'menu' => 'Principal' ) ); ?>
		</ul>
    </div>
    <div class="menu-social">
    	<ul class="social-list">
			
			<li class="font-resize"><a href="#" class="js-increase-font" title="Aumentar a fonte">A+</a></li>
    		<li class="font-resize"><a href="#" class="js-regular-font" title="Voltar ao tamanho normal da fonte">A</a></li>
    		<li class="font-resize"><a href="#" class="js-decrease-font" title="Diminuir a fonte">A-</a></li>
    		<li class="social-item"><a href="<?php echo home_url( '/fale-conosco/' ); ?>" title="Entre em contato conosco"><span class="icon-social icon-email" >Contato</span></a></li>

    		<li class="social-item"><a href="http://www.facebook.com/SemanaFluminensedoPatrimonio" title="Curta nossa Página!" target="_blank"><span class="icon-social icon-facebook" >Facebook</span></a></li>
    	</ul>
    </div>

</div>
<div class="sub-menu-principal">
	<ul id="sub-menu">
		<?php 
			wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'submenu-menu-class', 'menu' => 'Principal', 'sub_menu' => true ) ); 
		?>
	</ul>
</div>