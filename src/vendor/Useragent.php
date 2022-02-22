<?php

/**
 * Useragent 数据生成
 * 
 * @author  骚气靓丽的仔仔
 * @date    2022-01-17 20:55:03
 * 
 * @link    http://www.useragentstring.com/pages/useragentstring.php?name=All
 */

namespace Faker\vendor;

use Exception;
use Faker\Base;

class Useragent extends Base
{

    protected function randomBrowserAndOS()
    {
        $frequencies = array(
            34 => array(
                89 => array('chrome', 'win'),
                9 => array('chrome', 'mac'),
                2 => array('chrome', 'lin')
            ),

            32 => array(
                100 => array('iexplorer', 'win')
            ),

            25 => array(
                83 => array('firefox', 'win'),
                16 => array('firefox', 'mac'),
                1 => array('firefox', 'lin')
            ),

            7 => array(
                95 => array('safari', 'mac'),
                4 => array('safari', 'win'),
                1 => array('safari', 'lin')
            ),

            2 => array(
                91 => array('opera', 'win'),
                6 => array('opera', 'lin'),
                3 => array('opera', 'mac')
            )
        );

        $rand = rand(1, 100);
        $sum = 0;
        foreach ($frequencies as $freq => $osFreqs) {
            $sum += $freq;
            if ($rand <= $sum) {
                $rand = rand(1, 100);
                $sum = 0;
                foreach ($osFreqs as $freq => $choice) {
                    $sum += $freq;
                    if ($rand <= $sum) {
                        return $choice;
                    }
                }
            }
        }

        throw new Exception("Frequencies don't sum to 100.");
    }

    protected function randomLang()
    {
        $languages = array(
            'AB', 'AF', 'AN', 'AR', 'AS', 'AZ', 'BE', 'BG', 'BN', 'BO', 'BR', 'BS', 'CA', 'CE', 'CO', 'CS',
            'CU', 'CY', 'DA', 'DE', 'EL', 'EN', 'EO', 'ES', 'ET', 'EU', 'FA', 'FI', 'FJ', 'FO', 'FR', 'FY',
            'GA', 'GD', 'GL', 'GV', 'HE', 'HI', 'HR', 'HT', 'HU', 'HY', 'ID', 'IS', 'IT', 'JA', 'JV', 'KA',
            'KG', 'KO', 'KU', 'KW', 'KY', 'LA', 'LB', 'LI', 'LN', 'LT', 'LV', 'MG', 'MK', 'MN', 'MO', 'MS',
            'MT', 'MY', 'NB', 'NE', 'NL', 'NN', 'NO', 'OC', 'PL', 'PT', 'RM', 'RO', 'RU', 'SC', 'SE', 'SK',
            'SL', 'SO', 'SQ', 'SR', 'SV', 'SW', 'TK', 'TR', 'TY', 'UK', 'UR', 'UZ', 'VI', 'VO', 'YI', 'ZH'
        );
        return $languages[rand(0, 95)];
    }

    protected function randomProc($arch)
    {
        $procs = array(
            'lin' => array('i686', 'x86_64'),
            'win' => array('', 'WOW64', 'Win64; x64'),
            'mac' => array(
                'Intel', 'PPC', 'U; Intel', 'U; PPC'
            )
        );

        return $this->array_random($procs[$arch]);
    }

    protected function randomRevision($dots)
    {
        $return_val = '';

        for ($x = 0; $x < $dots; $x++) {
            $return_val .= '.' . rand(0, 9);
        }

        return $return_val;
    }

    protected function version_string($type, $delim = null)
    {
        switch ($type) {
            case 'net':
                $numbers = implode('.', array(rand(1, 4), rand(0, 9), rand(10000, 99999), rand(0, 9)));
                break;
            case 'nt':
                $numbers = rand(5, 6) . '.' . rand(0, 3);
                break;
            case 'ie':
                $numbers = rand(7, 11);
                break;
            case 'trident':
                $numbers = rand(3, 7) . '.' . rand(0, 1);
                break;
            case 'osx':
                $separator = $delim ?: '.';
                $numbers = implode($separator, array(10, rand(5, 10), rand(0, 9)));
                break;
            case 'chrome':
                $numbers = implode('.', array(rand(13.39), 0, rand(800, 899), 0));
                break;
            case 'presto':
                $numbers =  '2.9.' + rand(160, 190);
                break;
            case 'presto2':
                $numbers = rand(10, 12) . '.00';
                break;
            case 'safari':
                $numbers = rand(531, 538) . '.' . rand(0, 2) . '.' . rand(0, 2);
                break;
            default:
                $numbers = '';
                break;
        }

        return $numbers;
    }

