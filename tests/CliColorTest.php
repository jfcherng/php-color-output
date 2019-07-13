<?php

declare(strict_types=1);

namespace Jfcherng\Utility\Test;

use Jfcherng\Utility\CliColor;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jfcherng\Utility\CliColor
 *
 * @internal
 */
final class CliColorTest extends TestCase
{
    /**
     * Provide testcases for testing CliColor::color.
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
                // repeated colors only output once
                ['foo', 'b_green, b_green, b_green, b_green'],
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
     * Provide testcases for testing CliColor::noColor.
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
     * Test CliColor::color.
     *
     * @dataProvider colorTestcaseProvider
     *
     * @param array  $inputs   the inputs
     * @param string $expected the expected
     */
    public function testColor(array $inputs, string $expected): void
    {
        static::assertSame($expected, CliColor::color(...$inputs));
    }

    /**
     * Test CliColor::noColor.
     *
     * @dataProvider noColorTestcaseProvider
     *
     * @param string $inputs   the input
     * @param string $expected the expected
     */
    public function testNoColor(string $input, string $expected): void
    {
        static::assertSame($expected, CliColor::noColor($input));
    }
}
