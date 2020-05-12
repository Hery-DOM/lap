<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UrlExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('url', [$this,'url']),
        ];
    }

    public function url($value)
    {

        $result = strtolower($value);
        $result = str_replace("é","e",$result);
        $result = str_replace("è","e",$result);
        $result = str_replace("ê","e",$result);
        $result = str_replace("ë","e",$result);
        $result = str_replace("à","a",$result);
        $result = str_replace("ä","a",$result);
        $result = str_replace("â","a",$result);
        $result = str_replace("ù","u",$result);
        $result = str_replace("û","u",$result);
        $result = str_replace("î","i",$result);
        $result = str_replace("ï","i",$result);
        $result = str_replace("ô","o",$result);
        $result = str_replace(" ","-",$result);
        $result = str_replace("?","",$result);
        $result = str_replace("!","",$result);
        $result = str_replace(".","",$result);
        $result = str_replace(",","",$result);
        $result = str_replace("/","",$result);
        $result = str_replace("_","",$result);
        $result = str_replace(" : ","-",$result);
        $result = str_replace("'","-",$result);

        return $result;
    }


}