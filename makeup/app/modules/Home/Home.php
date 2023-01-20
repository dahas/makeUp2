<?php

use makeUp\lib\Template;
use makeUp\src\Lang;
use makeUp\src\Module;
use makeUp\src\Request;


class Home extends Module {

    protected function build(Request $request): string
    {
        $parameters = $request->getParameters();

        $template = Template::load("Home");

        $m["[[APP_CREATED_SUCCESS]]"] = Lang::get("app_created_success");

        if (Module::checkLogin()) {
            $s["{{TOP_SECRET}}"] = $template->getSlice("{{TOP_SECRET}}")->parse();
        } else {
            $s["{{TOP_SECRET}}"] = "";
        }

        $html = $template->parse($m, $s);
        return $this->render($html);
    }
}