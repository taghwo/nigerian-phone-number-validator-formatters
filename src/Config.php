<?php
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if (!function_exists('config')) {
    function config($key)
    {
        $configs = [
            'spamCheckerKey' => $_ENV['rapidspamcheckerkey'],
            'spamCheckerURL' => $_ENV['rapidspamcheckerurl'],
            'spamCheckerHost' => $_ENV['rapidspamcheckerhost']
        ];

        if ($configs[$key]) {
            return $configs[$key];
        }
        throw new InvalidArgumentException("Sorry array key => $key does not exist in the config file");
    }
}
