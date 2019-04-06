<?php

namespace Tomodomo\Theme\Models;

use Carbon\Carbon;

class Post extends \Timber\Post
{
    /**
     * Fetch the post excerpt
     *
     * @return string
     */
    public function excerpt() : ?string
    {
        return has_excerpt($this->id)
            ? wp_trim_words(get_the_excerpt($this->id), 25)
            : null;
    }

    /**
     * Get the comment count
     *
     * @return int
     */
    public function commentCount() : int
    {
        return (int) get_comments_number($this->id);
    }

    /**
     * Get the date as a Carbon object
     *
     * @return Carbon
     */
    public function carbonDate() : Carbon
    {
        return new Carbon($this->date('c'));
    }

    /**
     * The relative day the post was published
     *
     * @return string
     */
    public function relativeDate() : string
    {
        $date = $this->carbonDate();

        if ($date->isToday()) {
            return 'today';
        }

        if ($date->isYesterday()) {
            return 'yesterday';
        }

        return $date->format('F jS');
    }

    /**
     * The time for this post
     *
     * @return string
     */
    public function relativeTime() : string
    {
        $date = $this->carbonDate();

        return $date->format('H:i');
    }

    /**
     * Fetch the post's featured image
     *
     * @param string $size
     *
     * @return string
     */
    public function featuredImage(string $size = 'thumbnail') : string
    {
        $url = get_the_post_thumbnail_url($this->id, $size);

        // Build a fallback URL
        $fallback = 'https://placehold.it/150x150';

        return $url ?: $fallback;
    }
}
