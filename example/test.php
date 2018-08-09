<?php

/**
 * Test script
 *
 * User: Alexey
 * Date: 02.08.2018
 * Time: 0:50
 */

use browse\ActionDirectory;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ActionDirectory.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'TestsActionDirectory.php';

/**
 * Create test structure
 */
$parent_test_dir = __DIR__ . DIRECTORY_SEPARATOR . 'test';
mkdir($parent_test_dir);
$result_dir = __DIR__ . DIRECTORY_SEPARATOR . 'result';
mkdir($result_dir);
$result_file_name = 'example_1_' . strtotime('NOW');

/**
 * Set params
 */
$current_dir = $parent_test_dir . DIRECTORY_SEPARATOR . 'test_1';
$sub_dir_1_name = 'sub_dir_1_test_1';
$sub_dir_1 = $current_dir . DIRECTORY_SEPARATOR . $sub_dir_1_name;
$sub_dir_2_name = 'sub_dir_2_test_1';
$sub_dir_2 = $current_dir . DIRECTORY_SEPARATOR . $sub_dir_2_name;
$sub_dir_3_name = 'sub_dir_3_test_1';
$sub_dir_4_name = 'sub_dir_4_test_1';

$test_dir_2_name = 'test_2';
$test_dir_2 = $parent_test_dir . DIRECTORY_SEPARATOR . $test_dir_2_name;
$test_dir_3_name = 'test_3';
$test_dir_3 = $parent_test_dir . DIRECTORY_SEPARATOR . $test_dir_3_name;

/**
 * Start tests
 */
$tests = new TestsActionDirectory($result_file_name, $result_dir);

/**
 * Create structure dir
 *
 * dir => [
 *          sub_dir => [
 *                       file_1,
 *                       file_2
 *
 *          ],
 *          file_3,
 *          file_4
 * ]
 */
create_demo_data($tests, $current_dir);
create_demo_data($tests, $sub_dir_1);
create_demo_data($tests, $test_dir_2);
create_demo_data($tests, $test_dir_3);

// test 1
$tests->testGetCurrentDirName($current_dir);
// test 2
$tests->testGetParentDir($sub_dir_1);

// test 3
$tests->testShowDir($current_dir);
// test 4
$tests->testScanDir($current_dir);

/**
 * Create demo data
 *
 * @param TestsActionDirectory $tests
 * @param $dir
 */
function create_demo_data(TestsActionDirectory $tests, $dir)
{
    // Create test dir
    mkdir($dir);
//    sleep(5);

    // create test file 1
    $tests->createTestFile($dir);
//    sleep(5);

    // create test file 2
    sleep(1);
    $tests->createTestFile($dir);
}
