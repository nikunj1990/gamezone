<?php
class Designmodo_registration_form
{

    private $username;
    private $email;
    private $password;
    private $first_name;
	private $estimezone;
	private $esgame;
	private $gamebox;

    function __construct()
    {

        add_shortcode('dm_registration_form', array($this, 'shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'flat_ui_kit'));
    }
	function tz_list() {
	  $zones_array = array();
	  $timestamp = time();
	  foreach(timezone_identifiers_list() as $key => $zone) {
		date_default_timezone_set($zone);
		$zones_array[$key]['zone'] = $zone;
		$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
	  }
	  return $zones_array;
	}
	
	function select_game() {
		global $wpdb;
		$sel="";
		$table1 = $wpdb->prefix . 'iggame';	
		$tableedit = $wpdb->prefix . 'iggamelist';	
			global $wpdb;
			  $team_rec= $wpdb->get_results(
			 "SELECT * FROM $table1"
			);
		 for($i=0;$i<count($team_rec);$i++):
		  echo '<input type="checkbox"  value="'.$team_rec[$i]->id.'" name="gamebox[]"
		  />'.$team_rec[$i]->name.'</br>';
		endfor;

		}	
	
    public function registration_form()
    {

	 	if (is_user_logged_in()) { 
                  
         $current_user = wp_get_current_user();	
          echo 'Welcome '.$current_user ->user_firstname;
		}
	  else{
        ?>

        <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" id="game_register">
            <div class="login-form">
                <div class="form-group">
					<label class="login-field-icon fui-user" for="reg-name">User Name</label>
                    <input name="reg_name" type="text" class="form-control login-field"
                           value="<?php echo(isset($_POST['reg_name']) ? $_POST['reg_name'] : null); ?>"
                          id="reg-name" required/>
					</div>

				<div class="form-group">
					<label class="login-field-icon fui-lock" for="reg-pass">Password</label>
                    <input name="reg_password" type="password" class="form-control login-field"
                           value="<?php echo(isset($_POST['reg_password']) ? $_POST['reg_password'] : null); ?>"
                           id="reg-pass" required/>
                </div>	
                <div class="form-group">
					 <label class="login-field-icon fui-mail" for="reg-email">Email</label>
                    <input name="reg_email" type="email" class="form-control login-field"
                           value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>"
                          id="reg-email" required/>
                </div>

               
				<div class="form-group">
					<label class="login-field-icon fui-user" for="estimezone">TimeZone</label>
                  <select name="estimezone" name="estimezone">
					<option value="0">Please, select timezone</option>
					<?php foreach(self::tz_list() as $t) { 
					if($exp_timezone==$t['zone']) {
					$sel="selected=selected";
					}
					else {
					$sel="";
					}	
					?>
					<option value="<?php print $t['zone'] ?>" <?php echo $sel;?>>
					<?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
					</option>
					<?php } ?>

					</select>	
				  
                    
                </div>
     	<div class="form-group">
		 <label>Favourite Games </label>
         <?php self::select_game();?>
                 
               </div>
	
                <input class="btn btn-primary btn-lg btn-block" type="submit" name="reg_submit" value="Register"/>
				</div>
        </form>
	  
    <?php
	  }
	}

    function validation()
    {

        if (empty($this->username) || empty($this->password) || empty($this->email)) {
            return new WP_Error('field', 'Required form field is missing');
        }

        if (strlen($this->username) < 4) {
            return new WP_Error('username_length', 'Username too short. At least 4 characters is required');
        }

        if (strlen($this->password) < 5) {
            return new WP_Error('password', 'Password length must be greater than 5');
        }

        if (!is_email($this->email)) {
            return new WP_Error('email_invalid', 'Email is not valid');
        }

        if (email_exists($this->email)) {
            return new WP_Error('email', 'Email Already in use');
        }

      

        $details = array('Username' => $this->username,
            'First Name' => $this->first_name,
           
        );

        foreach ($details as $field => $detail) {
            if (!validate_username($detail)) {
                return new WP_Error('name_invalid', 'Sorry, the "' . $field . '" you entered is not valid');
            }
        }

    }

    function registration()
    {

        $userdata = array(
            'user_login' => esc_attr($this->username),
            'user_email' => esc_attr($this->email),
            'user_pass' => esc_attr($this->password),
            'first_name' => esc_attr($this->first_name),
			'estimezone' => esc_attr($this->estimezone),
			'gamebox' => esc_attr($this->gamebox),
        );

        if (is_wp_error($this->validation())) {
            echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
            echo '<strong>' . $this->validation()->get_error_message() . '</strong>';
            echo '</div>';
        } else {
            $register_user = wp_insert_user($userdata);
            if (!is_wp_error($register_user)) {

                echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
                echo '<strong>Registration complete. Goto <a href="' . wp_login_url() . '">login page</a></strong>';
                echo '</div>';
            } else {
                echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
                echo '<strong>' . $register_user->get_error_message() . '</strong>';
                echo '</div>';
            }
			$to= esc_attr($this->email);
			$admin_email = get_option( 'admin_email' ); 
			$blog_title = get_bloginfo('name');
			$message='Your Username is: <b>'.esc_attr($this->username).'</b>';
			$subject= 'Username For '.$blog_title;
		
			$headers .= 'From: '.$blog_title.' '.$admin_email. "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			wp_mail( $to, $subject, $message, $headers); 
        }

    }

    function flat_ui_kit()
    {
        wp_enqueue_style('bootstrap-css', plugins_url('bootstrap/css/bootstrap.css', __FILE__));
        wp_enqueue_style('flat-ui-kit', plugins_url('css/flat-ui.css', __FILE__));

    }

    function shortcode()
    {

        ob_start();

        if (!empty($_POST['reg_submit']) && $_POST['reg_submit']) {
		
            $this->username = $_POST['reg_name'];
            $this->email = $_POST['reg_email'];
            $this->password = $_POST['reg_password'];
            $this->first_name = $_POST['reg_name'];
		    $this->estimezone = $_POST['estimezone'];
            if(!empty($_POST['gamebox'])) $this->gamebox = implode(",",$_POST['gamebox']);

            $this->validation();
            $this->registration();
        }

        $this->registration_form();
        return ob_get_clean();
    }

}

new Designmodo_registration_form;



//////////* Extra Field *////////

add_action('register_form','show_extrafield');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_extra_fields');

function show_extrafield()
{
?>
 
	
	<select name="estimezone" name="estimezone">
    <option value="0">Please, select timezone</option>
    <?php foreach(tz_list() as $t) { 
	    if($exp_timezone==$t['zone']) {
			 $sel="selected=selected";
	    }
		else {
         	$sel="";
		}	
	?>
      <option value="<?php print $t['zone'] ?>" <?php echo $sel;?>>
        <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
      </option>
    <?php } ?>
	
     </select>		
	
<?php
}

function check_fields ( $login, $email, $errors )
{
     global $estimezone;
     $estimezone = $_POST['estimezone'];
	 $gamebox = implode(",",$_POST['gamebox']);
}

function register_extra_fields ( $user_id, $password = "", $meta = array() )
{
    update_user_meta( $user_id, 'estimezone', $_POST['estimezone'] );
	if(!empty($_POST['gamebox'])) update_user_meta( $user_id, 'gamebox', implode(",",$_POST['gamebox']) );
}

 

///////* Backend Edition  *///////// 
 
add_action( 'show_user_profile', 'add_extra_profile' );
add_action( 'edit_user_profile', 'add_extra_profile' );

function add_extra_profile( $user )
{
	
	
function select_game($id) {
		global $wpdb;
		$sel="";
		$table1 = $wpdb->prefix . 'iggame';	
		$tableedit = $wpdb->prefix . 'iggamelist';	
			global $wpdb;
			  $team_rec= $wpdb->get_results(
			 "SELECT * FROM $table1"
			);
		$temp_data= explode(",",get_the_author_meta('gamebox', $id ));
	    
	function objectToArray ($object) {
    if(!is_object($object) && !is_array($object))
        return $object;

    return array_map('objectToArray', (array) $object);
}


	foreach ($team_rec as $key => $obj)
	{
	$flag = '';
	$objtoarr=json_decode(json_encode($obj),TRUE);  

	for($k=0;$k<count($temp_data);$k++):
	if (in_array($temp_data[$k],$objtoarr))
	{
	  $flag = 'checked';
	}
	endfor;
	echo '<input type="checkbox" '. $flag
	. ' value="' . $team_rec[$key]->id
	. '" name="gamebox[]"/>' . $team_rec[$key]->name
	. '</br>';
	} 

		}		
 ?>
        <h3>Game Option fields</h3>

        <table class="form-table">
            <tr>
                <th><label for="estimezone">Timezone</label></th>
                <td><input type="text" name="estimezone" value="<?php echo esc_attr(get_the_author_meta( 'estimezone', $user->ID ));?>" readonly class="regular-text" /></td>
            </tr>
<tr>
     <th><label for="gamebox">Favourite Games</label></th> <td> <?php select_game($user->ID);?> </td>
</tr>			
        </table>
    <?php
}

add_action( 'personal_options_update', 'save_extra_social_links' );
add_action( 'edit_user_profile_update', 'save_extra_social_links' );

function save_extra_social_links( $user_id )
{
    update_user_meta( $user_id,'estimezone', sanitize_text_field( $_POST['estimezone'] ) );
	update_user_meta( $user_id,'gamebox', implode(",",$_POST['gamebox'] ));
  
}

function ematcheslogin( $atts, $content = null ) {
  $current_user = wp_get_current_user();	
 $form="";
	extract( shortcode_atts( array(
      'redirect' => ''
      ), $atts ) );
 
 
	if (!is_user_logged_in()) {
		if($redirect) {
			$redirect_url = $redirect;
		} else {
			$redirect_url = get_permalink();
		}
		$form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url,'label_username' => __( 'Email' )));
	
return '<div class="gm_loginform"><a href="'.site_url().'/register">Not a Member, Register Now</a>'.$form .'</div>

<a href="'.wp_lostpassword_url( get_bloginfo('url') ).'" title="Lost Password">Lost Password</a>';
} 
else{
  return '<div class="gm_loginform">Welcome '.$current_user->user_firstname.'</div>';	
	
}
}
add_shortcode('esloginform', 'ematcheslogin');
