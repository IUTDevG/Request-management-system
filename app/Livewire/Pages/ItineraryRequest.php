<?php

namespace App\Livewire\Pages;

use App\Models\SchoolRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

#[Title('Itinerary Request'), Layout('livewire.layout.student')]
class ItineraryRequest extends Component
{
    public ?string $request_code;
    public ?SchoolRequest $request;
    public $activities;

    public function mount()
    {
        $this->request = $this->getRequestId($this->request_code);
        $this->activities = $this->getActivityForRequest();
    }

    private function getRequestId($request_code)
    {
        return SchoolRequest::where('request_code', $request_code)->first();
    }

    public function getActivityForRequest()
    {
        $activity = Activity::where('subject_id', $this->request->id);
        return $activity->get();
    }

    public function render()
    {
        return view('livewire.pages.itinerary-request');
    }
}
