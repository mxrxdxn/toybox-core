<?php

namespace Toybox\Core\Components\Google;

class Reviews
{
    /**
     * Boots the application by setting up the necessary database and initializing a cron job for fetching data.
     *
     * @param string $placeID      The Google Place ID for retrieving data associated with the specified location.
     * @param string $cronSchedule The schedule frequency for the cron job (default: 'daily').
     *
     * @return void
     */
    public static function boot(string $placeID, string $cronSchedule = "daily"): void
    {
        // Install the database
        static::install();

        // Add the cron
        static::initializeCron($cronSchedule, $placeID);
    }

    /**
     * Installs the database table for storing review data.
     *
     * This method creates a new database table to store review records, including
     * author information, rating, review content, type, and creation timestamp.
     * It utilizes WordPress's `dbDelta` function for executing the SQL query and
     * managing the database schema.
     *
     * @return void
     */
    private static function install(): void
    {
        global $wpdb, $charset_collate;

        // We need this for the dbDelta function
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $tableName = $wpdb->prefix . 'maxweb_reviews';

        $sql = "
            CREATE TABLE {$tableName} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            review_author_id varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
            review_author_name tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            review_author_image tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            rating int(2) NOT NULL,
            review_text text COLLATE utf8mb4_unicode_520_ci NOT NULL,
            type tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY  (id)
            ) {$charset_collate}
        ";

