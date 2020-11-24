<?php
/**
* Plugin Name: Lucky Seven 777
* Author: Emil
*/

// require 'acf-field-data.php';


$object_check_string = new Is_seven;

// $sanitized_string = sanitize_text_field($_POST["user_entered_String"]);
// var_dump($_POST["user_entered_String"]);
// $object_check_string->set_string_to_check($sanitized_string);

do_action('woocommerce_before_shop_loop_item', array($object_check_string, 'check_string'));

class Is_seven
{
    public $string_to_check;

    public function __construct()
    {
        self::check_form();
    }

    public function set_string_to_check($string_to_check)
    {
        $this->string_to_check = $string_to_check;
    }
    public function get_string_to_check()
    {
        return $this->string_to_check;
    }
    public function check_form()
    {
        if (! $this->string_to_check) {
            echo '<form action="777.php" method="post">
      <input type="text" name="user_entered_string" id="" placeholder="Enter text">
      <input type="submit" value="Submit">
      </form>';
        } elseif (strlen($string_to_check) === 7) {
            echo "<p>String is seven characters long</p>";
        } else {
            echo "<p>String is <b>NOT</b> seven characters long</p>";
        }
    }
}
