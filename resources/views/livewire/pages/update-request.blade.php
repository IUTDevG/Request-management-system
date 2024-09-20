<div>
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
                                <x-input id="title" placeholder="{{ __('Title your request') }}" wire:model.live="title"
                                         type="text"/>
                                <x-input-error for="title"/>
                            </div>

                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-textarea id="description" wire:model.live="description"
                                            placeholder="{{ __('Describe your request') }}"/>
                                <x-input-error for="description"/>
                            </div>

                            <x-select
                                label="{{ __('Branche') }}"
                                id="level"
                                name="level_id"
                                :options="$levels"
                                wire:model.live="level_id"
                                placeholder="{{ __('Select your branch') }}"
                            />
                            <x-input-error for="level_id"/>

                            <x-select
                                label="{{ __('Department') }}"
                                id="department"
                                name="department_id"
                                :options="$departments"
                                wire:model.live="department_id"
                                placeholder="{{ __('Select your department') }}"
                            />
                            <x-input-error for="department_id"/>

                            <div class="mb-3">
                                <x-label class="uppercase font-bold from-background" for="files"
                                         value="{{ __('Attached files') }}"/>
                                <div class="mb-3">
                                    <h4>{{ __('Existing Files') }}</h4>
                                    @foreach($existingFiles as $file)
                                        <div class="flex items-center space-x-2 mb-2">
                                            <a href="{{ $file['url'] }}" target="_blank"
                                               class="text-green-600 hover:underline">
                                                {{ $file['name'] }}
                                            </a>
                                            <button type="button" wire:click="markFileForRemoval({{ $file['id'] }})"
                                                    class="text-red-600 hover:text-red-800">
                                                <span wire:loading.remove
                                                      wire:target="markFileForRemoval({{$file['id']}})"> {{ __('Remove') }}</span>
                                                <svg class="size-6 animate-spin" wire:loading
                                                     wire:target="markFileForRemoval({{$file['id']}})"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     aria-hidden="true">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <h4>{{ __('Upload New Files') }}</h4>
                                    <x-file-upload-update wire:model.live="files" :is-multiple="true"/>
                                </div>
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
