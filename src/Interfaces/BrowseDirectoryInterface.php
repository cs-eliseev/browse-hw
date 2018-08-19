<?php

namespace browse\Interfaces;

interface BrowseDirectoryInterface
{
    /**
     * Set operation view
     *
     * @param string $operation
     * @return BrowseDirectoryInterface
     */
    public function setOperation(string $operation = '') : self;

    /**
     * @param string $pathDir
     * @return BrowseDirectoryInterface
     */
    public function setPathDir(string $pathDir) : self;

    /**
     * @param string $optionsResponse
     * @return BrowseDirectoryInterface
     */
    public function setOptionsResponse(string $optionsResponse) : self;

    /**
     * Show directory
     *
     * @param string $pathDir
     * @param string $operation
     * @param string $optionsResponse
     *
     * @return array|string
     */
    public function showDir(string $pathDir = '', string $operation = '', string $optionsResponse = '');

    /**
     * Scan directory
     *
     * @param string $pathDir
     * @param string $operation
     * @param string $optionsResponse
     *
     * @return array|string
     */
    public function scanDir(string $pathDir = '', string $operation = '', string $optionsResponse = '');
}