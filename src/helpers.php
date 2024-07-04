<?php

declare(strict_types=1);

if (! function_exists('shell_command_exists')) {
    function shell_command_exists(string $command): bool
    {
        return (bool) shell_exec('command -v '.escapeshellarg($command));
    }
}
