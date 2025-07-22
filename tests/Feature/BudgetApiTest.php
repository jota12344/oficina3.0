use App\Models\Budget;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// INDEX
it('retorna todos os orçamentos (index)', function () {
    $this->actingAs(\App\Models\User::factory()->create());

    Budget::factory()->count(3)->create();

    $response = $this->getJson('/api/budgets');

    $response->assertStatus(200)
             ->assertJsonStructure(['data' => [['id', 'client', 'budget_datetime', 'estimated_value', 'seller']]]);
});

// STORE
it('cria um novo orçamento com dados válidos', function () {
    $this->actingAs(\App\Models\User::factory()->create());

    $data = [
        'client' => 'João da Silva',
        'budget_datetime' => now()->format('Y-m-d H:i'),
        'estimated_value' => 1500,
        'seller' => 'Lucas',
    ];

    $response = $this->postJson('/api/budgets', $data);

    $response->assertStatus(201)
             ->assertJsonFragment(['client' => 'João da Silva']);

    $this->assertDatabaseHas('budgets', ['client' => 'João da Silva']);
});

// UPDATE
it('atualiza um orçamento existente', function () {
    $this->actingAs(\App\Models\User::factory()->create());

    $budget = Budget::factory()->create();
    $data = ['client' => 'Novo Nome'];

    $response = $this->putJson("/api/budgets/{$budget->id}", $data);

    $response->assertStatus(200)
             ->assertJsonFragment(['client' => 'Novo Nome']);

    $this->assertDatabaseHas('budgets', ['id' => $budget->id, 'client' => 'Novo Nome']);
});

// DELETE
it('deleta um orçamento', function () {
    $this->actingAs(\App\Models\User::factory()->create());

    $budget = Budget::factory()->create();

    $response = $this->deleteJson("/api/budgets/{$budget->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('budgets', ['id' => $budget->id]);
});
