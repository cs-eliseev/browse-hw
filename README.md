Browse HW PHP
==========

This library contains pure PHP implementations for directory managing.

This library stripped-down version project: [Browse](https://github.com/cs-eliseev/browse.git)
Spcial for OTUS curs backendPHP.

# Install


### Composer

Execute the following command to get the latest version of the package:

>composer require cs-eliseev/browse-hw

# Info

### Methods

| methods | info |
| --- | --- |
| show | view set directory |
| scan | view set directory & sub directory |

### Ooperations

| operations | info |
| --- | --- |
| s | view structure |
| f | view files |
| d | view directoris |

# Usage

### Usage console

**Description**

> run methods operations directory

* method view: show, scan
* operation view: s, f, d
* directory - scaning directory

**Example*

> run scan s ~/example

**Result**

```
result: Array
(
    [0] => Array
    (
        [name] => 1534367219_2208.txt
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_2208.txt
        [relative_path] =>
        [relative_path_name] => /1534367219_2208.txt
        [short_name] => 1534367219_2208
        [extension] => txt
        [type] => file
    )
    [1] => Array
    (
        [name] => 1534367219_4388
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388
        [relative_path] =>
        [relative_path_name] => /1534367219_4388
        [type] => directory
        [node] => Array
        (
            [0] => Array
            (
                [name] => 1534367219_1506
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1506
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_1506
                [type] => directory
                [node] => Array
                (
                    [0] => Array
                    (
                        [name] => 1534367219_5663.txt
                        [path] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1506
                        [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1506/1534367219_5663.txt
                        [relative_path] => /1534367219_4388/1534367219_1506
                        [relative_path_name] => /1534367219_4388/1534367219_1506/1534367219_5663.txt
                        [short_name] => 1534367219_5663
                        [extension] => txt
                        [type] => file
                    )
                )
            )
            [1] => Array
            (
                [name] => 1534367219_1538.txt
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1538.txt
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_1538.txt
                [short_name] => 1534367219_1538
                [extension] => txt
                [type] => file
            )
            [2] => Array
            (
                [name] => 1534367219_2521
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_2521
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_2521
                [type] => directory
            )
            [3] => Array
            (
                [name] => 1534367219_536.txt
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_536.txt
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_536.txt
                [short_name] => 1534367219_536
                [extension] => txt
                [type] => file
            )
        )
    )
    [2] => Array
    (
        [name] => 1534367219_5489.txt
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_5489.txt
        [relative_path] =>
        [relative_path_name] => /1534367219_5489.txt
        [short_name] => 1534367219_5489
        [extension] => txt
        [type] => file
    )
    [3] => Array
    (
        [name] => 1534367219_6228
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_6228
        [relative_path] =>
        [relative_path_name] => /1534367219_6228
        [type] => directory
    )
)
```

### Usage Object

**Example**

```php
$browse = new BrowseDirectory();
$arrayStructureDirectory = $browse->scanDir(
    '~/Example',
    's'
);
print_r($arrayStructureDirectory);
```

**Result**

```
Array
(
    [0] => Array
    (
        [name] => 1534367219_2208.txt
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_2208.txt
        [relative_path] =>
        [relative_path_name] => /1534367219_2208.txt
        [short_name] => 1534367219_2208
        [extension] => txt
        [type] => file
    )
    [1] => Array
    (
        [name] => 1534367219_4388
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388
        [relative_path] =>
        [relative_path_name] => /1534367219_4388
        [type] => directory
        [node] => Array
        (
            [0] => Array
            (
                [name] => 1534367219_1506
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1506
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_1506
                [type] => directory
                [node] => Array
                (
                    [0] => Array
                    (
                        [name] => 1534367219_5663.txt
                        [path] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1506
                        [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1506/1534367219_5663.txt
                        [relative_path] => /1534367219_4388/1534367219_1506
                        [relative_path_name] => /1534367219_4388/1534367219_1506/1534367219_5663.txt
                        [short_name] => 1534367219_5663
                        [extension] => txt
                        [type] => file
                    )
                )
            )
            [1] => Array
            (
                [name] => 1534367219_1538.txt
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_1538.txt
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_1538.txt
                [short_name] => 1534367219_1538
                [extension] => txt
                [type] => file
            )
            [2] => Array
            (
                [name] => 1534367219_2521
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_2521
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_2521
                [type] => directory
            )
            [3] => Array
            (
                [name] => 1534367219_536.txt
                [path] => /home/browse/tests/1534367219_6524/1534367219_4388
                [path_name] => /home/browse/tests/1534367219_6524/1534367219_4388/1534367219_536.txt
                [relative_path] => /1534367219_4388
                [relative_path_name] => /1534367219_4388/1534367219_536.txt
                [short_name] => 1534367219_536
                [extension] => txt
                [type] => file
            )
        )
    )
    [2] => Array
    (
        [name] => 1534367219_5489.txt
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_5489.txt
        [relative_path] =>
        [relative_path_name] => /1534367219_5489.txt
        [short_name] => 1534367219_5489
        [extension] => txt
        [type] => file
    )
    [3] => Array
    (
        [name] => 1534367219_6228
        [path] => /home/browse/tests/1534367219_6524
        [path_name] => /home/browse/tests/1534367219_6524/1534367219_6228
        [relative_path] =>
        [relative_path_name] => /1534367219_6228
        [type] => directory
    )
)
```
