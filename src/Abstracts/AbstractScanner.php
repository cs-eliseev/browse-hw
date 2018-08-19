<?php

namespace browse\Abstracts;

use browse\Interfaces\ScannerInterface;
use browse\Operations\Exceptions\ScannerException;
use DirectoryIterator;

abstract class AbstractScanner implements ScannerInterface
{
    const TYPE_DIR = 'directory';
    const TYPE_FILE = 'file';
    const TYPE_LINK = 'link';

    protected $pathDir = '';

    protected $showLink = false;
    protected $fileMode = false;

    protected $fullScan = false;

    public function __construct(string $pathDir = '')
    {
        $this->pathDir = $pathDir;
    }

    protected abstract function getItem(DirectoryIterator $item, string $path, string $defaultPath = ''): array;

    /**
     * Show directory
     *
     * @return array
     * @throws ScannerException
     */
    public function showDir(): array
    {
        return $this->viewDir();
    }

    /**
     * Show directory & sub directory
     *
     * @return array
     * @throws ScannerException
     */
    public function scanDir(): array
    {
        // enabled full scan
        $this->fullScan = true;

        $res = $this->viewDir();

        // disabled full scan
        $this->fullScan = false;

        return $res;
    }

    /**
     * Recursive function view directory
     *
     * @param string $defaultPath
     * @return array
     * @throws ScannerException
     */
    protected function viewDir(string $defaultPath = ''): array
    {
        // check directory
        $this->validateDir($this->pathDir);

        $iterator = new DirectoryIterator($this->pathDir);

        // set default path start directory
        if (empty($defaultPath)) $defaultPath = $this->pathDir;

        // get relative path for start directory
        $path = str_replace($defaultPath, '', $iterator->getPath());
        $path = $path ? $path : '';

        $res = [];

        while ($iterator->valid()) {

            $item = $iterator->current();

            // ignore dot
            if (!$item->isDot()) {

                $attr = $this->getItem($item, $path, $defaultPath);
                if (!empty($attr)) {

                    if (empty($attr['filter'])) {
                        $res[] = $attr;
                    } else {
                        foreach ($attr['filter'] as $item) {
                            $res[] = $item;
                        }
                    }

                }
                unset($attr);
            }

            unset($item);
            $iterator->next();
        }

        $this->pathDir = $defaultPath;

        unset($path);
        unset($defaultPath);
        unset($iterator);

        return $res;
    }

    /**
     * Set settings show link
     *
     * @param bool $showLink
     */
    public function setShowLink(bool $showLink): void
    {
        $this->showLink = $showLink;
    }

    /**
     * Set settings file mode
     *
     * @param bool $fileMode
     */
    public function setFileMode(bool $fileMode): void
    {
        $this->fileMode = $fileMode;
    }

    /**
     * Set current path directory
     *
     * @param string $pathDir
     * @throws ScannerException
     */
    public function setPathDir(string $pathDir): void
    {
        // check directory
        $this->validateDir($pathDir);

        $this->pathDir = $pathDir;
    }

    /**
     * Get current path directory
     *
     * @return string
     */
    public function getPathDir(): string
    {
        return $this->pathDir;
    }

    /**
     * Get current name directory
     *
     * @param string $pathDir
     * @return string
     * @throws ScannerException
     */
    public function getCurrentDirName(string $pathDir = ''): string
    {
        if (empty($pathDir)) {

            $dir = $this->pathDir;

        } else {

            // check directory
            $this->validateDir($pathDir);

            $dir = $pathDir;
        }

        return array_pop(
            explode(DIRECTORY_SEPARATOR, $dir)
        );
    }

    /**
     * Get parent directory
     *
     * @param string $pathDir
     * @return string
     * @throws ScannerException
     */
    public function getParentDir(string $pathDir = ''): string
    {
        if (empty($pathDir)) {

            $list_path = explode(DIRECTORY_SEPARATOR, $this->pathDir);

        } else {

            // check directory
            $this->validateDir($pathDir);

            $list_path = explode(DIRECTORY_SEPARATOR, $pathDir);
        }

        array_pop($list_path);

        return implode(DIRECTORY_SEPARATOR, $list_path);
    }

    /**
     * Go to parent directory
     *
     * @return string
     * @throws Exception
     */
    public function gotoParentDir(): string
    {
        $this->pathDir = $this->getParentDir();

        return $this->pathDir;
    }

    /**
     * Go to sub directory
     *
     * @param string $subDirName
     * @return string
     * @throws ScannerException
     */
    public function gotoSubDir(string $subDirName): string
    {
        $path_dir = $this->pathDir . DIRECTORY_SEPARATOR . $subDirName;

        // check directory
        $this->validateDir($path_dir);

        $this->pathDir = $path_dir;

        return $this->pathDir;
    }

    /**
     * Check path directory
     *
     * @param $pathDir
     * @throws ScannerException
     */
    public function validateDir($pathDir): void
    {
        if (!is_dir($this->pathDir)) {
            ScannerException::throwException(ScannerException::ERROR_DIR_NOT_EXIST, 'current path: ' . $pathDir);
        }
    }
}