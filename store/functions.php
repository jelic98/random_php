<?php
function compress_image($source_url, $destination_url) { 
    if(!empty($source_url)) {
        $info = getimagesize($source_url); 

        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source_url); 
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source_url); 
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source_url); 

        imagejpeg($image, $destination_url, 80);

        $thumb_img = imagecreatetruecolor(500, 500);

        imagecopyresampled($thumb_img, $image,
                           0, 0,
                           0, 0,
                           150, 150,
                           $info[0], $info[1]);

        imagejpeg($thumb_img, $destination_url, 80);

        return $destination_url;    
    }
}

function resize($source_image, $destination) {
    if(!empty($source_image)) {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }

        $old_height = imagesx($source);
        $old_width = imagesy($source);

        $height = 500;
        $width = 500;

        if($old_height > $old_width) {
            $height = 500;
            $width = ($old_width * $height) / $old_height;
        }elseif($old_height < $old_width) {
            $width = 500;
            $height = ($old_height * $width) / $old_width;
        }

        $newpic = imagecreatetruecolor($width, $height);
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $width, $height, $old_width, $old_height);

        $final = imagecreatetruecolor(500, 500);
        $bg = imagecolorallocate ($final, 255, 255, 255);
        imagefill($final, 0, 0, $bg);
        imagecopy($final, $newpic, 0, 0, 0, 0, 500, 500);

        imagejpeg($final, $destination, 100);

        return $destination;  
    }
}

function bbl_sort(array $arr1, array $arr2) {
    if(isset($_GET['dir'])) {
        $dir = $_GET['dir'];
    }else {
        $dir = "asc";
    }

    $sorted = false;

    while (false === $sorted) {
        $sorted = true;

        for ($i = 0; $i < count($arr1)-1; ++$i) {
            if($dir == "asc") {
                if ($arr1[$i] > $arr1[$i+1]) {
                    $tmp1 = $arr1[$i];
                    $arr1[$i] = $arr1[$i+1];
                    $arr1[$i+1] = $tmp1;

                    $tmp2 = $arr2[$i];
                    $arr2[$i] = $arr2[$i+1];
                    $arr2[$i+1] = $tmp2;

                    $sorted = false;
                }   
            }

            if($dir == "desc") {
                if ($arr1[$i] < $arr1[$i+1]) {
                    $tmp1 = $arr1[$i];
                    $arr1[$i] = $arr1[$i+1];
                    $arr1[$i+1] = $tmp1;

                    $tmp2 = $arr2[$i];
                    $arr2[$i] = $arr2[$i+1];
                    $arr2[$i+1] = $tmp2;

                    $sorted = false;
                }
            }
        }
    }

    return $arr2;
}

