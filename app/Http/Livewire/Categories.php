<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public $name, $category_id;
    public $isOpen = 0;

    public function render()
    {
        $categories  = Category::all();
        return view('admin.categories.cats', compact('categories'));
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

    private function resetInputFields(){
        $this->name = '';
    }

    public function store()
    {
        $this->validate([
            'name'   => 'required|max:30',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'name'    => $this->name,
        ]);

        session()->flash('message',
            $this->category_id ? 'Категория успешно обновлена.' : 'Категория успешно создана.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category             =    Category::findOrFail($id);
        $this->category_id    =    $id;
        $this->name           =    $category->name;
        $this->openModal();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Категория успешно удалена.');
    }
}