        dbDelta($sql);
    }

    /**
     * Initializes a recurring cron job for fetching new reviews from Google Places API.
     *
     * @param string $cronSchedule The schedule frequency for the cron job (e.g., 'hourly', 'twicedaily', 'daily').
     * @param string $placeID      The Google Place ID for fetching reviews associated with a specific location.
     *
     * @return void
     */
    private static function initializeCron(string $cronSchedule, string $placeID)
    {
        /**
         * Cron to fetch new reviews from Google
         */
        add_action('toybox_google_reviews_cron_hook', function () use ($placeID) {
            global $wpdb;

            // Google API Key
            $googleApiKey = static::getGoogleApiKey();

            if ($googleApiKey === false) {
                // No API key set, so just return here.
                return false;
            }

            $endpoint = add_query_arg(
                [
                    'placeid' => $placeID,
                    'fields'  => "review",
                    'key'     => $googleApiKey,
                ],
                'https://maps.googleapis.com/maps/api/place/details/json'
            );

            // Sanitize the URL
            $endpoint = esc_url_raw($endpoint);

            // Send API Call using WP's HTTP API
            $data = wp_remote_get($endpoint);

            if (! is_wp_error($data)) {
                $response = json_decode($data['body'], true);

                // If we got reviews
                if (isset($response['result']['reviews'])) {
                    // Loop the reviews
                    foreach ($response['result']['reviews'] as $review) {
                        // Get the author ID
                        $authorID  = static::getAuthorID($review['author_url']);
                        $timestamp = static::getTimestamp($review['time']);

                        if ($authorID) {
                            // Make sure we don't already have the review
                            static::createReview($review, $authorID, $timestamp);
                        }
                    }
                } else {
                    $file = 'error_log.txt';
                    file_put_contents($file, $response);
                }
            }
        });

        if (! wp_next_scheduled('toybox_google_reviews_cron_hook')) {
            wp_schedule_event(time(), $cronSchedule, 'toybox_google_reviews_cron_hook');
        }
    }

    /**
     * Extracts the author ID from a given Google Maps contributor URL.
     *
     * This method takes a URL string and matches it against a specific pattern
     * to extract the numeric ID of a Google Maps contributor. If the URL matches
     * the expected format, the numeric author ID is returned; otherwise, it returns false.
     *
     * @param string $authorUrl The Google Maps contributor URL from which the author ID should be extracted.
     *
     * @return bool|string Returns the author ID as a string if the URL matches the pattern, or false if it does not.
     */
    private static function getAuthorID(string $authorUrl): bool|string
    {
        if (preg_match('#^https://www.google.com/maps/contrib/(\d+)/reviews$#', $authorUrl, $matches)) {
            return $matches[1];
        }

        return false;
    }

    /**
     * Converts a given timestamp into a formatted datetime string.
     *
     * This method accepts a Unix timestamp and formats it into a
     * string representation in the 'Y-m-d H:i:s' format.
     *
     * @param string $timestamp The Unix timestamp to be formatted.
     *
     * @return string The formatted datetime string.
     */
    private static function getTimestamp(string $timestamp): string
    {
        return date('Y-m-d H:i:s', $timestamp);
    }

    /**
     * Inserts a new review into the database if it does not already exist.
     *
     * This method checks whether a review with the given author ID and timestamp already exists
     * in the database. If no matching record is found, it inserts a new review into the
     * `maxweb_reviews` table, including details such as author information, rating, review
     * content, type, and the creation timestamp.
     *
     * @param array  $review    An associative array containing review details, including:
     *                          'author_name' (string) - The name of the review author.
     *                          'profile_photo_url' (string) - The URL of the review author's profile photo.
     *                          'rating' (int) - The rating provided in the review.
     *                          'text' (string) - The content of the review.
     * @param string $authorID  The unique identifier for the review author.
     * @param string $timestamp The timestamp when the review was created.
     *
     * @return void
     */
    private static function createReview($review, $authorID, $timestamp): void
    {
        global $wpdb;

        $tableName = "{$wpdb->prefix}maxweb_reviews";
        $query     = $wpdb->prepare("select id from {$tableName} where review_author_id = %s and created_at = %s", $authorID, $timestamp);

        $wpdb->query($query);

        if ($wpdb->num_rows === 0) {
            $query = $wpdb->prepare("
            insert into {$tableName} (
                review_author_id,
                review_author_name,
                review_author_image,
                rating,
                review_text,
                type,
                created_at
            ) values (
                %s,
                %s,
                %s,
                %s,
                %s,
                %s,
                %s
            )
        ", $authorID, $review['author_name'], $review['profile_photo_url'], $review['rating'], $review['text'], 'Google', $timestamp);

            $wpdb->query($query);
        }
    }

    /**
     * Retrieves a specified number of random Google reviews from the database.
     *
     * This method fetches reviews stored in the `maxweb_reviews` database table filtered
     * by the review type "Google". The reviews are returned in random order, with the
     * number of reviews limited by the specified count. The returned array includes
     * details such as author name, image, review content, rating, and formatted creation date.
     *
     * @param int $count The number of reviews to retrieve (default is 5).
     *
     * @return array An array of associative arrays, each representing a review with keys:
     *               'author', 'image', 'content', 'rating', and 'created_at'.
     */
    public static function getReviews(int $count = 5): array
    {
        global $wpdb;

        $count = 5;

        $tableName = "{$wpdb->prefix}maxweb_reviews";
        $reviews   = $wpdb->get_results($wpdb->prepare("select * from {$tableName} where type = %s order by rand() limit 0,%d", 'Google', $count));

        $return = [];

        // Get our date/time formats
        $dateFormat = get_option('date_format');
        $timeFormat = get_option('time_format');

        foreach ($reviews as $review) {
            $createdAtDate = (DateTime::createFromFormat('Y-m-d H:i:s', $review->created_at))->format($dateFormat);
            $createdAtTime = (DateTime::createFromFormat('Y-m-d H:i:s', $review->created_at))->format($timeFormat);

            $return[] = [
                'author'     => $review->review_author_name,
                'image'      => $review->review_author_image,
                'content'    => $review->review_text,
                'rating'     => $review->rating,
                'created_at' => "$createdAtDate",
            ];
        }

        return $return;
    }

    /**
     * Retrieves the Google API key from the global settings.
     *
     * This method fetches the Google API key stored in the global options field.
     * If the key is not set, it returns false.
     *
     * @return string|false The Google API key as a string if available, or false if not set.
     */
    private static function getGoogleApiKey(): string|false
    {
        $global = get_field("global", "options");

        return $global['google_api_key'] ?? false;
    }
}
