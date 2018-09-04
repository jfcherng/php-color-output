<?php

declare(strict_types=1);

if (!\function_exists('str_color')) {
    /**
     * Make a string colorful.
     *
     * A global alias to \Jfcherng\Color\Colorful::color.
     *
     * @param string       $str       the string
     * @param array|string $colors    the colors
     * @param bool         $autoReset automatically reset at the end of the string?
     *
     * @return string the colored string
     */
    function str_color(string $str, $colors = [], bool $autoReset = true): string
    {
        return \Jfcherng\Color\Colorful::color($str, $colors, $autoReset);
    }
}

if (!\function_exists('str_nocolor')) {
    /**
     * Remove all colors from a string.
     *
     * A global alias to \Jfcherng\Color\Colorful::noColor
     *
     * @param string $str the string
     *
     * @return string the string without colors
     */
    function str_nocolor(string $str): string
    {
        return \Jfcherng\Color\Colorful::noColor($str);
    }
}
