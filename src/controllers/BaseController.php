<?php

namespace Tomodomo\Theme\Controllers;

use Pimple\Container;

class BaseController
{
    /**
     * The Pimple DI container
     *
     * @var \Pimple\Container
     */
    public $container;

    /**
     * A more easily accessible $twig instance
     *
     * @var \Tomodomo\Theme\Helpers\Twig $twig
     */
    public $twig;

    /**
     * @param \Pimple\Container $container
     *
     * @return void
     */
    public function __construct(Container $container)
    {
        // Grab the Pimple container
        $this->container = $container;

        // A Twig instance
        $this->twig = $this->container['twig'];

        return;
    }
}
