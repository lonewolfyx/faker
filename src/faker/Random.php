<?php

/**
 * 数据伪造 - 随机数值
 * 
 * @author  骚气靓丽的仔仔
 * @date    2022-01-17 16:41:07
 */

namespace Faker;

class Random
{
    /**
     * 随机字符串
     * 
     * @param  int    $length 长度
     * @param  bool   $useLowerCase 使用小写
     * @param  bool   $useUpperCase 使用大写
     * @param  bool   $useNumbers  使用数字
     * @param  bool   $useSpecial 使用特殊符号
     * @param  bool   $useHex 十六进制符号
     * @param  string $pool  指定字符串内容
     * @return string
     */
    public function randomString($length = 7, $useLowerCase = true, $useUpperCase = true, $useNumbers = true, $useSpecial = false, $useHex = false, $pool = '')
    {
        $key = '';
        $chars = '';

        if ($useLowerCase) {
            $chars .= 'abcdefghijklmnopqrstuvwxyz';
        }

        if ($useUpperCase) {
            $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        if ($useNumbers) {
            $chars .= '1234567890';
        }

        if ($useSpecial) {
            $chars .= '`~!@#$%^&*()-=_+[]{}|;\':",./<>?';
        }

        if ($useHex) {
            $chars .= '123456789ABCDEF';
        }

        if ($pool) {
            $chars .= $pool;
        }


        for ($i = 0; $i < $length; $i++) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $key .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            $key .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $key;
    }

    /**
     * 随机字母
     */
    public function alphaNumeric(int $number = 1)
    {
        return $this->randomString($number, true, false, false, false, false);
    }

    /**
     * 随机布尔值
     * 
     * @return bool
     */
    public function boolean()
    {
        $number = rand(1, 9999);
        if ($number / 1) {
            return true;
        }

        return false;
    }

    /**
     * 十六进制
     * 
     * @param int $number 数量
     * @return string
     */
    public function hexaDecimal(int $number = 1)
    {
        return '0x' . $this->randomString($number, false, false, false, false, true);
    }
}
