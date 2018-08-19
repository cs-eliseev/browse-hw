<?php

namespace browse;

use browse\Exceptions\BrowseDirectoryException;
use browse\Helpers\Json;
use browse\Interfaces\BrowseDirectoryInterface;
use browse\Operations\ScannerDir;
use browse\Operations\ScannerFile;
use browse\Operations\ScannerFull;

class BrowseDirectory implements BrowseDirectoryInterface
{
    const RESPONSE_OPTIONS_JSON = 'j';
    const RESPONSE_OPTIONS_STRING = 's';

    const OPERATION_DIR = 'd';
    const OPERATION_FILE = 'f';

    protected $pathDir;

    protected $showLink = false;
    protected $fileMode = false;

    protected $fullScan = false;

    protected $operation;
    protected $optionsResponse;

    protected $response;

    /**
     * BrowseDirectory constructor
     *
     * @param string $operation
     * @param string $pathDir
     * @param string $optionsResponse
     */
    public function __construct(string $operation = '', string $pathDir = '', string $optionsResponse = '')
    {
        $this->pathDir = $pathDir;
        $this->optionsResponse = $optionsResponse;
        if (!empty($operation)) $this->setOperation($operation);
    }

    /**
     * Set operation directory
     *
     * @param string $operation
     */
    public function setOperation(string $operation): void
    {
        switch ($operation) {
            case self::OPERATION_DIR:
                $this->operation = new ScannerDir();
                break;

            case self::OPERATION_FILE:
                $this->operation = new ScannerFile();
                break;

            default:
                $this->operation = new ScannerFull();
                break;
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
     * @throws BrowseDirectoryException
     */
    public function showDir(string $pathDir = '', string $operation = '', string $optionsResponse = '')
    {
        $this->initOperations($pathDir, $operation, $optionsResponse);

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
     * @throws BrowseDirectoryException
     */
    public function scanDir(string $pathDir = '', string $operation = '', string $optionsResponse = '')
    {
        $this->initOperations($pathDir, $operation, $optionsResponse);

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
     * Init Operation directory
     *
     * @param string $pathDir
     * @param string $operation
     * @param string $optionsResponse
     *
     * @throws BrowseDirectoryException
     */
    protected function initOperations(string $pathDir, string $operation, string $optionsResponse): void
    {
        if (!empty($pathDir)) $this->pathDir = $pathDir;
        if (!empty($optionsResponse)) $this->optionsResponse = $optionsResponse;

        if (!empty($operation)) $this->setOperation($operation);
        $this->validateInitOperation();

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
     * Check init operation directory
     *
     * @throws BrowseDirectoryException
     */
    protected function validateInitOperation(): void
    {
        if (!is_object($this->operation)) {
            BrowseDirectoryException::throwException(BrowseDirectoryException::ERROR_OPERATION_IS_NOT_EXIST);
        }
    }
}