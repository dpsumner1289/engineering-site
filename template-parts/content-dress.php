<?php
/**
 * Template part for displaying dresses
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package caelynx
 */
// native meta
$budgets = get_the_terms( get_the_ID(), 'budget' );
$budget = join(', ', wp_list_pluck($budgets, 'name'));
$types = get_the_terms( get_the_ID(), 'type' );
$type = join(', ', wp_list_pluck($types, 'name'));
$dtypes = get_the_terms( get_the_ID(), 'dress_type' );
$dtype = join(', ', wp_list_pluck($dtypes, 'name'));
$designers = get_the_terms(get_the_ID(), 'designers');
$title = get_the_title();
$dress_types = get_the_terms(get_the_ID(), 'dress_type');
$shname = join(', ', wp_list_pluck($dress_types, 'name'));
$fabrics = get_the_terms(get_the_ID(), 'fabric');
$fabric = join(', ', wp_list_pluck($fabrics, 'name'));
// // custom fields
$try_it = get_field('try_it');
$buy_it = get_field('buy_it');
$book_appt = get_field('book_appt');
?>
<section class="flex row">
<div class="item_1_2 dress-image">
<?php get_the_post_thumbnail(get_the_ID()); ?>
</div><!-- /.item_1_2 -->
<div class="item_1_2">
    <h1><?php echo $title; ?></h1>
    <div class="dress_meta flex col">
        <aside class="flex vc hc price"><div class="item_1_4">PRICE</div><div class="item_3_4"><?php echo $budget; ?></div></aside>
        <aside class="flex vc hc designer"><div class="item_1_4">DESIGNER</div>
        <div class="item_3_4 flex vc">
            <?php 
            foreach($designers as $designer){
                $dimage = get_field('image', 'designers_' . $designer->term_id);
                echo '<img src="'.$dimage['url'].'" />';
            }
            ?>
        </div>
    </aside>
        <aside class="flex vc hc material"><div class="item_1_4">MATERIAL</div><div class="item_3_4"><?php echo $fabric; ?></div></aside>
        <aside class="flex vc hc shape">
            <div class="item_1_4">SHAPE</div>
            <div class="item_3_4">
            <?php 
            foreach($dress_types as $dress_type){
                $drimage = get_field('image', 'dress_type_' . $dress_type->term_id);
                if(!empty($drimage['url'])) {
                    echo '<img src="'.$drimage['url'].'" />';
                }
            }
            ?>    
            <span style="display:block;text-transform:uppercase;font-weight:lighter;color:rgb(165, 165, 165);"><?php echo $shname; ?></span></aside>
        <div class="flex row buttons">
            <div class="item_1_2"><?php if(!empty($try_it)){echo '<a href="'.$try_it.'" class="button pink">TRY IT</a>';} ?></div>
            <div class="item_1_2"><?php if(!empty($buy_it)){echo '<a href="'.$buy_it.'" class="button pink">BUY IT</a>';} ?></div>
        </div>
        <?php if(!empty($book_appt)): ?><div class="flex row"><a href="<?php echo $book_appt['url']; ?>" style="text-decoration:none;"><i class="fas fa-calendar-check"></i> <?php echo $book_appt['label']; ?></a></div><?php endif; ?>
    </div><!-- /.dress_meta -->
    <div class="flex row vc social-share">
        <div class="item_1_4">SHARE IT</div>
        <div class="item_3_4">
        <?php 
        // social sharing
        if(function_exists('social_warfare')):
            social_warfare();
        endif;
        // sidebar menu
        ?>
        </div><!-- /.social-share -->
    </div>
    <div class="dress-sidebar">
    <?php
    dynamic_sidebar( 'sidebar-dress-listings' );
    ?>
    </div><!-- /.dress-sidebar -->
</div><!-- /.item_1_2 -->
<?php
if( wp_get_referer() ):
    echo '<a href="'.wp_get_referer().'" class="back-dresses">Back to Dresses</a>';
else:
    echo '<a href="/our-dresses/" class="back-dresses">Back to Dresses</a>';
endif;
?>
</section> <!-- /.flex.row -->
<section class="suggestions">
    <h2>we thought you might like these too...</h2>
    <div class="flex row vc">
    <?php
    $dax_query = array(
        'relation' => 'OR',
        array( 'taxonomy' => 'budget', 'terms' => $budget),
        array( 'taxonomy' => 'type', 'terms' => $type),
        array( 'taxonomy' => 'dress_type', 'terms' => $dtype),
    );
    $dargs = array(
        'post_type'=>'dress',
        'post_status' => 'publish',
        'tax_query'=>$dax_query,
        'posts_per_page' => 4
    );
    $suggestions = new WP_Query($dargs);

    if($suggestions->found_posts): 
        foreach($suggestions->posts as $suggestion):
            $image = get_the_post_thumbnail( $suggestion->ID, 'medium-thumb');
    ?>
        <aside class="item_1_4">
            <?php echo $image; ?>
        </aside>
    <?php
        endforeach;
    endif;
    ?>
    </div>
</section><!-- /.suggestions -->