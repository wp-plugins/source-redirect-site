<?php

// Hook for adding admin menus
add_action( 'admin_menu', array('SourceRedirectAdmin', 'add_menu_options') );

// Only execute the code if we are viewing the Source Redirect page
if( $_REQUEST['page'] == 'sourceredirect' ) {
  // Add the css
  wp_register_style  ( 'source-redirect.css', plugins_url().'/source-redirect/assets/source-redirect.css' );
  wp_register_script ( 'jquery.tabs.js', plugins_url().'/source-redirect/assets/jquery.tabs.js' );
  wp_enqueue_style   ( 'source-redirect.css' );
  wp_enqueue_script  ( 'jquery.tabs.js' );
  
    // Footer Left and Right
  add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side

  function left_admin_footer_text_output($text) {
    $text = 'Source Redirect Site, Free Version. Get the Pro Version <a href=\'http://www.presspixels.com/release/source-redirect/\' target=\'_blank\'>Here</a>. Redirect your Site Content based on Browser, Location, Users or Mobile Device.';
    return $text;
  }

  add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side

  function right_admin_footer_text_output($text) {
    $text = 'A <a href=\'http://www.presspixels.com/\' target=\'_blank\'>Press Pixels</a> Plugin, built for WordPress by Lumo and Skashi.';
    return $text;
  }


}

class SourceRedirectAdmin {
  // action function for above hook
  function add_menu_options() {
    $title = 'Source Redirect';
    add_options_page( $title, $title, 'manage_options', 'sourceredirect', array('SourceRedirectAdmin','display'));
  }
  // add variable css

