<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package bluechip
 */
?>

<div class="col-md-4 sidebar-area">

    <?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

        <?php dynamic_sidebar( 'sidebar1' ); ?>

    <?php else : ?>

        <?php
            /*
             * This content shows up if there are no widgets defined in the backend.
            */
        ?>
        
        <div class="no-widgets">
            <p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'bluechip' );  ?></p>
        </div>

    <?php endif; ?>

</div>