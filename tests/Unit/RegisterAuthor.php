<?php

namespace Tests\Unit;

/* use PHPUnit\Framework\TestCase; */

use Tests\TestCase;

class RegisterAuthor extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        // Realizar la solicitud POST al endpoint de registro
        $response = $this->post('/author/store', $userData);

        // Verificar que la respuesta sea exitosa (código 200)

        $response->assertSee('');
        $response->assertStatus(200);

        // Verificar que el usuario se haya creado en la base de datos
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }
}
