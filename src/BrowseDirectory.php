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

    protected $showLink = false;
    protected $fileMode = false;

    protected $fullScan = false;

    protected $pathDir = '';
    protected $operation = '';
    protected $optionsResponse = '';

    protected $scanner;

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

        $this->response = $this->scanner->showDir();
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

        $this->response = $this->scanner->scanDir();
        return $this->convertResponse();
    }

    /**
     * @param string $pathDir
     * @return BrowseDirectoryInterface
     */
    public function setPathDir(string $pathDir): BrowseDirectoryInterface
    {
        $this->pathDir = $pathDir;

        return $this;
    }

    /**
     * @param string $optionsResponse
     * @return BrowseDirectoryInterface
     */
    public function setOptionsResponse(string $optionsResponse) : BrowseDirectoryInterface
    {
        $this->optionsResponse = $optionsResponse;

        return $this;
    }

    /**
     * Set operation directory
     *
     * @param string $operation
     * @return BrowseDirectoryInterface
     */
    public function setOperation(string $operation = '') : BrowseDirectoryInterface
    {
        $this->operation = $operation;

        return $this;
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
    protected function initOperations(string $pathDir, string $operation, string $optionsResponse) : void
    {
        if (!empty($pathDir)) $this->pathDir = $pathDir;
        if (!empty($optionsResponse)) $this->optionsResponse = $optionsResponse;

        if (!empty($operation)) $this->operation = $operation;

        $this->seScanner();

        $this->scanner->setPathDir($this->pathDir);
    }

    /**
     * Set scan object
     */
    protected function seScanner()
    {
        switch ($this->operation) {
            case self::OPERATION_DIR:
                $this->scanner = new ScannerDir();
                break;

            case self::OPERATION_FILE:
                $this->scanner = new ScannerFile();
                break;

            default:
                $this->scanner = new ScannerFull();
                break;
        }
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
}