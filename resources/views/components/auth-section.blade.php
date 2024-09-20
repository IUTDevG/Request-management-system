@props(['submit'=>'submit'])
    <div {{$attributes->merge(['class'=>'text-[#333] max-w-full mx-auto h-screen'])}}>
        <div class="grid md:grid-cols-2 items-center gap-8 h-full bg-gray-50">
            <form wire:submit="{{$submit}}" class="max-w-lg max-md:mx-auto w-full px-10 py-10">
               {{$form}}
            </form>
            <div
                class="h-full md:py-6 flex items-center relative max-md:hidden  max-md:before:hidden before:absolute before:bg-gradient-to-r before:from-gray-50 before:via-[#E4FE66] before:to-[#55F5A3] before:h-full before:w-3/4 before:right-0 before:z-0">
                <img src="{{asset('images/content/vue-de-face.png')}}"
                     class="rounded-md lg:w-4/5 md:w-11/12 z-50 relative" alt="{{config('app.name')}}"/>
            </div>
        </div>
    </div>
