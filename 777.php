<?php
/**
* Plugin Name: Lucky Seven 777
* Author: Emil
*/

// require 'acf-field-data.php';


$object_check_string = new Is_seven;


do_action('woocommerce_before_shop_item', array($object_check_string, 'clean_string_and_obj'));

class Is_seven
{
    public $string_to_check;
    public $clean_string;

    public function __contruct()
    {
        self::clean_string_and_obj();
    }

    public function set_string_to_check($string_to_check)
    {
        $this->string_to_check = $string_to_check;
    }
    public function get_string_to_check()
    {
        return $this->string_to_check;
    }
    public function clean_string_and_obj()
    {
        $clean_string->sanitize_text_field($_POST["user_entered_string"]);
        $this->set_string_to_check($clean_string);

        if (! $this->get_string_to_check()) {?>
<form
  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
  method="post">
  <input type="text" name="user_entered_string" id="" placeholder="Enter text">
  <input type="submit">
</form>
<?php
           } elseif (strlen($this->get_string_to_check()) === 7) {
               echo 'String is exactly 7 characters long';
           } else {
               echo 'string is <b>NOT</b> exactly 7 characters long';
           }
    }
}
