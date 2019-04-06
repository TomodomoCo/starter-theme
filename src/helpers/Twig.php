<?php

namespace Tomodomo\Theme\Helpers;

use Pimple\Container;
use Timber;

class Twig
{
    /**
     * @param \Pimple\Container
     *
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;

        return;
    }

    /**
     * Compile a template
     *
     * @param string|array $template
     * @param array $context
     *
     * @return string
     */
    public function compile($template, array $context = []) : string
    {
        // Build the context settings
        $settings = array_merge(
            $this->container['context'],
            $context
        );

        // Make sure template an array
        $template = is_array($template) ? $template : [$template];

        return Timber::compile($template, $settings);
    }
}