  // display() displays the page content for the Source Redirect settings submenu
  function display() {
    //must check that the user has the required capability
    if ( !current_user_can('manage_options') ) {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    // Declare field names
    $txt_redirect_not_registered_url    = 'redirect_not_registered_url';
    $txt_redirect_mobile_url_all        = 'redirect_mobile_url_all';
    $txt_redirect_mobile_url_android    = 'redirect_mobile_url_android';
    $txt_redirect_mobile_url_blackberry = 'redirect_mobile_url_blackberry';
    $txt_redirect_mobile_url_ipad       = 'redirect_mobile_url_ipad';
    $txt_redirect_mobile_url_iphone     = 'redirect_mobile_url_iphone';
    $txt_redirect_mobile_url_nokia      = 'redirect_mobile_url_nokia';
    $txt_redirect_mobile_url_opera      = 'redirect_mobile_url_opera';
    $txt_redirect_mobile_url_palm       = 'redirect_mobile_url_palm';
    $txt_redirect_mobile_url_windows    = 'redirect_mobile_url_windows';
    $txt_redirect_browser_chrome        = 'redirect_browser_chrome';
    $txt_redirect_browser_firefox       = 'redirect_browser_firefox';
    $txt_redirect_browser_opera         = 'redirect_browser_opera';
    $txt_redirect_browser_safari        = 'redirect_browser_safari';
    $txt_redirect_browser_ie            = 'redirect_browser_ie';
    $txt_redirect_browser_ie6           = 'redirect_browser_ie6';
    $txt_redirect_browser_ie7           = 'redirect_browser_ie7';
    $txt_redirect_browser_ie8           = 'redirect_browser_ie8';
    $txt_redirect_browser_ie9           = 'redirect_browser_ie9';
    $pro_feature_txt                    = 'Pro Feature::Easily upgrade to Pro to enable all the features. Just click on the Upgrade button on the right of the page.';
    $base_url                           = get_bloginfo('wpurl');

    // Declare mobile array of fields
    $mobile_fields = array(
      __("All mobile devices",     'menu-srsadmin' ) => array( $txt_redirect_mobile_url_all,        __( 'Enter the full url of the website you would like to redirect to if <i>Redirect Mobile Devices</i> was set to <i>All Mobile Devices</i>.' ) ),
      __("<span class=\"pro-feature\">Android...</span>",             'menu-srsadmin' ) => array( $txt_redirect_mobile_url_android,    __( 'Enter the full url of the website you would like all Android devices to redirect to. eg. http://www.android.com' ) ),
      __("<span class=\"pro-feature\">Blackberry...</span>",          'menu-srsadmin' ) => array( $txt_redirect_mobile_url_blackberry, __( 'Enter the full url of the website you would like all Blackberry devices to redirect to. eg. http://www.blackberry.com' ) ),
      __("<span class=\"pro-feature\">iPad...</span>",                'menu-srsadmin' ) => array( $txt_redirect_mobile_url_ipad,       __( 'Enter the full url of the website you would like all iPad devices to redirect to. eg. http://www.apple.com' ) ),
      __("<span class=\"pro-feature\">iPhone...</span>",              'menu-srsadmin' ) => array( $txt_redirect_mobile_url_iphone,     __( 'Enter the full url of the website you would like all iPhone devices to redirect to. eg. http://www.apple.com' ) ),
      __("<span class=\"pro-feature\">Nokia...</span>",               'menu-srsadmin' ) => array( $txt_redirect_mobile_url_nokia,      __( 'Enter the full url of the website you would like all Nokia devices to redirect to. eg. http://www.nokia.com' ) ),
      __("<span class=\"pro-feature\">Palm...</span>",                'menu-srsadmin' ) => array( $txt_redirect_mobile_url_palm,       __( 'Enter the full url of the website you would like all Palm devices to redirect to. eg. http://www.palm.com' ) ),
      __("<span class=\"pro-feature\">Windows Mobile...</span>",      'menu-srsadmin' ) => array( $txt_redirect_mobile_url_windows,    __( 'Enter the full url of the website you would like all Windows Phone devices to redirect to. eg. http://www.microsoft.com' ) ),
      __("<span class=\"pro-feature\">Opera Mobile...</span>",        'menu-srsadmin' ) => array( $txt_redirect_mobile_url_opera,      __( 'Enter the full url of the website you would like all Opera browsers to redirect to. eg. http://www.opera.com' ) ) );

    // Declare browser array of fields
    $browser_fields = array(
      __("Google Chrome...",       'menu-srsadmin' ) => array( $txt_redirect_browser_chrome,        __( 'Enter the full url of the website you would like Chrome browsers to redirect to. eg. http://www.google.com' ) ),
      __("Mozilla Firefox...",     'menu-srsadmin' ) => array( $txt_redirect_browser_firefox,       __( 'Enter the full url of the website you would like Mozilla Firefox browsers to redirect to. eg. http://www.mozilla.com' ) ),
      __("Opera...",               'menu-srsadmin' ) => array( $txt_redirect_browser_opera,         __( 'Enter the full url of the website you would like Opera browsers to redirect to. eg. http://www.opera.com' ) ),
      __("Safari...",              'menu-srsadmin' ) => array( $txt_redirect_browser_safari,        __( 'Enter the full url of the website you would like Safari browsers to redirect to. eg. http://www.apple.com' ) ),
      __("Internet Explorer...",   'menu-srsadmin' ) => array( $txt_redirect_browser_ie,            __( 'Enter the full url of the website you would like Internet Explorer browsers to redirect to. eg. http://www.microsoft.com' ) ),
        __("<span class=\"pro-feature\">Internet Explorer 6…</span>", 'menu-srsadmin') => array($txt_redirect_browser_ie6, __('Enter the full url of the website you would like Internet Explorer 6 browsers to redirect to. eg. http://www.microsoft.com')),
        __("<span class=\"pro-feature\">Internet Explorer 7...</span>", 'menu-srsadmin') => array($txt_redirect_browser_ie7, __('Enter the full url of the website you would like Internet Explorer 7 browsers to redirect to. eg. http://www.microsoft.com')),
        __("<span class=\"pro-feature\">Internet Explorer 8...</span>", 'menu-srsadmin') => array($txt_redirect_browser_ie8, __('Enter the full url of the website you would like Internet Explorer 8 browsers to redirect to. eg. http://www.microsoft.com')),
        __("<span class=\"pro-feature\">Internet Explorer 9...</span>", 'menu-srsadmin') => array($txt_redirect_browser_ie9, __('Enter the full url of the website you would like Internet Explorer 9 browsers to redirect to. eg. http://www.microsoft.com')),
        __("<span class=\"pro-feature\">Internet Explorer 10...</span>", 'menu-srsadmin') => array($txt_redirect_browser_ie10, __('Enter the full url of the website you would like Internet Explorer 10 browsers to redirect to. eg. http://www.microsoft.com')));

// Declare user roles array of fields
    $user_fields = array(
        __("Unregistered Users Path…", 'menu-srsadmin') => array($txt_redirect_not_registered_url, __('Enter the full url for None Registered Users')),
        __("<span class=\"pro-feature\">Subscribers…</span>", 'menu-srsadmin') => array($txt_redirect_subscriber_url, __('Enter the full url for Subscribers')),
        __("<span class=\"pro-feature\">Contributors...</span>", 'menu-srsadmin') => array($txt_redirect_contributor_url, __('Enter the full url for Contributors')),
        __("<span class=\"pro-feature\">Authors…</span>", 'menu-srsadmin') => array($txt_redirect_author_url, __('Enter the full url for Authors')),
        __("<span class=\"pro-feature\">Editors…</span>", 'menu-srsadmin') => array($txt_redirect_editor_url, __('Enter the full url for Editors')),
        __("<span class=\"pro-feature\">Administrators…</span>", 'menu-srsadmin') => array($txt_redirect_administrator_url, __('Enter the full url for Administrators')),
        __("<span class=\"pro-feature\">Super Administrators…</span>", 'menu-srsadmin') => array($txt_redirect_super_administrator_url, __('Enter the full url for Super Administrators')));
        
    // Read in existing option value from database
    $hidden_field_name = 'srs_submit_hidden';
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
      update_option( 'redirect_mobile_all',      $_REQUEST['redirect_mobile_all']      );
      update_option( 'redirect_browser_all',     $_REQUEST['redirect_browser_all']     );
      // Loop through each mobile field
      foreach( $mobile_fields as $name => $value ) {
        // Read their posted value
        $opt_name = $value[0];
        $opt_val  = $_REQUEST[$opt_name];
        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
      }
       // Loop through each role field
      foreach ($user_fields as $name => $value) {
        // Read their posted value
        $opt_name = $value[0];
        $opt_val = $_REQUEST[$opt_name];
        // Save the posted value in the database
        update_option($opt_name, $opt_val);
      }
      // Loop through each mobile field
      foreach( $browser_fields as $name => $value ) {
        // Read their posted value
        $opt_name = $value[0];
        $opt_val  = $_REQUEST[$opt_name];
        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
      }
    }
    // Now display the settings editing screen

    ?>
    <div class="wrap" style="margin-top:20px">
      <div id="icon-link" class="icon32"><br /></div>
      <h2>Source Redirect Site</h2>
      <div class="postbox-container" style="width: 67%; margin-right: 2%; margin-top: 20px" >
        <div class="metabox-holder">
          <form name="srsForm" method="post" action="">
            <div class="postbox" id="tabs">
              <h3 class="hndle"><span>Core Settings</span></h3>
              <div class="inside">
              <?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
          		echo '<p class="updated">'.__('Settings have been saved and updated!', 'menu-srsadmin' ).'</p>';
          		} ?>
              <ul class="tabs">
          <li><a href="#tabs-info"><?php _e("Dashboard", 'menu-srsadmin' ); ?></a><span></span></li>
          <li><a href="#tabs-mobile"><?php _e("Mobile Devices", 'menu-srsadmin' ); ?></a><span></span></li>
          <li><a href="#tabs-browser"><?php _e("Browser Specific", 'menu-srsadmin' ); ?></a><span></span></li>
          <li><a href="#tabs-geolocation" title="<?php echo $pro_feature_txt?>"><?php _e("County / State Redirection", 'menu-srsadmin' ); ?></a><span></span></li>
          <li><a style="color: #999" href="#tabs-customredirects" title="<?php echo $pro_feature_txt?>"><?php _e("Custom Redirects", 'menu-srsadmin' ); ?></a><span></span></li>
          <li><a href="#tabs-userroles"><?php _e("User Roles", 'menu-srsadmin'); ?></a></li>
          <li><a style="color: red" href="#tabs-gopro"><?php _e("Upgrade", 'menu-srsadmin'); ?></a></li>
        </ul>
        <div class="tab_container">
          <div id="tabs-info" class="tab_content">
           <div class="clear"></div>
          <p>Source Redirect Site for WordPress is a complete redirection plugin which allows you to set redirection URL addresses for any browser type, mobile device, user location and even user country state.</p>
                    <p>Go through each link above and set your various URL addresses that you require and leave blank the items that do not need to be redirected. Once done, hit the save button and do a force refresh on your website front-end and that should be it! Remember to check the <a href="http://www.presspixels.com/source-redirect-site-wiki-documentation/">Documentation Wiki</a> if you need help.</p>
          
