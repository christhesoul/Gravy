<?php /* Sidebar */ ?>

<form class="form-search" action="<?php echo home_url( '/' ); ?>">
  <div class="input-append">
    <input type="text" placeholder="Search" name="s" id="search" class="span2 search-query" value="<?php the_search_query(); ?>">
    <button type="submit" class="btn">Search</button>
  </div>
</form> 