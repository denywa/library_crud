<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Journal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;


class JournalTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_journal()
    {
        // Arrange
        $data = [
            'title' => 'Sample Journal',
            'author' => 'Jane Doe',
            'publisher' => 'Sample Publisher',
            'publication_year' => 2021
        ];

        // Act
        $journal = Journal::create($data);

        // Assert
        $this->assertInstanceOf(Journal::class, $journal);
        $this->assertEquals('Sample Journal', $journal->title);
        $this->assertEquals('Jane Doe', $journal->author);
        $this->assertEquals('Sample Publisher', $journal->publisher);
        $this->assertEquals(2021, $journal->publication_year);
    }
}
