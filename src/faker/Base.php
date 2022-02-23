<?php

/**
 * 伪造者基础
 * 
 * @author  骚气靓丽的仔仔
 * @date    2022-01-12 20:41:39
 * 
 */

namespace Faker;

use Faker\Util;

class Base
{

    protected $util;

    protected $Dir_Path = '';

    public function __construct()
    {
        $this->util = new Util();
    }

    /**
     * Returns a random number between $int1 and $int2 (any order)
     *
     * @param integer $int1 default to 0
     * @param integer $int2 defaults to 32 bit max integer, ie 2147483647
     * @example 79907610
     *
     * @return integer
     */
    public function numberBetween($int1 = 0, $int2 = 2147483647)
    {
        $min = $int1 < $int2 ? $int1 : $int2;
        $max = $int1 < $int2 ? $int2 : $int1;
        return mt_rand($min, $max);
    }

    /**
     * 随机生成 0-9 之间的数值
     *
     * @return integer
     */
    public function randomDigit()
    {
        return mt_rand(0, 9);
    }

    /**
     * 随机生成 1-9 之间的数值
     *
     * @return integer
     */
    public function randomDigitNotNull()
    {
        return mt_rand(1, 9);
    }

    /**
     * 随机生成一个指定 0-xx 的数值
     *
     * The maximum value returned is mt_getrandmax()
     *
     * @param integer $nbDigits Defaults to a random number between 1 and 9
     * @param boolean $strict   Whether the returned number should have exactly $nbDigits
     *
     * @return integer
     */
    public function randomNumber($nbDigits = null, $strict = false)
    {
        if (!is_bool($strict)) {
            return $this->randomNumber($nbDigits, false);
        }
        if (null === $nbDigits) {
            $nbDigits = $this->randomDigitNotNull();
        }
        $max = pow(10, $nbDigits) - 1;
        if ($max > mt_getrandmax()) {
            return $this->randomNumber($nbDigits, false);
        }
        if ($strict) {
            return mt_rand(pow(10, $nbDigits - 1), $max);
        }

        return mt_rand(0, $max);
    }

    /**
     * 随机浮点数
     *
     * @param int       $nbMaxDecimals  最大小数值
     * @param int|float $min
     * @param int|float $max
     * @example 48.8932
     *
     * @return float
     */
    public function randomFloat($nbMaxDecimals = null, $min = 0, $max = null)
    {
        if (null === $nbMaxDecimals) {
            $nbMaxDecimals = $this->randomDigit();
        }

        if (null === $max) {
            $max = $this->randomNumber();
            if ($min > $max) {
                $max = $min;
            }
        }

        if ($min > $max) {
            $tmp = $min;
            $min = $max;
            $max = $tmp;
        }

        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), $nbMaxDecimals);
    }
}
