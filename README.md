# ZipWhip notifications channel for Laravel 5.3

This package makes it easy to send notifications using [zipwhip.com](https://www.zipwhip.com/) with Laravel 5.3.

THIS IS A MODIFIED VERSION OF THE [laravel-notification-channels/clickatell](https://github.com/laravel-notification-channels/clickatell) PACKAGE. ALL MAIN CREDIT GOES TO THEM, THIS IS JUST A MODIFICATION TO MAKE IT WORK WITH ZIPWHIP.


## Contents

- [Installation](#installation)
    - [Setting up the ZipWhip service](#setting-up-the-zipwhip-service)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

```bash
composer require colling-media/laravel-zipwhip-notification-channel
```

You must install the service provider:
```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\ZipWhip\ZipWhipServiceProvider::class,
],
```

### Setting up the ZipWhip service

Add your ZipWhip user and password to your `config/services.php`:

```php
// config/services.php
...
'zipwhip' => [
    'user'  => env('ZIPWHIP_USER'),
    'pass' => env('ZIPWHIP_PASS'),
],
...
```

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\ZipWhip\ZipWhipMessage;
use NotificationChannels\ZipWhip\ZipWhipChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [ZipWhipChannel::class];
    }

    public function toZipWhip($notifiable)
    {
        return (new ZipWhipMessage())
            ->content("Your {$notifiable->service} account was approved!");
    }
}
```

### Available methods

TODO

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [laravel-notification-channels/clickatell](https://github.com/laravel-notification-channels/clickatell) INITIAL LIBRARY - See them for full credits

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
