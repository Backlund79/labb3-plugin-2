<?php
/**
* Plugin Name: Lucky Seven 777
* Author: Emil
*/

register_activation_hook(__FILE__, 'check_for_lucky_seven_validator');
function check_for_lucky_seven_validator()
{
    if (is_plugin_active('labb3-plugin-4/lucky-seven-check.php')) {
        add_action('update_option_active_plugins', 'deactivate_lucky_seven_validator');
    }
}
function deactivate_lucky_seven_validator()
{
    deactivate_plugins('labb3-plugin-4/lucky-seven-check.php');
}


$object_check_string = new Is_seven;

// add_action('woocommerce_before_cart', array($object_check_string, 'check_string'));

class Is_seven
{
    public $string_to_check = '';
   
    public function set_string_to_check($string_to_check)
    {
        $this->string_to_check = $string_to_check;
    }
    public function get_string_to_check()
    {
        return $this->string_to_check;
    }
   
    public function check_string()
    {
        if ('GET' == $_SERVER['REQUEST_METHOD'] && !empty($_GET['action'])) {

            // Do some minor form validation to make sure there is content
            if (isset($_GET['user_entered_string'])) {
                $this->string_to_check =  sanitize_text_field($_GET['user_entered_string']);
            } else {
                echo 'Please enter a string';
            }
           
            if (strlen($this->get_string_to_check()) === 7) {
                echo 'string is 7 long';
            } else {
                if ($this->get_string_to_check()) {
                    echo 'string is not 7 long';
                }
            }
        }
    }
}


    // $obj_str = isset($_POST['user_entered_string']) ? $_POST['user_entered_string'] : '' ;
// $object_check_string->set_string_to_check($obj_str);

?>

<form
    action="<?php echo admin_url("admin-ajax.php")?>"
    method="">
    <input type="hidden" name="action" value="user_validation">
    <input required type="text" name="user_entered_string" id=""
        placeholder="Enter string to check if its seven characters long">
    <input type="submit">
</form>

<?php

    add_action('wp_ajax_user_validation', array($object_check_string, 'check_string'));
    add_action('wp_ajax_nopriv_user_validation', array($object_check_string, 'check_string'));
