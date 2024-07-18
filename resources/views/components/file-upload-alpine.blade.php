@props(['isMultiple'])

<div class="mt-1 sm:mt-0">
    <div
        wire:ignore
        x-data
        x-init="
        FilePond.setOptions({
            credits: false,
            acceptedFileTypes: ['application/pdf','image/jpeg','image/png','image/jpg','image/webp','image/heic','image/heic-sequence'],
            allowMultiple: {{ $isMultiple ? 'true' : 'false' }},
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (fileName, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', fileName, load)
                },
                remove: (source, load, error) => {
                    @this.call('removeExistingFile', source)
                    load()
                },
                load: (source, load, error, progress, abort, headers) => {
                    fetch(source.options.metadata.poster)
                        .then(response => response.blob())
                        .then(blob => load(blob))
                        .catch(error);
                }
            },
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
             labelIdle: `{{__('Drag & Drop your file or')}} <span class='filepond--label-action'>{{__('Browse')}}</span>`,
            });

           const pond = FilePond.create($refs.input);

        $wire.on('fileRemoved', fileId => {
            const file = pond.getFiles().find(f => f.source === fileId);
            if (file) {
                pond.removeFile(file);
            }
        });
        "
        class="w-full max-w-lg dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
    >
        <input x-ref="input"
               type="file"
               name="{{ $attributes['wire:model'] }}"
               {{ $isMultiple ? 'multiple' : '' }}
               data-allow-reorder="true" data-max-files="3" data-max-file-size="1MB"
        />
    </div>
</div>

@push('styles')
    @vite('resources/css/utils/filepond.css')
    <link rel="stylesheet" href="{{asset('build/assets/filepond-B2.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/filepond.css')}}"
@endpush

@push('scripts')
    @vite('resources/js/utils/filepond.js')
    <script src="{{asset('build/assets/filepond-D.js')}}"></script>
@endpush
