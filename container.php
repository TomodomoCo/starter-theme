<?php

namespace Tomodomo\Theme;

use Tomodomo\Theme\Helpers\Twig;
use Timber;

/**
 * Add the Timber context to our container
 */
$app->container['context'] = function ($container) {
    $context = Timber::get_context();

    return $context;
};

/**
 * Add the current user to our container for quicker access
 */
$app->container['user'] = function ($container) {
    return $container['context']['user'] ?? null;
};

/**
 * Make a Twig/Timber instance accessible
 */
$app->container['twig'] = function ($container) {
    return new Twig($container);
};
