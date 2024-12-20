<?php

function my_plugin_options_settings() {
    $options = array();

    // Tab 1: General Settings
	$options[] = array(
                        'tab'  => 'general',
                        'name' => __('Style', 'cwlp'),
                        'id' => 'stylecwlp',
                        'desc' => __('Choose style of login page', 'cwlp'),
                        'type' => 'radio',
						'default' => '0',
                        'choice' => array(
                            '0' => array(
									'text'  => __('Default', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/default-style.webp',
							),
                            '1' => array(
									'text'  => __('Blue', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/blue-style.webp',
							),
                            '2' => array(
									'text'  => __('Red', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/red-style.webp',
							),
                            '3' => array(
									'text'  => __('Green', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/green-style.webp',
							),
                            '4' => array(
									'text'  => __('Purple', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/purple-style.webp',
							),
                            '5' => array(
									'text'  => __('Snow', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/snow-style.webp',
							),
                            '6' => array(
									'text'  => __('Technology', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/technology-style.webp',
							),
                            '7' => array(
									'text'  => __('Learning', 'cwlp'),
									'image' => CWLP_LOGIN_ASSETS .'images/learning-style.webp',
							),
                        )
                    );
	$options[] = array(
                        'tab' => 'general',
                        'name' =>  __('Login form position', 'cwlp'),
                        'id' => 'cwlploginposition',
                        'desc' =>  __('Choose login form position. (Only for desktop)', 'cwlp'),
                        'type' => 'select',
                        'options' => array(
							__('Left', 'cwlp'),
                            __('Center', 'cwlp'),
                            __('Right', 'cwlp'),
                        )
                    );
					$options[] = array(
                        'tab' => 'general',
                        'name' => __('Custom background image', 'cwlp'),
                        'id' => 'cwlp-custom-ibc',
                        'desc' => __('Select the appropriate image for the background of the login page. Recommended image size: 1280x 720', 'cwlp'),
                        'type' => 'media',
                        'returnvalue' => 'url'
                    );
					$options[] = array(
                        'tab' => 'general',
                        'name' => __('Custom background image from url', 'cwlp'),
                        'id' => 'cwlp-custom-ibu',
                        'desc' => __('Enter the appropriate image link for the background of the login page. Recommended image size: 1280x 720. This image affects the above 2 items. Leave this field blank if you want to apply the default image of the plugin designs or the image uploaded by you on the login page.', 'cwlp'),
                        'type' => 'url'
                    );
                    $options[] = array(
                        'tab' => 'general',
                        'name' =>  __('Box Shadow', 'cwlp'),
                        'id' => 'cwlp-bshadow',
                        'desc' =>  __('This option adds a shadow to the outer box of the login box.', 'cwlp'),
                        'type' => 'toggle',
                    );
					$options[] = array(
                        'tab' => 'general',
                        'name' =>  __('Font family', 'cwlp'),
                        'id' => 'cwlp-fontfamily',
                        'desc' =>  __('Choose Font of login page text', 'cwlp'),
                        'type' => 'select',
                        'options' => array(
							__('Default', 'cwlp'),
                            __('Vazir', 'cwlp'),
                            __('Yekan', 'cwlp'),
                            __('Samim', 'cwlp'),
                            __('Shabnam', 'cwlp'),
                            __('Estedad', 'cwlp'),
							__('Lalezar', 'cwlp'),
							__('SorkhPust', 'cwlp'),
							__('Casablanca', 'cwlp'),
                        )
                    );
					 $options[] = array(
                        'tab' => 'general',
                        'name' => __('Change Logo URL To Home', 'cwlp'),
                        'id' => 'cwlp-logo-url',
                        'desc' => __('This option changes the URL of the logo on the login page to the main page.', 'cwlp'),
                        'type' => 'toggle',
                    );
					$options[] = array(
                        'tab' => 'general',
                        'name' => __('Custom login logo', 'cwlp'),
                        'id' => 'cwlp-custom-logo',
                        'desc' => __('This option replace default wordpress logo with your custom uploaded logo. Please upload image in square size like: 256x256', 'cwlp'),
                        'type' => 'media',
                        'returnvalue' => 'url'
                    );
					$options[] = array(
                        'tab' => 'general',
                        'name' =>  __('Language switcher', 'cwlp'),
                        'id' => 'cwlp-lswitch',
                        'desc' =>  __('This option can delete the language switcher section on the login page.', 'cwlp'),
                        'type' => 'toggle',
                    );
					
// Tab 2: captcha
			$options[] = array(
				'tab' => 'captcha',
				'label' => __('Captcha Mode', 'cwlp'),
				'id' => 'captcha_style',
				'desc' => __('Select the captcha mode you want to use.', 'cwlp'),
				'type' => 'select',
				'options' => array(
					'none' => __('Disable', 'cwlp'),
					'recaptcha' => __('Google reCAPTCHA(v2)', 'cwlp'),
					'simple' => __('Simple Math Captcha', 'cwlp'),
				)
			);
			$options[] = array(
				'tab' => 'captcha',
				'name' => __('reCAPTCHA Site Key', 'cwlp'),
				'id' => 'recaptcha_site_key',
				'desc' => __('Enter your Google reCAPTCHA site key.', 'cwlp'),
				'type' => 'text',
			);
			
			$options[] = array(
			'tab' => 'captcha',
				'section' => 'CWLP_section_captcha',
				'name' => __('reCAPTCHA Secret Key', 'cwlp'),
				'id' => 'recaptcha_secret_key',
				'desc' => __('Enter your Google reCAPTCHA secret key.', 'cwlp'),
				'type' => 'text',
				'class' => 'hidden',
			);

	// Tab 3: Social
			$options[] = array(
                        'tab'  => 'social',
                        'name' =>  __('Display mode', 'cwlp'),
                        'id' => 'cwlp-dmode',
                        'desc' =>  __('Choose how to display icons', 'cwlp'),
                        'type' => 'select',
                        'options' => array(
							__('Vertical', 'cwlp'),
                            __('Horizontal', 'cwlp'),
                        )
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-instagram"></i> Instagram username', 'cwlp'),
                        'id' => 'cwlp-instagram',
                        'desc' => __('Type your Instagram username. ex: masoud.nkh', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-telegram"></i> Telegram username', 'cwlp'),
                        'id' => 'cwlp-telegram',
                        'desc' => __('Type your Telegram username. ex: masoud_nkh', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-pinterest"></i> Pinterest username', 'cwlp'),
                        'id' => 'cwlp-pinterest',
                        'desc' => __('Type your Pinterest username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-whatsapp"></i> Whatsapp number', 'cwlp'),
                        'id' => 'cwlp-whatsapp',
                        'desc' => __('Type your Whatsapp phone number with country code. ex: 989211234567', 'cwlp'),
                        'type' => 'number',
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-facebook"></i> Facebook username', 'cwlp'),
                        'id' => 'cwlp-facebook',
                        'desc' => __('Type your Facebook username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-x-twitter"></i> Twitter username', 'cwlp'),
                        'id' => 'cwlp-twitter',
                        'desc' => __('Type your Twitter username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab'  => 'social',
                        'name' => __('<i class="fab fa-linkedin"></i> Linkedin username', 'cwlp'),
                        'id' => 'cwlp-linkedin',
                        'desc' => __('Type your Linkedin username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    );
// Tab 4 - Login security
			$options[] = array(
                'tab'  => 'login-security',
                        'label' => __('Custom Login URL', 'cwlp'),
                        'id' => 'cwlp-login-urls',
                        'desc' => __('Type the address you want to use, for example: secadmin. Please use only English letters and numbers (Nothing else works). The WordPress admin page will be available through this address, for example: https://site.com/secadmin', 'cwlp'),
                        'type' => 'text',
						'placeholder' => 'secadmin',
                    );
					$options[] = array(
                'tab'  => 'login-security',
                        'label' => __('Error message', 'cwlp'),
                        'id' => 'cwlp-login-url-message',
                        'desc' => __('Enter the message you want to display when a person wants to log in with wp-admin or wp-login URLs', 'cwlp'),
                        'type' => 'wysiwyg',
						'placeholder' => __('You do not have permission to access this page!', 'cwlp'),
                    );
			$options[] = array(
                'tab'  => 'login-security',
                        'label' => __('Error page style', 'cwlp'),
                        'id' => 'cwlp-login-error-style',
                        'desc' => __('Select access error page design style.', 'cwlp'),
                        'type' => 'select',
						'default' => '1',
                        'options' => array(
                            __('Default wordpress style', 'cwlp'),
                            __('Style 1', 'cwlp'),
                            __('Style 2', 'cwlp'),
                        )
            );
				

// Tab 5 - Login label				
		$options[] = array(
                        'tab' => 'login-label',
                        'label' => __('username or email address', 'cwlp'),
                        'id' => 'cwlplabeluname',
                        'desc' => __('Change <span class="lable">username or email address</span> label text', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab' => 'login-label',
                        'label' => __('Password', 'cwlp'),
                        'id' => 'cwlplabelpass',
                        'desc' => __('Change <span class="lable">Password</span> label text', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab' => 'login-label',
                        'label' => __('Remember me', 'cwlp'),
                        'id' => 'cwlplabelremember',
                        'desc' => __('Change <span class="lable">Remember me</span> label text', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab' => 'login-label',
                        'label' => __('Lost your password?', 'cwlp'),
                        'id' => 'cwlplabelpasslost',
                        'desc' => __('Change <span class="lable">Lost your password?</span> label text', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab' => 'login-label',
                        'label' => __('Log in', 'cwlp'),
                        'id' => 'cwlplabelogin',
                        'desc' => __('Change <span class="lable">Log in</span> button label text', 'cwlp'),
                        'type' => 'text',
                    );
					$options[] = array(
                        'tab' => 'login-label',
                        'label' => __('Solve this', 'cwlp'),
                        'id' => 'cwlpllabelsolvethis',
                        'desc' => __('Change <span class="lable">Solve this</span> text when Simple math captcha enabled', 'cwlp'),
                        'type' => 'text',
                    );
					


// tab 6 - Login effect
			$options[] = array(
                        'tab' => 'login-effect',
                        'label' => __('WP login page effect style', 'cwlp'),
                        'id' => 'cwlpeffecttype',
                        'desc' => __('Select effect style if you want to have beautifull wordpress login page', 'cwlp'),
                        'type' => 'select',
						'default' => '1',
                        'options' => array(
                            __('Without effect', 'cwlp'),
                            __('Square bubble', 'cwlp'),
                            __('Circle bubble', 'cwlp'),
                            __('Pulsating ring', 'cwlp'),
                            __('Wandering balloon', 'cwlp'),
                        )
                    );
    return $options;
}

add_filter( 'optionsframework_options', 'my_plugin_options_settings' );

function cwlp_field_callback( $field ) {
		$value = get_option($field['id'], $field['default'] ?? '');

		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		// if(!isset($field['type'])) {
			// return false;
		// }
		switch ( $field['type'] ) {
						case 'wysiwyg':
							wp_editor($value, $field['id'], array( 'media_buttons' => false ));
							break;
                        case 'select':
                            case 'multiselect':
                                if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
                                    $attr = '';
                                    $options = '';
                                    foreach( $field['options'] as $key => $label ) {
                                        $options .= sprintf('<option value="%s" %s>%s</option>',
										$key,
										selected($value, $key, false),
										$label // $label is the value from $field['options'][$key]
									);

                                    }
                                    if( $field['type'] === 'multiselect' ){
                                        $attr = ' multiple="multiple" ';
                                    }
                                    printf( '<select name="%1$s" id="%1$s" %2$s>%3$s</select>',
                                        $field['id'],
                                        $attr,
                                        $options
                                    );
                                }
                                break;
								
								case 'radio':
                            if( ! empty ( $field['choice'] ) && is_array( $field['choice'] ) ) {
                                $options_markup = '';
                                $iterator = 0;
								// echo '<a onclick="myFunction()">' . __( 'Show/Hide styles', 'cwlp') . '</a>';
                                foreach( $field['choice'] as $key => $choice ) {
                                    $iterator++;
                                    $options_markup .= sprintf(
										'
										<li class="cwlp-rd-field-item %1$s">				
											<label for="%1$s_%6$s">
												<div class="cwlp-rd-img-wrap">
													<img src="%7$s">
												</div>
												<div class="cwlp-rd-footer">
													<input id="%1$s_%6$s" type="radio" name="%1$s" value="%3$s" %4$s /> 
													%5$s
												</div>
											</label>
										</li>',
										$field['id'],           // %1$s: Field ID
										$field['type'],         // %2$s: Field type (radio)
										$key,                   // %3$s: Value (key from $field['choice'])
										checked($value, $key, false),  // %4$s: Checked attribute
										$choice['text'],        // %5$s: Label text
										$iterator,              // %6$s: Iterator
										$choice['image'],       // %7$s: Image URL
									);
                                    }
									echo '</ul>';
                                    printf( '<ul id="cwlpstyleb"class="cwlp-style-table">%s</ul>',
                                    $options_markup
                                    );
                            }
                            break;
						case 'toggle':
								$value = isset( $field['id'] ) ? get_option( $field['id'], '' ) : ''; // Retrieve saved value
								$checked = ( $value === '1' ) ? 'checked="checked"' : '';
								$label = isset( $field['label'] ) ? $field['label'] : ''; // Retrieve label or default to an empty string

								printf(
									'
									<input type="hidden" name="%1$s" value="0" />
									<label class="switch">
										<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s />
										<span class="slider"></span>
									</label>
									<span>%3$s</span>',
									$field['id'],    // %1$s: Field ID
									$checked,        // %2$s: Checked attribute
									esc_html( $label ) // %3$s: Label text
								);
								break;

						
						 case 'textarea':
                            printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>',
                                $field['id'],
                                $placeholder,
                                $value
                                );
                                break;
                        case 'checkbox':
                            printf('<input %s id="%s" name="%s" type="checkbox" value="1">',
                                $value === '1' ? 'checked' : '',
                                $field['id'],
                                $field['id']
                        );
                            break;
						case 'media':
                            $field_url = '';
                            if ($value) {
                                if ($field['returnvalue'] == 'url') {
                                    $field_url = $value;
                                } else {
                                    $field_url = wp_get_attachment_url($value);
                                }
                            }
                            printf(
                                '<input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s"><div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 19%%;margin-right:5px;" class="button menutitle-media cwlp-btstyle" id="%s_button" name="%s_button" type="button" value="%8$s" /><input style="width: 19%%;" class="button remove-media cwlp-btrstyle" id="%s_buttonremove" name="%s_buttonremove" type="button" value="%12$s" />',
                                $field['id'],
                                $field['id'],
                                $value,
                                $field['returnvalue'],
                                $field['id'],
                                $field_url,
                                $field['id'],
								__('Select', 'cwlp'),
                                $field['id'],
                                $field['id'],
                                $field['id'],
								__('Clear', 'cwlp')
                            );
                            break;

			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}
	}
function my_plugin_render_fields_by_tab($tab) {
    $options = apply_filters('optionsframework_options', array());

    echo '<table class="form-table">'; // Start the table

    foreach ($options as $field) {
        if (isset($field['tab']) && $field['tab'] === $tab) {
            echo '<tr>';

            // Field Label
            echo '<th scope="row">';
            if (isset($field['name'])) {
                echo $field['name'];
            } elseif (isset($field['label'])) {
				echo $field['label'];
			}
            echo '</th>';

            // Field Input
            echo '<td>';
            cwlp_field_callback($field); // Render the field
            if (isset($field['desc'])) {
                echo '<p class="description">' . $field['desc'] . '</p>';
            }
            echo '</td>';

            echo '</tr>';
        }
    }

    echo '</table>'; // End the table
}





function cwlp_settings_content() {
    ?>
	<style>
	@media (max-width: 768px) {
    .nav-tab-wrapper {
        display: flex;
        flex-wrap: wrap;
    }
    .nav-tab {
        flex: 1 1 auto;
    }
}

</style>
    <div class="wrap cwlps">
        <h1 class="cwlp-set"><?php esc_html_e( 'Creative Wordpress Login Page Settings', 'cwlp' ); ?></h1>
<form method="post" action="options.php">
        <div class="nav-tab-wrapper">
			<h2 style="border-left: none;border-right: none">
				<a href="#tab-general" class="nav-tab nav-tab-active"><img src="<?php echo CWLP_LOGIN_ASSETS ?>images/main.svg" alt="Icon"><?php esc_html_e( 'General', 'cwlp' ); ?></a>
				<a href="#tab-captcha" class="nav-tab"><img src="<?php echo CWLP_LOGIN_ASSETS ?>images/captcha.svg" alt="Icon"><?php esc_html_e( 'captcha', 'cwlp' ); ?></a>
				<a href="#tab-social" class="nav-tab"><img src="<?php echo CWLP_LOGIN_ASSETS ?>images/social.svg" alt="Icon"><?php esc_html_e( 'Social', 'cwlp' ); ?></a>
				<a href="#tab-login-security" class="nav-tab"><img src="<?php echo CWLP_LOGIN_ASSETS ?>images/login.svg" alt="Icon"><?php esc_html_e( 'Login Security', 'cwlp' ); ?></a>
				<a href="#tab-login-label" class="nav-tab"><img src="<?php echo CWLP_LOGIN_ASSETS ?>images/label.svg" alt="Icon"><?php esc_html_e( 'Label Changer', 'cwlp' ); ?></a>
				<a href="#tab-login-effect" class="nav-tab"><img src="<?php echo CWLP_LOGIN_ASSETS ?>images/effect.svg" alt="Icon"><?php esc_html_e( 'Effect manager', 'cwlp' ); ?></a>
			</h2>
			<div class="topsubmitcwlp"><?php submit_button(); ?></div>
		</div>

        
            <?php
            // Output security fields and hidden fields for saving options.
            settings_fields( 'my_plugin_options_group' ); // Register your settings group.
            ?>

            <div id="tab-general" class="tab-content active">
                <?php my_plugin_render_fields_by_tab( 'general' ); ?>
            </div>

            <div id="tab-captcha" class="tab-content">
			<h3><?php esc_html_e( 'You can protect your login form with captcha', 'cwlp' ); ?></h3>
                <?php my_plugin_render_fields_by_tab( 'captcha' ); ?>
            </div>

            <div id="tab-social" class="tab-content">
			<h3><?php esc_html_e( 'With this section, you can add a floating social media toolbar to your login page. Empty field for remove icon.', 'cwlp' ); ?></h3>
                <?php my_plugin_render_fields_by_tab( 'social' ); ?>
            </div>
			
            <div id="tab-login-security" class="tab-content">
			<h3><?php esc_html_e( 'With this section, you can restrict access to the WordPress login and admin page to a specific address.', 'cwlp' ); ?></h3>
                <?php my_plugin_render_fields_by_tab( 'login-security' ); ?>
            </div>
			
            <div id="tab-login-label" class="tab-content">
			<h3><?php esc_html_e( 'With this section, you can change label text of all thing in wordpress login page', 'cwlp' ); ?></h3>
                <?php my_plugin_render_fields_by_tab( 'login-label' ); ?>
            </div>
			
            <div id="tab-login-effect" class="tab-content">
                <h3><?php esc_html_e( 'With this section, you can set some effect for show in wordpress login page', 'cwlp' ); ?></h3>
                <?php my_plugin_render_fields_by_tab( 'login-effect' ); ?>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>

    <style>
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
		.hidden {
    display: none !important;
}
a.nav-tab img {
    width: 25px;
    height: auto;
    vertical-align: middle;
}
a.nav-tab-active img {
    width: 30px;
}
.tab-content h3:before {
    content: '';
    display: inline-block;
    width: 25px;
    height: 25px;
    margin-left: 5px;
    vertical-align: middle;
    position: relative;
    background-image: url(<?php echo CWLP_LOGIN_ASSETS ?>images/header.svg);
    background-size: cover;
}

    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.nav-tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('nav-tab-active'));
                    contents.forEach(c => c.classList.remove('active'));

                    // Activate the clicked tab and its content
                    tab.classList.add('nav-tab-active');
                    document.querySelector(tab.getAttribute('href')).classList.add('active');
                });
            });

            // Show the first tab content by default
            document.querySelector('.nav-tab').click();
        });
    </script>
	<script>
			document.addEventListener('DOMContentLoaded', function () {
    if (typeof wp.media !== 'undefined') {
        let _customMedia = true;
        const _origSendAttachment = wp.media.editor.send.attachment;

        // Handle media button click
        document.querySelectorAll('.menutitle-media').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const id = button.id.replace('_button', '');
                _customMedia = true;

                wp.media.editor.send.attachment = function (props, attachment) {
                    if (_customMedia) {
                        const input = document.querySelector(`input#${id}`);
                        const returnType = input?.dataset?.return || 'id';
                        if (returnType === 'url') {
                            input.value = attachment.url;
                        } else {
                            input.value = attachment.id;
                        }
                        const previewDiv = document.querySelector(`div#preview${id}`);
                        if (previewDiv) {
                            previewDiv.style.backgroundImage = `url('${attachment.url}')`;
                        }
                    } else {
                        return _origSendAttachment.apply(this, [props, attachment]);
                    }
                };

                wp.media.editor.open(button);
            });
        });

        // Reset _customMedia when the "Add Media" button is clicked
        document.querySelectorAll('.add_media').forEach(function (button) {
            button.addEventListener('click', function () {
                _customMedia = false;
            });
        });

        // Handle media removal
        document.querySelectorAll('.remove-media').forEach(function (button) {
            button.addEventListener('click', function () {
                const parent = button.closest('td');
                if (parent) {
                    const input = parent.querySelector('input[type="text"]');
                    const previewDiv = parent.querySelector('div');
                    if (input) input.value = '';
                    if (previewDiv) previewDiv.style.backgroundImage = 'none';
                }
            });
        });
    }
});

		</script>
		
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get references to the dropdown and the fields to hide/show
    const captchaStyleSelect = document.getElementById('captcha_style');
    const recaptchaSiteKeyField = document.getElementById('recaptcha_site_key').closest('tr'); // Get the closest row
    const recaptchaSecretKeyField = document.getElementById('recaptcha_secret_key').closest('tr'); // Get the closest row

    // Function to toggle the visibility of fields
    function toggleRecaptchaFields() {
        if (captchaStyleSelect.value === 'recaptcha') {
            recaptchaSiteKeyField.classList.remove('hidden');
            recaptchaSecretKeyField.classList.remove('hidden');
        } else {
            recaptchaSiteKeyField.classList.add('hidden');
            recaptchaSecretKeyField.classList.add('hidden');
        }
    }

    // Initial check on page load
    toggleRecaptchaFields();

    // Add event listener for dropdown changes
    captchaStyleSelect.addEventListener('change', toggleRecaptchaFields);
});

</script>
    <?php
}
function my_plugin_register_settings() {
    $options = apply_filters( 'optionsframework_options', array() );

    foreach ( $options as $option ) {
        if ( isset( $option['id'] ) ) {
            register_setting('my_plugin_options_group', $option['id'], 'sanitize_callback_function');
        }
    }
}
add_action( 'admin_init', 'my_plugin_register_settings' );
add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );

add_action( 'admin_menu', function () {
    add_menu_page(
        __('Creative Wordpress Login Page Settings', 'cwlp'),
        __('CWLP Settings', 'cwlp'),
        'manage_options',
        'cwlp-settings',
        'cwlp_settings_content',
        CWLP_LOGIN_ASSETS . '/images/creative-logo.png',
        2
    );
} );
