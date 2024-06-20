@props(['isMultiple'])

<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-skin-base sm:pt-5">
    <div class="mt-1 sm:mt-0 sm:col-span-2">
        <div
            class="w-full max-w-lg  dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <input wire:ignore type="file" x-ref="input" name="avatar" data-max-file-size="3MB"/>
        </div>
    </div>
</div>
