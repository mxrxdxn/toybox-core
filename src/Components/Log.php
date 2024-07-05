<?php

namespace Toybox\Core\Components;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class Log
{
    public Logger $log;

    public function __construct(string $channel, string $filename, int|Level|string $level = Level::Debug)
    {
        if (! is_dir(WP_CONTENT_DIR . "/logs/toybox")) {
            wp_mkdir_p(WP_CONTENT_DIR . "/logs/toybox");
        }

        $this->log = new Logger($channel);
        $this->log->pushHandler(new StreamHandler(WP_CONTENT_DIR . "/logs/toybox/{$filename}", $level));
    }

    /**
     * Send an alert level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function alert(string $message, array $context = []): void
    {
        $this->log->alert($message, $context);
    }

    /**
     * Send a critical level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function critical(string $message, array $context = []): void
    {
        $this->log->critical($message, $context);
    }

    /**
     * Send a debug level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function debug(string $message, array $context = []): void
    {
        $this->log->debug($message, $context);
    }

    /**
     * Send an emergency level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function emergency(string $message, array $context = []): void
    {
        $this->log->emergency($message, $context);
    }

    /**
     * Send an error level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->log->error($message, $context);
    }

    /**
     * Send an info level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->log->info($message, $context);
    }

    /**
     * Send a notice level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function notice(string $message, array $context = []): void
    {
        $this->log->notice($message, $context);
    }

    /**
     * Send a warning level message to the log.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function warn(string $message, array $context = []): void
    {
        $this->log->warning($message, $context);
    }
}
