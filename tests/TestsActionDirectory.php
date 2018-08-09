<?php

/**
 * Class TestsActionDirectory
 *
 * User: Alexey
 * Date: 01.08.2018
 * Time: 22:28
 */

use browse\ActionDirectory;

include_once '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ActionDirectory.php';

class TestsActionDirectory
{
    protected $dir;

    protected $resultFileName;
    protected $resultFileDir;

    public function __construct($resultFileName, $resultFileDir)
    {
        $this->dir = new ActionDirectory();
        $this->resultFileName = $resultFileName;
        $this->resultFileDir = $resultFileDir;
    }

    public function createTestFile($dir)
    {
        $file_name =  strtotime('NOW') . '.txt';
        $file_path = $dir . DIRECTORY_SEPARATOR . $file_name;
        $file_content = 'date create: ' . date('d.m.Y H:i:s') . PHP_EOL
                      . 'file name: ' . $file_name . PHP_EOL
                      . 'path create: ' . $dir . PHP_EOL
                      . '************' . PHP_EOL . 'test' . PHP_EOL . '************';

        file_put_contents($file_path, $file_content);

        return $file_name;
    }


    public function setResultFile($name, $dir, $msg)
    {
        $file_name =  'result_' . $name . '.txt';
        $file_path = $dir . DIRECTORY_SEPARATOR . $file_name;
        $file_content = file_get_contents($file_path);
        $file_content .= PHP_EOL . '************' . PHP_EOL . $msg . PHP_EOL . '************' . PHP_EOL;

        file_put_contents($file_path, $file_content);

        return $file_name;
    }

    // test 3
    public function testShowDir($dir)
    {
        $this->dir->setPathDir($dir);

        $msg = 'SHOW DIR' . PHP_EOL . 'path: ' . $dir . PHP_EOL
             . print_r($this->dir->showDir() ,1);

        $this->log($msg);
        return $msg;
    }

    // test 4
    public function testScanDir($dir)
    {
        $this->dir->setPathDir($dir);

        $msg = 'SCAN DIR' . PHP_EOL . 'path: ' . $dir . PHP_EOL
             . print_r($this->dir->scanDir() ,1);

        $this->log($msg);
        return $msg;
    }

    // test 1
    public function testGetCurrentDirName($dir)
    {
        $msg = 'GET CORRENT DIR NAME' . PHP_EOL . 'path: ' . $dir . PHP_EOL
             . 'result: ' . $this->dir->getCurrentDirName($dir);

        $this->log($msg);
        return $msg;
    }

    // test 2
    public function testGetParentDir($dir)
    {
        $msg = 'GET PARENT DIR' . PHP_EOL . 'path: ' . $dir . PHP_EOL
             . 'result: ' . $this->dir->getParentDir($dir);

        $this->log($msg);
        return $msg;
    }

    protected function log($msg){

        $this->setResultFile($this->resultFileName, $this->resultFileDir, $msg);
    }
}