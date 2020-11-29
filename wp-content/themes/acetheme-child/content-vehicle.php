<div class="vehicles">
    <?php if(has_post_thumbnail()) {  ?>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'vehicle-thumb' ); ?></a>
    <?php } ?>
    <div class="vehicle-content">
        <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
        <?php
            $vehicle_number = get_post_meta( get_the_ID(), 'vehicle_number', true );  // or the_field('vehicle_number') if ACP installed
            $vehicle_owner_name = get_post_meta( get_the_ID(), 'vehicle_owner_name', true );
            $vehicle_price = get_post_meta( get_the_ID(), 'vehicle_price', true );
        ?>
        <h2><strong>Vehicle Number :</strong> <?php echo $vehicle_number; ?></h2>
        <h2><strong>Vehicle Owner name :</strong> <?php echo $vehicle_owner_name; ?></h2>
        <h2><strong>Vehicle Price :</strong> <?php echo $vehicle_price; ?></h2>
    </div>
    <h3>Description</h3>
    <p><?php the_excerpt(); ?></p>
</div>