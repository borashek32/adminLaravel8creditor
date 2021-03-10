<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Posts extends Component
{
    public $title, $categories, $category, $category_id, $body, $post_id, $search;
    public $isOpen = 0;

    use WithPagination;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function dehydrate() {
        $this->emit('initializeCkEditor');
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $posts = Post::where('title', 'LIKE', $search)
            ->orWhere('body', 'LIKE', $search)
            ->latest()
            ->paginate(12);

        return view('admin.posts.posts', ['posts' => $posts])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->category_id      =      '';
        $this->title            =      '';
        $this->body             =      '';
        $this->post_id          =      '';
    }

    public function store()
    {
        $this->validate([
            'category_id'    =>    'required',
            'title'          =>    'required',
            'body'           =>    'required',
        ]);

        Post::updateOrCreate(
            ['id'             =>    $this->post_id],
            ['category_id'    =>    $this->category_id,
                'title'          =>    $this->title,
                'body'           =>    $this->body,
            ]);

        session()->flash('message',
            $this->post_id ? 'Пост успешно обновлен.' : 'Пост успешно создан.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post                   =     Post::findOrFail($id);
        $this->category_id      =     $post->category_id;
        $this->post_id          =     $id;
        $this->title            =     $post->title;
        $this->body             =     $post->body;
        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Пост успешно удален.');
    }
}
