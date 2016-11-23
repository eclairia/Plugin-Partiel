<?php		

	$to = 'adrien.jourdier@gmail.com';
	$subject = 'Dernier utilisateur inscrit sur le site';
	$message = "Test";

	wp_mail($to, $subject, $message);
	remove_filter( 'wp_mail_content_type', 'get_mail_html' );

	function get_mail_html()
	{
			 return 'text/html';
	}

	add_filter( 'wp_mail_content_type', 'get_mail_html' );