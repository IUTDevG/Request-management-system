<?php

namespace App\Livewire;

use App\Enums\SchoolRequestStatus;
use App\Models\SchoolRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Accueil'), Layout('livewire.layout.student')]
class StudentDashboard extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public $searchTerm = '';

    #[Url(as: 'sort', history: true)]
    public $sortColumn = 'created_at';

    #[Url(as: 'direction', history: true)]
    public $sortDirection = 'desc';

    #[Url(as: 'filter', history: true)]
    public $selectedFilter = '';
    public $showCancelModal = false;
    public $requestIdToCancel;

    public function updatingSearchTerm($value): void
    {
        $this->resetPage();
    }

    public function closeModal(): void
    {
        $this->showCancelModal = false;
        $this->requestIdToCancel = null;
        $this->dispatch('modalClosed');
        $this->js('window.location.reload()');
    }

    #[On('modalClosed')]
    public function onModalClosed(): void
    {
        $this->js("setTimeout(()=>window.location.reload(),100)");
    }

    public function getDelayedSearchTermProperty()
    {
        return $this->searchTerm;
    }

    public function sortBy($column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function setFilter($filter): void
    {
        $this->selectedFilter = $filter;
        $this->resetPage();
    }

    public function getFilterOptions(): array
    {
        $options = [
            ['value' => '', 'label' => __('View all')]
        ];

        foreach (SchoolRequestStatus::cases() as $status) {
            $options[] = [
                'value' => $status->value,
                'label' => $status->label()
            ];
        }

        return $options;
    }

    public function openCancelModal($id): void
    {
        $this->requestIdToCancel = $id;
        $this->showCancelModal = true;
    }

    public function confirmCancelRequest(): \Illuminate\Http\RedirectResponse
    {
        $request = SchoolRequest::query()->findOrFail($this->requestIdToCancel);
        $request->status = SchoolRequestStatus::Cancelled;
        $request->update();
        $this->showCancelModal = false;
        $this->dispatch('requestCancelled');
        return back()->with('status', __('Status successfully changed.'));
    }

    public function updateStatus($id)
    {
        dd($id);
    }

    public function render()
    {
        $requests = SchoolRequest::query()->where('user_id', '=', auth()->user()->id)
            ->when($this->selectedFilter, function ($query) {
                return $query->where('status', $this->selectedFilter);
            })
            ->when($this->getDelayedSearchTermProperty(), function ($query, $search) {
                return $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->orderBy($this->sortColumn, $this->sortDirection);

        return view('livewire.student-dashboard', [
            'requests' => $requests->paginate(4),
            'filterOptions' => $this->getFilterOptions(),
        ]);
    }
}
