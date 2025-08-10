<?php
/**
 * The footer for Auntie MAP Recovery Store theme
 *
 * @package AuntieMap
 * @since 1.0.0
 */
?>

    </main><!-- .site-content -->

    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section footer-about">
                    <h3><?php bloginfo('name'); ?></h3>
                    <p>
                        Supporting recovery journeys with meaningful merchandise and resources.
                        Every purchase helps fund recovery programs and support services for those in need.
                    </p>
                    <p><strong>Remember:</strong> Progress, not perfection. One day at a time. 💜</p>
                </div>

                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-section">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-section">
                        <h3><?php esc_html_e('Quick Links', 'auntie-map'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'auntie-map'); ?></a></li>
                            <?php if (class_exists('WooCommerce')) : ?>
                                                                                <?php endif; ?>
                            <li><a href="<?php echo esc_url(home_url('/recovery-stories')); ?>"><?php esc_html_e('Recovery Stories', 'auntie-map'); ?></a></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-section">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-section">
                        <h3><?php esc_html_e('Recovery Resources', 'auntie-map'); ?></h3>
                        <ul>
                            <li><a href="https://www.aa.org/find-aa" target="_blank" rel="noopener"><?php esc_html_e('Find AA Meetings', 'auntie-map'); ?></a></li>
                            <li><a href="https://www.na.org/meetingsearch/" target="_blank" rel="noopener"><?php esc_html_e('Find NA Meetings', 'auntie-map'); ?></a></li>
                            <li><a href="https://www.samhsa.gov/find-help/national-helpline" target="_blank" rel="noopener"><?php esc_html_e('SAMHSA Helpline', 'auntie-map'); ?></a></li>
                            <li><a href="tel:988"><?php esc_html_e('Crisis Support: 988', 'auntie-map'); ?></a></li>
                            <li><a href="https://www.suicidepreventionlifeline.org/" target="_blank" rel="noopener"><?php esc_html_e('Suicide Prevention', 'auntie-map'); ?></a></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-section">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-section">
                        <h3><?php esc_html_e('Support & Contact', 'auntie-map'); ?></h3>
                        <div class="contact-info">
                            <?php
                            $support_phone = get_theme_mod('auntie_map_support_phone', '');
                            if ($support_phone) :
                            ?>
                                <p><strong><?php esc_html_e('Support Line:', 'auntie-map'); ?></strong><br>
                                <a href="tel:<?php echo esc_attr($support_phone); ?>"><?php echo esc_html($support_phone); ?></a></p>
                            <?php endif; ?>

                            <p><strong><?php esc_html_e('Email:', 'auntie-map'); ?></strong><br>
                            <a href="mailto:support@auntiemap.com">support@auntiemap.com</a></p>

                            <?php
                            $meeting_finder = get_theme_mod('auntie_map_meeting_finder', '');
                            if ($meeting_finder) :
                            ?>
                                <p><a href="<?php echo esc_url($meeting_finder); ?>" target="_blank" rel="noopener" class="btn btn-secondary">
                                    <?php esc_html_e('Find Local Meetings', 'auntie-map'); ?>
                                </a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (has_nav_menu('footer')) : ?>
                <nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e('Footer Navigation', 'auntie-map'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                        'depth'          => 1,
                    ));
                    ?>
                </nav>
            <?php endif; ?>

            <div class="footer-bottom">
                <div class="recovery-disclaimer">
                    <p><em>
                        <?php esc_html_e('Auntie MAP is not affiliated with Alcoholics Anonymous. We support recovery through community and meaningful merchandise. If you are struggling with addiction, please seek professional help.', 'auntie-map'); ?>
                    </em></p>
                </div>

                <div class="copyright">
                    <p>
                        &copy; <?php echo date('Y'); ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                        <?php esc_html_e('All rights reserved.', 'auntie-map'); ?>
                        <?php esc_html_e('Made with', 'auntie-map'); ?> 💜
                        <?php esc_html_e('for the recovery community.', 'auntie-map'); ?>
                    </p>
                </div>

                <div class="daily-affirmation-footer">
                    <p><strong><?php esc_html_e('Today\'s Affirmation:', 'auntie-map'); ?></strong>
                    "<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Emergency Support Modal (hidden by default) -->
    <div id="emergency-support-modal" class="emergency-modal" style="display: none;">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h3><?php esc_html_e('Emergency Support Resources', 'auntie-map'); ?></h3>
            <div class="emergency-resources">
                <p><strong><?php esc_html_e('Crisis Support:', 'auntie-map'); ?></strong></p>
                <ul>
                    <li><a href="tel:988"><?php esc_html_e('988 - Suicide & Crisis Lifeline', 'auntie-map'); ?></a></li>
                    <li><a href="tel:1-800-662-4357"><?php esc_html_e('SAMHSA National Helpline: 1-800-662-4357', 'auntie-map'); ?></a></li>
                    <li><a href="sms:741741"><?php esc_html_e('Crisis Text Line: Text HOME to 741741', 'auntie-map'); ?></a></li>
                </ul>
                <p><em><?php esc_html_e('You are not alone. Help is available 24/7.', 'auntie-map'); ?></em></p>
            </div>
        </div>
    </div>

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navigation = document.querySelector('.main-navigation');

    if (mobileToggle && navigation) {
        mobileToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            navigation.classList.toggle('active');
        });
    }

    // Emergency support modal
    const modal = document.getElementById('emergency-support-modal');
    const closeModal = document.querySelector('.modal-close');

    // Show modal if user seems distressed (example: rapid clicking)
    let clickCount = 0;
    let clickTimer;

    document.addEventListener('click', function() {
        clickCount++;
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function() {
            if (clickCount > 10) {
                // Show support modal if user clicks rapidly (might indicate distress)
                if (modal) {
                    modal.style.display = 'block';
                }
            }
            clickCount = 0;
        }, 3000);
    });

    if (closeModal && modal) {
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }

    // Close modal if clicked outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>

</body>
</html>
