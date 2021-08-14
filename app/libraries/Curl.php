<?php
/**
 * smskSoft Curl Library
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * @package     smskSoft-phpLibs
 * @subpackage  Curl
 * @file        Curl.php
 * @version     v1.0
 * @author      devsimsek
 * @copyright   Copyright (c) 2021, smskSoft, mtnsmsk
 * @license     https://opensource.org/licenses/MIT	MIT License
 * @link        @no_link_specified
 * @since       Version 1.0
 * @filesource
 */

/**
 * Curl Library For phpRest api system.
 * Copyright (C)mtnsmsk.
 */
class Curl
{
    // Always At The Top
    public function register(): array
    {
        // Library Configuration For phpRest
        $class_name = "Curl";
        $require_arguments = true;

        return array(
            "class_name" => $class_name,
            "require_arguments" => $require_arguments
        );
    }

    private $url;
    private $options;

    /**
     * @param string $url Request URL
     * @param array $options cURL options
     */
    public function __construct($url, array $options = [])
    {
        $this->url = $url;
        $this->options = $options;
    }

    /**
     * Get the response
     * @return string
     * @throws \RuntimeException On cURL error
     */
    public function __invoke(array $post)
    {
        $ch = \curl_init($this->url);

        foreach ($this->options as $key => $val) {
            \curl_setopt($ch, $key, $val);
        }

        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $post);

        $response = \curl_exec($ch);
        $error = \curl_error($ch);
        $errno = \curl_errno($ch);

        if (\is_resource($ch)) {
            \curl_close($ch);
        }

        if (0 !== $errno) {
            throw new \RuntimeException($error, $errno);
        }

        return $response;
    }
}