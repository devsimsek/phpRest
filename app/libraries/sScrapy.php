<?php

/**
 * smskSoft sScrapy Library
 * Scrape websites easily with php!
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * @package     smskSoft-phpLibs
 * @subpackage  sScrapy
 * @file        sScrapy.php
 * @version     v1.0
 * @author      devsimsek
 * @copyright   Copyright (c) 2021, smskSoft, mtnsmsk
 * @license     https://opensource.org/licenses/MIT	MIT License
 * @link        @no_link_specified
 * @since       Version 1.0
 * @filesource
 */
class sScrapy
{
    /**
     * Defines sScrapy Version
     * @var string $version
     */
    private string $version = "v1.0.0";
    /**
     * Debug
     * @var bool
     */
    protected bool $debug;

    /**
     * Url
     * @var string
     */
    public string $url;

    /**
     * Connection
     * @var bool
     */
    protected bool $connection = false;

    /**
     * htmlResult
     * @var string
     */
    protected string $htmlResult;

    /**
     * sScrapy constructor.
     * @param bool $debug
     */
    public function __construct(bool $debug = false)
    {
        $this->debug = $debug;
        $this->debug("sScrapy " . $this->version . " Copyright (C)smskSoft, devsimsek and contributors");
        $this->debug("Library Initialized Successfully.");
    }

    /**
     * Debug Log
     * @param $message
     */
    protected function debug($message)
    {
        if ($this->debug) {
            if (php_sapi_name() === "cli") {
                error_log("sScrapy DEBUG: " . $message);
            } else {
                print_r("sScrapy DEBUG: " . $message);
            }
        }
    }

    /**
     * Connect to specified url
     * Validates url!
     * Can connect with cUrl
     * @param string $url
     * @param array $headers
     * @param bool $curl
     */
    public function connect(string $url, array $headers = array('method' => "GET", 'header' => "User-Agent: sScrapy/1.0\r\n"), bool $curl = false)
    {
        $this->url = $url;

        $this->debug("Trying to connect " . $url);
        $this->debug("Validating " . $url);

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $this->debug($url . " is valid. Connecting...");
            if (!$curl) {

                $headers = array(
                    'http' => $headers
                );
                $headers = stream_context_create($headers);

                // Now lets connect
                $this->htmlResult = file_get_contents($this->url, false, $headers);

                if (!empty($this->htmlResult)) {
                    $this->connection = true;
                    $this->debug("Successfully Connected to " . $this->url . ".");
                } else {
                    $this->debug("Error! Can't Connect " . $this->url);
                    throw new \Error("Error! Can't Connect " . $this->url);
                }
            } else {
                // Initialize a connection with cURL (ch = channel)
                $ch = curl_init();

                // Set the URL
                curl_setopt($ch, CURLOPT_URL, $this->url);

                // Set the HTTP method
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

                // Return the response instead of printing it out
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                // Send the request and store the result in $response
                $response = curl_exec($ch);

                // Close cURL resource to free up system resources
                curl_close($ch);

                if (!empty($response)) {
                    $this->htmlResult = $response;
                    $this->connection = true;
                    $this->debug("Successfully Connected to " . $this->url . ".");
                } else {
                    $this->debug("Error! Can't Connect " . $this->url . " With Curl Method");
                    throw new \Error("Error! Can't Connect " . $this->url . " With cURL Method");
                }
            }
        } else {
            $this->debug("Error!" . $url . " is not valid . ");
            throw new \Error("Error! Can't Connect " . $this->url . ". Url is not valid!");
        }
    }

    /**
     * Returns connected url's response
     * @return string
     */
    public function result(): string
    {
        if ($this->connection) {
            return $this->htmlResult;
        }
        throw new \Error("Error! sScrapy is not connected!");
    }

    /**
     * Search's connected urls code.
     * Find's all results by given string or regex
     * @param string $pattern
     * @return null|array
     */
    public function matchAll(string $pattern): ?array
    {
        if ($this->connection) {
            // Removing unnecessary new lines
            $html = trim(preg_replace('/\s\s+/', ' ', $this->htmlResult));

            preg_match_all($pattern, $html, $result);
            if (!empty($result)) {
                return $result;
            }
            return null;
        }
        throw new \Error("Error! sScrapy is not connected!");
    }

    /**
     * Search's connected urls code.
     * Stops when it finds the result
     * @param string $pattern
     * @return null|array
     */
    public function match(string $pattern): ?array
    {
        if ($this->connection) {
            // Removing unnecessary new lines
            $html = trim(preg_replace('/\s\s+/', ' ', $this->htmlResult));

            preg_match($pattern, $html, $result);
            if (!empty($result)) {
                return $result;
            }
            return null;
        }
        throw new \Error("Error! sScrapy is not connected!");
    }

    /**
     * Search's connected urls code.
     * Find's all results by given string or regex
     * @param string $pattern
     * @return null|array
     */
    public function htmlMatchAll(string $pattern, string $html): ?array
    {
        $html = trim(preg_replace('/\s\s+/', ' ', $html));

        preg_match_all($pattern, $html, $result);
        if (!empty($result)) {
            return $result;
        }
        return null;
    }

    /**
     * Search's connected urls code.
     * Stops when it finds the result
     * @param string $pattern
     * @param string $html
     * @return null|array
     */
    public function htmlMatch(string $pattern, string $html): ?array
    {
        $html = trim(preg_replace('/\s\s+/', ' ', $html));

        preg_match($pattern, $html, $result);
        if (!empty($result)) {
            return $result;
        }
        return null;
    }

    /**
     * Find Tag By Name
     * @param string $name
     * @return DOMNodeList|false
     */
    public function tag(string $name): ?DOMNodeList
    {
        if ($this->connection) {
            $dd = new DomDocument();
            @$dd->loadHTML($this->htmlResult);
            return $dd->getElementsByTagName($name);
        }
        throw new \Error("Error! sScrapy is not connected!");
    }

    /**
     * Find Element By Id
     * @param string $name
     * @return DOMElement|false
     */
    public function id(string $name): ?DOMElement
    {
        if ($this->connection) {
            $dd = new DomDocument();
            @$dd->loadHTML($this->htmlResult);
            return $dd->getElementById($name);
        }
        throw new \Error("Error! sScrapy is not connected!");
    }

    /**
     * Find Element By Class Name
     * @param string $class
     * @return array|null
     */
    public function css(string $class): ?array
    {
        if ($this->connection) {
            $dd = new DomDocument();
            @$dd->loadHTML($this->htmlResult);
            $return = array();
            foreach ($dd->getElementsByTagName("*") as $e) {
                if ($class === $e->getAttribute('class')) {
                    array_push($return, $e);
                }
            }
            if (!empty($return)) {
                return $return;
            } else {
                return null;
            }
        }
        throw new \Error("Error! sScrapy is not connected!");
    }

    public function __destruct()
    {
        $this->debug("Destroying Library...");
        $this->debug("Destroyed. Thanks For Using sScrapy " . $this->version . ". Copyright (C)smskSoft, devsimsek and contributors.");
    }
}