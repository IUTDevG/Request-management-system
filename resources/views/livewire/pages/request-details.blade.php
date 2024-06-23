<div>
    {{--    @dd($requests->title)--}}
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
                                <x-input disabled id="title" :value="$requests->title" type="text"/>
                            </div>

                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-textarea disabled>
                                    {!! $requests->description !!}
                                </x-textarea>
                            </div>
                            {{--                            @dd($requests->levels->name)--}}
                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Branche') }}"/>
                                <x-input disabled
                                         label="{{ __('Filière') }}" :value="$requests->levels->name"
                                />
                            </div>
                            <div class="mb-3">
                                <x-label for="description" value="{{ __('Department') }}"/>
                                <x-input
                                    label="{{ __('Department') }}" disabled
                                    id="department" :value="$requests->departments->name"
                                />
                            </div>
                            <div class="mb-3">
                                <x-label for="files" value="{{ __('Attached files') }}"/>
                                <div class="grid grid-cols-2 gap-4 text-foreground">
{{--                                    @dd($medias)--}}

                                    @foreach($medias as $media)
                                        @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/heic']))
{{--                                            {!! $media->getUrl() !!}--}}
                                            <div class="relative group">
                                                <img src="{{ $media->getUrl() }}" alt="Image attachée"
                                                     class="w-full h-40 object-cover rounded-lg shadow-md">
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    <a href="{{ $media->getUrl() }}" target="_blank"
                                                       class="text-white bg-primary-500 hover:bg-primary-600 px-4 py-2 rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                            <path d="M16.5 7.5L6 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                            <path d="M8 6.18791C8 6.18791 16.0479 5.50949 17.2692 6.73079C18.4906 7.95209 17.812 16 17.812 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @elseif($media->mime_type === 'application/pdf')
                                            <div
                                                class="bg-gray-100 p-4 rounded-lg shadow-md flex items-center justify-between">
                                                <span class="text-gray-700">{{ $media->file_name }}</span>
                                                <a href="{{ $media->getUrl() }}" target="_blank"
                                                   class="text-blue-500 hover:text-blue-600 transition-transform duration-200 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M16.5 7.5L6 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                        <path d="M8 6.18791C8 6.18791 16.0479 5.50949 17.2692 6.73079C18.4906 7.95209 17.812 16 17.812 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </x-slot:form>
                    </x-form-section>
                </div>
            </div>
        </section>
    </div>
</div>
