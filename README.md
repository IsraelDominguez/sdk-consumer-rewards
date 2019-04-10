Consumer Rewards SDK
====================

PHP client for connecting to the Consumer Rewards REST API.

To find out more, visit the official documentation website:
https://dru-id.com/developers

Requirements
------------

- PHP 7.0 or greater
- cUrl extension enabled

**To connect to the Consumer Rewards API you need the following:**

- Username of an authorized user of the Consumer Rewards
- Password API key for the user


## Installation

We recommend installing the SDK with [Composer](https://getcomposer.org/doc/00-intro.md). You need add the GitHub repository in your composer.json

```
 "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/israeldominguez/sdk-consumer-rewards"
        }
    ]
```

And add you "require" the dependency

```
 "israeldominguez/sdk-consumer-rewards": "dev-master"
``` 

You can download the package on GitHub and use in your project