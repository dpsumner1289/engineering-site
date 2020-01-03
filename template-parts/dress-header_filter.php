<?php
/**
 * The template for displaying a horizontal dress filter bar
 */
?>
<div class="wrapper flex row">
	<?php 
	// check for category to preselect
	$category = gpm('budget');
	$start_cat = false;
	if(isset($category[0])){$start_cat = $category[0];}
	$dress_types = get_terms(array('taxonomy' => array('dress_type'), 'hide_empty' => false,));
	$i = 1;
	?>
	<div class="item_1_4">
		<h3>Silhouette</h3>
		<ul class="filter-list dress_types">
			<?php foreach($dress_types as $cat) : ?>
				<li class="filter-category" data-id="<?php echo $cat->term_id; ?>"><input type="checkbox" data-twd-tax="dress_type" name="dress_type" value="<?php echo $cat->term_id; ?>" id="dress_type-<?php echo $i; ?>" class="br"><label for="dress_type-<?php echo $i; ?>"><?php echo $cat->name; ?></label></li>
			<?php
			$i++;
			endforeach;
			?>
		</ul>
	</div>

	<?php 
    $budgets = get_terms(array('taxonomy' => array('budget'), 'hide_empty' => false,));
    $i = 1;
    $info = get_field('budget_information');
    ?>
	<div class="item_1_4">
	<h3>Price <?php if(!empty($info)){?><i class="fas fa-info-circle"><div class="tooltip"><?php echo $info; ?></div></i><?php } ?></h3>
		<ul class="filter-list budgets">
			<?php foreach($budgets as $cat) : ?>
				<li class="filter-category" data-id="<?php echo $cat->term_id; ?>"><input type="checkbox" data-twd-tax="budget" name="budget" value="<?php echo $cat->term_id; ?>" id="budget-<?php echo $i; ?>" class="br"><label for="budget-<?php echo $i; ?>"><?php echo $cat->name; ?></label></li>
			<?php
			$i++;
			endforeach;
			?>
		</ul>
	</div>
	
	<?php 
	$fabrics = get_terms(array('taxonomy' => array('fabric'), 'hide_empty' => false,));
	$i = 1;
	?>
	<div class="item_1_4">
		<h3>Fabric</h3>
		<ul class="filter-list fabric">
			<?php foreach($fabrics as $cat) : ?>
				<li class="filter-category" data-id="<?php echo $cat->term_id; ?>"><input type="checkbox" data-twd-tax="fabric" name="fabric" value="<?php echo $cat->term_id; ?>" id="fabric-<?php echo $i; ?>" class="br"><label for="fabric-<?php echo $i; ?>"><?php echo $cat->name; ?></label></li>
			<?php
			$i++;
			endforeach;
			?>
		</ul>
	</div>

	<div class="item_1_4">
	<form action="" class="search-form">
		<input class="keywords" type="text" placeholder="Search by Name" />
		<button class="dress-search">SEARCH DRESSES</button>
	</form>
	</div>
</div>