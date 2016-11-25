<?php

	function wpdocs_set_html_mail_content_type()
	{
			 return 'text/html';
	}

	remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
	add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );		

	//Récupérartion des informations du formulaire
	$login = htmlspecialchars($_POST['login']);
	$mdp = htmlspecialchars($_POST['mdp']);
	$email = htmlspecialchars($_POST['email']);
	$pseudo = htmlspecialchars($_POST['pseudo']);

	$insert_users = array(
		'user_login' => $login,
		'user_pass' => $mdp,
		'user_nicename' => $pseudo,
		'user_email' => $email,
		'display_name' => $pseudo
	);

	if(wp_insert_user($insert_users))
	{
		echo '<p>Un user a bien été inséré</p>';

		//Envoi du mail
		//require_once(plugin_dir_path(__FILE__)."send_mail.php");

		$to_admin = get_bloginfo("admin_email");
		$subject_admin = "Dernier utilisateur inscrit";
		$message_admin = "Le dernier utilisateur inscrit :  Login : ".$login." Mot de passe : Silence is golden "." E-mail : ".$email."  Pseudo : ".$pseudo;

		wp_mail($to_admin, $subject_admin, $message_admin);

		$to = $email;
		$subject = 'Confirmation de votre inscription';
		$message = "Merci de vous être inscrit." . "Rappel de vos informations: " . " Login : ".$login." Mot de passe : Silence is golden "." E-mail : ".$email."  Pseudo : ".$pseudo;
		wp_mail($to, $subject, $message);
	}

	else
	{
		echo 'Veuillez refaire la démarche svp, une erreur technique est survenue';
	}