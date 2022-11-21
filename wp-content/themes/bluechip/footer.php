<?php
/**
 * The template for displaying the footer.
 *
 * @package bluechip
 */

?>  
            </div>
            <footer class="footer" role="contentinfo">
                <?php
                /**
                 * Functions hooked in to bluechip_footer action.
                 *
                 * @hooked bluechip_template_footer_widgets -10 
                 * @hooked bluechip_template_copyright -15
                 */ 
                    do_action('bluechip_footer'); 
                ?>
            </footer>

        <?php wp_footer(); ?>
    </body>

</html>