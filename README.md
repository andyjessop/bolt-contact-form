# Contact Form

An AJAX contact form for Bolt CMS. Uses Bootstrap 3 form syntax out of the box.

## Installation

Create the extension folder and clone the repository. From the your installation root:

    mkdir extensions/local
    mkdir extensions/local/andyjessop && cd extensions/local/andyjessop
    git clone https://github.com/andyjessop/bolt-contact-form.git
    
Add your config. Within Bolt, go to Extras > Configure Extensions > contact-form-backend.andyjessop.yml, and change the settings:

    email: The email that you want the contact form sent to
    submject: The subject line of the form
    
To customise the actual email template, go to `assets/email.twig` and put what you want in there.

To customise the form markup, use `assets/contact-form.twig`.


## Todo

* Create Twig function for front-end form with relevant js assets ✓
* Create Twig template for email ✓
* Move configuration to config.yml ✓


## Changelog

v1.1.0

* Added Twig function for front end form
* Added js assets
* Added Twig template for email
* Moved configuration to config.yml
