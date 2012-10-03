<?php get_header(); ?>

<div class="container">

	<?php get_template_part( 'loop', 'index' ); ?>

	<div id="myCarousel" class="carousel slide" style="width:500px;">
	  <!-- Carousel items -->
	  <div class="carousel-inner">
	    <div class="active item">
	    	<img src="http://farm8.staticflickr.com/7145/6464988209_b02ca53047.jpg" width="500" height="500" alt="ad34">
	    </div>
	    <div class="item">
	    	<img src="http://farm8.staticflickr.com/7158/6464987939_4f7dfb2eb9.jpg" width="500" height="500" alt="ad33">
	    </div>
	    <div class="item">
				<img src="http://farm8.staticflickr.com/7145/6464988209_b02ca53047.jpg" width="500" height="500" alt="ad34">
			</div>
	  </div>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>

</div>

<?php get_footer(); ?>