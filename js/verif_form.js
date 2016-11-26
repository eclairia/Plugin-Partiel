document.getElementById("formsubscribe").onsubmit = function(event)
{
	if(document.getElementById("widget-widget-inscription-4-login").value == "")
	{
		event.preventDefault();
		return alert("Veuillez renseigner le champs login svp");
	}

	else if(document.getElementById("widget-widget-inscription-4-mdp").value == "")
	{
		event.preventDefault();
		return alert("Veuillez renseigner le champs mot de passe svp");
	}

	else if(document.getElementById("widget-widget-inscription-4-email").value == "")
	{
		event.preventDefault();
		return alert("Veuillez renseigner le champs email svp");
	}

	else if(document.getElementById("widget-widget-inscription-4-pseudo").value == "")
	{
		event.preventDefault();
		return alert("Veuillez renseigner le champs pseudo svp");
	}			
}