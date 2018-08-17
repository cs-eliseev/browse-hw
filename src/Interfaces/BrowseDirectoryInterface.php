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
     * @param string $optionsResponse
     *
     * @return array|string
     */
    public function showDir(string $pathDir,string $operation, string $optionsResponse = '');

    /**
     * Scan directory
     *
     * @param string $pathDir
     * @param string $operation
     * @param string $optionsResponse
     *
     * @return array|string
     */
    public function scanDir(string $pathDir, string $operation, string $optionsResponse = '');

    /**
     * @param string $pathDir
     */
    public function setPathDir(string $pathDir): void;

    /**
     * @param string $optionsResponse
     */
    public function setOptionsResponse(string $optionsResponse): void;
}