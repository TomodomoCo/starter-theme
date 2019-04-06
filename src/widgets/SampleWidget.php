<?php

namespace Tomodomo\Theme\Widgets;

use Timber;
use Tomodomo\Theme\Helpers\Faker;
use Tomodomo\Theme\Models\Post;
use WP_Query;
use WP_Widget;

class PopularPostsWidget extends WP_Widget
{
    /**
     * Construct your widget.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(
            'sample-widget',
            'Sample Widget',
            [
                'description' => 'A sample widget.',
            ]
        );

        return;
    }

    /**
     * Echo the widget output.
     *
     * @param array $args
     * @param array $instance
     *
     * @return void
     */
    public function widget(array $args, array $instance)
    {
        $context = [
            'key' => 'value',
        ];

        // Echo the view
        echo Timber::compile('path/to/template.twig', $context);

        return;
    }

    /**
     * Handle when the form is submitted.
     *
     * @param array $args
     * @param array $old
     *
     * @return array
     */
    public function update(array $args, array $old) : array
    {
        return $args;
    }

    /**
     * Echo the form to update the widget.
     *
     * @param array $instance
     *
     * @return void
     */
    public function form(array $instance)
    {
        return;
    }
}
