<?php
	// The super-lazy checking for errors bit
	$errors = array();

	if (!isset($_POST['name'])) {
		$errors['name'] = 'Please enter your name';
	}

	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Please enter a valid email address';
	}

	if (!isset($_POST['massage'])) {
		$errors['massage'] = 'Please enter your message';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}


	// The super-lazy send mail bit
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['massage'];
	$from = $email;
	$to = 'blackberryfair@talktalk.net';
	$subject = 'Blackberryfair.co.uk Contact Form';

	$body = "From: $name\n E-Mail: $email\n Message:\n $message";


	$result = '';
	if (mail ($to, $subject, $body)) {
		$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Thank you! Your message has been sent.';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Whoops, something went wrong. Please try again later!';
	$result .= '</div>';

	echo $result;
