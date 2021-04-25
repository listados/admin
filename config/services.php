<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => Vistoria\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook'  =>  [ 
        'client_id'  =>  '369225070101040' , 
        'client_secret'  =>  '6937d2ac486cee1425831f4573f91f01' , 
        'redirect'  =>  'http://grautour.com/callback' , 
        //'redirect'  =>  'http://localhost/grautour/callback' , 
    ],

    'google'  =>  [ 
        'client_id'  =>  '1016682731922-qljirimn7ov0au550i3f1pv78hpv9mna.apps.googleusercontent.com' , 
        'client_secret'  =>  '6rNdCPs6Ckt95bkKlty_myuo' , 
        'redirect'  =>  'http://grautour.com/callback' ,
        //'redirect'  =>  'http://excellencesoft.com.br/ea_app/public/callback' , 
    ],

];
