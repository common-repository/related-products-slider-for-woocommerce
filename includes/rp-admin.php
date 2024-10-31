<?php

if (!defined('ABSPATH')) exit;

add_filter('plugin_row_meta', 'rp_Register_Plugins_Links', 10, 2);

function rp_Register_Plugins_Links($links, $file)
{
    $base = RP_PLUGIN_SLUG;
    if ($file == $base) {
        $links[] = '<a href="https://codecanyon.net/user/wooteam/portfolio?ref=wooteam" target="_blank">More plugins by WooTeam</a>';
    }
    return $links;
}

add_filter('plugin_action_links_' . RP_PLUGIN_SLUG, 'rp_link_action_on_plugin');

function rp_link_action_on_plugin($links)
{
    return array_merge(array('settings' => '<a href="' . admin_url('admin.php?page='.RP_SLUG.'') . '">Settings</a>'), $links);
}

/***Add sub menu page***/

add_action('admin_menu', 'rp_add_menu_page');
function rp_add_menu_page()
{
    add_submenu_page('woocommerce', 'RP Related Products', 'RP Related Products', 'manage_options', RP_SLUG, 'rp_options');
}

function rp_options()
{
  global  $default_rp_number_related_products,
          $default_rp_columns_related_products,
          $default_rp_columns_desktop,
          $default_rp_columns_desktop_small,
          $default_rp_columns_tablet,
          $default_rp_columns_mobile,
          $default_rp_slider_auto_play,
          $default_rp_slider_auto_play_speed,
          $default_rp_slider_pagination,
          $default_rp_slider_navigation,
          $default_rp_slider_navigation_prev_text,
          $default_rp_slider_navigation_next_text,
          $default_rp_slider_paginationNumbers,
          $default_rp_slider_direction,
          $default_rp_ribbon_sale_text,
          $default_rp_show_thumb;

    //must check that the user has the required capability
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrapper">
        <h2>Related Products for WooCommerce</h2>

        <a href="https://codecanyon.net/item/related-products-slider-for-woocommerce/19423571?ref=wooteam">
        <img src="<?php echo RP_URL;  ?>/assets/images/banner-1.png"/>
      </a>
        <br/>
        <form name="rp_options" method="post" action="">
            <input type="hidden" name="send_form" value="Y">

            <ul class="rp-tabs">
              <li data-target="general-settings" class="active">
                <a href="javascript:void(0)">General settings</a>
              </li>
              <li data-target="slider-settings">
                <a href="javascript:void(0)">Slider Settings</a>
              </li>

            </ul>

            <div data-target="general-settings" class="rp-tab-content active">
              <table class="form-table">
                <tr>
                    <td class="label-column">Related Products Title</td>
                    <td>
                      <input name="rp_title" id="rp_title" type="text" placeholder='Related Products' value="<?php echo get_option('rp_title') ?>" class="regular-text" /><br />
                      <!-- <span class="description"> </span> -->
                      </td>
                </tr>
                <tr>
                    <td class="label-column">Show Type</td>
                    <td>
                      <select name="rp_show_type" class="rp_show_type">
                            <option value="slider" <?php selected(get_option('rp_show_type'), 'slider', true); ?>>Slider</option>
                            <!-- <option value="thumb" <?php selected(get_option('rp_show_type'), 'thumb', true); ?>>Thumbnails</option> -->

                        </select>
                      <span class="description">Select the show type of Related Products</span></td>
                </tr>
                  <tr >
                      <td class="label-column">Slider type</td>
                      <td>
                        <select name="rp_slider_type" class="rp_slider_type">
                             <option value="hover_theme_bottom" <?php selected(get_option('rp_slider_type'), 'hover_theme_bottom', true); ?>>Hover Effect from bottom (default)</option>


                              <option value="theme_basic" <?php selected(get_option('rp_slider_type'), 'theme_basic', true); ?>>Basic(without hover effect)</option>

                          </select>
                        <span class="description">Select the type of slider</span></td>
                  </tr>

                  <tr>
                      <td class="label-column">Number of related products</td>
                      <td>
                        <input name="rp_number_related_products" id="rp_number_related_products" type="number" value="<?php echo (strlen(get_option('rp_number_related_products'))>0?get_option('rp_number_related_products'):$default_rp_number_related_products) ?>" class="regular-text" /><br />

                           <!-- <span class="description"> </span> -->
                        </td>
                  </tr>
                  <tr>
                      <td class="label-column">Number of columns</td>
                      <td>
                        <input name="rp_number_related_products_columns" id="rp_number_related_products_columns" type="number" value="<?php echo (strlen(get_option('rp_number_related_products_columns'))>0?get_option('rp_number_related_products_columns'):$default_rp_columns_related_products) ?>" class="regular-text" /><br />

                           <!-- <span class="description"> </span> -->
                        </td>
                  </tr>
                  <tr>
                      <td class="label-column">Related products by </td>
                      <td>
                      <select name="rp_related_products_by">
                          <option value="product_cat" <?php selected(get_option('rp_related_products_by'), 'product_cat', true); ?>>Product Category</option>
                          <option value="product_type" <?php selected(get_option('rp_related_products_by'), 'product_type', true); ?>>Product Type</option>
                      </select>
                  </tr>




                </table>
            </div>
            <div data-target="slider-settings" class="rp-tab-content">
              <table class="form-table">

                <tr>
                    <td class="label-column">Auto Play </td>
                    <td>
                    <select name="rp_slider_auto_play" class="rp_slider_auto_play">
                        <option value="true" <?php selected(get_option('rp_slider_auto_play'), 'true', true); ?>>True</option>
                        <option value="false" <?php selected(get_option('rp_slider_auto_play'), 'false', true); ?>>False</option>
                    </select>
                </tr>

                <tr>
                    <td class="label-column">Slider navigation</td>
                    <td>
                    <select name="rp_slider_navigation">
                        <option value="true" <?php selected(get_option('rp_slider_navigation'), 'true', true); ?>>True</option>
                        <option value="false" <?php selected(get_option('rp_slider_navigation'), 'false', true); ?>>False</option>
                    </select>
                </tr>
                <tr>
                    <td class="label-column">Slider navigation position</td>
                    <td>
                    <select name="rp_slider_navigation_position">
                        <option value="nav_top_right" <?php selected(get_option('rp_slider_navigation_position'), 'nav_top_right', true); ?>>Top Right(default)</option>
                        <option value="nav_bottom_left" <?php selected(get_option('rp_slider_navigation_position'), 'nav_bottom_left', true); ?>>Bottom Left</option>
                        <option value="nav_bottom_center" <?php selected(get_option('rp_slider_navigation_position'), 'nav_bottom_center', true); ?>>Bottom Center</option>

                        <option value="nav_bottom_right" <?php selected(get_option('rp_slider_navigation_position'), 'nav_bottom_right', true); ?>>Bottom Right</option>

                    </select>
                </tr>
                <tr>
                    <td class="label-column">Slider pagination</td>
                    <td>
                    <select name="rp_slider_pagination" class="rp_slider_pagination">
                        <option value="true" <?php selected(get_option('rp_slider_pagination'), 'true', true); ?>>True</option>
                        <option value="false" <?php selected(get_option('rp_slider_pagination'), 'false', true); ?>>False</option>
                    </select>
                </tr>
                <tr>
                    <td class="label-column">Slider pagination number</td>
                    <td>
                    <select name="rp_slider_pagination_number" class="rp_slider_pagination_number">
                        <option value="true" <?php selected(get_option('rp_slider_pagination_number'), 'true', true); ?>>True</option>
                        <option value="false" <?php selected(get_option('rp_slider_pagination_number'), 'false', true); ?>>False</option>
                    </select>
                </tr>
                <tr>
                    <td class="label-column">Slider Navigation previous button text</td>
                    <td>
                      <input name="rp_slider_navigation_prev_text" id="rp_slider_navigation_prev_text"
                       type="text"
                        value="<?php echo (strlen(get_option('rp_slider_navigation_prev_text'))>0?get_option('rp_slider_navigation_prev_text'):$default_rp_slider_navigation_prev_text) ?>"
                       class="regular-text" /><br />

                         <!-- <span class="description"> </span> -->
                      </td>
                </tr>
                <tr>
                    <td class="label-column">Slider Navigation next button text</td>
                    <td>
                      <input name="rp_slider_navigation_next_text" id="rp_slider_navigation_next_text"
                       type="text"
                       value="<?php echo (strlen(get_option('rp_slider_navigation_next_text'))>0?get_option('rp_slider_navigation_next_text'):$default_rp_slider_navigation_next_text) ?>"

                       class="regular-text" /><br />

                         <!-- <span class="description"> </span> -->
                      </td>
                </tr>
                <tr>
                    <td class="label-column">Slider  Direction</td>
                    <td>
                    <select name="rp_slider_direction">
                        <option value="ltr" <?php selected(get_option('rp_slider_direction'), 'ltr', true); ?>>LTR</option>
                        <option value="rtl" <?php selected(get_option('rp_slider_direction'), 'rtl', true); ?>>RTL</option>
                    </select>
                </tr>
              </table>
            </div>

          <?php
                       if (isset($_POST['send_form']) && $_POST['send_form'] == 'Y') {
                           foreach ($_POST as $option_name => $option_value) {

                               // Save the posted value in the database
                               update_option($option_name, $option_value);
                           }
header("Refresh:0");
                           ?>
                           <div class="updated"><p><strong>Settings saved</strong></p></div>
                           <?php
                       }
     ?>
            <p class="submit">
                <input type="submit" name="submit" class="rp-submit" value="<?php esc_attr_e('Save Changes') ?>" />
            </p>

        </form>

    </div>
<style>
.wrapper{
  background-color: #fff;
  padding: 10px 25px;
}
</style>

<?php
}

/*** Add Color Picker ***/
add_action('admin_enqueue_scripts', 'rp_enqueue_color_picker');

function rp_enqueue_color_picker()
{
    wp_register_style('rp-admin', plugins_url('assets/css/rp-admin.css', RP_FILE));
    wp_register_script('rp-admin', plugins_url('assets/js/rp-admin.js', RP_FILE));
    wp_enqueue_style('rp-admin');
    wp_enqueue_script('rp-admin');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker-script', plugins_url('assets/js/script.js', RP_FILE), array('wp-color-picker'), false, true);
}


?>
