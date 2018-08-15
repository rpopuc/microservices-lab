<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * @testdox API de gerência de usuários
 * @group api
 * @group usuarios
 * @group users
 */
class UserApiTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @group inclusao
     */
    public function inclui_usuario()
    {
        $response = $this->call('POST', '/v1/user', [
            'name' => 'Teste',
            'email' => 'test@example.com',
            'password' => 'teste',
        ]);
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('users', ['email' => 'test@example.com']);
    }

    /**
     * @test
     * @group obtencao
     */
    public function obtem_usuario()
    {
        $user = \App\User::make([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
        ]);
        $user->password = 'teste';
        $user->save();

        $response = $this->call('GET', '/v1/user/' . $user->id);
        $this->assertEquals(200, $response->status());
        $this->seeJson([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * @test
     * @group listagem
     */
    public function obtem_usuarios()
    {
        $userA = \App\User::make([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
        ]);
        $userA->password = 'teste';
        $userA->save();

        $userB = \App\User::make([
            'name' => 'TesteB',
            'email' => 'teste_b@teste.com',
        ]);
        $userB->password = 'testeb';
        $userB->save();
        $response = $this->call('GET', '/v1/user');

        $this->assertEquals(200, $response->status());
        $this->seeJson([
            'name' => $userA->name,
            'email' => $userA->email,
        ]);

        $this->seeJson([
            'name' => $userB->name,
            'email' => $userB->email,
        ]);
    }

    /**
     * @test
     * @group exclusao
     */
    public function exclui_usuario()
    {
        $userA = \App\User::make([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
        ]);
        $userA->password = 'teste';
        $userA->save();

        $userB = \App\User::make([
            'name' => 'TesteB',
            'email' => 'teste_b@teste.com',
        ]);
        $userB->password = 'testeb';
        $userB->save();

        $response = $this->call('DELETE', "/v1/user/{$userA->id}");
        $this->assertEquals(200, $response->status());

        $this->notSeeInDatabase('users', ['email' => $userA->email]);
        $this->seeInDatabase('users', ['email' => $userB->email]);
    }
}
