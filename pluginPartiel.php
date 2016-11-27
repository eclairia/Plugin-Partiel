<?php

/*
Plugin Name: Plugin Partiel
Plugin URI:  https://developer.wordpress.org/plugins/pluginPartiel/
Description: Ce code permet l'inscription d'un utilisateur ainsi que l'envoi d'un mail à l'administrateur lorsque l'utilisateur est inscrit.
Version:     20161109
Author:      Adrien Jourdier
Domain Path: /languages
Text Domain: wp_langue
*/

defined( 'ABSPATH' )
 or die ( 'No direct load !' );

 function wp_languages_init()
{
    load_plugin_textdomain('wp_langue', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');
}

add_action('plugins_loaded', 'wp_languages_init');

//Fonction qui appelle les fichiers css et js
function scripts()
{
    wp_register_style( 'style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_style('style');	
 	wp_enqueue_script('js', plugins_url('js/verif_form.js', __FILE__), array(), '1.0', true);
}

add_action("wp_enqueue_scripts", "scripts");

add_action( 'plugins_loaded', 'wp_languages_init');

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

			"classname" => "form_subscribe",
			"description" => "Widget which display a subscribe form in the sidebar", "wp_langue",

			);
		WP_Widget::__construct("widget-subscribe", "Subscribe widget", $options);
	}

	//Fonction qui permet l'affichage des données dans la sidebar
	function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;
		echo $before_title . $instance["title"] . $after_title;
		?>

		<form method="POST" action="" id="formsubscribe">

			<label for="<?= $this->get_field_id("login"); ?>"><?php _e('Login:','wp_langue'); ?></label>
			<input type="text" name="login" id="<?= $this->get_field_id("login"); ?>"><br /><br />
			<label for="<?= $this->get_field_id("password"); ?>"><?php _e('Password:' , 'wp_langue'); ?></label>
			<input type="password" name="password" id="<?= $this->get_field_id("password"); ?>"><br /><br />
			<label for="<?= $this->get_field_id("email"); ?>"><?php _e('Email:' , 'wp_langue'); ?></label>
			<input type="email" name="email" id="<?= $this->get_field_id("email"); ?>"><br /><br />
			<label for="<?= $this->get_field_id("pseudo"); ?>"><?php _e('Pseudo:' , 'wp_langue'); ?></label>
			<input type="text" name="pseudo" id="<?= $this->get_field_id("pseudo"); ?>"><br /><br />

			<input type="hidden" name="securite_nonce" value="<?php echo wp_create_nonce('securite-nonce'); ?>"/>

			<input type="submit" value="S'inscrire" id="submit-form" name="verif_submit_subscribe_form"><br /><br />

		</form>	

		<?php require_once(plugin_dir_path(__FILE__)."inc/admin/verif_form.php"); ?>		

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
			<label for="<?= $this->get_field_id("title"); ?>">Titre: </label>
			<input type="text" name="<?= $this->get_field_name("title"); ?>" id="<?= $this->get_field_id("title"); ?>">
			
		</p>

		<?php
	}
}