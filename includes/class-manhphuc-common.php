<?php

/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 2/19/16
 * Time: 2:20 PM
 */
class NpCommon
{


    public static function fullFillLink($link)
    {

        $link = strtolower($link);
        $link = !$link || substr($link, 0, 7) == 'http://' || substr($link, 0,
            8) == 'https://' ? $link : 'http://' . $link;

        return $link;
    }

    public static function getOption($name, $default = null)
    {
        if (get_field($name, 'option')) {
            return get_field($name, 'option');
        } else if (defined('ICL_LANGUAGE_CODE') && get_field($name . '_' . ICL_LANGUAGE_CODE, 'option')) {
            return get_field($name . '_' . ICL_LANGUAGE_CODE, 'option');
        } else {
            return $default;
        }
    }

    public static function getOptionData($name, $data, $default = null)
    {
        if (isset($data[$name]) && $data[$name]) {
            return $data[$name];
        } else if (defined('ICL_LANGUAGE_CODE') && isset($data[$name . '_' . ICL_LANGUAGE_CODE]) && $data[$name . '_' . ICL_LANGUAGE_CODE]) {
            return $data[$name . '_' . ICL_LANGUAGE_CODE];
        } else {
            return $default;
        }
    }

    public static function debugVar($varName, $web = true)
    {
        if ($web) {
            echo '<pre> value: ';
            print_r($varName);
            echo '</pre>';
        } else {
            print_r($varName);
        }
    }

    /**
     * @param $str string
     * @param $first number, start at the start'th position in $str
     * @param $last number, position end in $str
     * @param $replace , return character
     * @return string and $replace at position lasted
     */

    public static function manhphucSubtring($str, $end, $replace)
    {
        if (strlen($str) > $end) {
            $str = substr($str, 0, $end);
            return preg_replace('/\W\w+\s*(\W*)$/', '$1', $str) . $replace;
        }
        return $str;
    }

    /**
     * @param $timeZone
     * @param $format string, format time zone default 'Y-m-d H:i:s'
     * @param $dateTime , default date time current
     * @return string, date time of time zone
     */
    public static function convertTimeZone($timeZone, $format = null, $dateTime = null)
    {
        date_default_timezone_set('Europe/London');
        if (empty($format)) {
            $format = 'Y-m-d H:i:s';
        }
        if (empty($dateTime)) {
            $datetime = date($format);
        } else {
            $datetime = $dateTime;
        }
        $datetime = new DateTime($datetime);
        $datetime->format($format);
        $la_time = new DateTimeZone($timeZone);
        $datetime->setTimezone($la_time);
        return $datetime->format($format);
    }
    
}