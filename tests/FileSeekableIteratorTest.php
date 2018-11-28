<?php
declare(strict_types=1);

namespace kfreiman\FileIterator;

use PHPUnit\Framework\TestCase;

final class FileSeekableIteratorTest extends TestCase
{
  private $iterator;

  protected function setUp(): void
  {
    $file = __DIR__ . '/files/data.txt';
    $this->iterator = new FileSeekableIterator($file);
  }


  public function testSeekAndCheck(): void
  {
    $this->assertEquals(true, $this->iterator->valid());

    $this->iterator->seek(2);
    $this->assertEquals("16y3424ggg4\n", $this->iterator->current());
    $this->assertEquals(2, $this->iterator->key());
    $this->assertEquals(true, $this->iterator->valid());

    $this->iterator->rewind();
    $this->iterator->next();
    $this->assertEquals(1, $this->iterator->key());
    $this->assertEquals("a35aw36a677\n", $this->iterator->current());

    $this->iterator->seek(3);
    $this->assertEquals("r125316 1261326 43\n", $this->iterator->current());

    $this->iterator->next();
    $this->assertEquals(4, $this->iterator->key());
    $this->assertEquals(true, $this->iterator->valid());

    $this->iterator->next();
    $this->assertEquals(5, $this->iterator->key());
    $this->assertEquals("", $this->iterator->current());

    $this->iterator->next();
    $this->assertEquals(false, $this->iterator->valid());

    $this->iterator->rewind();
    $this->assertEquals("123frqw3aw\n", $this->iterator->current());
    $this->assertEquals(0, $this->iterator->key());
    $this->assertEquals(true, $this->iterator->valid());

  }

  public function testSeekInvalidPosition(): void
  {
    $this->expectException(\OutOfBoundsException::class);
    $this->iterator->seek(100);
  }


}
