<?php

use makeUp\lib\Lang;
use makeUp\lib\Module;


class Home extends Module {

    protected function build(): string
    {
        $params = $this->requestData();
        $m["[[APP_CREATED_SUCCESS]]"] = Lang::get("app_created_success");

        if (Module::checkLogin()) {
            $s["{{TOP_SECRET}}"] = $this->getTemplate()->getSlice("{{TOP_SECRET}}")->parse();
        } else {
            $s["{{TOP_SECRET}}"] = "";
        }

        $html = $this->getTemplate()->parse($m, $s);
        return $this->render($html);
    }
}