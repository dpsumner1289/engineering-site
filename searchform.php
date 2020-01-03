<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="visiblyhidden">Search</label>
    <style>
        .visiblyhidden {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
    </style>
    <input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" aria-label="Search" />
	<button type="submit" class="search-submit"><i class="fas fa-search"></i> Search</button>
</form>
<script>
    $ = jQuery;
    function searchForm(button) {
        var clicked = false;
        button.on('click', function(e){
            if(!clicked) {
                e.preventDefault();
                $('.search-field').animate({width: '+=57%', marginLeft: 0, paddingLeft: 5, paddingTop: 3}, 200);
                clicked = true;
            }
        });
    }
    $(document).ready(function(){
        searchForm($('.search-submit'));
    });
</script>