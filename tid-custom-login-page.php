<?php
/*
 * @wordpress-plugin
 * Plugin Name:       TID Custom Login page
 * Plugin URI:        https://wordpress.org/plugins/tid-login-page-for-admin/
 * Description:       Simple Custom Login Page for Admin. 
 * Author:            TechIT Dev
 * Author URI:        https://techitdev.com/
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Text Domain:       tidlogin
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

  // Loading CSS File
  add_action( 'admin_enqueue_scripts', 'tidlogin_add_theme_css');
  function tidlogin_add_theme_css() {
    wp_enqueue_style( 'tidlogin-admin-style', plugins_url('css/tidlogin-admin-style.css', __FILE__ ), false, '1.0.0');
  }

 /**
  * Wordpress custom login page Function
  */
  add_action( 'admin_menu', 'tidlogin_add_theme_page' );
  function tidlogin_add_theme_page() {
    add_menu_page( 'Login page for Admin', 'Login Options', 'manage_options', 'tidlogin-login-option', 'tidlogin_create_page', 'dashicons-unlock', 101);
  }

  // Plugin callback
  function tidlogin_create_page() {
    ?>
    <div class="tidlogin-main-area">
      <div class="tidlogin-body-area tidlogin-common">
        <h3 id="title"> <?php echo esc_attr( 'Login Page Customizer' )?> </h3>
        <form action="options.php" method="post">
          <?php wp_nonce_field( 'update-options' );?>
          <!-- Primary color -->
          <div class="form-gorup">
            <label for="tidlogin-primary-color" name="tidlogin-primary-color"> <?php print esc_attr( 'Primary Color' )?> </label>
            <small> Add your Primary Color</small><br>
            <input type="color" name="tidlogin-primary-color" class="form-control" value="<?php print get_option( 'tidlogin-primary-color' )
            ?>">
          </div>
          <!-- Secondary color -->
          <div class="form-gorup">
            <label for="tidlogin-seconday-color" name="tidlogin-seconday-color"> <?php print esc_attr( 'Seconday Color' )?> </label>
            <small> Add your Secondary Color</small><br>
            <input type="color" name="tidlogin-seconday-color" class="form-control" value="<?php print get_option( 'tidlogin-seconday-color' )
            ?>">
          </div>
        
          <!-- Main Logo -->
          <div class="form-gorup">
            <label for="tidlogin-logo-image-url" name="tidlogin-logo-image-url"> <?php print esc_attr( 'Upload Logo' )?> </label>           
              <small> Past your Logo Image URL(80x80 Recommended) </small>
            <input type="text" name="tidlogin-logo-image-url" class="form-control" value="<?php print get_option( 'tidlogin-logo-image-url' ); ?>" placeholder="Paste your logo URL here">
          </div>

          <!-- Background Image -->
          <div class="form-gorup">
            <label for="tidlogin-custom-bg-image" name="tidlogin-custom-bg-image"> <?php print esc_attr( 'Upload Background Image' )?> </label>
            <small> Past your Background Image URL</small>
            <input type="text" name="tidlogin-custom-bg-image" class="form-control" value="<?php print get_option( 'tidlogin-custom-bg-image' ); ?>" placeholder="Paste your logo URL here">
          </div>

          <!-- Background Britness -->
          <div class="form-gorup">
            <label for="tidlogin-custom-bg-britness" name="tidlogin-custom-bg-britness"> <?php print esc_attr( 'Background Brightness between 0.1 to 0.9' )?> </label>
            <small> Set your Background Brightness between 0.1 to 0.9 </small>
            <input type="text" name="tidlogin-custom-bg-britness" class="form-control" value="<?php print get_option( 'tidlogin-custom-bg-britness' ); ?>" placeholder="Between 0.1 to 0.9">
          </div>


            <input type="hidden" name="action" value="update">
            <input type="hidden" name="page_options" value="tidlogin-primary-color, tidlogin-seconday-color,tidlogin-logo-image-url, tidlogin-custom-bg-image, tidlogin-custom-bg-britness">
         
            <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'tidlogin');?>">
       
        </form>
      </div>
      <div class="tidlogin-sidebar-area tidlogin-common">
      <h3 id="title"> <?php echo esc_attr( 'About Author' )?> </h3>
      <p>
        <img src="<?php print plugin_dir_url( __FILE__).'/img/author.png'; ?>" alt="<?php esc_attr( 'TechIT Dev' ); ?>">
        <a href="https://techitdev.com/">Techit Dev</a> are founded in 2019 and connected all around the world. 

        We’ve been working as a professional Website Development, Website Design, Software Development, Mobile App, Digital Marketing, and Search Engine Optimization(SEO) Service Company.
      </p>
      <p >
        <a href="https://www.buymeacoffee.com/techitdev/" target="_blank">
        <img class="" src="<?php print plugin_dir_url (__FILE__) .'/img/bmc.png' ;?>" alt="">
        </a>
      </p>
      </div>
    </div>

    <?php
  }

  // Loading CSS File
  add_action( 'login_enqueue_scripts', 'tidlogin_enqueue_register');
  function tidlogin_enqueue_register() {
    wp_enqueue_style( 'tidlogin_login_enqueue', plugins_url('css/tidlogin-style.css', __FILE__ ), false, '1.0.0');
  }

  // Changing Login form LOGO
  add_action( 'login_enqueue_scripts', 'tidlogin_login_logo_change');

  function tidlogin_login_logo_change() {
    ?>
    <style>
      #login h1 a, .login h1 a {
        background-image: url(<?php print get_option( 'tidlogin-logo-image-url' ); ?>) !important;
        background-size: contain;
      }
      body.login {
        background-image: url(<?php print get_option( 'tidlogin-custom-bg-image' ); ?>) !important;   
      }
      body.login::after {
        opacity: <?php print get_option( 'tidlogin-custom-bg-britness' ); ?> !important;
      }
      .login #login_error,
      .login .message,
      .login .success {
        border-left: 4px solid <?php print get_option( 'tidlogin-primary-color' ); ?> !important;
      }
      input#user_login,
      input#user_pass {
        border-left: 4px solid <?php print get_option( 'tidlogin-primary-color' ); ?> !important;        
      }
      .login #backtoblog a {
        background: <?php print get_option( 'tidlogin-seconday-color' ); ?> !important;
      }
      .login #backtoblog a:hover {
        background: <?php print get_option( 'tidlogin-primary-color' ); ?> !important;
      }
      #login form p.submit input {
      background: <?php print get_option( 'tidlogin-primary-color' ); ?> !important;     
    }
    #login form p.submit input:hover {
      background: <?php print get_option( 'tidlogin-primary-color' ); ?> !important;
    }
    </style>
    <?php
  }

  // Changing Login form logo url
  add_action( 'login_headerurl', 'tidlogin_login_logo_url_change' );

  function tidlogin_login_logo_url_change() {
    return home_url();
  }

  // Plugin Redirect Featire

  register_activation_hook( __FILE__, 'tidlogin_plugin_activation' );

  function tidlogin_plugin_activation(){
    add_option( 'tidlogin_plugin_do_activation_redirect', true );
  }


  add_action( 'admin_init','tidlogin_plugin_redirect');

  function tidlogin_plugin_redirect() {
    if(get_option( 'tidlogin_plugin_do_activation_redirect', false )){
      delete_option( 'tidlogin_plugin_do_activation_redirect' );

      if( !isset( $_GET['active_multi'])){
        wp_safe_redirect( admin_url( 'admin.php?page=tidlogin-login-option' ) );

        exit;

      }
    }
  }
?>