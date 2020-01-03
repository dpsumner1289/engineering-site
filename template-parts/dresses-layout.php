<?php
/* 
## Template part for displaying filtered dresses via AJAX
**/
?>
<?php if(is_page_template('templates/dresses.php')): echo '<div class="flex row dress-list">'; else: echo '<div class="item_4_5 dress-list">';  endif; ?>
		<div class="posts-list"></div>
</div>
<script>
    jQuery(document).ready(function($){
        
        // set the loading message
        function state_change(){
            var loading = '<p class="loading"><i class="fas fa-spinner fa-pulse"></i> Loading</p>';
            $('.posts-list').html(loading);	
        }	
        $('input.br').click(function(){
            state_change();
            var choices = {};

            $('.posts-list').empty();

            $('input[type=checkbox]:checked').each(function() {
                if (!choices.hasOwnProperty(this.name)) {
                    choices[this.name] = [this.value];
                } else {
                    choices[this.name].push(this.value);
                }
            });
            var data = {
                action : 'dress_type_filter',
                choices : choices,
                postsnum : 12
            };
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response){
                $('.posts-list').html(response);
            });
        });

        // paginate
        $(document).on('click', '.pagination a', function(e){
            state_change();
            e.preventDefault();
            var data = {
                action : 'dress_type_filter',
                page : $(this).data('page'),
                postsnum : 12
            }
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response){
                $('.posts-list').html(response);
                $('html, body').animate({scrollTop: $(".filter-bar").offset().top - 100}, 500);
            });
        });

        // trigger on page load
        var datainit = {
            action : 'dress_type_filter',
            postsnum : 12
        };
        $.post("<?php echo admin_url('admin-ajax.php'); ?>", datainit, function(response){
            $('.posts-list').html(response);
        });

        // search form
        // prevent from actually submitting
        $('.search-form').submit(function(e){
            e.preventDefault();
        });

        // do the search/filter
        $(document).on('click', '.dress-search', function(e){
            e.preventDefault();
            var datasearch = {
                action : 'dress_search',
                page : $(this).data('page'),
                keywords : $('.keywords').val(),
                postsnum : 12
            }
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", datasearch, function(response){
                $('.posts-list').html(response);
            });
        });
    });	
</script>

<?php 