<?php

namespace browse\Interfaces;

interface ScannerInterface
{
    /**
     * Show directory
     *
     * @return array
     */
    public function showDir() : array;

    /**
     * Show directory & sub directory
     *
     * @return array
     */
    public function scanDir() : array;

    /**
     * Set settings show link
     *
     * @param bool $showLink
     * @return ScannerInterface
     */
    public function setShowLink(bool $showLink) : self;

    /**
     * Set current path directory
     *
     * @param string $pathDir
     * @return ScannerInterface
     */
    public function setPathDir(string $pathDir) : self;

    /**
     * Get current path directory
     *
     * @return string
     */
    public function getPathDir() : string;

    /**
     * Get current name directory
     *
     * @param string $pathDir
     * @return string
     */
    public function getCurrentDirName(string $pathDir = '') : string;

    /**
     * Get parent directory
     *
     * @param string $pathDir
     * @return string
     */
    public function getParentDir(string $pathDir = '') : string;

    /**
     * Go to parent directory
     *
     * @return string
     */
    public function gotoParentDir() : string;

    /**
     * Go to sub directory
     *
     * @param string $subDir
     * @return string
     */
    public function gotoSubDir(string $subDir) : string;

    /**
     * Check path directory
     *
     * @param $pathDir
     * @return ScannerInterface
     */
    public function validateDir($pathDir) : self;
}