           <ul>
			<li><strong>Mobiles Devices</strong> Set single address for all mobile types or <span class="pro-feature" title="<?php echo $pro_feature_txt?>">for each specific mobile type</span>.</li>
			<li><strong>Browser Specific</strong> Set redirect for browsers and <span class="pro-feature" title="<?php echo $pro_feature_txt?>">versions</span>.</li>
			<li><span class="pro-feature" title="<?php echo $pro_feature_txt?>"><strong>Geo Location</strong></span> Set unique redirect URL&#39;s for any Global Country and US State!</li>
			 
			<li><strong>User Roles</strong> Set redirects based on user registration status <span class="pro-feature">and role.</span></li>
			<li><strong>Custom Redirects</strong> Set redirects for specific pages and posts. <span class="pro-feature">Admin Area Pro Only</span></li>
		   </ul> 
          <hr>
          <p><span class="pro-feature">Redirect Bypass Links are also only available in the Pro Version.</span> If you are having problems with this plugin and need support, please <a href="http://www.presspixels.com/contact/" target="_blank">contact online</a> or alternatively <a href="mailto:hello@presspixels.com">send a mail</a> and we will help sort you out.</p>
          <p class="notice">Items listed above and in this plugin shown in <span class="pro-feature">grey</span> are available in the <a style="color: red" href="http://www.presspixels.com/release/source-redirect-site/">pro version</a> only.</p>  
          </div><!-- end tabs-info div -->
          <div id="tabs-mobile" class="tab_content">
          <div class="clear"></div>
           <table class="form-table">
                      <tbody>
                        <tr valign="top">
                          <th scope="row">
                            <label for="twp_items"><?php _e("Redirect mobile devices", 'menu-srsadmin'); ?></label>
                          </th>
                          <td>
                            <select name="redirect_mobile_all">
                              <option value="0" <?php echo get_option('redirect_mobile_all') == 0 ? 'selected="true"' : '' ?>>Disable Mobile Device Redirection</option>
                              <option value="1" <?php echo get_option('redirect_mobile_all') == 1 ? 'selected="true"' : '' ?>>All Mobile Devices</option>
                            