    protected function firefox($arch)
    {
        $firefox_ver = rand(5, 15) . $this->randomRevision(2);
        // $gecko_ver = 'Gecko/20100101 Firefox/' . $firefox_ver;
        $gecko_ver = $this->array_random(array(
            'Gecko/' . date('Ymd', rand(strtotime('2011-1-1'), time())) . ' Firefox/' . $firefox_ver,
            'Gecko/' . date('Ymd', rand(strtotime('2011-1-1'), time())) . ' Firefox/' . $firefox_ver,
            'Gecko/' . date('Ymd', rand(strtotime('2010-1-1'), time())) . ' Firefox/3.6.' . rand(1, 20),
            'Gecko/' . date('Ymd', rand(strtotime('2010-1-1'), time())) . ' Firefox/3.8'
        ));
        $proc = $this->randomProc($arch);

        $os_ver = '';
        if ($arch === 'win') {
            $os_ver = '(Windows NT ' . $this->version_string('nt') . (($proc) ? '; ' . $proc : '');
        } else if ($arch === 'mac') {
            $os_ver = '(Macintosh; ' . $proc . ' Mac OS X ' . $this->version_string('osx');
        } else {
            $os_ver = '(X11; Linux ' . $proc;
        }

        return 'Mozilla/5.0 ' . $os_ver . '; rv:' . $firefox_ver . ') ' . $gecko_ver;
    }

    protected function iexplorer($arch)
    {
        $ver = $this->version_string('ie');

        if ($ver >= 11) {
            return 'Mozilla/5.0 (Windows NT 6.' . rand(1, 3) . '; Trident/7.0; ' . $this->array_random(['Touch; ', '']) . 'rv:11.0) like Gecko';
        }

        return 'Mozilla/5.0 (compatible; MSIE ' . $ver . '.0; Windows NT ' . $this->version_string('nt') . '; Trident/' .
            $this->version_string('trident') . ((rand(0, 1) === 1) ? '; .NET CLR ' . $this->version_string('net') : '') . ')';
    }

    protected function opera($arch)
    {
        $presto_ver = ' Presto/' .  $this->version_string('presto') . ' Version/' . $this->version_string('presto2') . ')';
        if ($arch == 'win') {
            $os_ver = '(Windows NT ' . $this->version_string('nt') . '; U; ' . $this->randomLang() . $presto_ver;
        } elseif ($arch == 'lin') {
            $os_ver = '(X11; Linux ' . $this->randomProc($arch) . '; U; ' . $this->randomLang() . $presto_ver;
        } else {
            $os_ver = '(Macintosh; Intel Mac OS X ' . $this->version_string('osx') .  ' U; ' . $this->randomLang() . ' Presto/' . $this->version_string('presto') . ' Version/' . $this->version_string('presto2') . ')';
        }

        return 'Opera/' . rand(9, 14) . '.' . rand(0, 99) . ' ' . $os_ver;
    }

    protected function safari($arch)
    {
        $safari = $this->version_string('safari');
        $ver = rand(4, 7) . '.' . rand(0, 1) . '.' . rand(0, 10);

        if ($arch === 'mac') {
            $os_ver = '(Macintosh; ' . $this->randomProc('mac') . ' Mac OS X ' . $this->version_string('osx', '_') . ' rv:' . rand(2, 6) . '.0; ' . $this->randomLang() . ') ';
        } else {
            $os_ver = '(Windows; U; Windows NT ' . $this->version_string('nt') . ')';
        }

        return 'Mozilla/5.0 ' . $os_ver . 'AppleWebKit/' . $safari . ' (KHTML, like Gecko) Version/' . $ver . ' Safari/' . $safari;
    }

    protected function chrome($arch)
    {
        $safari = $this->version_string('safari');

        if ($arch == 'win') {
            $os_ver = '(Windows; U; Windows NT ' . $this->version_string('nt') . ')';
        } elseif ($arch == 'mac') {
            $os_ver = '(Macintosh; ' . $this->randomProc('mac') . ' Mac OS X ' . $this->version_string('osx', '_') . ') ';
        } else {
            $os_ver = '(X11; Linux ' . $this->randomProc($arch);
        }

        return 'Mozilla/5.0 ' . $os_ver . ' AppleWebKit/' . $safari . ' (KHTML, like Gecko) Chrome/' . $this->version_string('chrome') . ' Safari/' . $safari;
    }

    public function generate()
    {
        // return 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36';
        // return $this->randomRevision(2);
        list($browser, $os) = $this->randomBrowserAndOS();
        // return $this->firefox('win');
        $ua = '';
        switch ($browser) {
            case 'firefox':
                $ua = $this->firefox($os);
                break;
            case 'iexplorer':
                $ua = $this->iexplorer($os);
                break;
            case 'opera':
                $ua = $this->opera($os);
                break;
            case 'safari':
                $ua = $this->safari($os);
                break;
            case 'chrome':
                $ua = $this->chrome($os);
                break;
        }

        return $ua;
        // return $this->iexplorer($os);
    }
}
