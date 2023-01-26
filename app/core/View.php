<?php

namespace app\core;

class View
{
    const VIEWS_DIR = '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views';

    /**
     * @var string
     */
    protected $template = 'main';

    /**
     * @var string
     */
    protected $page;

    public function __construct(string $template = null)
    {
        if (!is_null($template)) {
            $this->template = $template;
        }
    }

    /**
     * @param string $page
     * @param array $params
     * @return void
     */
    public function render(string $page, $params = []) : void
    {
        extract($params);
        $this->page = $page;
        include_once $this->getTemplatePath();
    }

    /**
     * return formatted path to templates directory
     * @return string
     */
    private function getTemplatePath() : string
    {
        return self::VIEWS_DIR.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$this->template.'.php';
    }

    /**
     * return formatted path to pages directory
     * @return string
     */
    private function getPagePath() : string
    {
        return self::VIEWS_DIR.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR.$this->page.'.php';
    }
}