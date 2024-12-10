<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class BookTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_book()
    {
        // Arrange
        $data = [
            'title' => 'Sample Book',
            'author' => 'John Doe',
            'publisher' => 'Sample Publisher',
            'publication_year' => 2021,
            'type' => 'physical'
        ];

        // Act
        $book = Book::create($data);

        // Assert
        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals('Sample Book', $book->title);
        $this->assertEquals('John Doe', $book->author);
        $this->assertEquals('Sample Publisher', $book->publisher);
        $this->assertEquals(2021, $book->publication_year);
        $this->assertEquals('physical', $book->type);
    }
}
