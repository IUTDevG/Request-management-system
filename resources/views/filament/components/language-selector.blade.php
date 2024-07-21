<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <x-heroicon-o-language class="h-5 w-5 text-gray-400" />
        <span class="ml-2">{{ strtoupper(app()->getLocale()) }}</span>
    </button>

    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        @foreach(config('app.available_locales') as $locale => $language)
            <a href="{{ route('filament.admin.change-language', $locale) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">{{ $language }}</a>
        @endforeach
    </div>
</div>
