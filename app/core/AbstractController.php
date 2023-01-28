<?php

namespace app\core;

abstract class AbstractController implements indexable
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Validator
     */
    protected $validate;

    /**
     * AbstractController constructor
     */
    public function __construct($template)
    {
        $this->view = new View($template);
    }
}