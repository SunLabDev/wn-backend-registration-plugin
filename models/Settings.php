<?php namespace SunLab\BackendRegistration\Models;

use Backend\Models\UserRole;
use October\Rain\Database\Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'sunlab_registration_settings';
    public $settingsFields = 'fields.yaml';
    public function initSettingsData()
    {
        $this->open_registration = false;
        $this->need_activation = true;
    }

    use \October\Rain\Database\Traits\Validation;
    public $rules = [
        'role' => 'required|exists:backend_user_roles,id'
    ];

    public $dates = [
        'registration_open_at'
    ];

    protected $guarded = ['*'];

    public function getRoleOptions()
    {
        return UserRole::select(['name', 'id'])->get()->pluck('name', 'id');
    }
}
