<?php return [
    'plugin' => [
        'description' => 'Allows your visitors to register as Backend Users'
    ],

    'permissions' => [
        'manage_plugin' => 'Manage plugin settings',
        'view_additional_fields' => 'View registration'
    ],

    'settings' => [
        'label' => 'Backend Registration',
        'description' => 'Manage backend registration',
        'fields' => [
            'open_registration' => [
                'label' => 'Open registration'
            ],
            'registration_open_at' => [
                'label' => 'Open registration at',
                'comment' => 'Leave blank to open registration now'
            ],
            'role' => [
                'label' => 'Role on registration',
                'comment' => 'This role will be set to the new users on registration'
            ],
            'need_terms_agreement' => [
                'label' => 'Need terms agreement',
                'comment' => 'Terms of service is displayed through a popup on register page'
            ],
            'terms' => [
                'label' => 'Terms of service',
            ],
            'need_activation' => [
                'label' => 'Need email activation',
                'comment' => 'If checked the password will be sent by email'
            ]
        ],
    ],

    'account' => [
        'want_to_register' => "I want to register",
        'password_confirmation_placeholder' => "password confirmation",
        'already_registered' => "I already have an account",
        'register' => "Register",
    ],

    'register' => [
        'i_confirm_read_the' => 'I confirm that I have read and accept the',
        'terms' => 'Terms of Service'
    ],

    'coming_soon' => [
        'coming_soon' => 'Coming Soon',
        'open_at' => 'Registrations open on:',
    ],

    'messages' => [
        'password_will_be_sent' => 'To confirm your email, your password will be sent to it.',
        'password_has_been_sent' => 'Your password has been sent to your email.'
    ],

    'date_format' => 'l jS \\of F Y \\a\\t h:i A'
];
