<?php

/*
Plugin Name: Plugin Partiel
Plugin URI:  https://developer.wordpress.org/plugins/pluginPartiel/
Description: Ce code permet l'inscription d'un utilisateur ainsi que l'envoi d'un mail à l'administrateur lorsque l'utilisateur est inscrit.
Version:     20161109
Author:      Adrien Jourdier
Author URI:  https://developer.wordpress.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

//Page de base de mon plugin qui fait les require et appelle les fichiers css et js
function scripts()
{
    wp_register_style( 'style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_style('style');	
  wp_enqueue_script('js', plugins_url('js/verif_form.js', __FILE__), array(), '1.0', true);
}

add_action("wp_enqueue_scripts", "scripts");

add_action("widgets_init", "form_subscribe2");

function form_subscribe2()
{
	register_widget("widget_form_subscribe2");
}

class widget_form_subscribe2 extends WP_widget
{
	function widget_form_subscribe2()
	{
		$options = array(

			"classname" => "formulaire_inscription",
			"description" => "Widget qui affiche un formulaire d'inscription dans la barre latérale",

			);
		WP_Widget::__construct("widget-inscription", "Widget d'inscription", $options);
	}

	//Fonction qui permet l'affichage des données dans la sidebar
	function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;
		echo $before_title . $instance["titre"] . $after_title;
		?>

		<form method="POST" action="" id="formsubscribe">

			<label for="<?= $this->get_field_id("login"); ?>">Login: </label>
			<input type="text" name="login" id="<?= $this->get_field_id("login"); ?>"><br /><br />
			<label for="<?= $this->get_field_id("mdp"); ?>">Mot de passe: </label>
			<input type="password" name="mdp" id="<?= $this->get_field_id("mdp"); ?>"><br /><br />
			<label for="<?= $this->get_field_id("email"); ?>">Email: </label>
			<input type="email" name="email" id="<?= $this->get_field_id("email"); ?>"><br /><br />
			<label for="<?= $this->get_field_id("pseudo"); ?>">Pseudo: </label>
			<input type="text" name="pseudo" id="<?= $this->get_field_id("pseudo"); ?>"><br /><br />

			<?php //wp_nonce_field(); ?>

			<input type="submit" value="S'inscrire" id="submit-form">

		</form>

		<?php 

			var_dump($_POST);
			/*if(!wp_verify_nonce($_POST['_wpnonce']))
			{
				die("Mauvais nonce");
			}*/	

			if(empty($_POST['login']))
			{
				echo "<p>Veuillez renseigner le champs login svp</p>";
			}

			else if(empty($_POST['mdp']))
			{
				echo "<p>Veuillez renseigner le champs mot de passe svp</p>";
			}	

			else if(empty($_POST['email']))
			{
				echo "<p>Veuillez renseigner le champs e-mail svp</p>";
			}

			else if(empty($_POST['pseudo']))
			{
				echo "<p>Veuillez renseigner le champs pseudo svp</p>";
			}

			else
			{
				require_once(plugin_dir_path(__FILE__)."model/insert_users.php");
				//add_action("wp", "insert_users");					
				echo "<p>Les données ont été entregistré, vous allez recevoir un mail de confirmation</p>";
			}										
		?>			

		<?php
		echo $after_widget;
	}

	//Fonction qui permet de sauvegarder les données du widget
	function update($new, $old)
	{
		return $new;
	}

	function form($instance)
	{
		?>

		<p>
			<label for="<?= $this->get_field_id("titre"); ?>">Titre: </label>
			<input type="text" name="<?= $this->get_field_name("titre"); ?>" id="<?= $this->get_field_id("titre"); ?>">
			
		</p>

		<?php
	}
}
