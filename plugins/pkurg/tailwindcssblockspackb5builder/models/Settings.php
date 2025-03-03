<?php

namespace Pkurg\TailwindCssBlocksPackB5builder\Models;

use Model;

class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'pkurg_tailwindpack_settings';

    public $settingsFields = 'fields.yaml';

    protected $cache = [];

    private function SetDefaultSettings()
    {            
         $this->enbbldin = 1;
         $this->enbcustom = 0;            
         $this->save();
    }

    public function initSettingsData()
    {

        $this->SetDefaultSettings();

    }

    public function resetDefault()
    {

        $this->SetDefaultSettings();

    }

}
