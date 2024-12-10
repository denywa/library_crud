<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Cd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CdTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_cd()
    {
        // Arrange
        $data = [
            'title' => 'Sample CD',
            'artist' => 'Jane Doe',
            'release_year' => 2020
        ];

        // Act
        $cd = Cd::create($data);

        // Assert
        $this->assertInstanceOf(Cd::class, $cd);
        $this->assertEquals('Sample CD', $cd->title);
        $this->assertEquals('Jane Doe', $cd->artist);
        $this->assertEquals(2020, $cd->release_year);
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
