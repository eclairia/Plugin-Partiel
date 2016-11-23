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
    wp_enqueue_script('js', plugins_url('js/verif_form.js', __FILE__));
}

//Permet de require la page form_subscribe.php
require_once(plugin_dir_path(__FILE__)."view/form_subscribe.php");
