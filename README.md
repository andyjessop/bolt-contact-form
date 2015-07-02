Contact Form
============

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

    Response Code: 402 Bad Request
    Message: Individual error messages for incorrect fields

    Response Code: 500
    Message: "Could not send message"