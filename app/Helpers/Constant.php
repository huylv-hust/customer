<?php

namespace App\Helpers;

class Constant
{
    public static $city = [
        '' => ' --- City ---',
        '1' => 'Hà Nội',
        '2' => 'Hồ Chí Minh',
        '3' => 'Đà Nẵng',
        '4' => 'Bắc Kạn',
        '5' => 'Bắc Giang',
        '6' => 'Bắc Ninh',
        '7' => 'Bến Tre',
        '8' => 'Bình Dương',
        '9' => 'Bình Định',
        '10' => 'Bình Phước',
        '11' => 'Bình Thuận',
        '12' => 'Cà Mau',
        '13' => 'Cao Bằng',
        '14' => 'Cần Thơ',
        '15' => 'Đắk Lắk',
        '16' => 'Đồng Nai',
        '17' => 'Đồng Tháp',
        '18' => 'Gia Lai',
        '19' => 'Hà Giang',
        '20' => 'Hà Nam',
        '21' => 'An Giang',
        '22' => 'Hậu Giang',
        '23' => 'Hà Tĩnh',
        '24' => 'Hải Dương',
        '25' => 'Hải Phòng',
        '26' => 'Hòa Bình',
        '27' => 'Hưng Yên',
        '28' => 'Bà Rịa Vũng Tàu',
        '29' => 'Khánh Hòa',
        '30' => 'Kiên Giang',
        '31' => 'Kon Tum',
        '32' => 'Lai Châu',
        '33' => 'Lạng Sơn',
        '34' => 'Lào Cai',
        '35' => 'Lâm Đồng',
        '36' => 'Long An',
        '37' => 'Nam Định',
        '38' => 'Nghệ An',
        '39' => 'Ninh Bình',
        '40' => 'Ninh Thuận',
        '41' => 'Phú Thọ',
        '42' => 'Phú Yên',
        '43' => 'Quảng Bình',
        '44' => 'Quảng Nam',
        '45' => 'Quảng Ngãi',
        '46' => 'Quảng Ninh',
        '47' => 'Quảng Trị',
        '48' => 'Sóc Trăng',
        '49' => 'Sơn La',
        '50' => 'Tây Ninh',
        '51' => 'Thái Bình',
        '52' => 'Thái Nguyên',
        '53' => 'Thanh Hóa',
        '54' => 'Thừa Thiên Huế',
        '55' => 'Tiền Giang',
        '56' => 'Trà Vinh',
        '57' => 'Tuyên Quang',
        '58' => 'Vĩnh Long',
        '59' => 'Vĩnh Phúc',
        '60' => 'Yên Bái',
        '61' => 'Điện Biên',
        '62' => 'Đắk Nông',
        '63' => 'Bạc Liêu',
    ];

    public static $gender = [
        '' => ' --- Gender ---',
        '1' => 'Male',
        '2' => 'Female',
        '3' => 'Other',
    ];

    public static function encryptData($textToEncrypt)
    {
        $encryptedMessage = openssl_encrypt($textToEncrypt, config('app.cipher'), config('app.secret_hash'), 0, config('app.iv'));
        $encryptedMessage = str_replace("+", "-", $encryptedMessage);
        $encryptedMessage = str_replace("/", "_", $encryptedMessage);
        return $encryptedMessage;
    }

    public static function decryptData($textToDecrypt)
    {
        $textToDecrypt = str_replace("-", "+", $textToDecrypt);
        $textToDecrypt = str_replace("_", "/", $textToDecrypt);
        $decryptedMessage = openssl_decrypt($textToDecrypt, config('app.cipher'), config('app.secret_hash'), 0, config('app.iv'));
        return $decryptedMessage;
    }

    public static function checkToken($json)
    {
        $decode = json_decode($json);
        if (isset($decode->email) && $decode->email && isset($decode->expired) && $decode->expired > time()) {
            return true;
        }
        return false;
    }

    public static $user = [
        'user' => 'admin',
        'password' => '999999',
    ];
}