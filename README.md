Browse HW PHP
==========

This library contains pure PHP implementations for directory managing.

This library stripped-down version project: [Browse](https://github.com/cs-eliseev/browse.git)
Spcial for OTUS curs backendPHP.

### Info

**Methods**

| methods | info |
| --- | --- |
| show | view set directory |
| scan | view set directory & sub directory |

**Ooperations:**

| operations | info |
| --- | --- |
| s | view structure |
| f | view files |
| d | view directoris |

### Usage console

**Description**

> run methods operations directory

* method view: show, scan
* operation view: s, f, d
* directory - scaning directory

**Example*

> run scan s ~/example

### Usage Object

**Example**

```php
$browse = new BrowseDirectory();
$arrayStructureDirectory = $browse->scanDir(
    '~/Example',
    's'
)
```
