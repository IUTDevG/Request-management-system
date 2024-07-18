@use('App\Enums\SchoolRequestStatus')
<div>
{{--        @dd($requests)--}}
    <div class="transition-all duration-200 lg:ml-64 ml-0 mt-20 min-h-[calc(100vh-80px)]">
        <section class="px-4">
            @if($requests->status === SchoolRequestStatus::Draft->value)
            <div class="flex justify-end">
                <a href="{{ route('student.updated-request',$requests->id) }}"
                   class="py-3 px-4 inline-flex items-center gap-x-2 font-semibold  border border-transparent gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 text-gray-700 dark:text-gray-200 hover:bg-info-500 focus-visible:bg-info-700 bg-info-500 dark:hover:bg-info-300 dark:focus-visible:bg-white/5">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                         color="#ffffff" fill="none">
                        <path
                            d="M16.2141 4.98239L17.6158 3.58063C18.39 2.80646 19.6452 2.80646 20.4194 3.58063C21.1935 4.3548 21.1935 5.60998 20.4194 6.38415L19.0176 7.78591M16.2141 4.98239L10.9802 10.2163C9.93493 11.2616 9.41226 11.7842 9.05637 12.4211C8.70047 13.058 8.3424 14.5619 8 16C9.43809 15.6576 10.942 15.2995 11.5789 14.9436C12.2158 14.5877 12.7384 14.0651 13.7837 13.0198L19.0176 7.78591M16.2141 4.98239L19.0176 7.78591"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path
                            d="M21 12C21 16.2426 21 18.364 19.682 19.682C18.364 21 16.2426 21 12 21C7.75736 21 5.63604 21 4.31802 19.682C3 18.364 3 16.2426 3 12C3 7.75736 3 5.63604 4.31802 4.31802C5.63604 3 7.75736 3 12 3"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <span
                        class="flex-1 truncate text-start">
                                                                                {!! __('Update') !!}
                                                                            </span>
                </a>
            </div>
            @endif
            <div class="w-full">
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
                                         label="{{ __('Filière') }}" :value="$requests->level->name"
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
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-foreground">
                                    {{-- @dd($medias) --}}
                                    @foreach($medias as $media)
                                        @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/heic']))
                                            <div class="relative group">
                                                <img src="{{ $media->getUrl() }}" alt="Image attachée"
                                                     class="w-full h-40 object-cover rounded-lg shadow-md">
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    <a href="{{ $media->getUrl() }}" target="_blank"
                                                       class="text-white bg-secondary/50 hover:bg-secondary px-4 py-2 rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             width="24" height="24" color="#000000" fill="none">
                                                            <path d="M16.5 7.5L6 18" stroke="currentColor"
                                                                  stroke-width="1.5" stroke-linecap="round"/>
                                                            <path
                                                                d="M8 6.18791C8 6.18791 16.0479 5.50949 17.2692 6.73079C18.4906 7.95209 17.812 16 17.812 16"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @elseif($media->mime_type === 'application/pdf')
                                            <div class="relative group">
                                                <div id="pdf-preview-{{ $loop->index }}"
                                                     class="w-full h-40 bg-gray-100 rounded-lg shadow-md flex items-center justify-center">
                                                    <span class="text-gray-500">{!! __('Loading...') !!}</span>
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ $media->getUrl() }}" target="_blank"
                                                           class="text-white bg-success-400/50 hover:bg-success-600 px-4 py-2 rounded-md">
                                                            {{ __('Open') }}
                                                        </a>
                                                        <a href="{{ $media->getUrl() }}" download
                                                           class="text-white flex items-center justify-between bg-success-400/50 hover:bg-success-600 px-4 py-2 rounded-md">
                                                            {{ __('Download') }}
                                                            <svg class="size-5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#ffffff" fill="none">
                                                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="1.5" />
                                                                <path d="M12 7V12.5M10 11L11.2929 12.2929C11.6262 12.6262 11.7929 12.7929 12 12.7929C12.2071 12.7929 12.3738 12.6262 12.7071 12.2929L14 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M8.99023 16H14.9902" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <script
                                                src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    var url = "{{ $media->getUrl() }}";
                                                    var loadingTask = pdfjsLib.getDocument(url);
                                                    loadingTask.promise.then(function (pdf) {
                                                        pdf.getPage(1).then(function (page) {
                                                            var viewport = page.getViewport({scale: 1});
                                                            var canvas = document.createElement('canvas');
                                                            var context = canvas.getContext('2d');
                                                            canvas.height = viewport.height;
                                                            canvas.width = viewport.width;

                                                            var renderContext = {
                                                                canvasContext: context,
                                                                viewport: viewport
                                                            };
                                                            page.render(renderContext).promise.then(function () {
                                                                var pdfPreview = document.getElementById('pdf-preview-{{ $loop->index }}');
                                                                pdfPreview.innerHTML = '';
                                                                pdfPreview.appendChild(canvas);
                                                                canvas.classList.add('object-cover', 'rounded-lg', 'w-full', 'h-full');
                                                            });
                                                        });
                                                    });
                                                });
                                            </script>
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
