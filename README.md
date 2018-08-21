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

### Operations

| operations | info |
| --- | --- |
| defualt | view directoris & files |
| f | view files |
| d | view directoris |

### Format options response

| options | info |
| --- | --- |
| default | response array |
| s | response string |
| j | response array |

# Usage

### Usage socket

**Description client**

> socket server host port thread

* host - listener ip address
* port - listener port
* thread - forck count

**Description client**

> socket client host port method operation directory [options]

* host - connect ip address or domain
* port - connect port
* method view: show, scan
* operation view: s, f, d
* directory - scaning directory
* options - format options response

Response options:

| options | info |
| --- | --- |
| default | response string |
| s | response string |
| j | response array |

**Example**

```php
#!/usr/bin/env php
<?php
$app = new Application('Directory information scanner.', 'v1.0.0');
$app->addCommands([
    new SocketTerminalClient(),
    new SocketTerminalServer()
]);
$app->run()
```

*Start server*
> socket server 127.0.0.1 5030 2

*Send client data*
> socket client 127.0.0.1 5030 show s ~/tests j

*Result client data*
```
[
    {
        "name": "1534877041_219",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_219",
        "relative_path": "",
        "relative_path_name": "/1534877041_219",
        "type": "directory"
    },
    {
        "name": "1534877041_3364.txt",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_3364.txt",
        "relative_path": "",
        "relative_path_name": "/1534877041_3364.txt",
        "short_name": "1534877041_3364",
        "extension": "txt",
        "type": "file"
    },
    {
        "name": "1534877041_7878.txt",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_7878.txt",
        "relative_path": "",
        "relative_path_name": "/1534877041_7878.txt",
        "short_name": "1534877041_7878",
        "extension": "txt",
        "type": "file"
    },
    {
        "name": "1534877041_9129",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_9129",
        "relative_path": "",
        "relative_path_name": "/1534877041_9129",
        "type": "directory"
    },
    {
        "name": "1534877041_958",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_958",
        "relative_path": "",
        "relative_path_name": "/1534877041_958",
        "type": "directory"
    }
]
```

*Send telnte data*
> telnte 127.0.0.1 5030
> show s /home/browse/tests j

*Result telnet data*
```
[
    {
        "name": "1534877041_219",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_219",
        "relative_path": "",
        "relative_path_name": "/1534877041_219",
        "type": "directory"
    },
    {
        "name": "1534877041_3364.txt",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_3364.txt",
        "relative_path": "",
        "relative_path_name": "/1534877041_3364.txt",
        "short_name": "1534877041_3364",
        "extension": "txt",
        "type": "file"
    },
    {
        "name": "1534877041_7878.txt",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_7878.txt",
        "relative_path": "",
        "relative_path_name": "/1534877041_7878.txt",
        "short_name": "1534877041_7878",
        "extension": "txt",
        "type": "file"
    },
    {
        "name": "1534877041_9129",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_9129",
        "relative_path": "",
        "relative_path_name": "/1534877041_9129",
        "type": "directory"
    },
    {
        "name": "1534877041_958",
        "path": "/home/browse/tests/1534877041_1830",
        "path_name": "/home/browse/tests/1534877041_1830/1534877041_958",
        "relative_path": "",
        "relative_path_name": "/1534877041_958",
        "type": "directory"
    }
]
```

**Client command**

| command | info |
| --- | --- |
| quit | Client cisconnect |
| shutdown | Shutdown forck |

> socket client 127.0.0.1 5030 shutdown

### Usage console

**Description**

> run methods operations directory [options]

* method view: show, scan
* operation view: s, f, d
* directory - scaning directory
* options - format options response

Response options:

| options | info |
| --- | --- |
| default | response string |
| s | response string |
| j | response array |

**Example**

```php
#!/usr/bin/env php
<?php
$app = new Application('Directory information scanner.', 'v1.0.0');
$app->addCommands([
    new BrowseDirectoryTerminalScan(),
    new BrowseDirectoryTerminalShow()
]);
$app->run();
```

> run scan s ~/tests

**Response**

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

### Usage Object

**Description**

Operations:

| operations | info |
| --- | --- |
| defualt | view directoris & files |
| f | view files |
| d | view directoris |

Response options:

| options | info |
| --- | --- |
| default | response array |
| s | response string |
| j | response json |

**Example**

```php
$browse = new BrowseDirectory();
$arrayStructureDirectory = $browse->setPathDir('~/tests')
                                  ->setOperation('s')
                                  ->scanDir();
print_r($arrayStructureDirectory);
```

**Response**

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
