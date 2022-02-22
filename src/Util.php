<?php

namespace Faker;

class Util
{
    /**
     * 随机数组中一位
     * 
     * @example array_random({...});
     */
    public function array_random(array $array)
    {
        return $array[array_rand($array, 1)];
    }

    /**
     * 文件数据加载
     * 
     * @param string $folder 文件夹名称
     * @param string $name 文件名称
     * @return array
     */
    public function load($folder, $name)
    {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $name . '.php';
        if (is_file($filename)) {
            return include($filename);
        }

        return array();
    }
}
