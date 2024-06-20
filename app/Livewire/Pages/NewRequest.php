<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('livewire.layout.student'),Title('New request')]
class NewRequest extends Component
{
    use WithFileUploads;
    public $title;
    public $request_code;
    public $description;
    public $status;
    public $level_id;
    public $department_id;
    public $user_id;
    public $files=[];

    public function submitRequest()
    {
        $this->validate(rules: [
            'title' => 'required|string',
            'request_code' => 'required',
            'description' => 'required|file',
            'status' => 'required',
            'level_id' => 'required|in:levels,id',
            'department_id' => 'required|in:departments,id',
            'user_id' => 'required|in:users,id',
            'files' => 'required|file',
            'files.*' => 'required|file|mimes:png,jpg,pdf|max:4096',
        ]);
    }
    public function render()
    {
        return view('livewire.pages.new-request');
    }
}
