<?php

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
		echo 'Un user a bien été inséré';

		//Envoi du mail
		require_once(plugin_dir_path(__FILE__)."send_mail.php");
		wp_mail($to, $subject, $message);
	}

	else
	{
		echo 'Veuillez refaire la démarche svp, une erreur technique est survenue';
	}