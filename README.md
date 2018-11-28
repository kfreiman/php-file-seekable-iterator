# Seekable file iterator

It is implementation of [SeekableIterator](https://secure.php.net/manual/en/class.seekableiterator.php) for text files. This library uses [generators](https://secure.php.net/manual/en/class.generator.php) under hood, so it's suitable for large files.

## How to use

```php
$iterator = new FileSeekableIterator('/path/to/file');

$iterator->valid(); // true
$iterator->current(); // "16y3424ggg4\n" (based on test/files/data.txt example)
$iterator->key(); // 0

$iterator->seek(3);
$iterator->key(); // 3
```

## Standart implementation

Note, this project was created for learning purposes and can be used as an example, but in most cases [SplFileObject](http://php.net/manual/en/class.splfileobject.php) from Standard PHP Library is more useful.
