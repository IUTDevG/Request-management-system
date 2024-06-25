<div>
    {{--    @dd($schoolRequest->title)--}}
    <div class="transition-all duration-200 lg:ml-64 ml-0 mt-20 min-h-[calc(100vh-80px)]">
        <section class="">
            <div class="container mx-auto">
                <div class="p-6 rounded-lg shadow-front-2">
                    <x-form-section class="lg:grid gap-7" submit="updateRequest">
                        <x-slot name="title">
                            {{ __('Request informations') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Information about your request') }}
                        </x-slot>

                        <x-slot:form>

                            <div class="mb-3">
                                <x-label for="title" value="{{ __('Title') }}"/>
                                <x-input id="title" placeholder="{!! __('Title your request') !!}" wire="title"
                                         type="text"/>
{{--                                @dd($schoolRequest)--}}
                                <x-input-error for="title"/>
                            </div>

                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-textarea id="description" wire="description"
                                            placeholder="{!! __('Describe your request') !!}"/>
                                <x-input-error for="description"/>
                            </div>

                            <x-select
                                label="{{ __('Branche') }}"
                                id="level"
                                name="level_id"
                                :options="$levels"
                                wire="level_id"
                                placeholder="{{ __('Select your branch') }}"
                            />
                            <x-input-error for="level_id"/>

                            <x-select
                                label="{{ __('Department') }}"
                                id="department"
                                name="department_id"
                                :options="$departments"
                                wire="department_id"
                                placeholder="{{ __('Select your department') }}"
                            />
                            <x-input-error for="department_id"/>
                            <div class="mb-3">
                                <x-label for="files" value="{{ __('Attached files') }}"/>
{{--                                @dd($existingFiles)--}}
                                <x-file-upload-update  wire:model="files"
                                                       :existingFiles="$existingFiles"
                                                       :isMultiple="true"
                                                       accept="application/pdf,image/jpg,image/png,image/jpeg" />
                                <x-input-error for="files"/>
                            </div>
                        </x-slot:form>

                        <x-slot:actions>
                            <div class="flex flex-col sm:flex-row items-center w-full">
                                <x-button type="submit" class="bg-success-600">
                                    {{ __('Submit') }}
                                </x-button>
                            </div>

                            @if (session('error'))
                                <div class="text-red-500">
                                    {{ session('error') }}
                                </div>
                            @endif

                        </x-slot:actions>
                    </x-form-section>
                </div>
            </div>
        </section>
    </div>
</div>