                            </select>
                          </td>
                        </tr>
						<?php
                        foreach ($mobile_fields as $name => $val) {
                            $value        = $val[0];
                			$disabled_txt = $name == 'All mobile devices'? '': 'disabled="true"';
                			$title_txt    = $name == 'All mobile devices'? '': "title='{$pro_feature_txt}'";
                          echo "
                      		<tr valign='top'>
              							<th scope='row'>
              								<label for='twp_items'>{$name}</label>
              							</th>
              							<td>".SourceRedirectAdmin::makeHtmlFormField( 'text', $value, get_option($value), '50', null, $disabled_txt )."</td>
              						</tr>
              						";
                        }
                        ?>
					</tbody>				
                 </table>
                 <p class="submit"><input type="submit" name="Submit" class="button-save" value="<?php esc_attr_e('Save Changes') ?>" /></p>
          </div><!-- end tabs-mobile div -->
           <div id="tabs-browser" class="tab_content">
           <div class="clear"></div>
           <table class="form-table">
               <tbody>
          			<tr valign="top">
                          <th scope="row">
                            <label for="twp_items"><?php _e("Redirect browser devices", 'menu-srsadmin'); ?></label>
                          </th>
                          <td>
                            <select name="redirect_browser_all">
                              <option value="0" <?php echo get_option('redirect_browser_all') == 0 ? 'selected="true"' : '' ?>>Disable Browser Redirection</option>
                              <option value="1" <?php echo get_option('redirect_browser_all') == 1 ? 'selected="true"' : '' ?>>Enabled Browser Specific as below...</option>
                            </select>
                          </td>
                        </tr>
         			 <?php
                        foreach ($browser_fields as $name => $val) {
                        $value        = $val[0];
                		$disabled_txt = preg_match('/internet\sexplorer\s\d.../i',$name)? 'disabled="true"': '';
                		$title_txt    = preg_match('/internet\sexplorer\s\d.../i',$name)? "title='{$pro_feature_txt}'": '';
                          echo "
                      		<tr valign='top'>
              							<th scope='row'>
              								<label for='twp_items'>{$name}</label>
              							</th>
              							<td>".SourceRedirectAdmin::makeHtmlFormField( 'text', $value, get_option($value), '50', null, $disabled_txt )."</td>
              						</tr>
              						";
                        }
                        ?>

