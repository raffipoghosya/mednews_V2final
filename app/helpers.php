<?php
if (!function_exists('cleanHtml')) {
    function cleanHtml($html)
    {
        return strip_tags($html, '<p><br><b><strong><i><ul><ol><li><a><img><h1><h2><h3><h4><h5><h6><blockquote>');
    }
}
function cleanHtml($html)
{
    // Հեռացնում է MS Word-ի span-ներն ու &shy; և mso-* բանալիները
    $html = preg_replace('/<span[^>]*mso[^>]*>.*?<\/span>/i', '', $html); // span mso-* հեռացնենք
    $html = preg_replace('/<[^>]+class="MsoNormal"[^>]*>/', '<p>', $html); // class="MsoNormal" → <p>
    $html = preg_replace('/&shy;/', '', $html); // հեռացրու բոլոր `&shy;`
    $html = preg_replace('/<span[^>]*>/', '', $html); // հեռացրու բոլոր span-ները
    $html = preg_replace('/<\/span>/', '', $html); // հեռացրու փակող span-ները
    $html = preg_replace('/style="[^"]*"/i', '', $html); // մաքրիր style=""
    $html = preg_replace('/lang="[^"]*"/i', '', $html); // մաքրիր lang=""
    $html = preg_replace('/mso-[^:]+:[^;"]+;?/i', '', $html); // mso-* style-ները

    return $html;
}
