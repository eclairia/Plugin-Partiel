document.getElementById("formsubscribe").onsubmit = function(event)
{
	if(document.getElementById("widget-widget-subscribe-2-login").value == "")
	{
		event.preventDefault();
		return alert("Please, fill the field login");
	}

	else if(document.getElementById("widget-widget-subscribe-2-password").value == "")
	{
		event.preventDefault();
		return alert("Please, fill the field password");
	}

	else if(document.getElementById("widget-widget-subscribe-2-email").value == "")
	{
		event.preventDefault();
		return alert("Please, fill the field email");
	}

	else if(document.getElementById("widget-widget-subscribe-2-pseudo").value == "")
	{
		event.preventDefault();
		return alert("Please, fill the field pseudo");
	}			
}