              </tbody>				
             </table>
             <p class="submit"><input type="submit" name="Submit" class="button-save" value="<?php esc_attr_e('Save Changes') ?>" /></p>
          </div><!-- end tabs-browser div -->
          <div id="tabs-geolocation" class="tab_content">
          <div class="clear"></div>
			<p>With the Geo Location feature you can set custom redirects for any Country on earth, plus also custom redirects for every U.S. State. This is only available in the <a href="http://www.presspixels.com/release/source-redirect-site/">pro version</a>, which has also all other <span class="pro-feature">grey</span> unavailable features shown in this plugin.</p>
			 <p>To find out more please visit us at <a href="http://www.presspixels.com">Press Pixels</a> or <a target="_blank" href="http://www.presspixels.com/wordpress-contact-press-pixels-support/" target="_blank">contact us online</a>, or alternatively <a href="mailto:hello@presspixels.com">send a mail</a> and we will help sort you out ASAP!</p>

          </div><!-- end tabs-geolocation div -->
          <div id="tabs-customredirects" class="tab_content">
          <div class="clear"></div>
			<p>With Custom Redirects you can specify specific redirects per page or post on your site using custom fields. You can create custom redirects however list management and other features are only available in the <a href="http://www.presspixels.com/release/source-redirect-site/">pro version</a>, which has also all other <span class="pro-feature">grey</span> unavailable features shown in this plugin.</p>
			 <p>To find out more please visit us at <a href="http://www.presspixels.com">Press Pixels</a> or <a target="_blank" href="http://www.presspixels.com/wordpress-contact-press-pixels-support/" target="_blank">contact us online</a>, or alternatively <a href="mailto:hello@presspixels.com">send a mail</a> and we will help sort you out ASAP!</p>

          </div><!-- end tabs-customredirects div -->
          <div id="tabs-userroles" class="tab_content">
          <div class="clear"></div>
                    <table class="form-table">
                      <tbody>
                      <p>First two options highlighted below are specifically for redirection of none registered site users. Enter the relative URL for non registered users to be redirected to <b>(for example /register/)</b> This will redirect all none registered users to <i>http://www.yoursite.com/register/</i> Recursing this specified path means that (if enabled below - Pro Version) a none registered user can also access for example <i>http://www.yoursite.com/register/info</i> <b>or any next level path.</b></p>
                      <tr valign="top">
                          <th scope="row">
                            <label for="twp_items"><?php _e("<span class=\"pro-feature\">Recurse None Registered Path</span>", 'menu-srsadmin'); ?></label>
                          </th>
                          <td>
                            <select name="recurse_non_reg_dir" disabled="true">
                              <option value="0" <?php echo get_option('recurse_non_reg_dir') == 0 ? 'selected="true"' : '' ?>>No</option>
                              <option value="1" <?php echo get_option('recurse_non_reg_dir') == 1 ? 'selected="false"' : '' ?>>Yes</option>
                            </select>
                          </td>
                        </tr>
                        <?php
                        foreach ($user_fields as $name => $val) {
                          $value = $val[0];
                          $disabled_txt = preg_match('/Unregistered/i',$name)? 'found': '';
                          if ($disabled_txt <> 'found') {
                          echo "
                      		<tr valign='top'>
              							<th scope='row'>
              								<label for='twp_items'>{$name}</label>
              							</th>
              							<td>" .SourceRedirectAdmin::makeHtmlFormField('text', $value, get_option($value), '50', null, $switchvar )."</td>
              						</tr>
              						";
                          } else {
                          $switchvar = "disabled=\"false\"";
                          echo "
                      		<tr valign='top'>
              							<th scope='row'>
              								<label for='twp_items'>{$name}</label>
              							</th>
              							<td>" .SourceRedirectAdmin::makeHtmlFormField('text', $value, get_option($value), '50', null, null)."</td>
              						</tr>
              						";
                        } }
                        ?>
                      </tbody>				
                    </table>
                    <p class="submit"><input type="submit" name="Submit" class="button-save" value="<?php esc_attr_e('Save Changes') ?>" /></p>
                  </div><!-- end tabs-roles div -->
                  <div id="tabs-gopro" class="tab_content">
                  <div class="clear"></div>
                  <p>The Pro version of Source Redirect has many more features including the features not available in this free version (greyed out options). You can <a style="color: red" href="http://www.presspixels.com/release/source-redirect-site/" target="_blank">Upgrade to a Pro license</a> and get a full redirection suite for your WordPress site.</p>
			 <p>To find out more please visit us at <a href="http://www.presspixels.com">Press Pixels</a> or <a target="_blank" href="http://www.presspixels.com/wordpress-contact-press-pixels-support/" target="_blank">contact us online</a>, or alternatively <a href="mailto:hello@presspixels.com">send a mail</a> and we will help sort you out ASAP!</p>

