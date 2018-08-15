<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use browse\Abstracts\AbstractScanner;
use browse\BrowseDirectory;
use PHPUnit\Framework\TestCase;

class TestBrowseDirectory extends TestCase
{
    public function testShowS(): void
    {
        $directory = new BrowseDirectory();

        $patchDir = $this->createDir(__DIR__);

        // create test data
        $structTest = [];

        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        $dir1 = $this->createDir($patchDir);
        $dir1_struct = $this->createArrayStruct($dir1, '');
        $sub_dir1 = $this->createDir($dir1);
        $sub_dir1_struct = $this->createArrayStruct($sub_dir1, $dir1_struct['name']);
        $sub_dir1_file1 = $this->createFile($sub_dir1);
        $this->createArrayStruct($sub_dir1_file1, $dir1_struct['name'] . DIRECTORY_SEPARATOR . $sub_dir1_struct['name']);
        $this->createDir($dir1);
        $this->createFile($dir1);
        $this->createFile($dir1);
        array_push($structTest, $dir1_struct);
        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));

        // get scan data
        $structDir = $directory->showDir($patchDir, BrowseDirectory::OPERATION_SCAN);

        // validate data
        $this->assertTrue($this->isValidateArray($structDir, $structTest));
    }

    public function testShowF(): void
    {
        $directory = new BrowseDirectory();

        $patchDir = $this->createDir(__DIR__);

        // create test data
        $structTest = [];

        $this->createDir($patchDir);
        $dir1 = $this->createDir($patchDir);
        $dir1_struct = $this->createArrayStruct($dir1, '');
        $sub_dir1 = $this->createDir($dir1);
        $sub_dir1_struct = $this->createArrayStruct($sub_dir1, $dir1_struct['name']);
        $sub_dir1_file1 = $this->createFile($sub_dir1);
        $this->createArrayStruct($sub_dir1_file1, $dir1_struct['name'] . DIRECTORY_SEPARATOR . $sub_dir1_struct['name']);
        $this->createDir($dir1);
        $this->createFile($dir1);
        $this->createFile($dir1);
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));

        // get scan data
        $structDir = $directory->showDir($patchDir, BrowseDirectory::OPERATION_FILE);

        // validate data
        $this->assertTrue($this->isValidateArray($structDir, $structTest));
    }

    public function testShowD(): void
    {
        $directory = new BrowseDirectory();

        $patchDir = $this->createDir(__DIR__);

        // create test data
        $structTest = [];

        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        $dir1 = $this->createDir($patchDir);
        $dir1_struct = $this->createArrayStruct($dir1, '');
        $sub_dir1 = $this->createDir($dir1);
        $sub_dir1_struct = $this->createArrayStruct($sub_dir1, $dir1_struct['name']);
        $sub_dir1_file1 = $this->createFile($sub_dir1);
        $this->createArrayStruct($sub_dir1_file1, $dir1_struct['name'] . DIRECTORY_SEPARATOR . $sub_dir1_struct['name']);
        $this->createDir($dir1);
        $this->createFile($dir1);
        $this->createFile($dir1);
        array_push($structTest, $dir1_struct);
        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        $this->createFile($patchDir);
        $this->createFile($patchDir);

        // get scan data
        $structDir = $directory->showDir($patchDir, BrowseDirectory::OPERATION_DIR);

        // validate data
        $this->assertTrue($this->isValidateArray($structDir, $structTest));
    }

    public function testScanS(): void
    {
        $directory = new BrowseDirectory();

        $patchDir = $this->createDir(__DIR__);

        // create test data
        $structTest = [];

        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        $dir1 = $this->createDir($patchDir);
        $dir1_struct = $this->createArrayStruct($dir1, '');
        $sub_dir1 = $this->createDir($dir1);
        $sub_dir1_struct = $this->createArrayStruct($sub_dir1, $dir1_struct['name']);
        $sub_dir1_file1 = $this->createFile($sub_dir1);
        $sub_dir1_file1_struct = $this->createArrayStruct($sub_dir1_file1, $dir1_struct['name'] . DIRECTORY_SEPARATOR . $sub_dir1_struct['name']);
        $sub_dir1_struct['node'][] = $sub_dir1_file1_struct;
        $dir1_struct['node'][] = $sub_dir1_struct;
        $dir1_struct['node'][] = $this->createArrayStruct($this->createDir($dir1), $dir1_struct['name']);
        $dir1_struct['node'][] = $this->createArrayStruct($this->createFile($dir1), $dir1_struct['name']);
        $dir1_struct['node'][] = $this->createArrayStruct($this->createFile($dir1), $dir1_struct['name']);
        array_push($structTest, $dir1_struct);
        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));

        // get scan data
        $structDir = $directory->scanDir($patchDir, BrowseDirectory::OPERATION_SCAN);

        // validate data
        $this->assertTrue($this->isValidateArray($structDir, $structTest));
    }

    public function testScanF(): void
    {
        $directory = new BrowseDirectory();

        $patchDir = $this->createDir(__DIR__);

        // create test data
        $structTest = [];

        $this->createDir($patchDir);
        $dir1 = $this->createDir($patchDir);
        $dir1_struct = $this->createArrayStruct($dir1, '');
        $sub_dir1 = $this->createDir($dir1);
        $sub_dir1_struct = $this->createArrayStruct($sub_dir1, $dir1_struct['name']);
        $sub_dir1_file1 = $this->createFile($sub_dir1);
        array_push($structTest, $this->createArrayStruct($sub_dir1_file1, $dir1_struct['name'] . DIRECTORY_SEPARATOR . $sub_dir1_struct['name']));
        array_push($structTest, $this->createArrayStruct($this->createFile($dir1), $dir1_struct['name']));
        array_push($structTest, $this->createArrayStruct($this->createFile($dir1), $dir1_struct['name']));
        $this->createDir($patchDir);
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));
        array_push($structTest, $this->createArrayStruct($this->createFile($patchDir), ''));

        // get scan data
        $structDir = $directory->scanDir($patchDir, BrowseDirectory::OPERATION_FILE);

        // validate data
        $this->assertTrue($this->isValidateArray($structDir, $structTest));
    }

    public function testScanD(): void
    {
        $directory = new BrowseDirectory();

        $patchDir = $this->createDir(__DIR__);

        // create test data
        $structTest = [];

        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));

        $dir1 = $this->createDir($patchDir);
        $dir1_struct = $this->createArrayStruct($dir1, '');
        $sub_dir1 = $this->createDir($dir1);
        array_push($structTest, $this->createArrayStruct($sub_dir1, $dir1_struct['name']));
        $this->createFile($sub_dir1);
        array_push($structTest, $this->createArrayStruct($this->createDir($dir1), $dir1_struct['name']));
        $this->createFile($dir1);
        $this->createFile($dir1);
        array_push($structTest, $dir1_struct);
        array_push($structTest, $this->createArrayStruct($this->createDir($patchDir), ''));
        $this->createFile($patchDir);
        $this->createFile($patchDir);

        // get scan data
        $structDir = $directory->scanDir($patchDir, BrowseDirectory::OPERATION_DIR);

        // validate data
        $this->assertTrue($this->isValidateArray($structDir, $structTest));
    }

    public function testBrowseEOperationIsNotExist(): void
    {
        $directory = new BrowseDirectory();

        // create test data
        $this->expectException(\Exception::class);

        // get scan data
        $directory->scanDir(__DIR__, '');
    }

    public function testBrowseEOperationUnknown(): void
    {
        $directory = new BrowseDirectory();

        // create test data
        $this->expectException(\Exception::class);

        // get scan data
        $directory->scanDir(__DIR__, '');
    }

    public function testBrowseEDirIsNotExist(): void
    {
        $directory = new BrowseDirectory();

        // create test data
        $this->expectException(\Exception::class);

        // get scan data
        $directory->scanDir('', BrowseDirectory::OPERATION_SCAN);
    }

    /**
     * @param string $patch
     * @param string $relativePatch
     * @param array $node
     * @return array
     */
    protected function createArrayStruct(string $patch, string $relativePatch, array $node = []): array
    {
        $patchArray = explode(DIRECTORY_SEPARATOR, $patch);
        $name = array_pop($patchArray);
        $nameArray = explode('.', $name);

        $relativePatchArray = explode(DIRECTORY_SEPARATOR, $relativePatch);

        array_pop($relativePatchArray);

        $attr = [
            'name' => $name,
            'path' => implode(DIRECTORY_SEPARATOR, $patchArray),
            'path_name' => $patch,
            'relative_path' => empty($relativePatch) ? $relativePatch : DIRECTORY_SEPARATOR . $relativePatch,
            'relative_path_name' => empty($relativePatch) ?
                                    DIRECTORY_SEPARATOR . $name :
                                    DIRECTORY_SEPARATOR . $relativePatch . DIRECTORY_SEPARATOR . $name,
        ];


        if (count($nameArray) > 1) {
            $attr['short_name'] = $nameArray[0];
            $attr['extension'] = $nameArray[1];
            $attr['type'] = AbstractScanner::TYPE_FILE;
        } else {
            $attr['type'] = AbstractScanner::TYPE_DIR;
            if (!empty($node)) $attr['node'] = $node;
        }

        return $attr;
    }

    /**
     * @param string $patchDir
     * @return string
     */
    protected function createDir(string $patchDir): string
    {
        $dir_name = strtotime('NOW') . '_' . rand(1,9999);
        $dir_patch = $patchDir . DIRECTORY_SEPARATOR . $dir_name;

        mkdir($dir_patch);

        return $dir_patch;
    }

    /**
     * @param string $patchDir
     * @return string
     */
    protected function createFile(string $patchDir): string
    {
        $file_name =  strtotime('NOW') . '_' . rand(1,9999) . '.txt';
        $file_path = $patchDir . DIRECTORY_SEPARATOR . $file_name;
        $file_content = 'date create: ' . date('d.m.Y H:i:s') . PHP_EOL
            . 'file name: ' . $file_name . PHP_EOL
            . 'path create: ' . $patchDir . PHP_EOL
            . '************' . PHP_EOL . 'test' . PHP_EOL . '************';

        file_put_contents($file_path, $file_content);

        return $file_path;
    }

    /**
     * @param array $arrayFirst
     * @param array $arraySecond
     * @return bool
     */
    protected function isValidateArray(array $arrayFirst, array $arraySecond): bool
    {
        // sort array
        if (array_key_exists(0, $arrayFirst)) {
            asort($arrayFirst);
            $arrayFirst = array_values($arrayFirst);
        }

        if (array_key_exists(0, $arraySecond)) {
            asort($arraySecond);
            $arraySecond = array_values($arraySecond);
        }

        // if the indexes don't match, return immediately
        if (count(array_diff_assoc($arrayFirst, $arraySecond))) {
            return false;
        }

        // we know that the indexes, but maybe not values, match.
        // compare the values between the two arrays
        foreach ($arrayFirst as $key => $value) {

            if (
                (is_array($value) && !$this->isValidateArray($value, $arraySecond[$key])) ||
                (!is_array($value) && $value !== $arraySecond[$key])
            ) {
                return false;
            }
        }

        // we have identical indexes, and no unequal values
        return true;
    }
}