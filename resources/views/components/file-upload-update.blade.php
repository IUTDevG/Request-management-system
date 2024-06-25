@props(['isMultiple' => true, 'accept' => 'application/pdf,image/jpeg,image/png,image/jpg,image/webp,image-heic,image-heic-sequence'])

<div class="mt-1 sm:mt-0">
    <div
        wire:ignore
        x-data="{
            existingFiles: @entangle('existingFiles'),
            pond: null,
            init() {
                FilePond.setOptions({
                    credits: false,
                    acceptedFileTypes: ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image-heic', 'image-heic-sequence'],
                    allowMultiple: {{ $isMultiple ? 'true' : 'false' }},
                    files: this.existingFiles.map(file => ({
                        source: file.id,
                        options: {
                            type: 'local',
                            file: {
                                name: file.options.file.name,
                                size: file.options.file.size,
                                type: file.options.file.type,
                            },
                            metadata: {
                                poster: file.poster
                            },
                        },
                    })),
                    server: {
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress);
                        },
                        revert: (filename, load) => {
                            const file = this.existingFiles.find(file => file.options.file.name === filename);
                            if (file) {
                                const fileId = file.id;
                                @this.call('removeExistingFile', fileId).then(() => {
                                    load();
                                    // Rafraîchir existingFiles après la suppression
                                    this.existingFiles = this.existingFiles.filter(f => f.id !== fileId);
                                });
                            }
                        },
                    },
                     labelIdle: `{{ __('Drag & Drop your file or') }} <span class='filepond--label-action'>{{ __('Browse') }}</span>`,
                    labelFileProcessing: `{{ __('File processing') }}`,
                    labelFileProcessingComplete: `{{ __('File processing complete') }}`,
                    labelTapToUndo: `{{ __('Tap to undo') }}`,
                    labelTapToCancel: `{{ __('Tap to cancel') }}`,
                    labelFileWaitingForSize: `{{ __('Waiting for size') }}`,
                    labelFileSizeNotAvailable: `{{ __('File size not available') }}`,
                    labelFileLoading: `{{ __('File loading') }}`,
                    labelFileLoadError: `{{ __('File load error') }}`,
                    labelFileProcessingAborted: `{{ __('File processing aborted') }}`,
                    labelFileProcessingError: `{{ __('File processing error') }}`,
                    labelFileProcessingRevertError: `{{ __('File processing revert error') }}`,
                    labelFileRemoveError: `{{ __('File remove error') }}`,
                    labelTapToRetry: `{{ __('Tap to retry') }}`,
                    labelButtonRemoveItem: `{{ __('Remove') }}`,
                    labelButtonAbortItemLoad: `{{ __('Abort load') }}`,
                    labelButtonRetryItemLoad: `{{ __('Retry load') }}`,
                    labelButtonAbortItemProcessing: `{{ __('Abort processing') }}`,
                    labelButtonUndoItemProcessing: `{{ __('Undo processing') }}`,
                    labelButtonRetryItemProcessing: `{{ __('Retry processing') }}`,
                    labelButtonProcessItem: `{{ __('Process') }}`,
                });

                this.pond = FilePond.create($refs.input);
            }
        }"
        x-init="() => { setTimeout(() => init(), 0) }"
        class="w-full max-w-lg dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
    >
        <input
            type="file"
            x-ref="input"
            accept="{{ $accept }}"
            {{ $isMultiple ? 'multiple' : '' }}
            data-allow-reorder="true"
            data-max-files="3"
            data-max-file-size="1MB"
        />
    </div>
</div>

@push('styles')
    @vite('resources/css/utils/filepond.css')
@endpush

@push('scripts')
    @vite('resources/js/utils/filepond.js')
@endpush
