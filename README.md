# coderstm/laravel-installer

<p align="center">
<a href="https://packagist.org/packages/coderstm/laravel-installer"><img src="https://img.shields.io/packagist/dt/coderstm/laravel-installer" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/coderstm/laravel-installer"><img src="https://img.shields.io/packagist/v/coderstm/laravel-installer" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/coderstm/laravel-installer"><img src="https://img.shields.io/packagist/l/coderstm/laravel-installer" alt="License"></a>
</p>

- [coderstm/laravel-installer](#coderstmlaravel-installer)
	- [About](#about)
	- [Requirements](#requirements)
	- [Installation](#installation)
	- [Routes](#routes)
	- [Usage](#usage)

## About

Do you want your clients to be able to install a Laravel project just like they do with WordPress or any other CMS?
This Laravel package allows users who don't use Composer, SSH etc to install your application just by following the setup wizard.
The current features are :

- Check For Server Requirements.
- Check For Folders Permissions.
- Ability to set database information.
	- .env text editor
	- .env form wizard
- Migrate The Database.
- Seed The Tables.

## Requirements

* [Laravel 8+](https://laravel.com/docs/installation)

## Installation

1. From your projects root folder in terminal run:

```bash
    composer require coderstm/laravel-installer
```

2. Register the package

* Laravel 5.5 and up
Uses package auto discovery feature, no need to edit the `config/app.php` file.

* Laravel 5.4 and below
Register the package with laravel in `config/app.php` under `providers` with the following:

```php
	'providers' => [
	    Coderstm\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class,
	];
```

3. Publish the packages views, config file, assets, and language files by running the following from your projects root folder:

```bash
    php artisan vendor:publish --tag=installer-lang
```

## Routes

* `/install`
* `/update`

## Usage

* **Install Routes Notes**
	* In order to install your application, go to the `/install` route and follow the instructions.
	* Once the installation has ran the empty file `installed` will be placed into the `/storage` directory. If this file is present the route `/install` will abort to the 404 page.

* **Update Route Notes**
	* In order to update your application, go to the `/update` route and follow the instructions.
	* The `/update` routes countes how many migration files exist in the `/database/migrations` folder and compares that count against the migrations table. If the files count is greater then the `/update` route will render, otherwise, the page will abort to the 404 page.

* Additional Files and folders published to your project :

