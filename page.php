<?php get_header(); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span12">
			
			<?php get_template_part( 'loop', 'page' ); ?>
			
			<p>
				<a href="#" class="btn large primary">Hello!</a>
				<a href="#" class="btn large">World.</a>
			</p>
				
		</div>
		
		<div class="span4">
			
			<h1>Sidebar</h1>
			
		</div>
		
	</div>
	
	
	
</div>

<?php get_footer(); ?>