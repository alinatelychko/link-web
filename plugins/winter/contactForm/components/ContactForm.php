<?php

namespace Winter\ContactForm\Components;

use Cms\Classes\ComponentBase;
use Input;
use Mail;

class ContactForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Contact Form',
            'description' => 'Handles contact form submissions.'
        ];
    }

    public function onSend()
    {
        // Validate and retrieve form data
        $name = Input::get('name');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $message = Input::get('message');

        // Send email
        Mail::send('winter.contactform::mail.contact', [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message,
        ], function($message) use ($email) {
            $message->to('adelin9999@gmail.com'); // Your receiving email
            $message->subject('New Contact Form Submission');
            $message->from($email); // Set the sender's email
        });

        // Return success message
        return [
            'success' => 'Your message has been sent successfully!'
        ];
    }
}
