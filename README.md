<div id="top"></div>

<!-- Shields -->
[![hits](https://hits.deltapapa.io/github/devsimsek/phpRest.svg)](https://devsimsek.github.io/phpRest)
[![Github All Releases](https://img.shields.io/github/downloads/devsimsek/phpRest/total.svg)]()
[![GitHub license](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)](https://github.com/devsimsek/phpRest/blob/master/LICENSE)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/devsimsek/phpRest/graphs/commit-activity)
[![GitHub issues](https://img.shields.io/github/issues/devsimsek/phpRest.svg)](https://GitHub.com/devsimsek/phpRest/issues/)
[![Open Source](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/devsimsek/phpRest)



<!-- Logo -->
<br />
<div align="center">
  <a href="https://github.com/devsimsek/phpRest">
    <i style="font-size: 350%;color: white;-webkit-font-smoothing: antialiased;">php<b style="color: black;text-shadow: #fff 0 0 5px;">Rest</b></i>
  </a>

<h3 align="center">phpRest</h3>

  <p align="center">
    Create Restful Api's With The Power Of php And MVC
    <br />
    <a href="https://github.com/devsimsek/phpRest"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/devsimsek/phpRest/issues">Report Bug</a>
    ·
    <a href="https://github.com/devsimsek/phpRest/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->

## About The Project

Here's a blank template to get started: To avoid retyping too much info. Do a search and replace with your text editor
for the following: `github_username`, `repo_name`, `twitter_handle`, `linkedin_username`, `email`, `email_client`
, `project_title`, `project_description`

<p align="right">(<a href="#top">back to top</a>)</p>

### Built With

* [Php](https://php.net/)
* spf (Closed Source)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->

## Getting Started

### Installation

You can install phpRest using git, curl or github cli

OS X & Linux & Windows (With Github CLI):

```sh
gh repo clone devsimsek/phpRest
```

OS X & Linux & Windows (With Git):

```sh
git clone https://github.com/devsimsek/phpRest.git
```

Curl Installation

```sh
curl https://raw.githubusercontent.com/devsimsek/phpRest/setup.sh | bash
```

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->

## Usage

Once you've installed phpRest successfully on your workspace please configure your project. You can use
our [guideline here](https://github.com/devsimsek/phpRest/tree/main/wiki/configuration.md)

Then create a controller file at app/controllers directory.

Example controller file:

```php
<?php
class ExampleFile extends Controller
{
    protected $res;

    public function __construct() {
        $this->load_library("Response");
        $this->res = new Response();
    }

    public function ExampleFunction(){
        $this->res->set_header(200);
        echo json_encode(array(
            "message" => "Hello World!"
        ), JSON_UNESCAPED_UNICODE);
    }
}
```

save it and run phpRest development by ```./bin/phpRest serve -d . -p 8001```

_For more examples, please refer to the [Documentation](https://example.com)_

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ROADMAP -->

## Roadmap

- [x] MVC Structure
- [x] Built-in Libraries
- [x] Third Party Library Support
    - [x] ReSQL (Sqlite)
    - [x] Database (Mysql)
    - [x] Curl
    - [x] Date_time
    - [x] Response
    - [x] sScrapy
    - [x] Uri
    - [x] Uuid
    - and more soon...

See the [open issues](https://github.com/devsimsek/phpRest/issues) for a full list of proposed features (and known
issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make phpRest better, please fork the repo and create a pull request. You can also
simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->

## Contact

devsimsek - [@smskSoft](https://smsk.me) - mtnsmsk@smsk.ga

Project Link: [https://github.com/devsimsek/phpRest](https://github.com/devsimsek/phpRest)

<p align="right">(<a href="#top">back to top</a>)</p>