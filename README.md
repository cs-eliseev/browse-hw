Browse HW PHP
==========

This library contains pure PHP implementations for directory managing.

This library stripped-down version project: [Browse](https://github.com/cs-eliseev/browse.git)
Spcial for OTUS curs backendPHP.

### Usage

Usage all method exec relative set path directory.

**Init**

Example:

```php
$dir = new ActionDirectory(__DIR__);
```

**Set path directory**

Example:

```php
$dir->setPathDir(__DIR__);
```

**Get current name directory**

Example:

```php
$dir->getCurrentDirName();
```

**Get parent directory**

Example:

```php
$dir->getParentDir();
```

**Get current path directory**

Example:

```php
$dir->getPathDir();
```

**Go to parent directory**

Example:

```php
$dir->gotoParentDir();
```

**Go to sub directory**

Example:

```php
$dir->gotoSubDir('subDir/subDir');
```

**Show directory**

Example:

```php
$dir->showDir();
```

**Show directory & sub directory**

Example:

```php
$dir->scanDir();
```