          </div>
                  
                  
                 </div><!-- end tabs-container div -->
              </div>
            </div>
            <div class="clear"></div>
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
          </form>
        </div>
      </div>
      <div class="postbox-container" style="width: 30%; margin-top: 20px" >
        <div class="metabox-holder">
          <div class="postbox">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Looking for Support?</span></h3>
            <div class="inside">
              <p>If you are having problems with this plugin and need support, please <a target="_blank" href="http://www.presspixels.com/wordpress-contact-press-pixels-support/" target="_blank">contact online</a> or alternatively <a href="mailto:hello@presspixels.com">send a mail</a> and we will help sort you out ASAP!</p>
            </div>
          </div>
          <div class="postbox">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Press Pixels Info</span></h3>
            <div class="inside">
              <p>Press Pixels is all over the Web, you can keep focused with all the latest news at any of the Press Pixels pages listed below:</p>
              <p><a target="_blank" href="http://twitter.com/sitesolution" target="_blank">Twitter</a>&nbsp;&nbsp;<a target="_blank" href="http://www.facebook.com/pages/Press-Pixels/343270052366258?sk=wall" target="_blank">Facebook</a>&nbsp;&nbsp;<a target="_blank" href="http://feeds.feedburner.com/presspixels" target="_blank">RSS</a>&nbsp;&nbsp;<a target="_blank" href=“http://www.presspixels.com/release/source-redirect-site/“>Redirect</a>&nbsp;&nbsp;<a target="_blank" href="http://www.presspixels.com" target="_blank">Site</a></dt></p>
            </div>
          </div>
          <div class="postbox">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Latest News from Press Pixels</span></h3>
            <div class="inside">
              <p>Checkout the latest news and updated content from the Press Pixels Team:</p>
              <?php
              // import rss feed
              if (function_exists('fetch_feed')) {
                $rss = fetch_feed('http://feeds.feedburner.com/presspixels');
                if (!is_wp_error($rss)) : // error check
                  $maxitems = $rss->get_item_quantity(5); // number of items
                  $rss_items = $rss->get_items(0, $maxitems);
                endif;
                ?>
                <ul>
                         <?php if ($maxitems == 0)
                           echo '<dt>Updating... more news soon!</dt>';
                         else
                           foreach ($rss_items as $item) : ?>
                      <li>
                        <a target="_blank" href="<?php echo $item->get_permalink(); ?>" 
                           title="<?php echo $item->get_date('j F Y @ g:i a'); ?>">
          <?php echo $item->get_title(); ?>
                        </a>
                      </li>
        <?php endforeach; ?>
                </ul>
    <?php } ?>
            </div> 
          </div>
        </div>
      </div>
      
      <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
    </form>
  </div><!-- end wrap div -->
  <?php
  }
  /*
   * Function that creates an html textbox
   */
  function makeHtmlFormField( $type, $name, $value='', $size=50, $label='', $extra='' ) {
    $html_text = '';
    switch( $type ) {
      case 'text':
        $html_text .= "<input type='{$type}' name='{$name}' value='{$value}' size='{$size}' {$extra} />";
        break;
      case 'checkbox':
        $checked = $value == 1? "checked='true'": '';
        $html_text .= "&nbsp;<input type='{$type}' name='{$name}' value='1' {$checked} {$extra} class='checkbox' />&nbsp;{$label}";
        break;
    }
    return $html_text;
  }
}
?>