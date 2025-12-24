<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // Tambahkan ini
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase; // Dan gunakan ini di dalam class

    public function test_the_application_returns_a_successful_response(): void
    {
        // Jika halaman utama Anda memanggil table 'menu', 
        // RefreshDatabase akan membuatkan tabelnya terlebih dahulu.
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}