function selectCountryCodeHTML() {
    $codes = array('Country code',
                   'AF',
                   'AL',
                   'DZ',
                   'AS',
                   'AD',
                   'AO',
                   'AI',
                   'AQ',
                   'AG',
                   'AR',
                   'AM',
                   'AW',
                   'AU',
                   'AT',
                   'AZ',
                   'BS',
                   'BH',
                   'BD',
                   'BB',
                   'BY',
                   'BE',
                   'BZ',
                   'BJ',
                   'BM',
                   'BT',
                   'BO',
                   'BQ',
                   'BA',
                   'BW',
                   'BV',
                   'BR',
                   'IO',
                   'BN',
                   'BG',
                   'BF',
                   'BI',
                   'KH',
                   'CM',
                   'CA',
                   'CV',
                   'KY',
                   'CF',
                   'TD',
                   'CL',
                   'CN',
                   'CX',
                   'CC',
                   'CO',
                   'KM',
                   'CG',
                   'CD',
                   'CK',
                   'CR',
                   'HR',
                   'CU',
                   'CW',
                   'CY',
                   'CZ',
                   'CI',
                   'DK',
                   'DJ',
                   'DM',
                   'DO',
                   'EC',
                   'EG',
                   'SV',
                   'GQ',
                   'ER',
                   'EE',
                   'ET',
                   'FK',
                   'FO',
                   'FJ',
                   'FI',
                   'FR',
                   'GF',
                   'PF',
                   'TF',
                   'GA',
                   'GM',
                   'GE',
                   'DE',
                   'GH',
                   'GI',
                   'GR',
                   'GL',
                   'GD',
                   'GP',
                   'GU',
                   'GT',
                   'GG',
                   'GN',
                   'GW',
                   'GY',
                   'HT',
                   'HM',
                   'VA',
                   'HN',
                   'HK',
                   'HU',
                   'IS',
                   'IN',
                   'ID',
                   'IR',
                   'IQ',
                   'IE',
                   'IM',
                   'IL',
                   'IT',
                   'JM',
                   'JP',
                   'JE',
                   'JO',
                   'KZ',
                   'KE',
                   'KI',
                   'KP',
                   'KR',
                   'KW',
                   'KG',
                   'LA',
                   'LV',
                   'LB',
                   'LS',
                   'LR',
                   'LY',
                   'LI',
                   'LT',
                   'LU',
                   'MO',
                   'MK',
                   'MG',
                   'MW',
                   'MY',
                   'MV',
                   'ML',
                   'MT',
                   'MH',
                   'MQ',
                   'MR',
                   'MU',
                   'YT',
                   'MX',
                   'FM',
                   'MD',
                   'MC',
                   'MN',
                   'ME',
                   'MS',
                   'MA',
                   'MZ',
                   'MM',
                   'NA',
                   'NR',
                   'NP',
                   'NL',
                   'NC',
                   'NZ',
                   'NI',
                   'NE',
                   'NG',
                   'NU',
                   'NF',
                   'MP',
                   'NO',
                   'OM',
                   'PK',
                   'PW',
                   'PS',
                   'PA',
                   'PG',
                   'PY',
                   'PE',
                   'PH',
                   'PN',
                   'PL',
                   'PT',
                   'PR',
                   'QA',
                   'RO',
                   'RU',
                   'RW',
                   'RE',
                   'BL',
                   'SH',
                   'KN',
                   'LC',
                   'MF',
                   'PM',
                   'VC',
                   'WS',
                   'SM',
                   'ST',
                   'SA',
                   'SN',
                   'RS',
                   'SC',
                   'SL',
                   'SG',
                   'SX',
                   'SK',
                   'SI',
                   'SB',
                   'SO',
                   'ZA',
                   'GS',
                   'SS',
                   'ES',
                   'LK',
                   'SD',
                   'SR',
                   'SJ',
                   'SZ',
                   'SE',
                   'CH',
                   'SY',
                   'TW',
                   'TJ',
                   'TZ',
                   'TH',
                   'TL',
                   'TG',
                   'TK',
                   'TO',
                   'TT',
                   'TN',
                   'TR',
                   'TM',
                   'TC',
                   'TV',
                   'UG',
                   'UA',
                   'AE',
                   'GB',
                   'US',
                   'UM',
                   'UY',
                   'UZ',
                   'VU',
                   'VE',
                   'VN',
                   'VG',
                   'VI',
                   'WF',
                   'EH',
                   'YE',
                   'ZM',
                   'ZW',
                   'AX');

    echo '<select name="country" required>';

    for($i = 0; $i < count($codes); $i++) {
        echo '<option>'.$codes[$i].'</option>';
        echo '</br>';
    } 

    echo '</select>';

}

