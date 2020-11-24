<?php
/**
* Plugin Name: Lucky Seven 777
* Author: Emil
*/

require 'acf-field-data.php';

$object_check_string = new Is_seven;

do_action('woocommerce_before_shop_loop_item', array($object_check_string, 'check_string'));

class Is_seven
{
    public $string_to_check;

    public function check_string($string_to_check)
    {
        if (strlen($string_to_check) === 7) {
            echo "<p>String is seven characters long</p>";
        } else {
            echo "<p>String is <b>NOT</b> seven characters long</p>";
        }
    }
}

?>
<form action="777.php" method="post">
<input type="text" name="user_entered_string" id="" placeholder="Enter text">
<input type="submit" value="Submit">
</form>