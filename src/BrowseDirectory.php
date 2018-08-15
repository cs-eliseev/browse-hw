<?php

namespace browse;

use browse\Interfaces\BrowseDirectoryInterface;
use browse\Operations\Dir;
use browse\Operations\File;
use browse\Operations\Scan;
use Exception;

class BrowseDirectory implements BrowseDirectoryInterface
{

    const OPERATION_DIR = 'd';
    const OPERATION_FILE = 'f';
    const OPERATION_SCAN = 's';

    const ERROR_DIR_NOT_EXIST = 1;
    const ERROR_FILE_MOD_NOT_OCT = 2;
    const ERROR_OPERATION_UNKNOWN = 3;
    const ERROR_OPERATION_IS_NOT_EXIST = 4;

    protected $pathDir = '';

    protected $showLink = false;
    protected $fileMode = false;

    protected $fullScan = false;

    protected $operation;

    protected $errors = [
        self::ERROR_DIR_NOT_EXIST => 'Directory is not exist',
        self::ERROR_FILE_MOD_NOT_OCT => 'Invalid file mode',
        self::ERROR_OPERATION_UNKNOWN => 'Unknown operation',
        self::ERROR_OPERATION_IS_NOT_EXIST => 'Operation is not exist',
    ];

    /**
     * Directory constructor.
     *
     * @param string $operation
     * @param string $pathDir
     * @throws Exception
     */
    public function __construct(string $operation = '', string $pathDir = '')
    {
        $this->pathDir = $pathDir;
        if (!empty($operation)) $this->setOperation($operation);
    }

    /**
     * Set operation view
     *
     * @param string $operation
     * @throws Exception
     */
    public function setOperation(string $operation): void
    {
        switch ($operation) {
            case self::OPERATION_DIR:
                $this->operation = new Dir();
                break;

            case self::OPERATION_FILE:
                $this->operation = new File();
                break;

            case self::OPERATION_SCAN:
                $this->operation = new Scan();
                break;

            default :
                $this->throwException(self::ERROR_OPERATION_UNKNOWN);
        }
    }

    /**
     * Show directory
     *
     * @param string $pathDir
     * @param string $operation
     * @return array
     * @throws Exception
     */
    public function showDir(string $pathDir,string $operation): array
    {
        if (!empty($operation)) $this->setOperation($operation);
        if (!is_object($this->operation)) $this->throwException(self::ERROR_OPERATION_IS_NOT_EXIST);

        $this->operation->setPathDir($pathDir);

        return $this->operation->showDir();
    }

    /**
     * Scan directory
     *
     * @param string $pathDir
     * @param string $operation
     * @return array
     * @throws Exception
     */
    public function scanDir(string $pathDir, string $operation): array
    {
        if (!empty($operation)) $this->setOperation($operation);
        if (!is_object($this->operation)) $this->throwException(self::ERROR_OPERATION_IS_NOT_EXIST);

        $this->operation->setPathDir($pathDir);

        return $this->operation->scanDir();
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