<div class="vehicles">
	<?php if(has_post_thumbnail()) {  ?>
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'vehicle-thumb' ); ?></a>
	<?php } ?>
	<div class="vehicle-content">
		<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
	</div>
	<table class="table table-striped table-bordered">
	<thead><th>Information</th><th>Values</th></thead>
	<?php 
	$meta = get_post_meta( get_the_ID() ); 
	$exclude = array('_edit_last', '_wp_page_template', '_edit_lock', '_wp_old_slug', '_thumbnail_id','vehicle_price');
	foreach( $meta as $key => $value ) {
		if( in_array( $key, $exclude) )
			continue;
		?>
		<tr>
			<td><?php echo ucwords(str_replace('_', ' ', $key)); ?></td>
			<td><?php echo $value[0]; ?></td>
		</tr>
		<?php
	}
	?>
	</table>    
	<h3>Description</h3>
	<p><?php the_content(); ?></p>
	<p class="blog-post-meta">Posted on <?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
</div>