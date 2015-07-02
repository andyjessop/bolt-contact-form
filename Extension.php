<?php

namespace Bolt\Extension\AndyJessop\ContactForm;

use Bolt\Application;
use Bolt\BaseExtension;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Extension extends BaseExtension
{
  
	const EMAIL = "andy@andyjessop.com";
	const SUBJECT = "New contact form submission";

    public function initialize() {

    	$this->app->post('api/forms/contact', array($this, 'handleContactFormSubmission'))
            ->bind('handleContactFormSubmission');
    }

    public function getName()
    {
        return "Contact Form";
    }

    public function handleContactFormSubmission(Request $request)
    {

    	// Retreive data
        $name = $request->get('name');
        $email = $request->get('email');
        $message = $request->get('message');

        $validation = $this->validateFields($name, $email, $message);

        if (count($validation) > 0)
        {
        	$response = $this->app->json(array(
        		'errors' => $validation
        	), 401);
        	return $response;
        }

       	// Build body
       	$body = 
       		"From: " . $name . "\n" .
       		"Email: " . $email . "\n" .
       		"Message: " . $message . "\n";

    	// Send Email
    	$message = \Swift_Message::newInstance()
            ->setSubject(Extension::SUBJECT)
            ->setFrom(Extension::EMAIL)
            ->setBody($body)
            ->setTo(Extension::EMAIL);

        if ($this->app['mailer']->send($message)) {
            $this->app['logger.system']->info("Sent Contact Form notification to {Extension::EMAIL} <{Extension::EMAIL}>", array('event' => 'extensions'));
            
            $response = $this->app->json(array(
            	'message' => 'Message Sent!'
            ), 200);

        } else {
            $this->app['logger.system']->info("Failed Contact Form notification to {Extension::EMAIL} <{Extension::EMAIL}>", array('event' => 'extensions'));
        	
        	$response = $this->app->json(array(
            	'message' => 'Could not send email'
            ), 500);
        	
        }

        return $response;
    }

    private function validateFields($name, $email, $message)
    {
    	$errors = [];

    	if (strlen($name) < 1)
    	{
    		$error = 'The name field is required';
    		array_push($errors, $error);
    	}

    	if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]/", $email))
    	{
    		$error = 'The email field is invalid';
    		array_push($errors, $error);
    	}

    	if (strlen($message) < 1)
    	{
    		$error = 'The message field is required';
    		array_push($errors, $error);
    	}

    	return $errors;

    }

}






