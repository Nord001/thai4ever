<?php

function mysql_date( $date ) {
    return date( 'Y-m-d H:i:s', strtotime($date) );
}

function nice_title( $name ){
    $name = trim( $name );
    $trans = array(
        "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l", "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t", "у"=>"u","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch", "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u","я"=>"ya",
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E", "Ё"=>"Yo","Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K", "Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P", "Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F", "Х"=>"H","Ц"=>"C","Ч"=>"Ch","Ш"=>"Sh","Щ"=>"Sh", "Ы"=>"I","Э"=>"E","Ю"=>"U","Я"=>"Ya",
        "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"", " "=>"-"
    );
    $name = strtolower( strtr($name, $trans));
    $name = preg_replace('/[^A-Za-z0-9_\-]/', '', $name);
    return $name;
}

/**
 * Вычищает текст от html, css, xml, script тэгов
 *
 * @param   string $htmlText    текст который нужно вычестить
 * @return  string
 */
function clean_html($htmlText) {
    $search = array (
        "'<script[^>]*?>.*?</script>'si",  // Remove javaScript
        "'<style[^>]*?>.*?</style>'si",  // Remove styles
        "'<xml[^>]*?>.*?</xml>'si",  // Remove xml tags
        "'<[\/\!]*?[^<>]*?>'si",           // Remove HTML-tags
        "'([\r\n])[\s] '",                 // Remove spaces
        "'&ndash;'i",                 // Replace HTML special chars
        "'&mdash;'i",                 // Replace HTML special chars
        "'&raquo;'i",                 // Replace HTML special chars
        "'&laquo;'i",                 // Replace HTML special chars
        "'&(quot|#34);'i",                 // Replace HTML special chars
        "'&(amp|#38);'i",
        "'&(lt|#60);'i",
        "'&(gt|#62);'i",
        "'&(nbsp|#160);'i",
        "'&(iexcl|#161);'i",
        "'&(cent|#162);'i",
        "'&(pound|#163);'i",
        "'&(copy|#169);'i",
        "'&#(\d );'e"
    );                    // write as php

    $replace = array (
        "",
        "",
        "",
        "",
        "\\1",
        "\"",
        "&",
        "<",
        ">",
        " ",
        chr(161),
        chr(162),
        chr(163),
        chr(169),
        "chr(\\1)"
    );

    return preg_replace($search, $replace, $htmlText);
}
