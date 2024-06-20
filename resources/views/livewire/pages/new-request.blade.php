<div>
    <div class="transition-all duration-200 lg:ml-64 ml-0 mt-20 min-h-[calc(100vh-80px)]">
        <section class="">
            <div class="container mx-auto">
                <div class="p-6 rounded-lg shadow-front-2">
                    <x-form-section class="lg:grid gap-7" submit="submitRequest">
                        <x-slot name="title">
                            {{ __('Request informations') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Ces informations sont modifiables par l\'administration.') }}
                        </x-slot>
                        <x-slot:form>
                            <input type="hidden" wire:model="user_id" value="{{auth()->user()->id}}"/>
                            <div class="mb-3">
                                <x-label value="{{__('Title')}}"/>
                                <x-input wire:model="name" type="text" wire:model="title"/>
                                <x-input-error for="title"/>
                            </div>
                            <div class="mb-3">
                                <x-label value="{{__('Description')}}"/>
                                <x-input wire:model="first_name" type="text" wire:model="description"/>
                                <x-input-error for="description"/>
                            </div>
                            <div class="mb-3">
                                <x-label value="{{__('Files')}}"/>
                                <x-file-upload-alpine wire:model="files"/>
                                <x-input-error for="files"/>
                            </div>
                        </x-slot:form>
                        <x-slot:actions class="flex flex-row items-center col-span-2 text-nowrap">
                            <x-flash-message class="mr-3" on="saved">{{__('Saved.')}}</x-flash-message>
                            <x-button type="submit">
                                {{ __('Submit')}}
                            </x-button>

                        </x-slot:actions>
                    </x-form-section>
                </div>
            </div>
        </section>
    </div>
</div>
