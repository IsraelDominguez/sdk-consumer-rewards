Consumer Rewards SDK
====================

PHP client for connecting to the Consumer Rewards REST API.

To find out more, visit the official documentation website:
http://developer.genetsis.com

Requirements
------------

- PHP 7.0 or greater
- cUrl extension enabled

**To connect to the API with basic auth you need the following:**

- Secure URL pointing to a Bigcommerce store
- Username of an authorized admin user of the store
- API key for the user


## Installation

We recommend installing the SDK with [Composer](https://getcomposer.org/doc/00-intro.md). If you already have Composer installed globally, run the following:

```
$ composer require auth0/auth0-php
```

Otherwise, [download Composer locally](https://getcomposer.org/doc/00-intro.md#locally) and run:

```
php composer.phar require israeldominguez/sdk-consumer-rewards
``` 

This will create `composer.json` and `composer.lock` files in the directory where the command was run, along with a vendor folder containing this SDK and its dependencies. 

Finally, include the Composer autoload file in your project to use the SDK:

```php
require __DIR__ . '/vendor/autoload.php';

use ConsumerRewards\SDK\MarketingSDK;
```

The examples below use [PHP Dotenv](https://github.com/josegonzalez/php-dotenv) to store and load sensitive Auth0 credentials from the environment rather than hard-coding them into your application. PHP Dotenv is a dependency of this SDK so if you followed the steps above to install via Composer, the class is available for you to use in your project. 

First, you'll need a free Auth0 account and an Application:

1. Go to [auth0.com/signup](https://auth0.com/signup) and create your account.
2. Once you are in the dashboard, go to **Applications**, then **Create Application**.
3. Give your Application a name, select **Regular Web Application**, then **Create**
4. Click the **Settings** tab for the required credentials used below.

Next, create a `.env` file and add the following values:

```
# Auth0 tenant domain, found in your Application settings
AUTH0_DOMAIN="tenant.auth0.com"

# Auth0 Client ID, found in your Application settings
AUTH0_CLIENT_ID="Client ID goes here"