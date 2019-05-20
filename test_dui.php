<?php

// Takes a character like 'a'
// And an alphabet array('A', 'B', 'C',...,'Z')
// And a direction -1 = backward & 1 = forward
// returns an array like this (Forward from A):
// array(1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1);
function BuildInputArray($char, $alphabet, $direction){
    $char = array_search(strtoupper($char), $alphabet); // find char in array
    $input = '';
    
    // Prepend -1's
    if($char > 0){
        $input = str_repeat('-1 ', $char); // -1's
    }
    
    $input .= '1 '; // Add 1 at char position
    
    // Append -1's
    if($char < 25){
        $input .= str_repeat('-1 ', (26 - $char) - 1);
    }

    // Convert string to array
    $input = array_filter(explode(' ', $input));
    
    // Add direction to the beginning of the array
    array_unshift($input, $direction);
    return $input;
}



// DON'T TOUCH!!! /////////////////
/**/ $alphabet = range(chr(65), chr(90)); // A - Z
////////////////////////////////////

////////////////////////////////////
//// Okay to touch but don't get it greasy!
/**/
/**/ $direction = '1'; // -1 = backward & 1 = forward
/**/ $char = strtoupper('a'); // A
/**/ $stop_char = strtoupper('z'); // Z
///////////////////////////////////

// Load ANN
$train_file = (dirname(__FILE__) . "/dui.net");
if (!is_file($train_file))
    die("The file dui.net has not been created! Please run train_dui.php to generate it" . PHP_EOL);
$ann = fann_create_from_file($train_file);
if ($ann) {
    echo $char . PHP_EOL;
    
    // While the bot hasn't output the expected last char
    while($char != $stop_char){
        $calc_out = fann_run($ann, BuildInputArray($char, $alphabet, $direction)); // Run ANN        
        $max = max($calc_out); // Figure out which value was the largest
        $NextChar = array_search($max, $calc_out); // determine which output neuron returned $max
        $char = $alphabet[$NextChar]; // determine which char that neuron is correlated with
        echo $char . PHP_EOL;         // echo the value
    }
	
    // Destroy ANN
    fann_destroy($ann);
} else {
    die("Invalid file format" . PHP_EOL);
}
