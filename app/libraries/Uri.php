<?php

/**
 * smskSoft Uri Library
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * @package     smskSoft-phpLibs
 * @subpackage  Uri
 * @file        Uri.php
 * @version     v1.0
 * @author      devsimsek
 * @copyright   Copyright (c) 2021, smskSoft, mtnsmsk
 * @license     https://opensource.org/licenses/MIT	MIT License
 * @link        @no_link_specified
 * @since       Version 1.0
 * @filesource
 */
class Uri
{
    /**
     *
     * Base Url
     *
     * Returns Base Url Of The Site
     *
     * @param string|null $path
     * @return string
     */
    public function base_url(string $path = null): string
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        if ($path !== null) {
            return $protocol . "://" . $_SERVER['HTTP_HOST'] . "/" . $path;
        } else {
            return $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";
        }
    }

    /**
     *
     * Current Url
     *
     * Returns Active Url
     *
     * @param false $atRoot
     * @param false $atCore
     * @param false $parse
     * @return array|false|int|string|null
     */
    public function current_url($atRoot = false, $atCore = false, $parse = false): mixed
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $curr_url = sprintf($tmplt, $http, $hostname, $end);
        } else $curr_url = 'http://localhost/';

        if ($parse) {
            $curr_url = parse_url($curr_url);
            if (isset($curr_url['path'])) if ($curr_url['path'] == '/') $curr_url['path'] = '';
        }

        return $curr_url;
    }

    /**
     *
     * Url Segments
     *
     * Get the segment of desired url.
     *
     * @param string $url
     * @return array
     */
    public function segment(string $url = null): array
    {
        if ($url == null) {
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
        } else {
            $uri_path = parse_url($url, PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
        }
        unset($uri_segments[0]); // Removing First Element Due To Its Blank
        return $uri_segments;
    }

    /**
     *
     * Array To Url
     *
     * Creates url from arrays
     *
     * @param array $array
     * @param string|null $url
     * @return string
     */
    public function arr2uri(array $array = array(), string $url = null): string
    {
        if ($url !== null) {
            $return = $url . "?" . http_build_query($array);
        } else {
            $return = $this->base_url() . "?" . http_build_query($array);
        }
        return $return;
    }
}