<?php
/**
 * Created by PhpStorm.
 * User: akeliseev
 * Date: 15.08.18
 * Time: 11:14
 */

namespace browse\Operations;


use browse\Abstracts\AbstractScanner;
use DirectoryIterator;

class Dir extends AbstractScanner
{
    protected  function getItem(DirectoryIterator $item, string $path, string $defaultPath = ''): array
    {
        $attr = [];
        if ($item->isDir()) {

            // set attributes item
            $attr[] = [
                'name' => $item->getFilename(),
                'path' => $item->getPath(),
                'path_name' => $item->getPathname(),
                'relative_path' => $path,
                'relative_path_name' => $path . DIRECTORY_SEPARATOR . $item->getFilename(),
                'type' => self::TYPE_DIR,
            ];

            // get sab directory
            if ($this->fullScan) {

                $this->pathDir = $item->getPathname();

                $dirInfo = $this->viewDir($defaultPath);
                if (!empty($dirInfo)) {
                    foreach ($dirInfo as $item) {
                        $attr[] = $item;
                    }
                    unset($item);
                }
                unset($dirInfo);
            }

        } elseif ($item->isLink() && $this->fullScan && $this->showLink) {

            $dirInfo = $this->viewDir($defaultPath);
            if (!empty($dirInfo)) {
                $attr['filter'] = $dirInfo;
            }
            unset($dirInfo);
        }

        return empty($attr) ? $attr : [
            'filter' => $attr
        ];
    }
}