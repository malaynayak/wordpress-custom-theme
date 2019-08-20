
<form role="search" method="get" id="searchform" class="searchform" action="http://localhost:8080/wordpress/">
    <div>
        <label class="screen-reader-text" for="s">Search for:</label>
        <input type="text" placeholder="Search..." value="<?php the_search_query() ?>" name="s" id="s">
        <input type="submit" id="searchsubmit" value="Search">
    </div>
</form>