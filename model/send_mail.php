<?php	

	$login = htmlspecialchars($_POST['login']);
	$mdp = htmlspecialchars($_POST['mdp']);
	$email = htmlspecialchars($_POST['email']);
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$to = get_bloginfo("admin_email");
	$subject = 'Dernier utilisateur inscrit sur le site';
	$message = "Le dernier utilisateur inscrit :  Login : ".$login." Mot de passe : ".$mdp." E-mail : ".$email."  Pseudo : ".$pseudo;
	wp_mail($to, $subject, $message);

	
	remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

	function wpdocs_set_html_mail_content_type()
	{
			 return 'text/html';
	}

	add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );