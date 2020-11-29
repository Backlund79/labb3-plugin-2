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

add_action('woocommerce_before_cart', array($object_check_string, 'check_string'));

class Is_seven
{
    public $string_to_check = '';
   
    public function set_string_to_check($string_to_check)
    {
        $this->string_to_check = sanitize_text_field($string_to_check);
    }
    public function get_string_to_check()
    {
        return $this->string_to_check;
    }
   

    public function check_string()
    {
        ?>
<form action="" method="post">
    <input type="text" name="user_entered_string" id="" placeholder="Enter text">
    <input type="submit">
</form>
<?php
if (strlen($this->get_string_to_check()) === 7) {
            echo 'string is 7 long';
        } else {
            if ($this->get_string_to_check()) {
                echo 'string is not 7 long';
            }
        }
    }
}

$obj_str = isset($_POST['user_entered_string']) ? $_POST['user_entered_string'] : '' ;
$object_check_string->set_string_to_check($obj_str);
