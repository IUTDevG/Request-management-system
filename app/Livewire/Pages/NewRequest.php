<?php

namespace App\Livewire\Pages;

use App\Enums\SchoolRequestStatus;
use App\Models\Department;
use App\Models\Level;
use App\Models\SchoolRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

#[Layout('livewire.layout.student'), Title('New request')]
class NewRequest extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $level_id;
    public $department_id;
    public $files = [];

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level_id' => 'required|exists:levels,id',
            'department_id' => 'required|exists:departments,id',
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => __('title'),
            'level_id'=>__('level'),
            'files'=>__('files'),
            'department_id'=>__('department'),
        ];
    }

    public function submitRequest()
    {

        $this->validate();

        Log::info('Validation passée avec succès');
        try {
            DB::beginTransaction();
            Log::info('Transaction commencée');
            $request = SchoolRequest::create([
                'title' => $this->title,
                'description' => $this->description,
                'status' => SchoolRequestStatus::Submitted,
                'level_id' => $this->level_id,
                'department_id' => $this->department_id,
                'user_id' => auth()->user()->id,
            ]);
            Log::info('SchoolRequest créé', ['id' => $request->id]);

            foreach ($this->files as $file) {
                $request->addMedia($file)
                    ->preservingOriginal()
                    ->toMediaCollection('school-request');
            }
            Log::info('Tous les fichiers traités');


            DB::commit();
            Log::info('Transaction validée');
            $this->reset();
            return redirect()->route('student.home')->with('status', 'Demande soumise avec succès');
        } catch (\Exception $e) {
            DB::rollBack();

            if (method_exists($e, 'errors')) {
                Log::error('Erreurs de validation:', $e->errors());
            }

            Log::error('Exception détaillée:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Une erreur est survenue lors de la soumission de la demande' . $e->getMessage());
            Log::error('Erreur lors de la soumission de la demande scolaire: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.new-request',
            [
                'levels' => Level::all(),
                'departments' => Department::all()]);
    }
}
