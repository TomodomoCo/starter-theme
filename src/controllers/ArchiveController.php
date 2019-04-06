<?php

namespace Tomodomo\Theme\Controllers;

use Timber\PostQuery;
use GuzzleHttp\Psr7\Request;

class ArchiveController extends BaseController
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

        $context['archive']['year']  = get_query_var('year');
        $context['archive']['month'] = get_query_var('monthnum');

        return $this->twig->compile('archives.twig', $context);
    }
}
