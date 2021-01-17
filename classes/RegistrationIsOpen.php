<?php namespace SunLab\BackendRegistration\Classes;

use Backend\Facades\Backend;
use SunLab\BackendRegistration\Models\Settings;
use System\Classes\PluginManager;

class RegistrationIsOpen
{
    public function handle($request, \Closure $next)
    {
        $settings = Settings::instance();
        if (!$settings->open_registration
            ||
            (!is_null($settings->registration_open_at) && $settings->registration_open_at->isFuture())
        ) {
            // Search for an eventual pre-registration
            if (!PluginManager::instance()->exists('SunLab.BackendPreRegistration')) {
                return Backend::redirect('coming-soon');
            }

            $preRegistrationSettings = \SunLab\BackendPreRegistration\Models\Settings::instance();
            if ($preRegistrationSettings->open_registration
                &&
                !optional($preRegistrationSettings->open_registration_at)->isFuture()
            ) {
                return Backend::redirect('preregister');
            }
        }

        return $next($request);
    }
}
