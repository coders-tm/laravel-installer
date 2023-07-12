<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '8.1.0',
    ],
    'final' => [
        'key' => true,
        'publish' => false,
    ],
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'BCMath',
            'Ctype',
            'DOM',
            'Fileinfo',
            'PCRE',
            'PDO',
            'XML',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775',
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Form Wizard Validation Rules & Messages
    |--------------------------------------------------------------------------
    |
    | This are the default form field validation rules. Available Rules:
    | https://laravel.com/docs/5.4/validation#available-validation-rules
    |
    */
    'environment' => [
        'form' => [
            'rules' => [
                'app_name'              => 'required|string',
                'app_domain'            => 'required|string',
                'app_admin_email'       => 'required|email',
                'app_env'               => 'required|string',
                'app_debug'             => 'required|string',
                'log_level'             => 'required|string',
                'app_url'               => 'required|url',
                'database_connection'   => 'required|string',
                'database_hostname'     => 'required|string',
                'database_port'         => 'required|numeric',
                'database_name'         => 'required|string',
                'database_username'     => 'required|string',
                'database_password'     => 'nullable|string',
                'broadcast_driver'      => 'required|string',
                'cache_driver'          => 'required|string',
                'session_driver'        => 'required|string',
                'queue_driver'          => 'required|string',
                'redis_hostname'        => 'required|string',
                'redis_password'        => 'required|string',
                'redis_port'            => 'required|numeric',
                'mail_driver'           => 'required|string',
                'mail_host'             => 'required|string',
                'mail_port'             => 'required|string',
                'mail_username'         => 'required|string',
                'mail_password'         => 'required|string',
                'mail_encryption'       => 'required|string',
                'recaptcha_site_key'    => 'required|string',
                'recaptcha_secret_key'  => 'required|string',
                'cashier_currency'    => 'required|string',
                'stripe_key'    => 'required|string',
                'stripe_secret'  => 'required|string',
                'stripe_webhook_secret'  => 'required|string',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Installed Middleware Options
    |--------------------------------------------------------------------------
    | Different available status switch configuration for the
    | canInstall middleware located in `canInstall.php`.
    |
    */
    'installed' => [
        'redirectOptions' => [
            'route' => [
                'name' => 'home',
                'data' => [],
            ],
            'abort' => [
                'type' => '404',
            ],
            'dump' => [
                'data' => 'Dumping a not found message.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Selected Installed Middleware Option
    |--------------------------------------------------------------------------
    | The selected option fo what happens when an installer instance has been
    | Default output is to `/resources/views/error/404.blade.php` if none.
    | The available middleware options include:
    | route, abort, dump, 404, default, ''
    |
    */
    'installedAlreadyAction' => 'route',

    /*
    |--------------------------------------------------------------------------
    | Updater Enabled
    |--------------------------------------------------------------------------
    | Can the application run the '/update' route with the migrations.
    | The default option is set to False if none is present.
    | Boolean value
    |
    */
    'updaterEnabled' =>  false,

];
