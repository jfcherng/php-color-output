<?php

declare(strict_types=1);

namespace Jfcherng\Color\Test;

use Jfcherng\Color\Colorful;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jfcherng\Color\Colorful
 *
 * @internal
 */
final class ColorfulTest extends TestCase
{
    /**
     * Provide testcases for testing Colorful::color.
     *
     * @return array the testcases
     */
    public function colorTestcaseProvider(): array
    {
        return [
            [
                [''],
                "\033[0m",
            ],
            [
                ['', 'b_green'],
                "\033[0m",
            ],
            [
                ['', 'b_green', false],
                "\033[42m",
            ],
            [
                ['foo'],
                'foo' . "\033[0m",
            ],
            [
                ['foo' . "\033[0m"],
                'foo' . "\033[0m",
            ],
            [
                ['foo', ''],
                'foo' . "\033[0m",
            ],
            [
                ['foo', 'b_green, b_green'],
                "\033[42m" . 'foo' . "\033[0m",
            ],
            [
                ['foo', ['foo', 'b_green', 'bar'], false],
                "\033[42m" . 'foo',
            ],
            [
                ['foo', 'f_red, b_green'],
                "\033[31;42m" . 'foo' . "\033[0m",
            ],
            [
                ['foo', ['f_red', 'b_green', 'blk']],
                "\033[31;42;5m" . 'foo' . "\033[0m",
            ],
            [
                ['foo', ['f_red', 'b_green', 'blk'], false],
                "\033[31;42;5m" . 'foo',
            ],
        ];
    }

    /**
     * Provide testcases for testing Colorful::noColor.
     *
     * @return array the testcases
     */
    public function noColorTestcaseProvider(): array
    {
        return [
            [
                "\033[31;42;5m" . 'foo' . "\033[0m" . 'bar',
                'foobar',
            ],
        ];
    }

    /**
     * Test Colorful::color.
     *
     * @dataProvider colorTestcaseProvider
     *
     * @param array  $inputs   The inputs
     * @param string $expected The expected
     */
    public function testColor(array $inputs, string $expected): void
    {
        static::assertSame($expected, Colorful::color(...$inputs));
    }

    /**
     * Test Colorful::noColor.
     *
     * @dataProvider noColorTestcaseProvider
     *
     * @param string $inputs   The input
     * @param string $expected The expected
     */
    public function testNoColor(string $input, string $expected): void
    {
        static::assertSame($expected, Colorful::noColor($input));
    }
}
