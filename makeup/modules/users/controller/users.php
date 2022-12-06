<?php

use makeUp\lib\Module;
use makeUp\lib\attributes\Inject;


class Users extends Module
{
    #[Inject('Sampledata')]
    protected $SampleService;


    public function __construct()
    {
        parent::__construct();
    }


    protected function build(): string
    {
        $this->SampleService->read();
        $Item = $this->SampleService->getByUniqueId(3);

        $m = [];
        $s = [];

        $m['##MODULE##'] = $Item->getProperty("name");

        return $this->render($m, $s);
    }


    public function example()
    {
        return;
    }

}