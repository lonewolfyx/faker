<?php

/**
 * 城市街道数据
 * 
 * @author  骚气靓丽的仔仔
 * @date    2022-02-17 23:27:13
 */

namespace Faker;

class Address extends Base
{

    /**
     * 基本方向+顺序
     */
    private $direction = array(
        '东', '南', '西', '北', '东北', '西北', '东南', '西南'
    );

    /**
     * 城市数据随机获取
     * 
     * @param string $filename 文件名
     * @param string $region_code 是否输出区域代码
     * @return string|array
     */
    private function getRegionData(string $filename, bool $region_code = false)
    {
        $regions = json_decode($this->util->get('region', ucfirst($filename), 'json'), true);
        $total = count($regions);
        $random = rand(0, ($total - 1));

        if ($region_code) {
            return $this->util->array_random($regions);
        }

        return $this->util->array_random($regions)['name'];
    }

    /**
     * 随机省份
     * 
     * @param bool $region_code 区域代码
     * @return string|array
     */
    public function province(bool $region_code = false)
    {
        if ($region_code) {
            return $this->getRegionData('province', true);
        }

        return $this->getRegionData('province');
    }

    /**
     * 随机省份代码
     * 
     * @return int
     */
    public function provCode()
    {
        return $this->province(true)['code'];
    }

    /**
     * 随机城市
     * 
     * @param bool $region_code 区域代码
     * @return string|array
     */
    public function city(bool $region_code = false)
    {
        if ($region_code) {
            return $this->getRegionData('city', true);
        }

        return $this->getRegionData('city');
    }

    /**
     * 随机城市代码
     * 
     * @return int
     */
    public function cityCode()
    {
        return $this->city(true)['code'];
    }

    /**
     * 随机区域
     * 
     * @param bool $region_code 区域代码
     * @return string|array
     */
    public function area(bool $region_code = false)
    {
        if ($region_code) {
            return $this->getRegionData('area', true);
        }

        return $this->getRegionData('area');
    }

    /**
     * 随机区域代码
     * 
     * @return int
     */
    public function areaCode()
    {
        return $this->area(true)['code'];
    }

    /**
     * 随机国家
     * 
     * @return string
     */
    public function country()
    {
        return $this->util->array_random($this->util->load('dictionaries', 'country'));
    }

    /**
     * 随机国家代码
     * 
     * @return string
     */
    public function countryCode()
    {
        return $this->util->array_random($this->util->load('dictionaries', 'country_code'));
    }

    /**
     * 随机生成省份缩写
     * 
     * @return string
     */
    public function stateAbbr()
    {
        $stats = array('京', '沪', '津', '渝', '黑', '吉', '辽', '蒙', '冀', '新', '甘', '青', '陕', '宁', '豫', '鲁', '晋', '皖', '鄂', '湘', '苏', '川', '黔', '滇', '桂', '藏', '浙', '赣', '粤', '闽', '台', '琼', '港', '澳');
        return $this->util->array_random($stats);
    }

    /**
     * 随机生成纬度
     */
    public function latitude($min = -90, $max = 90)
    {
        return $this->randomFloat(6, $min, $max);
    }

    /**
     * 随机生成经度
     */
    public function longitude($min = -180, $max = 180)
    {
        return static::randomFloat(6, $min, $max);
    }

    /**
     * 随机经纬度
     * @return array
     */
    public function localCoordinates()
    {
        return array(
            'latitude' => static::latitude(),
            'longitude' => static::longitude()
        );
    }
    /**
     * 随机生成方向（基数和序数；西北、东方等）
     * 
     * @return string
     */
    public function direction()
    {
        return $this->direction[rand(0, 7)];
    }

    /**
     * 随机生成基本方向（北、东、南、西）。
     * 
     * @return string
     */
    public function cardinalDirection($useAbbr = false)
    {
        return $this->direction[rand(0, 3)];
    }

    /**
     * 随机生成方向顺序（西北、东南等）
     * 
     * @return string
     */
    public function ordinalDirection($useAbbr = false)
    {
        return $this->direction[rand(4, 7)];
    }

    public function nearbyGPSCoordinate()
    {
    }

