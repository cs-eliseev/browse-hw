<?php

namespace browse;

use DirectoryIterator;
use Exception;

/**
 * Class ActionDirectory
 *
 * Date: 31.07.2018
 * Time: 20:34
 */

class ActionDirectory
{

    const TYPE_DIR = 'directory';
    const TYPE_FILE = 'file';
    const TYPE_LINK = 'link';

    const ERROR_DIR_NOT_EXIST = 1;
    const ERROR_FILE_MOD_NOT_OCT = 2;

    protected $pathDir = '';

    protected $showLink = false;
    protected $fileMode = false;

    protected $fullScan = false;

    protected $errors = [
        self::ERROR_DIR_NOT_EXIST => 'Directory is not exist',
        self::ERROR_FILE_MOD_NOT_OCT => 'Invalid file mode'
    ];

    public function __construct(string $pathDir = '')
    {
        $this->pathDir = $pathDir;
    }

    /**
     * Show directory
     *
     * @return array
     */
    public function showDir(): array
    {
        return $this->viewDir();
    }

    /**
     * Show directory & sub directory
     *
     * @return array
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
     */
    protected function viewDir(string $defaultPath = ''): array
    {
        // check directory
        if (!is_dir($this->pathDir)) {
            $this->throwException(self::ERROR_DIR_NOT_EXIST, 'current path: ' . $this->pathDir);
        }

        $iterator = new DirectoryIterator($this->pathDir);

        // set default path start directory
        if (empty($defaultPath)) $defaultPath = $this->pathDir;

        // get relative path for start directory
        $path = str_replace($defaultPath, '', $iterator->getPath());
        $path = $path ? $path . DIRECTORY_SEPARATOR : '';

        $res = [];

        while ($iterator->valid()) {

            $item = $iterator->current();

            // ignore dot
            if (!$item->isDot()) {

                // set attributes item
                $attr = [
                    'name' => $item->getFilename(),
                    'path' => $item->getPath(),
                    'path_name' => $item->getPathname(),
                    'relative_path' => $path,
                    'relative_path_name' => $path . $item->getFilename(),
                ];

                if ($item->isDir()) {

                    $attr['type'] = self::TYPE_DIR;
                    // get sab directory
                    if ($this->fullScan) {

                        $this->pathDir = $item->getPathname();
                        $attr['node'] = $this->viewDir($defaultPath);
                    }

                } elseif($item->isFile()) {

                    $attr['type'] = self::TYPE_FILE;
                    $attr['short_name'] = $item->getBasename('.' . $item->getExtension());
                    $attr['extension'] = $item->getExtension();

                } elseif ($item->isLink()) {

                    $attr['type'] = self::TYPE_LINK;
                    // get sab directory link
                    if ($this->fullScan && $this->showLink) {

                        $this->pathDir = $item->getPathname();
                        $attr['node'] = $this->viewDir($defaultPath);
                    }
                }

                $res[] = $attr;

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
     */
    public function setPathDir(string $pathDir): void
    {
        // check directory
        if (!is_dir($pathDir)) {
            $this->throwException(self::ERROR_DIR_NOT_EXIST, 'current path: ' . $pathDir);
        }

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
     */
    public function getCurrentDirName(string $pathDir = ''): string
    {
        if (empty($pathDir)) {

            $dir = $this->pathDir;

        } else {

            // check directory
            if (!is_dir($pathDir)) {
                $this->throwException(self::ERROR_DIR_NOT_EXIST, 'current path: ' . $pathDir);
            }

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
     */
    public function getParentDir(string $pathDir = ''): string
    {
        if (empty($pathDir)) {

            $list_path = explode(DIRECTORY_SEPARATOR, $this->pathDir);

        } else {

            // check directory
            if (!is_dir($pathDir)) {
                $this->throwException(self::ERROR_DIR_NOT_EXIST, 'current path: ' . $pathDir);
            }

            $list_path = explode(DIRECTORY_SEPARATOR, $pathDir);
        }

        array_pop($list_path);

        return implode(DIRECTORY_SEPARATOR, $list_path);
    }

    /**
     * Go to parent directory
     *
     * @return string
     */
    public function gotoParentDir(): string
    {
        $this->pathDir = $this->getParentDir();

        return $this->pathDir;
    }

    /**
     * Go to sub directory
     *
     * @param string $subDir
     * @return string
     */
    public function gotoSubDir(string $subDir): string
    {
        $new_dir = $this->pathDir . DIRECTORY_SEPARATOR . $subDir;

        // check directory
        if (!is_dir($new_dir)) {
            $this->throwException(self::ERROR_DIR_NOT_EXIST, 'current path: ' . $new_dir);
        }

        $this->pathDir = $new_dir;

        return $this->pathDir;
    }

    /**
     * Check oct (0777)
     *
     * @param $oct
     * @return bool
     */
    protected function isOct($oct): bool
    {
        return (bool)preg_match("/^[0-7]{4}$/", $oct);
    }

    /**
     * Exceptions
     *
     * @param int $code
     * @param string $msg
     * @throws Exception
     */
    protected function throwException(int $code, string $msg = ''): void
    {
        throw new Exception(
            $this->errors[$code] . ($msg ? ' ' . $msg : ''),
            $code
        );
    }
}