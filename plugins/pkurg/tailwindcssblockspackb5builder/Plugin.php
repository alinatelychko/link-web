<?php namespace Pkurg\TailwindCssBlocksPackB5builder;

use Illuminate\Support\Facades\App;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{

    public function registerSettings()
    {

        return [
            'settings' => [
                'label' => 'Tailwind CSS Blocks Pack for Page Builders',
                'description' => 'Settings',
                'category' => SettingsManager::CATEGORY_CMS,
                'icon' => 'oc-icon-building-o',
                'class' => 'Pkurg\TailwindCssBlocksPackB5builder\Models\Settings',
                'order' => 600,
                //'permissions' => ['pkurg.tailwind.pack.manage'],

            ],
        ];

    }

    public function boot()
    {

        App::before(
            function () {

                if (!\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbbldin') and !\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbcustom')) {

                    return;
                }

                ////////////////
                //  B5BUILDER
                ////////////////
                \Route::get('bulder-custom-blocks.js', function () {

                    $assets_path = url('/plugins/pkurg/tailwindcssblockspackb5builder/assets/');
                    $scripts = 'function PBCustomBlocks(editor, options){' . PHP_EOL;
                    $scripts = $scripts . 'var CustomBlock = editor.BlockManager;' . PHP_EOL;
                    $scripts = $scripts . 'var Editor = editor;' . PHP_EOL;
                    $scripts = $scripts . 'Editor.BlockManager.getAll().reset();' . PHP_EOL;

                    if (\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbbldin')) {

                        if (\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbcustom')) {

                            $scripts = $scripts . '$.getScript("' . url('/plugins/pkurg/tailwindcssblockspackb5builder/assets/grapesjs-pkurg-tailwindcss-plugin.js') . '", function() { PLANDING5(Editor, "' . $assets_path . '"); custblk(); colapcecustblk();  });' . PHP_EOL;

                        } else {

                            $scripts = $scripts . '$.getScript("' . url('/plugins/pkurg/tailwindcssblockspackb5builder/assets/grapesjs-pkurg-tailwindcss-plugin.js') . '", function() { PLANDING5(Editor, "' . $assets_path . '");  colapcecustblk();  });' . PHP_EOL;

                        }

                    } else {

                        if (\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbcustom')) {

                            $scripts = $scripts . ' custblk(); colapcecustblk(); ' . PHP_EOL;

                        }
                    }

                    $custom = \Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('text');

                    $blocks = '';

                    if ($custom) {

                        foreach ($custom as $key => $value) {

                            $blocks = $blocks . "editor.BlockManager.add('" . uniqid() . "', {
                    label: '" . $value['label'] . "',
                    category: '" . $value['category'] . "',
                    content: `" . $value['content'] . "`,
                    attributes: {
                        class: '" . $value['icon'] . "'
                    }
                    });";

                        }
                    }

                    $scripts = $scripts . "function custblk() {" . PHP_EOL;

                    $scripts = $scripts . $blocks . PHP_EOL;

                    $scripts = $scripts . "}" . PHP_EOL;

                    $scripts = $scripts . "function colapcecustblk() {" . PHP_EOL;

                    $scripts = $scripts .

                        "var categories = editor.BlockManager.getCategories();
                    categories.each(category => {
                      category.set('open', false).on('change:open', opened => {
                        opened.get('open') && categories.each(category => {
                          category !== opened && category.set('open', false)
                        })
                      })
                    });" . PHP_EOL;

                    $scripts = $scripts . "}" . PHP_EOL;

                    $scripts = $scripts . '}';
                    return response($scripts, 200)->header('Content-Type', 'text/javascript');
                });

                ////////////////
                //  B4BUILDER
                ////////////////
                \Route::get('b4bulder-custom-blocks.js', function () {

                    $assets_path = url('/plugins/pkurg/tailwindcssblockspackb5builder/assets/');
                    $scripts = 'function PB4CustomBlocks(editor, options){' . PHP_EOL;
                    $scripts = $scripts . 'var CustomBlock = editor.BlockManager;' . PHP_EOL;
                    $scripts = $scripts . 'var Editor = editor;' . PHP_EOL;
                    $scripts = $scripts . 'Editor.BlockManager.getAll().reset();' . PHP_EOL;

                    if (\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbbldin')) {

                        if (\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbcustom')) {

                            $scripts = $scripts . '$.getScript("' . url('/plugins/pkurg/tailwindcssblockspackb5builder/assets/grapesjs-pkurg-tailwindcss-plugin.js') . '", function() { PLANDING5(Editor, "' . $assets_path . '"); custblk(); colapcecustblk();  });' . PHP_EOL;

                        } else {

                            $scripts = $scripts . '$.getScript("' . url('/plugins/pkurg/tailwindcssblockspackb5builder/assets/grapesjs-pkurg-tailwindcss-plugin.js') . '", function() { PLANDING5(Editor, "' . $assets_path . '");  colapcecustblk();  });' . PHP_EOL;

                        }

                    } else {

                        if (\Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('enbcustom')) {

                            $scripts = $scripts . ' custblk(); colapcecustblk(); ' . PHP_EOL;

                        }
                    }

                    $custom = \Pkurg\TailwindCssBlocksPackB5builder\Models\Settings::get('text');

                    $blocks = '';

                    if ($custom) {

                        foreach ($custom as $key => $value) {

                            $blocks = $blocks . "editor.BlockManager.add('" . uniqid() . "', {
                    label: '" . $value['label'] . "',
                    category: '" . $value['category'] . "',
                    content: `" . $value['content'] . "`,
                    attributes: {
                        class: '" . $value['icon'] . "'
                    }
                    });";

                        }
                    }

                    $scripts = $scripts . "function custblk() {" . PHP_EOL;

                    $scripts = $scripts . $blocks . PHP_EOL;

                    $scripts = $scripts . "}" . PHP_EOL;

                    $scripts = $scripts . "function colapcecustblk() {" . PHP_EOL;

                    $scripts = $scripts .

                        "var categories = editor.BlockManager.getCategories();
                    categories.each(category => {
                      category.set('open', false).on('change:open', opened => {
                        opened.get('open') && categories.each(category => {
                          category !== opened && category.set('open', false)
                        })
                      })
                    });" . PHP_EOL;

                    $scripts = $scripts . "}" . PHP_EOL;

                    $scripts = $scripts . '}' . PHP_EOL;

                    return response($scripts, 200)->header('Content-Type', 'text/javascript');
                });

            }

        );
    }
}
