<?php

namespace Winter\Contactform;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Contact Form Plugin',
            'description' => 'A simple contact form',
            'author' => 'Your Name',
            'icon' => 'icon-envelope'
        ];
    }

    public function registerComponents()
    {
        return [
            'Winter\Contactform\Components\ContactFormComponent' => 'contactForm',
        ];
    }
    

    public function registerSettings(){
    }
}
