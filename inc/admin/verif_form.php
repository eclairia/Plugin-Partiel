<?php 

	//var_dump($_POST);

	if(isset($_POST['securite_nonce']))
	{
		if(wp_verify_nonce($_POST['securite_nonce'], 'securite-nonce'))
		{
			if(empty($_POST['login']))
			{
				echo "<p>". _e('Please, fill the field login' , 'wp_langue') . "</p>";
			}

			else if(empty($_POST['password']))
			{
				echo "<p>". _e('Please, fill the field password' , 'wp_langue') . "</p>";
			}	

			else if(empty($_POST['email']))
			{
				echo "<p>". _e('Please, fill the field email' , 'wp_langue') . "</p>";
			}

			else if(!is_email($_POST['email']))
			{
				echo "<p>". _e('Please, fill the field login' , 'wp_langue') . "</p>";
			}


			else if(empty($_POST['pseudo']))
			{
				echo "<p>". _e('Please, fill the field pseudo' , 'wp_langue') . "</p>";
			}

			/*else if(!empty($_POST['email']))
			{
				global $wpdb;
				$tests = $wpdb->get_results("SELECT user_email FROM $wpdb->users");
				//var_dump($tests);

				foreach($tests as $test)
				{
					if($_POST['email'] == $test->user_email)
					{
						//var_dump($test->user_email);
						echo "<p>Cet email existe déjà dans notre base de données</p>";
						return false;
					}
				}					
			}*/			

			else
			{
				require_once(plugin_dir_path(__FILE__)."../../model/insert_users.php");
				//add_action("wp", "insert_users");					
				echo "<p>". _e('The data were recorded, you go to receive an e-mail of confirmation' , 'wp_langue') . "</p>";
			}
		}

		else
		{
			echo '<p>Problème de nonce</p>'; 
			exit;
		}
	}							