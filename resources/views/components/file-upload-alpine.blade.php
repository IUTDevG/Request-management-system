@props(['isMultiple'])

<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-skin-base sm:pt-5">
    <div class="mt-1 sm:mt-0 sm:col-span-2">
        <div
            wire:ignore
            x-data
            x-init="

            FilePond.setOptions({
            credits:false,
{{--            ...fr,--}}
            acceptedFileTypes:['image/*','application/pdf'],
            allowMultiple:true,
             labelIdle: `{{__('Drag & Drop your file or')}} <span class='filepond--label-action'>{{__('Browse')}}</span>`,
                server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer,options)=>{
                @this.upload('{{$attributes['wire:model']}}',file,load,error,progress)
                },
                revert: (fileName,load)=>{
                @this.removeUpload('{{$attributes['wire:model']}}',fileName,load)
                },
                },
            });

            FilePond.create($refs.input);
            "
            class="w-full max-w-lg  dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <input type="file" x-ref="input" name="avatar"  data-allow-reorder="true" data-max-file-size="3MB"/>
        </div>
    </div>
</div>

@push('styles')
    @vite('resources/css/utils/filepond.css')
@endpush

@push('scripts')
    @vite('resources/js/utils/filepond.js')
@endpush
