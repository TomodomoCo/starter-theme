<?php

namespace Tomodomo\Theme\Controllers;

use Timber\PostQuery;
use GuzzleHttp\Psr7\Request;

class SingleController extends BaseController
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
        // Pull in the posts
        $context['posts'] = new PostQuery(false, '\Tomodomo\Theme\Models\Post');

        return $this->twig->compile('post.twig', $context);
    }
}