function selectCountryCodePHP($res, $current) {
    $codes = array('AF',
                   'AL',
                   'DZ',
                   'AS',
                   'AD',
                   'AO',
                   'AI',
                   'AQ',
                   'AG',
                   'AR',
                   'AM',
                   'AW',
                   'AU',
                   'AT',
                   'AZ',
                   'BS',
                   'BH',
                   'BD',
                   'BB',
                   'BY',
                   'BE',
                   'BZ',
                   'BJ',
                   'BM',
                   'BT',
                   'BO',
                   'BQ',
                   'BA',
                   'BW',
                   'BV',
                   'BR',
                   'IO',
                   'BN',
                   'BG',
                   'BF',
                   'BI',
                   'KH',
                   'CM',
                   'CA',
                   'CV',
                   'KY',
                   'CF',
                   'TD',
                   'CL',
                   'CN',
                   'CX',
                   'CC',
                   'CO',
                   'KM',
                   'CG',
                   'CD',
                   'CK',
                   'CR',
                   'HR',
                   'CU',
                   'CW',
                   'CY',
                   'CZ',
                   'CI',
                   'DK',
                   'DJ',
                   'DM',
                   'DO',
                   'EC',
                   'EG',
                   'SV',
                   'GQ',
                   'ER',
                   'EE',
                   'ET',
                   'FK',
                   'FO',
                   'FJ',
                   'FI',
                   'FR',
                   'GF',
                   'PF',
                   'TF',
                   'GA',
                   'GM',
                   'GE',
                   'DE',
                   'GH',
                   'GI',
                   'GR',
                   'GL',
                   'GD',
                   'GP',
                   'GU',
                   'GT',
                   'GG',
                   'GN',
                   'GW',
                   'GY',
                   'HT',
                   'HM',
                   'VA',
                   'HN',
                   'HK',
                   'HU',
                   'IS',
                   'IN',
                   'ID',
                   'IR',
                   'IQ',
                   'IE',
                   'IM',
                   'IL',
                   'IT',
                   'JM',
                   'JP',
                   'JE',
                   'JO',
                   'KZ',
                   'KE',
                   'KI',
                   'KP',
                   'KR',
                   'KW',
                   'KG',
                   'LA',
                   'LV',
                   'LB',
                   'LS',
                   'LR',
                   'LY',
                   'LI',
                   'LT',
                   'LU',
                   'MO',
                   'MK',
                   'MG',
                   'MW',
                   'MY',
                   'MV',
                   'ML',
                   'MT',
                   'MH',
                   'MQ',
                   'MR',
                   'MU',
                   'YT',
                   'MX',
                   'FM',
                   'MD',
                   'MC',
                   'MN',
                   'ME',
                   'MS',
                   'MA',
                   'MZ',
                   'MM',
                   'NA',
                   'NR',
                   'NP',
                   'NL',
                   'NC',
                   'NZ',
                   'NI',
                   'NE',
                   'NG',
                   'NU',
                   'NF',
                   'MP',
                   'NO',
                   'OM',
                   'PK',
                   'PW',
                   'PS',
                   'PA',
                   'PG',
                   'PY',
                   'PE',
                   'PH',
                   'PN',
                   'PL',
                   'PT',
                   'PR',
                   'QA',
                   'RO',
                   'RU',
                   'RW',
                   'RE',
                   'BL',
                   'SH',
                   'KN',
                   'LC',
                   'MF',
                   'PM',
                   'VC',
                   'WS',
                   'SM',
                   'ST',
                   'SA',
                   'SN',
                   'RS',
                   'SC',
                   'SL',
                   'SG',
                   'SX',
                   'SK',
                   'SI',
                   'SB',
                   'SO',
                   'ZA',
                   'GS',
                   'SS',
                   'ES',
                   'LK',
                   'SD',
                   'SR',
                   'SJ',
                   'SZ',
                   'SE',
                   'CH',
                   'SY',
                   'TW',
                   'TJ',
                   'TZ',
                   'TH',
                   'TL',
                   'TG',
                   'TK',
                   'TO',
                   'TT',
                   'TN',
                   'TR',
                   'TM',
                   'TC',
                   'TV',
                   'UG',
                   'UA',
                   'AE',
                   'GB',
                   'US',
                   'UM',
                   'UY',
                   'UZ',
                   'VU',
                   'VE',
                   'VN',
                   'VG',
                   'VI',
                   'WF',
                   'EH',
                   'YE',
                   'ZM',
                   'ZW',
                   'AX');

    $res = '<select name="country" required>';

    for($i = 0; $i < count($codes); $i++) {
        if(strtolower($codes[$i]) == $current) {
            $res .= '<option selected="selected">'.$codes[$i].'</option>';
        }else {
            $res .= '<option>'.$codes[$i].'</option>';   
        }
    } 

    $res .= '</select>';
    
    return $res;
}
?>