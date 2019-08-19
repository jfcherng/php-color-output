# php-color-output 

<a href="https://travis-ci.org/jfcherng/php-color-output"><img alt="Travis (.org) branch" src="https://img.shields.io/travis/jfcherng/php-color-output/master"></a>
<a href="https://packagist.org/packages/jfcherng/php-color-output"><img alt="Packagist" src="https://img.shields.io/packagist/dt/jfcherng/php-color-output"></a>
<a href="https://packagist.org/packages/jfcherng/php-color-output"><img alt="Packagist Version" src="https://img.shields.io/packagist/v/jfcherng/php-color-output"></a>
<a href="https://github.com/jfcherng/php-color-output/blob/master/LICENSE"><img alt="Project license" src="https://img.shields.io/github/license/jfcherng/php-color-output"></a>
<a href="https://github.com/jfcherng/php-color-output/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/jfcherng/php-color-output?logo=github"></a>
<a href="https://www.paypal.me/jfcherng/5usd" title="Donate to this project using Paypal"><img src="https://img.shields.io/badge/paypal-donate-blue.svg?logo=paypal" /></a>

![demo.gif](https://i.imgur.com/xMhYHjV.gif)

The above screenshot is the output of `demo.php`. See the [Example](#example) section.


## Installation

```
composer require jfcherng/php-color-output
```


## Available Colors

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


## Functions

```php
<?php

// a global alias to \Jfcherng\Utility\CliColor::color
function str_cli_color(string $str, $colors = [], bool $reset = true): string

// a global alias to \Jfcherng\Utility\CliColor::noColor
function str_cli_nocolor(string $str): string
```


## Methods

```php
<?php

/**
 * Make a string colorful.
 *
 * @param string          $str       the string
 * @param string|string[] $colors    the colors
 * @param bool            $reset     reset color at the end of the string?
 *
 * @return string the colored string
 */
\Jfcherng\Utility\CliColor::color(string $str, $colors = [], bool $reset = true): string

/**
 * Remove all colors from a string.
 *
 * @param string $str the string
 *
 * @return string the string without colors
 */
\Jfcherng\Utility\CliColor::noColor(string $str): string
```


## Example

```php
<?php

include __DIR__ . '/vendor/autoload.php';

// colors in a string using a comma as the delimiter
echo str_cli_color('foo', 'f_light_cyan, b_yellow');  // "\033[1;36;43mfoo\033[0m"

echo PHP_EOL;

// colors in an array
echo str_cli_color('foo', ['f_white', 'b_magenta']); // "\033[1;37;45mfoo\033[0m"

echo PHP_EOL;

// do not auto reset color at the end of string
echo str_cli_color('foo', ['f_red', 'b_green', 'b', 'blk'], false); // "\033[31;42;1;5mfoo"

// manually add color reset
echo str_cli_color('', 'reset'); // "\033[0m"

echo PHP_EOL;

// remove all color codes from a string
echo str_cli_nocolor("\033[31;42;5mfoo\033[0mbar"); // "foobar"

echo PHP_EOL;
```
