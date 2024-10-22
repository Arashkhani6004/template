<?php

namespace Rahweb\CmsCore\Modules\General\Helper;

class SettingHelper
{
    public static  function textToArray($text) {
        $lines = explode(",", @$text);
        return $lines;
    }
}
