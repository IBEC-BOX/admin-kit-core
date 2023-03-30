<?php

namespace AdminKit\Core;

class Core
{
    public const VERSION = '1.2.10';

    /**
     * Return source path
     */
    public function srcPath(): string
    {
        return __DIR__;
    }

    /**
     * Return source path
     */
    public function shipPath(): string
    {
        return __DIR__.'/Ship';
    }

    /**
     * Return source path
     */
    public function containersPath(): string
    {
        return __DIR__.'/Containers';
    }
}
