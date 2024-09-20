<?php

namespace App\Livewire\Pages;

use App\Models\SchoolRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('request number')]
class RequestDetails extends Component
{
    public ?string $request_code;
    public function mount(string $request_code):void{
        $this->request_code=$request_code;
    }
    public function render()
    {
        $request=SchoolRequest::query()->with('media')->where('request_code',$this->request_code)->first();
        if(!$request){
           abort(404,__('Request not found'));
        }
        return view('livewire.pages.request-details',[
            'requests'=>$request,
            'medias'=>$request->getMedia('school-request')
        ])->layout('livewire.layout.student');
    }
}
