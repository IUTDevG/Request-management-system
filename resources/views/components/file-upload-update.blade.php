@props(['multiple' => false])

<div
    wire:ignore
    x-data
    x-init="
        FilePond.setOptions({
            acceptedFileTypes: ['application/pdf','image/jpeg','image/png','image/jpg','image/webp','image/heic','image/heic-sequence'],
            allowMultiple: {{ $isMultiple ? 'true' : 'false' }},
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->wire('model')->value() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->wire('model')->value() }}', filename, load)
                },
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
        FilePond.create($refs.input)
    "
>
    <input type="file" x-ref="input" {{ $multiple ? 'multiple' : '' }} data-allow-reorder="true"
           data-max-file-size="1MB"
           data-max-files="3">
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
