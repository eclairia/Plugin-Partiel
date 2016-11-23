<?php

	function form_subscribe()
	{
		echo "<form action='' method='POST'>";

			echo "<label>Login</label><input type='text' name='login' id='login'>";
			echo "<label>Mot de passe</label><input type='password' name='mdp' id='mdp'>";
			echo "<label>Adresse mail</label><input type='email' name='email' id='email'>";
			echo "<label>Pseudo</label><input type='text' name='pseudo' id='pseudo'>";
			echo "<input type='submit' name='submit'>";

		echo "</form>";

		var_dump($_POST);
	}

	add_action('the_content', 'form_subscribe');

	require_once(plugin_dir_path(__FILE__)."../model/insert_users.php");

	add_action('wp', 'insert_users');