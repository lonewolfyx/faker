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
     * @param string $ext 文件扩展名
     * @return array
     */
    public function load($folder, $name, $ext = 'php')
    {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $name . '.' . $ext;
        if (is_file($filename)) {
            return include($filename);
        }

        return array();
    }

    /**
     * 获取相关内容
     * 
     * @param string $folder 文件夹名称
     * @param string $name 文件名称
     * @param string $ext 文件扩展名
     * @return mixed
     */
    public function get($folder, $name, $ext = 'php')
    {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $name . '.' . $ext;
        if (is_file($filename)) {
            return file_get_contents($filename);
        }

        return array();
    }
}
