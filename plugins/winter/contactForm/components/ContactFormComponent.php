<?php

namespace Winter\Contactform\Components;

use Cms\Classes\ComponentBase;

class ContactFormComponent extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Contact Form',
            'description' => 'Displays a contact form and processes form submissions.'
        ];
    }

    public function onRun()
    {
        // You can load data or handle form submissions here if necessary
    }

    public function onSubmit()
    {
        $name = post('name');
        $email = post('email');
        $message = post('message');
        $phone = post('phone');

        // Validate fields
        if (empty($name) || empty($email) || empty($message)) {
            return ['#form-result' => 'All fields are required.'];
        }

        // Send email (example)
        $to = 'adelin9999@gmail.com';
        $subject = 'New Contact Form Submission';
        $body = "Name: $name\nPhone: $phone\nEmail: $email\nMessage: $message";
        $headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";

        // Send email using PHP's mail function (you can replace with a more advanced mailing solution)
        if (mail($to, $subject, $body, $headers)) {
            return ['#form-result' => 'Thank you! Your message has been sent successfully.'];
        } else {
            return ['#form-result' => 'There was an error sending your message. Please try again later.'];
        }
    }
}
