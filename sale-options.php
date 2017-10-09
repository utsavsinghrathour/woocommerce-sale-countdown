<?php

function sale_counter_add_theme_menu_item() {
    add_submenu_page('woocommerce', 'Sale Counter', 'Sale Counter ', 'manage_options', 'theme-panel', 'sale_counter_setting_page');
}

add_action('admin_menu', 'sale_counter_add_theme_menu_item');

function sale_counter_admin_script()
{
    wp_register_style( 'sale_counter_admin_css', plugins_url( '/assets/css/sale-counter-admin.css', __FILE__ ) );
    wp_enqueue_style( 'sale_counter_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'sale_counter_admin_script' );

function sale_counter_setting_page() {
    ?>
    <div class="sale-counter-wrap">
        <h1 class="sale-counter-title"><a href="#"><img src="<?php echo plugins_url( '/assets/img/codetheme-symbol.svg', __FILE__ );?>"></a><?php esc_html_e("Sale Counter",'sale-counter'); ?></h1>
        <form method="post" action="options.php" class="admin-settings-form">
            <?php
            settings_fields('section');
            do_settings_sections('sale-counter-options');
            submit_button();
            ?>
        </form>
    </div>
    <div class="company-handler">
        <h4>Powered by <a href="https://codethemes.co" target="_blank">codethemes.co</a></h4>
    </div>
    <?php
}


function sale_counter_display_logo_url() {
    ?>
    <input type="text" name="notice_url" id="notice_url" value="<?php if(isset($_POST['notice_url'])) {echo sale_counter_clean_data($_POST['notice_url']); } ?>" />

    <?php

}

function sale_counter_display_date_element() {
    ?>
    <span>
        <input name="main_name" type="radio" value="date" <?php checked('date', esc_html__(get_option('main_name'),'sale-counter')); ?> /><?php  esc_html_e('Date','sale-counter') ?>
    </span>
    <span>
        <input name="main_name" type="radio" value="time" <?php checked('time', esc_html__(get_option('main_name'),'sale-counter')); ?> /><?php  esc_html_e('Time','sale-counter') ?>
    </span>
    <?php
}

function sale_counter_display_panel_fields() {

    add_settings_section('section', esc_html__('All Setting','sale-counter'), null, 'sale-counter-options');

    add_settings_field('notice_url', esc_html__('Small Note','sale-counter'), 'sale_counter_display_logo_url', 'sale-counter-options', 'section');

    add_settings_field('main_name', esc_html__('Choose any one','sale-counter'), 'sale_counter_display_date_element', 'sale-counter-options', 'section');



    register_setting('section', 'notice_url');
    register_setting('section', 'main_name');
}

add_action('admin_init', 'sale_counter_display_panel_fields');
?>