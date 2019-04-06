<?php

namespace Tomodomo\Theme\Controllers;

use GuzzleHttp\Psr7\Request;

class Error404Controller extends BaseController
{
    /**
     * Handle GET requests to this route
     *
     * @param \GuzzleHttp\Psr7\Request $request
     * @param null $response
     * @param array $args
     *
     * @return string
     */
    public function get(Request $request, $response, array $args) : string
    {
        return $this->twig->compile('404.twig');
    }
}
