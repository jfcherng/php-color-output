<?php

namespace Jfcherng\Color;

/**
 * Make your PHP command-line application colorful.
 *
 * @see https://en.wikipedia.org/wiki/ANSI_escape_code
 *
 * @author Jack Cherng <jfcherng@gmail.com>
 */
class Colorful
{
    const COLOR_BEGIN = "\033[";
    const COLOR_END = 'm';

    const COLOR_BEGIN_REGEX = "\033\\[";
    const COLOR_END_REGEX = 'm';

    /**
     * @var array the color map
     */
    protected static $colorMap = [
        // background
        'b_black' => '40',
        'b_blue' => '44',
        'b_cyan' => '46',
        'b_green' => '42',
        'b_light_gray' => '47',
        'b_magenta' => '45',
        'b_red' => '41',
        'b_yellow' => '43',

        // foreground
        'f_black' => '30',
        'f_blue' => '34',
        'f_brown' => '33',
        'f_cyan' => '36',
        'f_green' => '32',
        'f_light_gray' => '37',
        'f_normal' => '39',
        'f_purple' => '35',
        'f_red' => '31',

        // compound
        'f_dark_gray' => '1;30',
        'f_light_blue' => '1;34',
        'f_light_cyan' => '1;36',
        'f_light_green' => '1;32',
        'f_light_purple' => '1;35',
        'f_light_red' => '1;31',
        'f_white' => '1;37',
        'f_yellow' => '1;33',

        // special
        'blink' => '5',
        'bold' => '1',
        'dim' => '2',
        'hidden' => '8',
        'reset' => '0',
        'reverse' => '7',
        'underline' => '4',

        // alias
        'b' => 'bold',
        'blk' => 'blink',
        'h' => 'hidden',
        'rev' => 'reverse',
        'rst' => 'reset',
        'u' => 'underline',
    ];

    /**
     * Get the color map.
     *
     * @return array the color map
     */
    public static function getColorMap(): array
    {
        return static::$colorMap;
    }

    /**
     * Make a string colorful.
     *
     * @param string       $str       the string
     * @param array|string $colors    the colors
     * @param bool         $autoReset automatically reset at the end of the string?
     *
     * @return string the colored string
     */
    public static function color(string $str, $colors = [], bool $autoReset = true): string
    {
        if ($str === '' && empty($colors)) {
            return '';
        }

        $colored = static::getColorCode($colors) . $str;

        if ($autoReset) {
            $colored .= static::getColorCode(['reset']);
        }

        return static::simplifyColoredString($colored);
    }

    /**
     * Remove all colors from a string.
     *
     * @param string $str the string
     *
     * @return string the string without colors
     */
    public static function noColor(string $str): string
    {
        $regex = (
            '~' .
            static::COLOR_BEGIN_REGEX .
            '([0-9]++;?)++' .
            static::COLOR_END_REGEX .
            '~uS'
        );

        return preg_replace($regex, '', $str);
    }

    /**
     * Get the color code from given colors.
     *
     * @param array|string $colors the colors
     *
     * @return string the color code
     */
    protected static function getColorCode($colors): string
    {
        $colors = static::sanitizeColors($colors);

        if (empty($colors)) {
            return '';
        }

        $colorCodes = array_map(
            function (string $color): string {
                for (; isset(static::$colorMap[$color]);) {
                    $color = static::$colorMap[$color];
                }

                return $color;
            },
            $colors
        );

        return static::COLOR_BEGIN . implode(';', $colorCodes) . static::COLOR_END;
    }

    /**
     * Sanitize colors.
     *
     * @param array|string $colors the colors
     *
     * @return array the sanitized colors
     */
    protected static function sanitizeColors($colors): array
    {
        if (is_string($colors)) {
            $colors = explode(',', $colors);
        }

        return array_filter(
            array_map('trim', $colors),
            function (string $color): bool {
                return isset(static::$colorMap[$color]);
            }
        );
    }

    /**
     * Simplify the colored string.
     *
     * @param string $str the colored string
     *
     * @return string the simplified colored string
     */
    protected static function simplifyColoredString(string $str): string
    {
        // replace multiple consecutive resets with a single reset
        $str = preg_replace(
            '~(' . static::COLOR_BEGIN_REGEX . '0' . static::COLOR_END_REGEX . '){2,}~uS',
            static::COLOR_BEGIN . '0' . static::COLOR_END,
            $str
        );

        return $str;
    }
}
