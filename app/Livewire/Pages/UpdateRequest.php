<?php

namespace App\Livewire\Pages;

use App\Enums\SchoolRequestStatus;
use App\Models\Department;
use App\Models\Level;
use App\Models\SchoolRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function mount($collection = 'school-request',$id=null)
    {
        $this->id = $id;
        $this->collection= $collection;
        if ($id){

        $request = SchoolRequest::findOrFail($this->id);
        $this->id = $request->id;
        $this->title = $request->title;
        $this->description = $request->description;
        $this->level_id = $request->level_id;
        $this->department_id = $request->department_id;
            $this->existingFiles = $request->getMedia('school-request')->map(function ($media) {
                return [
                    'source' => $media->id,
                    'options' => [
                        'type' => 'local',
                        'file' => [
                            'name' => $media->file_name,
                            'size' => $media->size,
                            'type' => $media->mime_type,
                        ],
                        'metadata' => [
                            'poster' => $media->getUrl(),
                        ],
                    ],
                ];
            })->toArray();
        }
        Log::info('Existing files initialized', ['existingFiles' => $this->existingFiles]);
    }
    public function getMediaUrl($mediaId)
    {
        $media = $this->getMedia($this->collection)->firstWhere('id', $mediaId);
        return $media ? $media->getUrl() : null;
    }

    public function removeExistingFile($fileId)
    {
        $schoolRequest = SchoolRequest::findOrFail($this->id);
        $media = $schoolRequest->getMedia($this->collection)->where('id', $fileId)->first();
        if ($media) {
            $media->delete();
            $this->existingFiles = array_filter($this->existingFiles, function ($file) use ($fileId) {
                return $file['source'] !== $fileId;
            });
            $this->dispatch('fileRemoved', $fileId);
        }
    }

//    public function refreshExistingFiles()
//    {
//        $schoolRequest = SchoolRequest::findOrFail($this->id);
//        $this->existingFiles = $schoolRequest->getMedia('school-request')->map(function ($file) {
//            return [
//                'source' => $file->id,
//                'options' => [
//                    'type' => 'local',
//                    'file' => [
//                        'name' => $file->file_name,
//                        'size' => $file->size,
//                        'type' => $file->mime_type,
//                    ],
//                    'metadata' => [
//                        'id' => $file->id,
//                        'url' => $file->getFullUrl(),
//                    ],
//                ],
//            ];
//        })->toArray();
//
//        Log::info('Existing files refreshed', ['existingFiles' => $this->existingFiles]);
//    }



    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level_id' => 'required|exists:levels,id',
            'department_id' => 'required|exists:departments,id',
            'files' => 'array',
            'files.*' => 'file|mimes:png,jpg,jpeg,pdf|max:1024',
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => __('title'),
            'level_id' => __('level'),
            'files' => __('files'),
            'department_id' => __('department'),
        ];
    }

    public function updateRequest()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            $request = SchoolRequest::findOrFail($this->id);
            $request->title = $this->title;
            $request->description = $this->description;
            $request->status = SchoolRequestStatus::Draft;
            $request->level_id = $this->level_id;
            $request->department_id = $this->department_id;
            $request->save();

            // Récupérer les fichiers actuels associés à la demande
            $currentFiles = $request->getMedia('school-request')->pluck('id')->toArray();
            Log::info('Current files', ['currentFiles' => $currentFiles]);

            // Identifier les fichiers à supprimer
            $filesToDelete = [];
            foreach ($currentFiles as $fileId) {
                if (!in_array($fileId, $this->getExistingFileIds())) {
                    $filesToDelete[] = $fileId;
                }
            }
            Log::info('Files to delete', ['filesToDelete' => $filesToDelete]);

            // Supprimer les fichiers à supprimer
            foreach ($filesToDelete as $fileToDelete) {
                $mediaItem = $request->getMedia('school-request')->firstWhere('id', $fileToDelete);
                if ($mediaItem) {
                    $mediaItem->delete();
                }
            }

            // Ajouter les nouveaux fichiers
            foreach ($this->files as $file) {
                $request->addMedia($file)
                    ->preservingOriginal()
                    ->toMediaCollection('school-request');
            }

            DB::commit();
            return redirect()->route('student.home')->with('status', 'Demande soumise avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Une erreur est survenue lors de la soumission de la demande: ' . $e->getMessage());
        }
    }

    protected function getExistingFileIds()
    {
        return collect($this->existingFiles)->pluck('id')->toArray();
    }






    public function render()
    {
        $schoolRequest = SchoolRequest::query()->findOrFail($this->id);
        return view('livewire.pages.update-request', [
            'levels' => Level::all(),
            'departments' => Department::all(),
            'existingFiles' => $this->existingFiles,
        ]);
    }
}
