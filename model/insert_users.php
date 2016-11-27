<?php

	function wpdocs_set_html_mail_content_type()
	{
			 return 'text/html';
	}

	remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
	add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );		

	//Récupérartion des informations du formulaire
	$login = htmlspecialchars($_POST['login']);
	$password = htmlspecialchars($_POST['password']);
	$email = htmlspecialchars($_POST['email']);
	$pseudo = htmlspecialchars($_POST['pseudo']);

	$insert_users = array(
		'user_login' => $login,
		'user_pass' => $password,
		'user_nicename' => $pseudo,
		'user_email' => $email,
		'display_name' => $pseudo
	);

	if(wp_insert_user($insert_users))
	{
		echo "<p>". _e('A user was well inserted' , 'wp_langue') . "</p>";

		//require_once(plugin_dir_path(__FILE__)."send_mail.php");

		//Envoi d'un email pour l'admin
		$to_admin = get_bloginfo("admin_email");
		$subject_admin = "Dernier utilisateur inscrit";
		$message_admin = "Le dernier utilisateur inscrit :  Login : ".$login." Mot de passe : Silence is golden "." E-mail : ".$email."  Pseudo : ".$pseudo;

		wp_mail($to_admin, $subject_admin, $message_admin);

		//Envoi un email pour l'utilisateur
		$to_user = $email;
		$subject_user = 'Confirmation de votre inscription';
		$message_user = "Merci de vous être inscrit." . "Rappel de vos informations: " . " Login : ".$login." Mot de passe : Silence is golden "." E-mail : ".$email."  Pseudo : ".$pseudo;

		wp_mail($to_user, $subject_user, $message_user);
	}

	else
	{
		echo "<p>". _e('Technical issue, please, try again' , 'wp_langue') . "</p>";
	}