<?php

use makeUp\lib\Module;
use makeUp\lib\RQ;
use makeUp\lib\Tools;
use makeUp\lib\Template;
use makeUp\lib\Cookie;
use makeUp\lib\Session;


class LanguageSelector extends Module
{
    public function __construct()
    {
        parent::__construct();
    }

    
    protected function build() : string
    {
        $m = [];
        $s = [];

        $suppLangs = Tools::getSupportedLanguages();
        $current = Cookie::get("lang_code") ?? Tools::getUserLanguageCode();

        $m["##CURRENT_LANGUAGE##"] = $suppLangs[$current];

        $slice = $this->getTemplate()->getSlice("{{SUPPORTED_LANGUAGES}}");

        $s["{{SUPPORTED_LANGUAGES}}"] = "";

        foreach ($suppLangs as $code => $name) {
            $sm = [];
            $sm["##ACTIVE##"] = $code == $current ? "active" : "";
            $sm["##LINK##"] = Tools::linkBuilder($this->modName, "change_language", ["referer" => RQ::get("mod"), "lang_code" => $code]);
            $sm["##LANG_NAME##"] = $name;
            $s["{{SUPPORTED_LANGUAGES}}"] .= $slice->parse($sm);
        }

        return $this->render($m, $s);
    }


    public function change_language()
    {
        Cookie::set("lang_code", RQ::get("lang_code"));
        Session::clear("translation"); // String resources must be renewed in the session
        header("Location: " . Tools::linkBuilder(RQ::get("referer")));
    }

}
