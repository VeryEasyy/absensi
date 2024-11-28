<?php

namespace Tests\Feature;

use App\Http\Controllers\AbsensiController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AbsensiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_absensi_masuk()
    {
        // Create a mock Karyawan (employee)
        $user = Karyawan::factory()->create([
            'nuptk' => '12345', // Example NUPTK
        ]);

        // Simulate authentication
        $this->actingAs($user, 'karyawan');

        // Prepare the request data (you can adjust the location and image as needed)
        $lokasi = '-6.1824092443393175,106.58873583071211'; // Example coordinates
        $image = 'data:image/png;base64,' . base64_encode(file_get_contents('path/to/test_image.png')); // Example base64 image

        // Mock the Storage facade to avoid actual file storage
        Storage::fake('public');

        // Send the POST request
        $response = $this->post('/absensi/masuk', [
            'lokasi' => $lokasi,
            'image' => $image,
        ]);

        // Assert the response is successful and contains expected success message
        $response->assertStatus(200);
        $response->assertSee('Absen Masuk Telah Berhasil');

        // Check if the image file was "stored" in the mock storage
        $expectedFilePath = 'uploads/absensi/12345-' . date('Y-m-d') . '-masuk.png';
        Storage::disk('public')->assertFileExists($expectedFilePath);

        // Optionally, check the database for the inserted record
        $this->assertDatabaseHas('presensis', [
            'nuptk_absen' => '12345',
            'tgl_presensi' => date('Y-m-d'),
        ]);
    }
}
