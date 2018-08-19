<?php

namespace browse\Interfaces;

interface ScannerInterface
{
    /**
     * Show directory
     *
     * @return array
     */
    public function showDir(): array;

    /**
     * Show directory & sub directory
     *
     * @return array
     */
    public function scanDir(): array;

    /**
     * Set settings show link
     *
     * @param bool $showLink
     */
    public function setShowLink(bool $showLink): void;

    /**
     * Set settings file mode
     *
     * @param bool $fileMode
     */
    public function setFileMode(bool $fileMode): void;

    /**
     * Set current path directory
     *
     * @param string $pathDir
     */
    public function setPathDir(string $pathDir): void;

    /**
     * Get current path directory
     *
     * @return string
     */
    public function getPathDir(): string;

    /**
     * Get current name directory
     *
     * @param string $pathDir
     * @return string
     */
    public function getCurrentDirName(string $pathDir = ''): string;

    /**
     * Get parent directory
     *
     * @param string $pathDir
     * @return string
     */
    public function getParentDir(string $pathDir = ''): string;

    /**
     * Go to parent directory
     *
     * @return string
     */
    public function gotoParentDir(): string;

    /**
     * Go to sub directory
     *
     * @param string $subDir
     * @return string
     */
    public function gotoSubDir(string $subDir): string;

    /**
     * Check path directory
     *
     * @param $pathDir
     */
    public function validateDir($pathDir): void;
}