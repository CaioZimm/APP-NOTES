<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Notes\CreateNote;
use App\Livewire\Notes\EditNote;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_notes_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/notes');
        
        $response->assertStatus(200);
    }

    public function test_user_can_create_a_note()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateNote::class)
            ->set('title', 'My New Note')
            ->set('description', 'Content of the note')
            ->set('date', '2023-10-10')
            ->call('save')
            ->assertRedirect('/notes');

        $this->assertDatabaseHas('notes', [
            'title' => 'My New Note',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_a_note()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(EditNote::class, ['note' => $note])
            ->set('title', 'Updated Title')
            ->call('update')
            ->assertRedirect('/notes');

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_user_cannot_update_another_users_note()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $note = Note::factory()->create(['user_id' => $user1->id]);

        Livewire::actingAs($user2)
            ->test(EditNote::class, ['note' => $note])
            ->assertForbidden();
    }
}

