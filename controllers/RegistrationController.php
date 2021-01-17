<?php namespace SunLab\BackendRegistration\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
use Backend\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use October\Rain\Support\Facades\Flash;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Str;
use SunLab\BackendRegistration\Models\Settings;
use October\Rain\Support\Facades\Validator;
use Exception;

class RegistrationController extends Controller
{
    protected $settings;
    protected $publicActions = ['register', 'comingSoon'];

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'auth';
        $this->vars['settings'] = $this->settings = Settings::instance();
    }

    // Add register render page
    public function register()
    {
        $this->setResponseHeader('Cache-Control', 'no-cache, no-store, must-revalidate');

        try {
            if (post('postback')) {
                return $this->register_onSubmit();
            }

            $this->bodyClass .= ' preload';
        } catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    // Add register form submit logic
    public function register_onSubmit()
    {
        $rules = [
            'terms' => $this->settings->need_terms_agreement ? 'accepted' : null,
            'email' => 'required|between:6,255|email|unique:backend_users',
            'login' => 'required|between:2,255|unique:backend_users',
            'password' => $this->settings->need_activation ? 'required:create|min:6|confirmed' : null,
            'password_confirmation' => $this->settings->need_activation ? 'required_with:password|min:6' : null
        ];

        $validator = Validator::make(post(), array_filter($rules));

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if ($this->settings->need_activation) {
            $password = $password_confirmation = Str::random(8);
        } else {
            $password = post('password');
            $password_confirmation = post('password_confirmation');
        }

        /** @var User $user */
        $user = BackendAuth::register([
            'login' => post('login'),
            'email' => post('email'),
            'password' => $password,
            'password_confirmation' => $password_confirmation,
            'role_id' => $this->settings->role
        ]);

        if ($this->settings->need_activation) {
            $mailData = [
                'password' => $password,
                'user' => $user,
                'link' => Backend::url('backend/auth/signin')
            ];

            Mail::queue('sunlab.backendregistration::mail.password', $mailData, function ($message) use ($user) {
                $message->to($user->email);
            });

            Flash::success(Lang::get('sunlab.backendregistration::lang.messages.password_has_been_sent'));
        } else {
            Flash::success(Lang::get('sunlab.backendregistration::lang.messages.successful_registration'));
        }
        return Backend::redirect('');
    }

    public function comingSoon()
    {
        $this->vars['openingDate'] = $this->settings->registration_open_at;
    }
}
