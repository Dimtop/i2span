<?php


/**
 * Plugin Name: i2span
 * License: GNU General Public License v2 or later
 *  License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

add_action( 'admin_menu', 'i2spanMenu' );
function i2spanMenu() {
    add_menu_page(
        'i2span',
        'i2span',
        'manage_options',
        'i2span',
        'i2spanPage',
        '',
        4
    );
}


function i2spanPage(){
  ?>
    <div class="wrap">

      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	  <h2>This plugin will affect the source code of your plugins. The actions are irreversible.</h2>
		<h3>.. = plugins folder, ../../themes = themes folder</h3>
      <form action="../wp-content/plugins/i2span/i2spanEngine.php" method="post">
		<input type="text" name="dir" required />
        <input type="submit" value="Run"/>
      </form>
    </div>
    <?php
}
