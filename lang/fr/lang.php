<?php return [
    'plugin' => [
        'description' => 'Permet l\'inscription d\'utilisateurs backend.'
    ],

    'permissions' => [
        'manage_plugin' => 'Gérer les paramètres du plugin',
        'view_additional_fields' => 'Voir les données de l\'inscription'
    ],

    'settings' => [
        'label' => 'Inscription Backend',
        'description' => 'Gestion ',
        'fields' => [
            'open_registration' => [
                'label' => 'Autoriser les inscriptions'
            ],
            'role' => [
                'label' => 'Rôle lors de l\'inscription',
                'comment' => 'Ce rôle sera assigné aux nouveaux utilisateurs'
            ],
            'need_activation' => [
                'label' => 'Vérification par mail',
                'comment' => 'Un mail sera transmis afin de confirmer l\'adresse mail'
            ],
            'need_terms_agreement' => [
                'label' => 'Conditions générales d\'utilisation',
                'comment' => 'Les CGU seront affichés dans une popup sur la page d\'inscription'
            ],
            'terms' => [
                'label' => 'Conditions générales d\'utilisation',
            ]
        ],
    ],

    'account' => [
        'want_to_register' => "Je n'ai pas encore de compte",
        'password_confirmation_placeholder' => "confirmation du mot de passe",
        'already_registered' => "J'ai déjà un compte",
        'register' => "S'inscrire",
    ],

    'register' => [
        'password_will_be_sent' => 'Afin de confirmer votre email, le mot de passe y sera envoyé.',
        'password_has_been_sent' => 'Votre mot de passe vous as été transmis par mail.',
        'i_confirm_read_the' => 'En créant mon compte je reconnais avoir lu et accepté les',
        'terms' => 'Conditions Générales d\'Utilisation'
    ],

    'coming_soon' => [
        'coming_soon' => 'Ouverture Prochainement',
        'open_at' => 'Les inscriptions ouvriront le:',
    ],

    'messages' => [
        'password_will_be_sent' => 'Pour confirmer votre email, votre mot de passe y sera envoyé.',
        'password_has_been_sent' => 'Votre mot de passe vous as été transmis par email.'
    ],

    'date_format' => 'l j F Y à H:i'
];
