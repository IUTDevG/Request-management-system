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

                            <div class="mb-3">
                                <x-label for="title" value="{{ __('Title') }}"/>
                                <x-input id="title" wire="title" type="text"/>
                                <x-input-error for="title"/>
                            </div>

                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-textarea id="description" wire="description"/>
                                <x-input-error for="description"/>
                            </div>

                            <x-select
                                label="{{ __('Filière') }}"
                                id="level"
                                name="level_id"
                                :options="$levels"
                                wire="level_id"
                                placeholder="{{ __('Sélectionnez votre filière') }}"
                            />
                            <x-input-error for="level_id"/>

                            <x-select
                                label="{{ __('Department') }}"
                                id="department"
                                name="department_id"
                                :options="$departments"
                                wire="department_id"
                                placeholder="{{ __('Sélectionnez votre département') }}"
                            />
                            <x-input-error for="department_id"/>
                            <div class="mb-3">
                                <x-label for="files" value="{{ __('Files') }}"/>
                                <x-file-upload-alpine wire:model="files" multiple/>
                                <x-input-error for="files"/>
                            </div>
                        </x-slot:form>

                        <x-slot:actions>
                            <div class="flex flex-col sm:flex-row items-center w-full">
                                <x-button type="submit">
                                    {{ __('Submit') }}
                                </x-button>
                                <x-button type="button" wire:click="DraftRequest">
                                    {!! __('Brouillon') !!}
                                </x-button>
                            </div>
                            @if (session('status'))
                                <x-flash-message class="mt-3" on="submit">

                                    <div class="text-green-500">
                                        {{ session('status') }}
                                    </div>
                                </x-flash-message>
                            @endif

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
