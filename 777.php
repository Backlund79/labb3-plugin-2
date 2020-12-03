<?php
/**
* Plugin Name: Lucky Seven 777
* Author: Emil
*/

// register_activation_hook(__FILE__, 'check_for_lucky_seven_validator');
// function check_for_lucky_seven_validator()
// {
//     if (is_plugin_active('labb3-plugin-4/lucky-seven-check.php')) {
//         add_action('update_option_active_plugins', 'deactivate_lucky_seven_validator');
//     }
// }
// function deactivate_lucky_seven_validator()
// {
//     deactivate_plugins('labb3-plugin-4/lucky-seven-check.php');
// }


$object_check_string = new Is_seven;

add_action('wp_ajax_user_validation', array($object_check_string, 'check_string'));
add_action('wp_ajax_nopriv_user_validation', array($object_check_string, 'check_string'));
add_action('woocommerce_before_cart', 'print_form');

class Is_seven
{
    public $string_to_check;
   
    public function set_string_to_check($string_to_check)
    {
        $this->string_to_check = $string_to_check;
    }
    public function get_string_to_check()
    {
        return $this->string_to_check;
    }
   
    public function is_seven_characters_long()
    {
        if ($this->get_string_to_check()===7) {
            return true;
        } else {
            return false;
        }
    }

    public function check_string()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action'])) {
            // var_dump($_POST);
            // Do some minor form validation to make sure there is content
            if (isset($_POST['user_entered_string'])) {
                $this->string_to_check =  sanitize_text_field($_POST['user_entered_string']);
            } else {
                echo 'Please enter a string';
                wp_die();
            }
            if (strlen($this->get_string_to_check()) === 7) {
                echo '<p style="color:green">string is 7 long </p>';
                wp_die();
            } else {
                if ($this->get_string_to_check()) {
                    echo '<p style="color:red">string is not 7 long </p>';
                    wp_die();
                }
            }
        }
    }
}

function print_form()
{
    ?>
<form id="is_this_seven"
    action="<?php echo admin_url("admin-ajax.php")?>"
    method="POST">
    <input type="hidden" name="action" value="user_validation">
    <input required type="text" name="user_entered_string" id="user_input_value"
        placeholder="Enter string to check if its seven characters long">
    <input id="submit_seven" type="submit">
</form>
<script>
    jQuery('#submit_seven').on('click', function(e) {
        e.preventDefault();

        let string_to_check = jQuery('#user_input_value').val();
        // console.log(user_entered_string) ok

        jQuery.ajax({
            url: 'http://localhost:8888/labb3/wp-admin/admin-ajax.php',
            method: 'POST',
            data: {
                action: 'user_validation',
                user_entered_string: string_to_check
            },
            success: function(res) {
                // console.log(res);
                jQuery("#is_this_seven").after(res);
            }
        })
    })
</script>
<?php
}
