<?php

namespace Winter\ContactForm; // Make sure this matches your folder structure

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Winter\ContactForm\Components\ContactForm' => 'contactForm',
        ];
    }
    
    public function registerSettings()
    {
        // Optional: Register any settings if needed
    }
}
