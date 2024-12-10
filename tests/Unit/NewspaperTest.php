<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Newspaper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class NewspaperTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_newspaper()
    {
        // Arrange
        $data = [
            'title' => 'Sample Newspaper',
            'publisher' => 'Kompas',
            'publication_date' => '2021-01-01'
        ];

        // Act
        $newspaper = Newspaper::create($data);

        // Assert
        $this->assertInstanceOf(Newspaper::class, $newspaper);
        $this->assertEquals('Sample Newspaper', $newspaper->title);
        $this->assertEquals('Kompas', $newspaper->publisher);
        $this->assertEquals('2021-01-01', $newspaper->publication_date);
    }
}
