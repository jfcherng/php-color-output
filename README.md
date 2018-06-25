# php-color-output [![Build Status](https://travis-ci.org/jfcherng/php-color-output.svg?branch=master)](https://travis-ci.org/jfcherng/php-color-output)

![demo.gif](https://i.imgur.com/xMhYHjV.gif)

The above screenshot is the output of `demo.php`. See the [Example](#example) section.


# Installation

```
composer require jfcherng/php-color-output --no-dev
```


# Available Colors

| Background   | Foreground   | Compound       | Special   | Alias         |
| ---          | ---          | ---            | ---       | ---           |
| b_black      | f_black      | f_dark_gray    | blink     | b (bold)      |
| b_blue       | f_blue       | f_light_blue   | bold      | blk (blink)   |
| b_cyan       | f_brown      | f_light_cyan   | dim       | h (hidden)    |
| b_green      | f_cyan       | f_light_green  | hidden    | rev (reverse) |
| b_light_gray | f_green      | f_light_purple | reset     | rst (reset)   |
| b_magenta    | f_light_gray | f_light_red    | reverse   | u (underline) |
| b_red        | f_normal     | f_white        | underline | -             |
| b_yellow     | f_purple     | f_yellow       | -         | -             |
| -            | f_red        | -              | -         | -             |


# Functions

```php
<?php

// a global alias to \Jfcherng\Color\Colorful::color
function str_color(string $str, $colors = [], bool $autoReset = true): string

// a global alias to \Jfcherng\Color\Colorful::noColor
function str_nocolor(string $str): string
```


# Methods

```php
<?php

/**
 * Make a string colorful.
 *
 * @param string       $str       the string
 * @param array|string $colors    the colors
 * @param bool         $autoReset automatically reset at the end of the string?
 *
 * @return string the colored string
 */
\Jfcherng\Color\Colorful::color(string $str, $colors = [], bool $autoReset = true): string

/**
 * Remove all colors from a string.
 *
 * @param string $str the string
 *
 * @return string the string without colors
 */
\Jfcherng\Color\Colorful::noColor(string $str): string
```


# Example

```php
<?php

include __DIR__ . '/vendor/autoload.php';

// colors in a string using a comma as the delimiter
echo str_color('foo', 'f_light_cyan, b_yellow');  // "\033[1;36;43mfoo\033[0m"

echo PHP_EOL;

// colors in an array
echo str_color('foo', ['f_white', 'b_magenta']); // "\033[1;37;45mfoo\033[0m"

echo PHP_EOL;

// do not auto reset color at the end of string
echo str_color('foo', ['f_red', 'b_green', 'b', 'blk'], false); // "\033[31;42;1;5mfoo"

// manually add color reset
echo str_color('', 'reset'); // "\033[0m"

echo PHP_EOL;

// remove all color codes from a string
echo str_nocolor("\033[31;42;5mfoo\033[0mbar"); // "foobar"

echo PHP_EOL;
```


Supporters <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ATXYY9Y78EQ3Y" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" /></a>
==========

Thank you guys for sending me some cups of coffee.