    /**
     * 随机生成时区
     * 
     * @return string
     */
    public function timeZone()
    {
        $time_zone = array(
            'Pacific/Midway',
            'Pacific/Pago_Pago',
            'Pacific/Honolulu',
            'America/Juneau',
            'America/Los_Angeles',
            'America/Tijuana',
            'America/Denver',
            'America/Phoenix',
            'America/Chihuahua',
            'America/Mazatlan',
            'America/Chicago',
            'America/Regina',
            'America/Mexico_City',
            'America/Mexico_City',
            'America/Monterrey',
            'America/Guatemala',
            'America/New_York',
            'America/Indiana/Indianapolis',
            'America/Bogota',
            'America/Lima',
            'America/Lima',
            'America/Halifax',
            'America/Caracas',
            'America/La_Paz',
            'America/Santiago',
            'America/St_Johns',
            'America/Sao_Paulo',
            'America/Argentina/Buenos_Aires',
            'America/Guyana',
            'America/Godthab',
            'Atlantic/South_Georgia',
            'Atlantic/Azores',
            'Atlantic/Cape_Verde',
            'Europe/Dublin',
            'Europe/London',
            'Europe/Lisbon',
            'Europe/London',
            'Africa/Casablanca',
            'Africa/Monrovia',
            'Etc/UTC',
            'Europe/Belgrade',
            'Europe/Bratislava',
            'Europe/Budapest',
            'Europe/Ljubljana',
            'Europe/Prague',
            'Europe/Sarajevo',
            'Europe/Skopje',
            'Europe/Warsaw',
            'Europe/Zagreb',
            'Europe/Brussels',
            'Europe/Copenhagen',
            'Europe/Madrid',
            'Europe/Paris',
            'Europe/Amsterdam',
            'Europe/Berlin',
            'Europe/Berlin',
            'Europe/Rome',
            'Europe/Stockholm',
            'Europe/Vienna',
            'Africa/Algiers',
            'Europe/Bucharest',
            'Africa/Cairo',
            'Europe/Helsinki',
            'Europe/Kiev',
            'Europe/Riga',
            'Europe/Sofia',
            'Europe/Tallinn',
            'Europe/Vilnius',
            'Europe/Athens',
            'Europe/Istanbul',
            'Europe/Minsk',
            'Asia/Jerusalem',
            'Africa/Harare',
            'Africa/Johannesburg',
            'Europe/Moscow',
            'Europe/Moscow',
            'Europe/Moscow',
            'Asia/Kuwait',
            'Asia/Riyadh',
            'Africa/Nairobi',
            'Asia/Baghdad',
            'Asia/Tehran',
            'Asia/Muscat',
            'Asia/Muscat',
            'Asia/Baku',
            'Asia/Tbilisi',
            'Asia/Yerevan',
            'Asia/Kabul',
            'Asia/Yekaterinburg',
            'Asia/Karachi',
            'Asia/Karachi',
            'Asia/Tashkent',
            'Asia/Kolkata',
            'Asia/Kolkata',
            'Asia/Kolkata',
            'Asia/Kolkata',
            'Asia/Kathmandu',
            'Asia/Dhaka',
            'Asia/Dhaka',
            'Asia/Colombo',
            'Asia/Almaty',
            'Asia/Novosibirsk',
            'Asia/Rangoon',
            'Asia/Bangkok',
            'Asia/Bangkok',
            'Asia/Jakarta',
            'Asia/Krasnoyarsk',
            'Asia/Shanghai',
            'Asia/Chongqing',
            'Asia/Hong_Kong',
            'Asia/Urumqi',
            'Asia/Kuala_Lumpur',
            'Asia/Singapore',
            'Asia/Taipei',
            'Australia/Perth',
            'Asia/Irkutsk',
            'Asia/Ulaanbaatar',
            'Asia/Seoul',
            'Asia/Tokyo',
            'Asia/Tokyo',
            'Asia/Tokyo',
            'Asia/Yakutsk',
            'Australia/Darwin',
            'Australia/Adelaide',
            'Australia/Melbourne',
            'Australia/Melbourne',
            'Australia/Sydney',
            'Australia/Brisbane',
            'Australia/Hobart',
            'Asia/Vladivostok',
            'Pacific/Guam',
            'Pacific/Port_Moresby',
            'Asia/Magadan',
            'Asia/Magadan',
            'Pacific/Noumea',
            'Pacific/Fiji',
            'Asia/Kamchatka',
            'Pacific/Majuro',
            'Pacific/Auckland',
            'Pacific/Auckland',
            'Pacific/Tongatapu',
            'Pacific/Fakaofo',
            'Pacific/Apia'
        );
        return $this->util->array_random($time_zone);
    }
}
