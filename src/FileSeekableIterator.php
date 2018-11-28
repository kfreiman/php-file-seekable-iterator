<?php
declare(strict_types=1);

namespace kfreiman\FileIterator;

// /**
//  *
//  */
// class Iterator extends \SplFileObject implements \SeekableIterator {
//
//   public function __construct($path)
//   {
//       parent::__construct($path);
//   }
// }

class FileSeekableIterator implements \SeekableIterator
{

  private $path;

  /** @var \Generator */
  private $fileGenerator;

  public function __construct($path)
  {
    $this->path = $path;
  }

  public function rewind()
  {
    $this->fileGenerator = $this->openFile($this->path);
  }

  public function current()
  {
    if (!$this->fileGenerator) { $this->rewind(); }
    return $this->fileGenerator->current();
  }

  public function key(): int
  {
    if (!$this->fileGenerator) { $this->rewind(); }
    return $this->fileGenerator->key();
  }

  public function next(): void
  {
    if (!$this->fileGenerator) { $this->rewind(); }
    $this->fileGenerator->next();
  }

  public function valid(): bool
  {
    if (!$this->fileGenerator) { $this->rewind(); }
    return $this->fileGenerator->valid();
  }

  public function seek($position)
  {
    while ($this->valid()) {
      if ($this->fileGenerator->key() == $position) {
        return;
      }
      $this->fileGenerator->next();
    }
    throw new \OutOfBoundsException("Invalid seek position ($position)");
  }

  private function openFile($path)
  {
    $handle = fopen($path, "r");

    while (!feof($handle)) {
        yield fgets($handle);
    }

    fclose($handle);
  }
}
