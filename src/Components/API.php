<?php

namespace Toybox\Core\Components;

use Closure;
use Toybox\Core\Exceptions\InvalidMethodException;

class API
{
    /**
     * Adds an endpoint to the WP-JSON API.
     *
     * When you define your callback, make sure you pass in the argument for $request, which should be of type
     * WP_REST_Request.
     *
     * @see https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
     *
     * @param string  $endpoint
     * @param Closure $callback
     * @param Closure $permissionCallback
     * @param string  $namespace
     * @param string  $method
     *
     * @return void
     * @throws InvalidMethodException
     */
    public static function addEndpoint(string $endpoint, Closure $callback, Closure $permissionCallback, string $namespace = "toybox/v1", string $method = "GET"): void
    {
        $allowedMethods = ["GET", "POST", "PUT", "HEAD", "DELETE", "PATCH", "OPTIONS"];
        $method         = strtoupper($method);

        if (! in_array($method, $allowedMethods)) {
            $validMethods = implode("\", \"", $allowedMethods);
            throw new InvalidMethodException("The method \"{$method}\" is not valid. Valid options are \"{$validMethods}\".");
        }

        add_action("rest_api_init", function () use ($namespace, $endpoint, $permissionCallback, $callback, $method) {
            register_rest_route($namespace, $endpoint, [
                "methods"  => $method,
                "callback" => $callback,
                "permission_callback" => $permissionCallback(),
            ]);
        });
    }
}
