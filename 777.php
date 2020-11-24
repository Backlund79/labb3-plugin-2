<?php
/**
* Plugin Name: Lucky Seven 777
* Author: Emil
*/

// require 'acf-field-data.php';


$object_check_string = new Is_seven;
// $object_check_string->set_string_to_check($_POST("user_entered_string"));

add_action('woocommerce_before_cart', array($object_check_string, 'check_string'));

class Is_seven
{
    public $string_to_check;
    public $clean_string;
   
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
        echo $string_to_check;
    }
}
?>

<form action="" method="post">
  <input type="text" name="user_entered_string" id="" placeholder="Enter text">
  <input type="submit">
</form>



