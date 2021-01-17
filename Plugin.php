<?php namespace SunLab\BackendRegistration;

use Backend\Controllers\Auth;
use Illuminate\Support\Facades\Event;
use SunLab\BackendRegistration\Models\Settings;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Illuminate\Support\Facades\View;

class Plugin extends PluginBase
{
    public $elevated = true;

    public function boot(): void
    {
        $this->extendAuthController();
        $this->addPopupToAuthLayout();
    }

    public function pluginDetails(): array
    {
        return [
            'name'        => 'Backend Registration',
            'description' => 'sunlab.backendregistration::lang.plugin.description',
            'author'      => 'SunLab',
            'icon'        => 'icon-user-plus'
        ];
    }

    public function registerSettings(): array
    {
        return [
            'sunlab_registration_settings' => [
                'label'       => 'sunlab.backendregistration::lang.settings.label',
                'description' => 'sunlab.backendregistration::lang.settings.description',
                'category'    => SettingsManager::CATEGORY_CUSTOMERS,
                'icon'        => 'icon-user-plus',
                'class'       => Settings::class,
                'order'       => 500,
                'keywords'    => 'sunlab.backendregistration::lang.settings.keywords',
                'permissions' => ['sunlab.backendregistration.*']
            ]
        ];
    }

    protected function extendAuthController(): void
    {
        Auth::extend(function ($controller) {
            $controller->addViewPath(plugins_path('sunlab/backendregistration/controllers/registrationcontroller'));
        });
    }

    public function registerMailTemplates(): array
    {
        return [
            'sunlab.backendregistration::mail.password'
        ];
    }

    protected function addPopupToAuthLayout(): void
    {
        $settings = Settings::instance();

        if ($settings->need_terms_agreement) {
            Event::listen('backend.layout.extendHead', function () use ($settings) {
                return View::make('sunlab.backendregistration::popup', ['terms' => $settings->terms]);
            });
        }
    }
}
