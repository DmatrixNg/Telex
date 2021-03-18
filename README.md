# Telex Retention Package

Telex Retention Package is a **PHP Email/SMS Management and Customer retention** library providing an easier and expressive way to send emails. The package includes ServiceProviders for easy **Laravel** integration.

[![Latest Version](https://img.shields.io/packagist/v/dmatrix/telex)](https://packagist.org/packages/dmatrix/telex)
[![Monthly Downloads](https://img.shields.io/packagist/dm/dmatrix/telex)](https://packagist.org/packages/dmatrix/telex)

## Requirements

- PHP >=7.4

## Getting started

- Create account on [Telex Retention](https://telex.im/) To create reuseable Email/SMS Templates.

## Installation
`composer require dmatrix/telex: "^1.0.2"`

## Publish Resources 
Run this in terminal
`php artisan vendor:publish --tag=telex-config`

Copy and add the below code block to config/services.php
```
'telex' => [
        'id' => env('TELEX_ORGANIZATION_ID'),
        'key' => env('TELEX_ORGANIZATION_KEY'),
        'from' => env('TELEX_FROM','Telex'),
        'email' => env('TELEX_EMAIL'),
        'template' => env('TELEX_TEMPLATE_ID'), // optional
        'placeholders' => env('TELEX_PLACEHOLDER_ID'), //optional
        'type' => env('TELEX_PROVIDER_TYPE','email'), //optional
        'endpoint' => env('TELEX_ENDPOINT','https://telex.im/api/send-message'),
    ], 
    ```

