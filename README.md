# Contact Form

An endpoint for AJAX-posting a contact form. In extension.php, set your email and subject line.

### Endpoint

    POST /api/forms/contact

### Payload

	{
		"name": "name",
		"email": "email",
		"message": "message"
	}

Successful Response

    200 { "success": "Message Sent!" }

Failure Responses

    {
		"errors":
			{
				"Message": message
			}
    }

    Response Code: 400 Bad Request
    Message: Individual error messages for incorrect fields

    Response Code: 500
    Message: "Could not send message"

So, in your website javascript, you'll need something like this:

	// POST to form backend
	$.ajax({
	    type:"POST",
	    data: form.serialize(),
	    url: 'api/forms/contact',
	    success: function(data){
	        handleFormSuccess();
	    },
	    error: function(error){
	        handleFormError();
	    } 
	});

## Todo

* Create Twig function with relevant js assets
* Move configuration to config.yml