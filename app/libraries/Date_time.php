<?php

/**
 * smskSoft DateTime Library
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * This Library Is Not Finished! Please do not use it for production
 * @package     smskSoft-phpLibs
 * @subpackage  DateTime
 * @file        Date_time.php
 * @version     v1.0
 * @author      devsimsek
 * @copyright   Copyright (c) 2021, smskSoft, mtnsmsk
 * @license     https://opensource.org/licenses/MIT	MIT License
 * @link        @no_link_specified
 * @since       Version 1.0
 * @filesource
 */
class Date_time
{

    /**
     *
     * Returns "h:i:sa" Formatted Date String
     *
     * @param string $format
     * @return string
     */
    public static function now(string $format = "Y/m/d H:i:s"): string
    {
        return date($format);
    }

    /**
     *
     * Calculates How Many Days Left For The Day
     *
     * @param string $to
     * @return false|float
     */
    public function calc_days(string $to = null)
    {

        if ($to == null) {
            $to = self::now();
        }

        $to = strtotime($to);
        $calc = ceil(($to - time()) / 60 / 60 / 24);
        return $calc;

    }
}