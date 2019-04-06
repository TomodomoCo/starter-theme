<?php

namespace Tomodomo\Theme\Helpers;

use Tomodomo\Theme\Models\Post;
use WP_Post;
use WP_Query;

class Faker
{
    /**
     * Get a selection of completely random posts from the database
     *
     * @param int $count
     *
     * @return array
     */
    public static function getRandomPosts(int $count = 3) : array
    {
        // Build a query
        $args = [
            'posts_per_page' => $count,
            'orderby'        => 'rand',
        ];

        // Run the query
        $query = new WP_Query($args);

        // Collect the posts
        $posts = array_map(function (WP_Post $post) {
            return new Post($post->ID);
        }, $query->posts ?? []);

        // Return the collection
        return $posts;
    }
}
