<?php

namespace browse\Interfaces;

interface BrowseDirectoryInterface
{
    /**
     * Set operation view
     *
     * @param string $operation
     */
    public function setOperation(string $operation): void;

    /**
     * Show directory
     *
     * @param string $pathDir
     * @param string $operation
     * @return array
     */
    public function showDir(string $pathDir,string $operation): array;

    /**
     * Scan directory
     *
     * @param string $pathDir
     * @param string $operation
     * @return array
     */
    public function scanDir(string $pathDir, string $operation): array;
}