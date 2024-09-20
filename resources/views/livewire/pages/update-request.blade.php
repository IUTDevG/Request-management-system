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
                                <x-input id="title" placeholder="{{ __('Title your request') }}" wire:model="title"
                                         type="text"/>
                                <x-input-error for="title"/>
                            </div>

                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-textarea id="description" wire:model="description"
                                            placeholder="{{ __('Describe your request') }}"/>
                                <x-input-error for="description"/>
                            </div>

                            <x-select
                                label="{{ __('Branche') }}"
                                id="level"
                                name="level_id"
                                :options="$levels"
                                wire:model="level_id"
                                placeholder="{{ __('Select your branch') }}"
                            />
                            <x-input-error for="level_id"/>

                            <x-select
                                label="{{ __('Department') }}"
                                id="department"
                                name="department_id"
                                :options="$departments"
                                wire:model="department_id"
                                placeholder="{{ __('Select your department') }}"
                            />
                            <x-input-error for="department_id"/>

                            <div class="mb-3">
                                <x-label class="uppercase font-bold from-background" for="files" value="{{ __('Attached files') }}"/>
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
                                                <svg class="animate-spin size-7" wire:loading wire:target="markFileForRemoval({{$file['id']}})" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="none">
                                                    <path d="M18.001 20C16.3295 21.2558 14.2516 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 12.8634 21.8906 13.7011 21.6849 14.5003C21.4617 15.3673 20.5145 15.77 19.6699 15.4728C18.9519 15.2201 18.6221 14.3997 18.802 13.66C18.9314 13.1279 19 12.572 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C13.3197 19 14.554 18.6348 15.6076 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <h4>{{ __('Upload New Files') }}</h4>
                                    <x-file-upload-update wire:model="files" :is-multiple="true"/>
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
