# phpRest

> A new way to create restful apis

[![hits](https://hits.deltapapa.io/github/devsimsek/phpRest.svg)](https://devsimsek.github.io/phpRest)
[![Github All Releases](https://img.shields.io/github/downloads/devsimsek/phpRest/total.svg)]()
[![Inline docs](http://inch-ci.org/github/devsimsek/phpRest.svg?branch=master)](http://inch-ci.org/github/devsimsek/phpRest)

With phpRest everybody can create simple, fast and secured restful apis. Start creating your own now!

## Installation

OS X & Linux & Windows (With Github CLI):

```sh
gh repo clone devsimsek/phpRest
```

OS X & Linux & Windows

```sh
git clone https://github.com/devsimsek/phpRest.git
```

Curl Installation

```sh
curl https://github.com/devsimsek/phpRest/setup.sh | bash
```

## Usage example

First you need to configure your application. Please look at
our [tutorial](https://github.com/devsimsek/phpRest/wiki/Tutorial-%231-Configuration).

Then create a handler file at app/handlers directory.

example handler file:

```php
<?php
set_header(200);
echo json_encode(array(
    "message" => "Hello World!"
), JSON_UNESCAPED_UNICODE);
```

save it and run phpRestCLI by ```./bin/phpRest serve -d . -p 8001```

For more examples and usage, please refer to the [Wiki](wiki).

## Development setup

For testing and logging everything (such as errors etc.) please open index.php and set environment to test.

## Release History

* v1.0
    * ADD: Added Repo.
* v1.1
    * CHANGE: Base Structure
    * ADD: Mvc Routing System
* v1.2
    * CHANGE: Base Structre
    * ADD: Github Pages
    * ADD: Github Release

* v1.3
    * FIX: OPTIMIZATION
    * FIX: Fixed Routing Class
    * CHANGE: Routing Json Structure
    * ISSUE: phpRest is now only accepting get request. Will be fixed in new update.
    * ADD: Built-in Libraries Such As Curl.
    * UPDATE: Request Method Schema

* v1.4
    * FIX: OPTIMIZATION
    * FIX: Fixed Routing Class
    * CHANGE: Routing Json Structure
    * FIX: phpRest is now accepting every request method.
    * ADD: Built-in server [phpRestCLI](https://github.com/devsimsek/phpRest/wiki/lib_Cli)
    * UPDATE: Request Method Schema

## Meta

Metin Şimşek – [@devsimsek](https://smsk.me/) – mtnsmsk@smsk.ga

Distributed under the MIT license. See ``LICENSE`` for more information.

[https://github.com/devsimsek/phpRest](https://github.com/devsimsek/)

## Contributing

1. Fork it (<https://github.com/devsimsek/phpRest/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
   <<<<<<< Updated upstream
5. Create a new Pull Request

> Stash Changes!