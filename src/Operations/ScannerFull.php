<?php

namespace browse\Operations;

use browse\Abstracts\AbstractScanner;
use DirectoryIterator;

class ScannerFull extends AbstractScanner
{
    protected  function getItem(DirectoryIterator $item, string $path, string $defaultPath = ''): array
    {
        // set attributes item
        $attr = [
            'name' => $item->getFilename(),
            'path' => $item->getPath(),
            'path_name' => $item->getPathname(),
            'relative_path' => $path,
            'relative_path_name' => $path . DIRECTORY_SEPARATOR . $item->getFilename(),
        ];

        if ($item->isDir()) {

            $attr['type'] = self::TYPE_DIR;
            // get sab directory
            if ($this->fullScan) {

                $this->pathDir = $item->getPathname();
                $dirInfo = $this->viewDir($defaultPath);
                if (!empty($dirInfo)) {
                    $attr['node'] = $dirInfo;
                }
                unset($dirInfo);
            }

        } elseif($item->isFile()) {

            $attr['short_name'] = $item->getBasename('.' . $item->getExtension());
            $attr['extension'] = $item->getExtension();
            $attr['type'] = self::TYPE_FILE;

        } elseif ($item->isLink()) {

            $attr['type'] = self::TYPE_LINK;
            // get sab directory link
            if ($this->fullScan && $this->showLink) {

                $this->pathDir = $item->getPathname();
                $dirInfo = $this->viewDir($defaultPath);
                if (!empty($dirInfo)) {
                    $attr['node'] = $dirInfo;
                }
                unset($dirInfo);
            }
        }

        return $attr;
    }
}