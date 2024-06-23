<?php

namespace App\Livewire\Pages;

use App\Models\SchoolRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('request number')]
class RequestDetails extends Component
{
    public ?int $id;
    public function mount(int $id):void{
        $this->id=$id;
    }
    public function render()
    {
        $request=SchoolRequest::with('media')->findOrFail($this->id);
        return view('livewire.pages.request-details',[
            'requests'=>$request,
            'medias'=>$request->getMedia('school-request')
        ])->layout('livewire.layout.student');
    }
}
