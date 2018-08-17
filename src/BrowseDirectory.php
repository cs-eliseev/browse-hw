<?php

namespace browse;

use browse\Helpers\Json;
use browse\Interfaces\BrowseDirectoryInterface;
use browse\Operations\Dir;
use browse\Operations\File;
use browse\Operations\Scan;
use Exception;

class BrowseDirectory implements BrowseDirectoryInterface
{
    const RESPONSE_OPTIONS_JSON = 'j';
    const RESPONSE_OPTIONS_STRING = 's';

    const OPERATION_DIR = 'd';
    const OPERATION_FILE = 'f';
    const OPERATION_SCAN = 's';

    const ERROR_DIR_NOT_EXIST = 1;
    const ERROR_FILE_MOD_NOT_OCT = 2;
    const ERROR_OPERATION_UNKNOWN = 3;
    const ERROR_OPERATION_IS_NOT_EXIST = 4;

    protected $pathDir;

    protected $showLink = false;
    protected $fileMode = false;

    protected $fullScan = false;

    protected $operation;
    protected $optionsResponse;

    protected $response;

    protected $errors = [
        self::ERROR_DIR_NOT_EXIST => 'Directory is not exist',
        self::ERROR_FILE_MOD_NOT_OCT => 'Invalid file mode',
        self::ERROR_OPERATION_UNKNOWN => 'Unknown operation',
        self::ERROR_OPERATION_IS_NOT_EXIST => 'Operation is not exist',
    ];

    /**
     * BrowseDirectory constructor
     *
     * @param string $operation
     * @param string $pathDir
     * @param string $optionsResponse
     * @throws Exception
     */
    public function __construct(string $operation = '', string $pathDir = '', string $optionsResponse = '')
    {
        $this->pathDir = $pathDir;
        $this->optionsResponse = $optionsResponse;
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
     * @param string $optionsResponse
     * @return array|string
     *
     * @throws Exception
     */
    public function showDir(string $pathDir = '', string $operation = '', string $optionsResponse = '')
    {
        $this->init($pathDir, $operation, $optionsResponse);

        $this->response = $this->operation->showDir();
        return $this->convertResponse();
    }

    /**
     * Scan directory
     *
     * @param string $pathDir
     * @param string $operation
     * @param string $optionsResponse
     * @return array|string
     *
     * @throws Exception
     */
    public function scanDir(string $pathDir = '', string $operation = '', string $optionsResponse = '')
    {
        $this->init($pathDir, $operation, $optionsResponse);

        $this->response = $this->operation->scanDir();
        return $this->convertResponse();
    }

    /**
     * @param string $pathDir
     */
    public function setPathDir(string $pathDir): void
    {
        $this->pathDir = $pathDir;
    }

    /**
     * @param string $optionsResponse
     */
    public function setOptionsResponse(string $optionsResponse): void
    {
        $this->optionsResponse = $optionsResponse;
    }

    /**
     * @param string $pathDir
     * @param string $operation
     * @param string $optionsResponse
     * @throws Exception
     */
    protected function init(string $pathDir, string $operation, string $optionsResponse): void
    {
        if (!empty($pathDir)) $this->pathDir = $pathDir;
        if (!empty($optionsResponse)) $this->optionsResponse = $optionsResponse;

        if (!empty($operation)) $this->setOperation($operation);
        if (!is_object($this->operation)) $this->throwException(self::ERROR_OPERATION_IS_NOT_EXIST);

        $this->operation->setPathDir($this->pathDir);
    }

    /**
     * @return array|string
     */
    protected function convertResponse()
    {
        switch ($this->optionsResponse) {
            case self::RESPONSE_OPTIONS_STRING:

                $this->response = print_r($this->response, 1);
                break;

            case self::RESPONSE_OPTIONS_JSON:

                $this->response = Json::encode($this->response);
                break;
        }

        return $this->response;
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