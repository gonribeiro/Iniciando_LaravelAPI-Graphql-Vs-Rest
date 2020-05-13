<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_exibe_todos_os_clientes()
    {
        $this->seed(['ClienteSeeder']);

        $response = $this->get('/api/v1/cliente');

        $response->assertStatus(200);
    }

    public function test_exibe_um_cliente()
    {
        $this->seed(['ClienteSeeder']);

        $response = $this->get('/api/v1/cliente/1');

        $response->assertStatus(200);
    }
    
    public function test_cria_cliente()
    {
        $this->seed(['ClienteSeeder']);

        $response = $this->json('POST', '/api/v1/cliente',
        [
            'nome'  => 'Fulano de Tal',
            'documento'  => '230.378.616-90',
            'nascimento' => '2004-10-25',
        ]);

        $response->assertStatus(201);
    }

    public function test_atualiza_cliente()
    {
        $this->seed(['ClienteSeeder']);

        $response = $this->json('PUT', '/api/v1/cliente/1',
        [
            'nome'  => 'Fulano de Tal Atualizado',
            'documento'  => '555.378.616-90',
            'nascimento' => '2019-10-25',
        ]);

        $response->assertStatus(200);
    }

    public function test_desabilita_cliente()
    {
        $this->seed(['ClienteSeeder']);

        $response = $this->json('DELETE', '/api/v1/cliente/1');

        $response->assertStatus(204);
    }

    public function test_restaura_cliente_desabilitado()
    {
        $this->seed(['ClienteSeeder']);

        $response = $this->json('PUT', '/api/v1/cliente/restore/1');

        $response->assertStatus(200);
    }
}
