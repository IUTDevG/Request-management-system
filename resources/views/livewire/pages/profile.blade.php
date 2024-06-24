<div>
    <div class="transition-all duration-200 lg:ml-64 ml-0 mt-20 min-h-[calc(100vh-80px)]">
        <section class="">
            <div class="container mx-auto">
                <div class="p-6 rounded-lg shadow-front-2">
                    <x-form-section class="lg:grid gap-7" submit="updateProfile">
                        <x-slot name="title">
                            {{ __('Your informations') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Information about your') }}
                        </x-slot>

                        <x-slot:form>

                            <div class="mb-3">
                                <x-label for="title" value="{{ __('Name') }}"/>
                                <x-input id="name" wire="name"
                                         type="text"/>
                                <x-input-error for="name"/>
                            </div>
                            <div class="mb-3">
                                <x-label for="title" value="{{ __('firstName') }}"/>
                                <x-input id="firstName" wire="firstName"
                                         type="text"/>
                                <x-input-error for="firstName"/>
                            </div>
                            <div class="mb-3">
                                <x-label for="username" value="{{ __('Username') }}"/>
                                <x-input id="username" wire="username"
                                         type="text"/>
                                <x-input-error for="username"/>
                            </div>


                        </x-slot:form>

                        <x-slot:actions>
                            <div class="flex flex-col sm:flex-row items-center w-full">
                                <x-flash-message class="mr-3" on="submit">
                                    @if (session('status'))
                                        <div class="text-green-500">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="text-red-500">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </x-flash-message>
                                <x-button type="submit">
                                    {{ __('Update Profile') }}
                                </x-button>
                            </div>
                        </x-slot:actions>
                    </x-form-section>
                </div>
            </div>
        </section>
    </div>
</div>
