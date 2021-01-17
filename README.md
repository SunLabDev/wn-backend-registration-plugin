## Backend Registration
This plugin allows your visitors to register as **Backend Users**.
Its main goal is to be used to develop SaaS applications using the OctoberCMS backend as your main service layer.

#### Important: Read this before enabling it in production
Make sure to create at least one limited role and configure this plugin to set the correct role to your new users.

_This step is mandatory to make sure no one can get Super Admin role_

### What you'll get when installing this plugin
This plugin adds all the classic steps of a registration process, including:
#### Basics:
It will add a registration link to the default sign-in page.
It will display a registration page, accessible via the `/register` backend route

#### Optional:
##### Terms of service agreement
When activated, the users will be forced to check a checkbox to register.
You can write your terms of service directly from a rich-editor inside the settings.
A link will be displayed on the registration page to your terms of service inside a popup.

##### Email verification
When activated, the registration page doesn't display the password fields.
Instead: a random password will be generated and sent via email to verify it.

##### Coming soon page
If you don't want to open registration for the moment, choose the date you want to open registrations.
Before that date, the users will be redirected to this page, displaying the opening date.


### How to override views
If, for any reason, your want to override the default plugin's views:
- Copy the files default files from `plugins/sunlab/backendregistration/controllers/registrationcontroller/` to your custom plugin.
- Extend the `AuthController` and `RegistrationController` to register the new views files path:

```php
Backend\Controllers\Auth::extend(function ($controller) {
    $controller->addViewPath(plugins_path('author/plugin/views'));
});

SunLab\BackendRegistration\Controllers\RegistrationController::extend(function ($controller) {
    $controller->addViewPath(plugins_path('author/plugin/views'));
});
```
