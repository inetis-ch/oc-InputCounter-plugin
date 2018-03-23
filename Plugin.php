<?php namespace Inetis\InputCounter;

use App;
use Backend\Widgets\Form;
use Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Input Counter',
            'description' => 'Add counters to text input',
            'author' => 'inetis',
            'icon' => 'icon-image'
        ];
    }

    public function boot()
    {
        // Check if we are currently in backend
        if (!App::runningInBackend()) {
            return;
        }

        // Listen for `backend.page.beforeDisplay` event and inject js to current controller instance.
        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss("/plugins/inetis/inputcounter/assets/css/style.css");
            $controller->addJs("/plugins/inetis/inputcounter/assets/js/main.js");
        });

        $this->registerCmsSeoRecommendation();
        $this->registerStaticPagesSeoRecommendation();
    }

    private function registerStaticPagesSeoRecommendation()
    {
        if (!class_exists(\RainLab\Pages\Classes\Page::class)) {
            return;
        }

        Event::listen('backend.form.extendFieldsBefore', function (Form $form) {
            if (
                !$form->getController() instanceof \RainLab\Pages\Controllers\Index ||
                !$form->model instanceof \RainLab\Pages\Classes\Page ||
                $form->isNested
            ) {
                return;
            }

            $form->tabs['fields']['viewBag[meta_title]'] += [
                'attributes' => [
                    'data-counter',
                    'data-optimal-min-length' => 50,
                    'data-optimal-max-length' => 60,
                ]
            ];

            $form->tabs['fields']['viewBag[meta_description]'] += [
                'attributes' => [
                    'data-counter',
                    'data-optimal-min-length' => 50,
                    'data-optimal-max-length' => 300,
                ]
            ];
        });
    }

    private function registerCmsSeoRecommendation()
    {
        Event::listen('backend.form.extendFieldsBefore', function (Form $form) {
            if (
                !$form->getController() instanceof \Cms\Controllers\Index ||
                !$form->model instanceof \Cms\Classes\Page ||
                $form->isNested
            ) {
                return;
            }

            $form->tabs['fields']['settings[meta_title]'] += [
                'attributes' => [
                    'data-counter',
                    'data-optimal-min-length' => 50,
                    'data-optimal-max-length' => 60,
                ]
            ];

            $form->tabs['fields']['settings[meta_description]'] += [
                'attributes' => [
                    'data-counter',
                    'data-optimal-min-length' => 50,
                    'data-optimal-max-length' => 300,
                ]
            ];
        });
    }
}
