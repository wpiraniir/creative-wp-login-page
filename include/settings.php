<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
error_reporting (E_ALL ^ E_NOTICE);

/**
 * CWLP Setting Page
 *
 * Add menu and options for CWLP plugin
 *
 * @since 1.0.0
 */
class CWLP_Settings_Page {
	
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'cwlp_create_settings' ) );
		add_action( 'admin_menu', array( $this, 'cwlp_submenu' ) );
		add_action( 'admin_init', array( $this, 'cwlp_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'cwlp_option_fields' ) );
		add_action( 'admin_init', array( $this, 'cwlp_social_field' ) );
		add_action( 'admin_init', array( $this, 'cwlp_login_security_field' ) );
		add_action( 'admin_init', array( $this, 'cwlp_login_label_field' ) );
		add_action( 'admin_init', array( $this, 'cwlp_login_effect_field' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	}

	public function cwlp_create_settings() {
		$page_title = __('Creative Wordpress Login Page Settings', 'cwlp');
		$menu_title = __('CWLP Settings', 'cwlp');
		$capability = 'manage_options';
		$slug = 'cwlp-settings';
		$callback = array($this, 'cwlp_settings_content');
        $icon = CWLP_LOGIN_ASSETS . '/images/creative-logo.png';
		$position = 2;
		add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
	}
	public function cwlp_submenu() {
		add_submenu_page( 'cwlp-settings', 'cwlpgeneral', __('General', 'cwlp' ), 'manage_options', 'cwlp-settings&tab=general_tools', array($this, 'cwlp_settings_content'), null);
		add_submenu_page( 'cwlp-settings', 'cwlpsocial', __('Social', 'cwlp' ), 'manage_options', 'cwlp-settings&tab=social_widget', array($this, 'cwlp_settings_content'), null);
		add_submenu_page( 'cwlp-settings', 'cwlplogs', __('Login Security', 'cwlp' ), 'manage_options', 'cwlp-settings&tab=login_security_cwlp', array($this, 'cwlp_settings_content'), null);
		add_submenu_page( 'cwlp-settings', 'cwlplogla', __('Label Changer', 'cwlp' ), 'manage_options', 'cwlp-settings&tab=cwlp_login_label', array($this, 'cwlp_settings_content'), null);
		add_submenu_page( 'cwlp-settings', 'cwlplogef', __('Effect manager', 'cwlp' ), 'manage_options', 'cwlp-settings&tab=cwlp_login_effect', array($this, 'cwlp_settings_content'), null);
	}
    
	public function cwlp_settings_content() { ?>
		<div class="wrap cwlps">
			<h1 class="cwlp-set"><?php esc_html_e( 'Creative Wordpress Login Page Settings', 'cwlp' ); ?></h1>
			 <?php settings_errors(); ?>
        
            <?php
            // if ( isset( $_GET ) ) {
                // $active_tab = $_GET['tab'];
            // }
            $default_tab = null;
			$active_tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
            ?>
			<form method="POST" action="options.php">
			<div class="nav-tab-wrapper">
			<h2 style="border-left: none;border-right: none">
				<a href="?page=cwlp-settings&tab=general_tools" class="nav-tab <?php if($active_tab==='general_tools'):?>nav-tab-active<?php endif; ?>"><span class="dashicons dashicons-admin-generic"></span><?php esc_html_e( 'General', 'cwlp' ); ?></a>
				<a href="?page=cwlp-settings&tab=social_widget" class="nav-tab <?php if($active_tab==='social_widget'):?>nav-tab-active<?php endif; ?>"><span class="dashicons dashicons-share"></span><?php esc_html_e( 'Social', 'cwlp' ); ?></a>
				<a href="?page=cwlp-settings&tab=login_security_cwlp" class="nav-tab cwlp-secure-tab <?php if($active_tab==='login_security_cwlp'):?>nav-tab-active<?php endif; ?>"><span class="dashicons dashicons-lock"></span><?php esc_html_e( 'Login Security', 'cwlp' ); ?></a>
				<a href="?page=cwlp-settings&tab=cwlp_login_label" class="nav-tab cwlp-label-tab <?php if($active_tab==='cwlp_login_label'):?>nav-tab-active<?php endif; ?>"><span class="dashicons dashicons-edit"></span><?php esc_html_e( 'Label Changer', 'cwlp' ); ?></a>
				<a href="?page=cwlp-settings&tab=cwlp_login_effect" class="nav-tab cwlp-efect-tab <?php if($active_tab==='cwlp_login_effect'):?>nav-tab-active<?php endif; ?>"><span class="dashicons dashicons-superhero"></span><?php esc_html_e( 'Effect manager', 'cwlp' ); ?></a>
			</h2>
			<div class="topsubmitcwlp"><?php submit_button(); ?></div>
			</div>
			
			
				<?php
					if ( $active_tab == 'general_tools' ) {
					settings_fields( 'cwlp-settings' );
					do_settings_sections( 'cwlp-settings' );
					// submit_button();
					} elseif ( $active_tab == 'social_widget' ) {
						settings_fields( 'cwlp-settings-social' );
						do_settings_sections( 'cwlp-settings-social' );
						// submit_button(); 
					} elseif ( $active_tab == 'login_security_cwlp' ) {
						settings_fields( 'cwlp-settings-login-security' );
						do_settings_sections( 'cwlp-settings-login-security' );
						// submit_button(); 
					} elseif ( $active_tab == 'cwlp_login_label' ) {
						settings_fields( 'cwlp-settings-login-label' );
						do_settings_sections( 'cwlp-settings-login-label' );
						// submit_button(); 
					} elseif ( $active_tab == 'cwlp_login_effect' ) {
						settings_fields( 'cwlp-settings-login-effect' );
						do_settings_sections( 'cwlp-settings-login-effect' );
						// submit_button(); 
					} else {
					settings_fields( 'cwlp-settings' );
					do_settings_sections( 'cwlp-settings' );
					// submit_button(); 
					}
					submit_button(); 
				?>
			</form>
		</div> <?php
	}
	
	public function cwlp_setup_sections() {
		add_settings_section( 'CWLP_section', __('Save the settings after changing each option. The "Default" options do not apply any style of plugin to the login page and use the default WordPress values.', 'cwlp' ), array(), 'cwlp-settings' );
		add_settings_section( 'CWLP_section_social', __('With this section, you can add a floating social media toolbar to your login page. Empty field for remove icon.', 'cwlp' ), array(), 'cwlp-settings-social' );
		add_settings_section( 'CWLP_section_login_security', __('With this section, you can restrict access to the WordPress login and admin page to a specific address.', 'cwlp' ), array(), 'cwlp-settings-login-security' );
		add_settings_section( 'CWLP_section_login_label', __('With this section, you can change label text of all thing in wordpress login page', 'cwlp' ), array(), 'cwlp-settings-login-label' );
		add_settings_section( 'CWLP_section_login_effect', __('With this section, you can set some effect for show in wordpress login page', 'cwlp' ), array(), 'cwlp-settings-login-effect' );
	}

	public function cwlp_option_fields() {
		$fields = array(
					array(
                        'section' => 'CWLP_section',
                        'label' => __('Style', 'cwlp'),
                        'id' => 'stylecwlp',
                        'desc' => __('Choose style of login page', 'cwlp'),
                        'type' => 'radio',
						'default' => '0',
                        'choice' => array(
                            '' => array(
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
                    ),
					array(
                        'section' => 'CWLP_section',
                        'label' =>  __('Login form position', 'cwlp'),
                        'id' => 'cwlploginposition',
                        'desc' =>  __('Choose login form position. (Only for desktop)', 'cwlp'),
                        'type' => 'select',
                        'options' => array(
							__('Left', 'cwlp'),
                            __('Center', 'cwlp'),
                            __('Right', 'cwlp'),
                        )
                    ),
					array(
                        'section' => 'CWLP_section',
                        'label' => __('Custom background image', 'cwlp'),
                        'id' => 'cwlp-custom-ibc',
                        'desc' => __('Select the appropriate image for the background of the login page. Recommended image size: 1280x 720', 'cwlp'),
                        'type' => 'media',
                        'returnvalue' => 'url'
                    ),
					array(
                        'section' => 'CWLP_section',
                        'label' => __('Custom background image from url', 'cwlp'),
                        'id' => 'cwlp-custom-ibu',
                        'desc' => __('Enter the appropriate image link for the background of the login page. Recommended image size: 1280x 720. This image affects the above 2 items. Leave this field blank if you want to apply the default image of the plugin designs or the image uploaded by you on the login page.', 'cwlp'),
                        'type' => 'url'
                    ),
                    array(
                        'section' => 'CWLP_section',
                        'label' =>  __('Box Shadow', 'cwlp'),
                        'id' => 'cwlp-bshadow',
                        'desc' =>  __('This option adds a shadow to the outer box of the login box.', 'cwlp'),
                        'type' => 'toggle',
                    ),
					array(
                        'section' => 'CWLP_section',
                        'label' =>  __('Font family', 'cwlp'),
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
                    ),
					 array(
                        'section' => 'CWLP_section',
                        'label' => __('Change Logo URL To Home', 'cwlp'),
                        'id' => 'cwlp-logo-url',
                        'desc' => __('This option changes the URL of the logo on the login page to the main page.', 'cwlp'),
                        'type' => 'toggle',
                    ),
					array(
                        'section' => 'CWLP_section',
                        'label' => __('Custom login logo', 'cwlp'),
                        'id' => 'cwlp-custom-logo',
                        'desc' => __('This option replace default wordpress logo with your custom uploaded logo. Please upload image in square size like: 256x256', 'cwlp'),
                        'type' => 'media',
                        'returnvalue' => 'url'
                    ),
					array(
                        'section' => 'CWLP_section',
                        'label' =>  __('Language switcher', 'cwlp'),
                        'id' => 'cwlp-lswitch',
                        'desc' =>  __('This option can delete the language switcher section on the login page.', 'cwlp'),
                        'type' => 'toggle',
                    )
		);

		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'cwlp_field_callback' ), 'cwlp-settings', $field['section'], $field );
			register_setting( 'cwlp-settings', $field['id'] );
		}
	}
	
	/// start social fields ///
	public function cwlp_social_field() {
		$fieldo = array(
					 array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-instagram"></i> Instagram username', 'cwlp'),
                        'id' => 'cwlp-instagram',
                        'desc' => __('Type your Instagram username. ex: masoud.nkh', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-telegram"></i> Telegram username', 'cwlp'),
                        'id' => 'cwlp-telegram',
                        'desc' => __('Type your Telegram username. ex: masoud_nkh', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-pinterest"></i> Pinterest username', 'cwlp'),
                        'id' => 'cwlp-pinterest',
                        'desc' => __('Type your Pinterest username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-whatsapp"></i> Whatsapp number', 'cwlp'),
                        'id' => 'cwlp-whatsapp',
                        'desc' => __('Type your Whatsapp phone number with country code. ex: 989211234567', 'cwlp'),
                        'type' => 'number',
                    ),
					array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-facebook"></i> Facebook username', 'cwlp'),
                        'id' => 'cwlp-facebook',
                        'desc' => __('Type your Facebook username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-twitter"></i> Twitter username', 'cwlp'),
                        'id' => 'cwlp-twitter',
                        'desc' => __('Type your Twitter username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_social',
                        'label' => __('<i class="fab fa-linkedin-in"></i> Linkedin username', 'cwlp'),
                        'id' => 'cwlp-linkedin',
                        'desc' => __('Type your Linkedin username. ex: masoudkhodabakhsh', 'cwlp'),
                        'type' => 'text',
                    )
		);
		foreach( $fieldo as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'cwlp_social_callback' ), 'cwlp-settings-social', $field['section'], $field );
			register_setting( 'cwlp-settings-social', $field['id'] );
		}
	}
	/// start login security fields ///
	public function cwlp_login_security_field() {
		$cwlogino = array(
					array(
                        'section' => 'CWLP_section_login_security',
                        'label' => __('Custom Login URL', 'cwlp'),
                        'id' => 'cwlp-login-urls',
                        'desc' => __('Type the address you want to use, for example: secadmin. Please use only English letters and numbers (Nothing else works). The WordPress admin page will be available through this address, for example: https://site.com/secadmin', 'cwlp'),
                        'input' => 'text',
						'placeholder' => 'secadmin',
                    ),
					array(
                        'section' => 'CWLP_section_login_security',
                        'label' => __('Error message', 'cwlp'),
                        'id' => 'cwlp-login-url-message',
                        'desc' => __('Enter the message you want to display when a person wants to log in with wp-admin or wp-login URLs', 'cwlp'),
                        'type' => 'textarea',
						'placeholder' => __('You do not have permission to access this page!', 'cwlp'),
                    ),
					array(
                        'section' => 'CWLP_section_login_security',
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
                    )
		);
		foreach( $cwlogino as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'cwlp_field_callback' ), 'cwlp-settings-login-security', $field['section'], $field );
			register_setting( 'cwlp-settings-login-security', $field['id'] );
		}
	}
	
		/// start login label changer fields ///
	public function cwlp_login_label_field() {
		$cwlabelo = array(
					array(
                        'section' => 'CWLP_section_login_label',
                        'label' => __('username or email address', 'cwlp'),
                        'id' => 'cwlplabeluname',
                        'desc' => __('Change <span class="lable">username or email address</span> label text', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_login_label',
                        'label' => __('Password', 'cwlp'),
                        'id' => 'cwlplabelpass',
                        'desc' => __('Change <span class="lable">Password</span> label text', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_login_label',
                        'label' => __('Remember me', 'cwlp'),
                        'id' => 'cwlplabelremember',
                        'desc' => __('Change <span class="lable">Remember me</span> label text', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_login_label',
                        'label' => __('Lost your password?', 'cwlp'),
                        'id' => 'cwlplabelpasslost',
                        'desc' => __('Change <span class="lable">Lost your password?</span> label text', 'cwlp'),
                        'type' => 'text',
                    ),
					array(
                        'section' => 'CWLP_section_login_label',
                        'label' => __('Log in', 'cwlp'),
                        'id' => 'cwlplabelogin',
                        'desc' => __('Change <span class="lable">Log in</span> button label text', 'cwlp'),
                        'type' => 'text',
                    )
		);
		foreach( $cwlabelo as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'cwlp_field_callback' ), 'cwlp-settings-login-label', $field['section'], $field );
			register_setting( 'cwlp-settings-login-label', $field['id'] );
		}
	}
	
	
	/// start effect manager fields ///
	public function cwlp_login_effect_field() {
		$cwlogeffe= array(
					array(
                        'section' => 'CWLP_section_login_effect',
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
                        )
                    )
		);
		foreach( $cwlogeffe as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'cwlp_field_callback' ), 'cwlp-settings-login-effect', $field['section'], $field );
			register_setting( 'cwlp-settings-login-effect', $field['id'] );
		}
	}
	
	public function cwlp_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		// if(!isset($field['type'])) {
			// return false;
		// }
		switch ( $field['type'] ) {
                        case 'select':
                            case 'multiselect':
                                if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
                                    $attr = '';
                                    $options = '';
                                    foreach( $field['options'] as $key => $label ) {
                                        $options.= sprintf('<option value="%s" %s>%s</option>',
                                            $key,
                                            selected($value, $key, false),
                                            $label
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
								echo '<a onclick="myFunction()">' . __( 'Show/Hide styles', 'cwlp') . '</a>';
                                foreach( $field['choice'] as $key => $choice ) {
                                    $iterator++;
                                    $options_markup.= sprintf('
									<li class="cwlp-rd-field-item %1$s">				
										<label for="%1$s_%6$s">
											<div class="cwlp-rd-img-wrap">
												<img src="%7$s">
											</div>
											<div class="cwlp-rd-footer">
												<input id="%1$s_%6$s"  type="radio"  name="%1$s"value="%3$s" %4$s /> %5$s
												<span class="cwlp-rd-item-text">%8$s</span>
											</div>
										</label>
									</li>',
									
                                    $field['id'],
                                    $field['type'],
                                    $key,
                                    checked($value, $key, false),
                                    $label,
                                    $iterator,
									$choice['image'],
									$choice['text']
                                    );
                                    }
									echo '</ul>';
                                    printf( '<ul id="cwlpstyleb"class="cwlp-style-table">%s</ul>',
                                    $options_markup
                                    );
                            }
                            break;
						case 'toggle':
							// $args['value'] = esc_attr( stripslashes( $args['value'] ) );
							$checked = ( $field['value'] ) ? 'checked="checked"' : '';

							printf( '
							<input type="hidden" name="%s" value="0" />
							<label class="switch">
							<input %1$s type="checkbox" name="%2$s" id="%2$s" value="1" class="%2$s" ' . esc_html( $checked ) . '><span class="slider"></span></label>',
							$value === '1' ? 'checked' : '',
							$field['id'],
							$label,
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
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.menutitle-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								if ($('input#' + id).data('return') == 'url') {
									$('input#' + id).val(attachment.url);
								} else {
									$('input#' + id).val(attachment.id);
								}
								$('div#preview'+id).css('background-image', 'url('+attachment.url+')');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$('.remove-media').on('click', function(){
						var parent = $(this).parents('td');
						parent.find('input[type="text"]').val('');
						parent.find('div').css('background-image', 'url()');
					});
				}
			});
		</script><script>function myFunction() {
  var x = document.getElementById("cwlpstyleb");
  if (x.style.display === "none") {
    x.style.display = "flex";
  } else {
    x.style.display = "none";
  }
}</script><?php
	}
    
	public function cwlp_social_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {
            
            
                        case 'select':
                            case 'multiselect':
                                if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
                                    $attr = '';
                                    $options = '';
                                    foreach( $field['options'] as $key => $label ) {
                                        $options.= sprintf('<option value="%s" %s>%s</option>',
                                            $key,
                                            selected($value, $key, false),
                                            $label
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

                        case 'checkbox':
                            printf('<input %s id="%s" name="%s" type="checkbox" value="1">',
                                $value === '1' ? 'checked' : '',
                                $field['id'],
                                $field['id']
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
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
	/// end social fields ///
}
new CWLP_Settings_Page();
