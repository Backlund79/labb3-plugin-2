<?php

/**
* ACF Options page
*/

add_action('acf/init', 'seven_options');
    function seven_options()
    {
        acf_add_options_page('777 Options');
    }
