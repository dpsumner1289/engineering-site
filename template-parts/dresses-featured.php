<?php
/* 
## Template part for displaying featured dresses via AJAX
**/
?>
<div class="flex row dress-list featured">
<h1 class="leftgray">our freshest styles</h1>
		<div class="posts-list"></div>
</div>
<script>
    jQuery(document).ready(function($){
        // trigger on page load
        var datainit = {
            action : 'dress_type_filter',
            <?php if(is_page_template('templates/dresses.php')): ?>
            choices : {special_category: ["281"]},
            postsnum : 4
            <?php endif; ?>
        };
        $.post("<?php echo admin_url('admin-ajax.php'); ?>", datainit, function(response){
            $('.posts-list').html(response);
        });
        // set cookies for search results
        function makeCookies(action, choices, keywords, postsnum) {
            Cookies.set('action', action, {expires : 1});
            Cookies.set('choices', choices, {expires : 1})
            Cookies.set('keywords', keywords, {expires : 1});
            Cookies.set('postsnum', postsnum, {expires : 1});
        }
        // move filter bar to sidebar position
        function changeLayout() {
            $('.template-dress').removeClass('container-md').addClass('container-md-lg-1');
            $('.dress-list.featured').addClass('item_4_5');
            $('.dress-sidebar').addClass('item_1_5');
            $('.dress-sidebar .wrapper').removeClass('row').addClass('item_1_5 col');
            $('.dress-sidebar .wrapper .item_1_4').removeClass('item_1_4');
            $('.opening_welcome').remove();
            $('h1.leftgray').remove();

            searched = true;
        }
        // get cookies for AJAX call
        function getCookies() {
            var action = Cookies.get('action');
            var choices = Cookies.getJSON('choices');
            var keywords = Cookies.get('keywords');
            var postsnum = Cookies.get('postsnum');
            var ajaxsearch = {
                action : action,
                page : $(this).data('page'),
                choices: choices,
                keywords : keywords,
                postsnum : postsnum
            };
            if(action){
                changeLayout();
            }
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", ajaxsearch, function(response){
                $('.posts-list').html(response);
                Cookies.remove('action');
                Cookies.remove('choices');
                Cookies.remove('keywords');
                Cookies.remove('postsnum');
            });
        }
        // set the loading message
        function state_change(){
            var loading = '<p class="loading"><i class="fas fa-spinner fa-pulse"></i> Loading</p>';
            $('.posts-list').html(loading);	
        }
        var searched = false;
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
        // if there are cookies, get them!
        getCookies();
        // search form
            // do the search/filter
        $(document).on('click', '.dress-search', function(e){
            e.preventDefault();
            if(searched === false) {
                changeLayout();
            }
            var choices = {};
            $('input[type=checkbox]:checked').each(function() {
                if (!choices.hasOwnProperty(this.name)) {
                    choices[this.name] = [this.value];
                } else {
                    choices[this.name].push(this.value);
                }
            });
            var dtype = [],
                datasearch = {
                    action : 'dress_search',
                    page : $(this).data('page'),
                    choices: choices,
                    keywords : $('.keywords').val(),
                    postsnum : 12
                }
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", datasearch, function(response){
                $('.posts-list').html(response);
                $('html, body').animate({scrollTop: $(".filter-bar").offset().top - 100}, 500);
            });
            makeCookies('dress_search', choices, $('.keywords').val(), 12);
        });
        // selecting options
        $(document).on('click', 'input.br', function(e){
            if(searched === true) {
                console.log(searched);
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
                    $('html, body').animate({scrollTop: $(".filter-bar").offset().top - 100}, 500);
                });
                makeCookies('dress_search', choices, $('.keywords').val(), 12);
            }
        });
    });	
</script>

<?php 