<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/country-codes', function () use ($router) {
    return [
        'data' => [
            'CountryCode' => 'ZAF',
            'CountryCode' => 'IND',
            'CountryCode' => 'PAK',
        ],
    ];
});

$router->get('/random-number/{randomCount}/{countryCode}',
    function ($randomCount, $countryCode) use ($router) {

        return [
            'data' => generateRandomPhoneNumbers($randomCount, $countryCode),
        ];
    });

function generateRandomPhoneNumber()
{
    // South African mobile numbers start with 06, 07, or 08
    $prefixes = ['06', '07', '08'];
    $prefix = $prefixes[array_rand($prefixes)];

    // Generate the remaining 8 digits
    $number = '';
    for ($i = 0; $i < 8; $i++) {
        $number .= rand(0, 9);
    }

    return $prefix . $number;
}

function generatePakistaniCellNumber()
{
    // Prefix for Pakistani mobile numbers
    $prefix = '03';

    // Generate the remaining 9 digits
    $number = $prefix . str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);

    return $number;
}

function generateIndianCellNumber()
{
    // Possible starting digits for Indian mobile numbers
    $startDigits = ['9', '8', '7'];

    // Randomly select a starting digit
    $prefix = $startDigits[array_rand($startDigits)];

    // Generate the remaining 9 digits
    $number = $prefix . str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);

    return $number;
}

function generateRandomPhoneNumbers($count = 10, $countryCode)
{
    $phoneNumbers = [];
    for ($i = 0; $i < $count; $i++) {

        if ($countryCode === 'ZAF') {

            $phoneNumbers[] = generateRandomPhoneNumber();
        } else if ($countryCode === 'PAK') {

            $phoneNumbers[] = generatePakistaniCellNumber();
        } else if ($countryCode === 'IDN') {

            $phoneNumbers[] = generateIndianCellNumber();
        }

    }

    return $phoneNumbers;
}
