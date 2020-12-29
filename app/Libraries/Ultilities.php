<?php

namespace App\Libraries;

use App\Jobs\SavePushNotification;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use File;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class Ultilities
{

    /**
     * get event by day
     * @author lamnt
     * @param
     * @date
     * type = 0 is week, = 1 is month, = 2 is day, = 3 is year
     */
    public static function dateSignup($datefr, $dateto, $day, $type = 0)
    {
        $period = new DatePeriod(
            new DateTime($datefr),
            new DateInterval('P1D'),
            new DateTime($dateto)
        );
        $strday = null;
        switch($day){
            case 1:$strday = 'Sunday';break;
            case 2:$strday = 'Monday';break;
            case 3:$strday = 'Tuesday';break;
            case 4:$strday = 'Wednesday';break;
            case 5:$strday = 'Thursday';break;
            case 6:$strday = 'Friday';break;
            case 7:$strday = 'Saturday';break;
            default: $strday = null; break;
        }
        if(!empty($strday)){
            $res = [];
            foreach ($period as $key => $value) {
                $date = $value->format('Y-m-d');
                $day_select = date('l', strtotime($date));
                if($type == 0){
                    if($day_select === $strday){
                        $res[] = [
                            'date'=>$date
                        ];
                    }
                }
                if($type == 2){
                    $res[] = [
                        'date'=>$date
                    ];
                }
            }
            return $res;
        }
        return null;
    }

    public static function formatDate($date, $type = 0)
    {
        if (empty($date)) {
            return null;
        }
        //input
        if ($type == 0) {
            $test =  Carbon::createFromFormat('d/m/Y', $date)->format('m/d/Y');
            return date("Y/m/d", strtotime($test));
        }
        if ($type == 2) {
            return date("d/m/Y", strtotime($date));
        }
        if ($type == 3) {
            $fomat = explode(' ', $date);
            $res =  Carbon::createFromFormat('d/m/Y', $fomat[0])->format('m/d/Y');
            $res .= $fomat[1];
            return date("Y/m/d H:i", strtotime($res));
        }
        return date("Y/m/d", strtotime($date));
    }

    public static function formatDateHMI($date)
    {
        //input
        // $test =  Carbon::createFromFormat('d/m/Y h:i:s', $date)->format('m/d/Y');
        return date("Y/m/d - h:i", strtotime($date));
    }

    /**
     * call date have time
     * @author lamnt
     * @param date $date
     */
    public static function fomatDateTime($date)
    {
        $dateTime = explode(' ', $date);
        $dateFomat = self::formatDate($dateTime[0]);
        $dateTimeFomat = $dateFomat . '-' . $dateTime[1];
        return date("Y/m/d - h:i", strtotime($dateTimeFomat));
    }

    public static function uploadFile($file)
    {
        $publicPath = public_path('uploads');
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0775, true, true);
        }
        $name = time().'-eduzu-'.$file->getClientOriginalName();
        $name = preg_replace('/\s+/', '', $name);
        $file->move(public_path('uploads'), $name);
        return '/uploads/'.$name;
    }

    //full url image, avatar...
    public static function replaceUrlImage($val)
    {
        $image = '';
        if (!empty($val)) {
            if (!filter_var($val, FILTER_VALIDATE_URL)) {
                $image = url($val);
            } else {
                $image = $val;
            }
        }
        return $image;
    }

    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);

        return $string;
    }
    public static function removeScripts($str)
    {
        $regex =
            '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|'.
            '<script[^>]*>.*?<\/script>|'.
            '<style[^>]*>.*?<\/style>|'.
            '<!--.*?-->/is';

        return preg_replace($regex, '', $str);
    }
    public static function phoneStartsWith($str, $prefix, $pos = 0, $encoding = null)
    {
        if (is_null($encoding)) {
            $encoding = mb_internal_encoding();
        }
        return mb_substr($str, $pos, mb_strlen($prefix, $encoding), $encoding) === $prefix;
    }
    public static function replacePhone($phone)
    {
        if (empty($phone)) {
            return $phone;
        }
        if (!self::phoneStartsWith($phone, '+84') && !self::phoneStartsWith($phone, '84') && !self::phoneStartsWith($phone, '0')) {
            $phone = '0'.$phone;
            // dd($phone);
        }
        if ($phone == '') {
            return null;
        }
        $search = array('(84)', '(+84)', '+84', ' ', '-');
        $replace = array('0', '0', '0', '', '');
        $phone = str_replace($search, $replace, Ultilities::clearXSS($phone));
        $rest = substr($phone, 0, 2);
        if ($rest == '84') {
            $restPhone = substr($phone, 2);
            $phone  = '0'.$restPhone;
        }
        return $phone;
    }

    public static function replacePhoneUSA($phone)
    {
        $restRe = substr($phone, 0, 1);
        if ($restRe == '0') {
            $restPhone = substr($phone, 1);
            $phone  = '(+84)' . $restPhone;
        }
    }

    public static function checkAvalable($nameAvailable, $val = null)
    {
        if (!empty(\Session::get($nameAvailable))) {
            if(!empty($val)){
                return $val;
            }
            return 'selected';
        }
        return null;
    }

    public static function wordLimiter($str, $limit = 100, $endChar = '&#8230;')
    {
        if (trim($str) == '') {
            return $str;
        }
        preg_match('/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches);
        if (strlen($str) == strlen($matches[0])) {
            $endChar = '';
        }
        return rtrim($matches[0]) . $endChar;
    }

    public static function characterLimiter($str, $limit = 500, $endChar = '&#8230;')
    {

        $str = preg_replace("/\\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
        if (strlen($str) <= $limit) {
            return $str;
        }
        $out = "";
        foreach (explode(' ', trim($str)) as $val) {
            $out .= $val . ' ';
            if (strlen($out) >= $limit) {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out . $endChar;
            }
        }
    }
}
