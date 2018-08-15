<?php
/**
 * Created by PhpStorm.
 * User: akeliseev
 * Date: 15.08.18
 * Time: 11:13
 */

namespace browse\Operations;


use browse\Abstracts\AbstractScanner;
use DirectoryIterator;

class File extends AbstractScanner
{
    protected  function getItem(DirectoryIterator $item, string $path, string $defaultPath = ''): array
    {
        $attr = [];
        if ($item->isDir() && $this->fullScan) {

            $this->pathDir = $item->getPathname();
            $dirInfo = $this->viewDir($defaultPath);
            if (!empty($dirInfo)) {
                $attr['filter'] = $dirInfo;
            }
            unset($dirInfo);

        } elseif($item->isFile()) {

            // set attributes item
            $attr = [
                'name' => $item->getFilename(),
                'path' => $item->getPath(),
                'path_name' => $item->getPathname(),
                'relative_path' => $path,
                'relative_path_name' => $path . DIRECTORY_SEPARATOR . $item->getFilename(),
                'short_name' => $item->getBasename('.' . $item->getExtension()),
                'extension' => $item->getExtension(),
                'type' => self::TYPE_FILE,
            ];

        } elseif ($item->isLink() && $this->fullScan && $this->showLink) {

            $this->pathDir = $item->getPathname();
            $dirInfo = $this->viewDir($defaultPath);
            if (!empty($dirInfo)) {
                $attr['filter'] = $dirInfo;
            }
            unset($dirInfo);
        }

        return $attr;
    }
}