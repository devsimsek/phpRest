# phpRest

> A new way to create restful apis

[![HitCount](http://hits.dwyl.com/devsimsek/phpRest.svg)](http://hits.dwyl.com/devsimsek/phpRest)
[![Build Status](https://travis-ci.com/devsimsek/phpRest.png?branch=master)](https://travis-ci.com/devsimsek/phpRest)
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

## Usage example

A simple database (mysql) router:

```php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$name = 'phpRest';
$db = new Database($host, $name, $user, $pass);
$somearrayfromdatabase = $db->query('SELECT * FROM `sample`');
echo json_encode(array("database" => $somearrayfromdatabase), JSON_UNESCAPED_UNICODE);

```

_For more examples and usage, please refer to the [Wiki][wiki]._

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

## Meta

Metin Şimşek – [@mtnsmsk](https://smsk.me/dbader_org) – mtnsmsk@smsk.ga

Distributed under the MIT license. See ``LICENSE`` for more information.

[https://github.com/devsimsek/phpRest](https://github.com/devsimsek/)

## Contributing

1. Fork it (<https://github.com/devsimsek/phpRest/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
<<<<<<< Updated upstream
5. Create a new Pull Request
=======
5. Create a new Pull Request
>>>>>>> Stashed changes
