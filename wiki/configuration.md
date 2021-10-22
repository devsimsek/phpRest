<div id="top"></div>

<div align="center">
  <a href="https://github.com/devsimsek/phpRest">
    <i style="font-size: 350%;color: white;-webkit-font-smoothing: antialiased;">php<b style="color: black;text-shadow: #fff 0 0 5px;">Rest</b></i>
  </a>

<h3 align="center">phpRest | Wiki | Configuration</h3>

  <p align="center">
    Configure your powerful phpRest api project
    <br />
    <a href="https://github.com/devsimsek/phpRest"><strong>Go To Home »</strong></a>
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
    <li><a href="#configure-application">Configure Application</a></li>
    <li><a href="#configure-routing-schema">Configure Routing Schema</a></li>
  </ol>
</details>

<!-- Configure Application -->

## Configure Application

In order to use phpRest's features you need to configure your project. Don't be afraid it is simple and yet quite fast.

1. Open your project root.
2. Find a file named `index.php`
3. In `index.php` change settings, core path, app path, controllers path, preload helpers and preload libraries these
   values to your desired configuration.

Simple as that! Now lets configure our routing [here](#configure-routing-schema).

<p align="right">(<a href="#top">back to top</a>)</p>

## Configure Routing Schema

So if you configured your application correctly you are asking yourself the question what next? The answer is routing!
You need to set your endpoints to be accessible by your clients.

In order to do that you need to follow these lines;

1. Open your project root.
2. Open `app/configuration/routing.php`.
3. In `routing.php` find `$router->add("/", "home&index");` line and change it to your controller name. More
   documentation on `routing.php` file.

So we this is it! That simple :)

See you in the next wiki.

<p align="right">(<a href="#top">back to top</a>)</p>