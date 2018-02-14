<?php
/*
Plugin Name: My Precious
Description: Quit leaking sensitive information to WordPress.org.
Version: 2.0
Author: ibericode
Author URI: https://ibericode.com/
License: GPL v3

My Precious - quit leaking sensitive information to WordPress.org
Copyright (C) 2016-2018, Danny van Kooten, danny@ibericode.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace my_precious;

// Prevent direct file access
defined( 'ABSPATH' ) or exit;

/**
 * @param array $args
 * @param string $url
 * @return array
 */
function clean_http_request_args( $args, $url ) {
    // only act on requests to api.wordpress.org
    if( wp_parse_url( $url, PHP_URL_HOST ) !== 'api.wordpress.org' ) {
        return $args;
    }

    // strip site URL from headers & user-agent
    unset( $args['headers']['wp_install'] );
    unset( $args['headers']['wp_blog'] );

    if( ! empty( $args['user-agent'] ) ) {
        $args['user-agent'] = sprintf( 'WordPress/%s', $GLOBALS['wp_version'] );
    }

    if( ! empty( $args['headers']['User-Agent'] ) ) {
        $args['user-agent'] = sprintf( 'WordPress/%s', $GLOBALS['wp_version'] );
    }

    return $args;
}

/**
 * @param array $query
 * @return array
 */
function filter_core_version_check_query_args( $query ) {
    // stop sending # of users to WordPress.org
    if( isset( $query['users'] ) ) {
        unset( $query['users'] );
    }

    return $query;
}

add_filter( 'http_request_args', 'my_precious\\clean_http_request_args', 10, 2 );
add_filter( 'core_version_check_query_args', 'my_precious\\filter_core_version_check_query_args', 10, 1 );
