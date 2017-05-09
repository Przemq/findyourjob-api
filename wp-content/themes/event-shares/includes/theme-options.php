<?php
/**
 * WPX Theme menu - this will be available in WordPress Dashboard. You can easily add more or remove unused parts.
 * Read all comments carefully.
 */
$themename = "WPX";
$shortname = "WPX";

function WPX_theme_menu() {
	add_menu_page( 'WPX Theme Menu', 'WPX Theme Options', 'edit_theme_options', 'WPX_options', 'theme_options_function', '', 200 );
}

add_action( 'admin_menu', 'WPX_theme_menu' );

/**
 * get_option('setting_name')
 * or better one with if statement
 * $var = !empty (get_option('setting_name')) ? (get_option('setting_name')) : 'Placeholder if empty';
 */
function register_theme_options() {
	$settings = array(
		'footer_line_1', // Footer first text line
		'footer_line_2', // Footer second text line
		'footer_line_3', // Footer third text line
		'footer_disclaimer_link', // Footer disclaimer link
		'modal_disclaimer', // Used in country-investor.php to add Disclaimer into modal
		'modal_accept', // Used in country-investor.php to add accept text into modal
		'modal_button', // Used in country-investor.php to add button text into modal
	);

	foreach ( $settings as $single ) {
		register_setting( 'WPX-settings-group', $single );
	}
}

add_action( 'admin_init', 'register_theme_options' );

function theme_options_function() { ?>
    <div class="theme-options-wrapper">
        <h3>WPX Theme Options</h3>

        <form method="post" action="options.php">
			<?php settings_fields( 'WPX-settings-group' ); ?>
			<?php do_settings_sections( 'WPX-settings-group' ); ?>
            <ul class="tab">
                <li><a href="#" class="tablinks active" onclick="openTab(event, 'footer')">Footer settings</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'modal')">Modal settings</a></li>
            </ul>

            <!-- Footer WPX Theme options -->
            <div id="footer" class="tabcontent" style="display: block">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Text line 1</th>
                        <td><textarea name="footer_line_1" cols="30"
                                      rows="5"><?= esc_attr( get_option( 'footer_line_1' ) );
								?></textarea></td>
                        </br>
                    </tr>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Text line 2</th>
                        <td><textarea name="footer_line_2" cols="30"
                                      rows="5"><?= esc_attr( get_option( 'footer_line_2' ) );
								?></textarea></td>
                        </br>
                    </tr>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Text line 3</th>
                        <td><textarea name="footer_line_3" cols="30"
                                      rows="5"><?= esc_attr( get_option( 'footer_line_3' ) ); ?></textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Disclaimer link</th>
                        <td>
                            <input type="text" name="footer_disclaimer_link"
                                   value="<?php echo esc_attr( get_option( 'footer_disclaimer_link' ) ); ?>"/>
                            <span>( Default : /risk-factors )</span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Modal WPX Theme options: -->
            <div id="modal" class="tabcontent">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Disclaimer text</th>
                        <td>
                            <textarea name="modal_disclaimer" cols="30"
                                      rows="5"><?= esc_attr( get_option( 'modal_disclaimer' ) ); ?></textarea>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Accept Terms</th>
                        <td>
                            <input type="text" name="modal_accept"
                                   value="<?php echo esc_attr( get_option( 'modal_accept' ) ); ?>"/>
                            <span>( Default: Accept Terms & Conditions )</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Modal button</th>
                        <td>
                            <input type="text" name="modal_button"
                                   value="<?php echo esc_attr( get_option( 'modal_button' ) ); ?>"/>
                            <span>(Default: Accept and proceed)</span>
                        </td>
                    </tr>
                </table>
            </div>

			<?php submit_button(); ?>

        </form>
    </div>
<?php } ?>