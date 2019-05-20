<?php
$num_input = 27;
$num_output = 26;
$num_layers = 3;
$num_neurons_hidden = 16;
$desired_error = 0.00001;
$max_epochs = 500000;
$epochs_between_reports = 10;
$ann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);
if ($ann) {
	
	// Configure the ANN
	fann_set_training_algorithm ($ann , FANN_TRAIN_RPROP);
	fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
	fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);
	
	// Train ANN
	$filename = dirname(__FILE__) . "/DUI.data";
	if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error)) {
		print('DUI trained.' . PHP_EOL);
	}
	
	// Save ANN
	if (fann_save($ann, dirname(__FILE__) . "/dui.net")){
		echo 'dui.net saved. run: php test_dui.php' . PHP_EOL;
	}
	
	// Destroy ANN
	fann_destroy($ann);
}
