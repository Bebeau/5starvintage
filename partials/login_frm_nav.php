<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/login_frm_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/login_frm_above_title.php');
}
?>
            
<form name="loginform" id="loginform" action="<?php global $General; echo $General->get_url_login(site_url('/?ptype=login')); ?>" method="post">
  <fieldset>
        <div>
          <label for="user_login">Username</label>
          <input type="text" name="log" id="user_login" class="input-block-level" value="<?php echo esc_attr($user_login); ?>" placeholder="username" />
          <label for="user_pass">Password <a id="LostPassword" class="lostpassword" role="button" data-toggle="modal" href="#NewPassword">forgot?</a> </label>
          <input type="password" name="pwd" id="user_pass" class="input-block-level" value="" placeholder="password" />
          <?php do_action('login_form'); ?>
        </div>
        
        <div class="row-fluid">
          <div class="span6">
            <button onclick="return chk_form_login();" type="submit" name="wp-submit" id="LoginButton" class="btn btn-primary btn-block" >Login</button>
            <!--<button id="FacebookLoginButton" class="btn btn-facebook" onclick="doLogin();return false;">
              <i class="facebook-icon"></i>
            </button>-->
          </div>
          <div class="span6">
            <label for="rememberme" id="Remember" class="checkbox rememberme">
                <input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me
            </label>
          </div>
        </div>

        <hr>
        <p class="centered">
          Don't have an account?
          <a id="RegisterButton" role="button" data-toggle="modal" href="<?php echo site_url('/my-account'); ?>" >Register</a>
        </p>

        <p class="clearfix"></p>

        <?php
          if(strstr($_SESSION['redirect_page'],'/checkout'))
            {
              $login_redirect_link = site_url('/cart');
              //session_unregister(redirect_page);
            }
          else
            {
            global $General;
              $login_redirect_link = $General->get_url_login(site_url('/my-account'));
            }
        ?>

        <input type="hidden" name="redirect_to" value="<?php echo $login_redirect_link; ?>" />
        <input type="hidden" name="testcookie" value="1" />

  </fieldset>
</form>
<!-- login form #end -->

<script type="text/javascript" >
  function chk_form_login()
  {
    if(document.getElementById('user_login').value=='')
    {
      alert('<?php _e('Please enter '.USERNAME_TEXT) ?>');
      document.getElementById('user_login').focus();
      return false;
    }
    if(document.getElementById('user_pass').value=='')
    {
      alert('<?php _e('Please enter '.PASSWORD_TEXT) ?>');
      document.getElementById('user_pass').focus();
      return false;
    }
    //return true;
    document.loginform.submit();
  }
</script>

<p class="clearfix"></p>

<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/login_frm_page_end.php'))
{
	include_once(CHILDTEMPLATEPATH . '/login_frm_page_end.php');
}
?>