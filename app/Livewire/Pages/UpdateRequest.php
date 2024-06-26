<?php

namespace App\Livewire\Pages;

use App\Enums\SchoolRequestStatus;
use App\Models\Department;
use App\Models\Level;
use App\Models\SchoolRequest;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Update request'), Layout('livewire.layout.student')]
class UpdateRequest extends Component
{
    use WithFileUploads;

    public $id;
    public $title;
    public $description;
    public $level_id;
    public $department_id;
    public $files = [];
    public $existingFiles = [];
    public $collection = 'school-request';
    public $filesToRemove = [];
    public ?int $filesTotal = 3;

    public function mount($id = null)
    {
        $this->id = $id;
        if ($id) {
            $request = SchoolRequest::findOrFail($this->id);
            $this->id = $request->id;
            $this->title = $request->title;
            $this->description = $request->description;
            $this->level_id = $request->level_id;
            $this->department_id = $request->department_id;
            $this->existingFiles = $request->getMedia('school-request')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'name' => $media->file_name,
                    'url' => $media->getUrl(),
                    'size' => $media->size,
                    'type' => $media->mime_type,
                ];
            })->toArray();
        }
    }

    public function markFileForRemoval($fileId)
    {
        $this->filesToRemove[] = $fileId;
        $this->existingFiles = array_filter($this->existingFiles, function ($file) use ($fileId) {
            return $file['id'] !== $fileId;
        });
    }

    public function updateRequest()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level_id' => 'required|exists:levels,id',
            'department_id' => 'required|exists:departments,id',
            'files' => 'array|max:3',
            'files.*' => 'file|mimes:png,jpg,jpeg,pdf|max:1024',
        ]);

        $totalFiles = count($this->files) + count($this->existingFiles);
        if ($totalFiles === 0 || $totalFiles > $this->filesTotal) {
            $this->addError('files', 'Le nombre total de fichiers doit être entre 1 et 3.');
            return;
        }

        try {
            DB::beginTransaction();
            $request = SchoolRequest::findOrFail($this->id);
            $request->update([
                'title' => $this->title,
                'description' => $this->description,
                'status' => SchoolRequestStatus::Submitted,
                'level_id' => $this->level_id,
                'department_id' => $this->department_id,
            ]);

            // Remove files marked for deletion
            foreach ($this->filesToRemove as $fileId) {
                $media = $request->getMedia('school-request')->where('id', $fileId)->first();
                if ($media) {
                    $media->delete();
                }
            }

            // Add new files
            foreach ($this->files as $file) {
                $request->addMedia($file->getRealPath())
                    ->usingName($file->getClientOriginalName())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('school-request');
            }

            DB::commit();
            return redirect()->route('student.home')->with('status', 'Demande mise à jour avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Une erreur est survenue lors de la mise à jour de la demande: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.update-request', [
            'levels' => Level::all(),
            'departments' => Department::all(),
        ]);
    }
}
