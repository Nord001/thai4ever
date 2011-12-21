<?
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
