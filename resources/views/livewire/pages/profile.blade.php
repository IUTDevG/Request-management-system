<div>
    {{--    @dd($name)--}}
    <div class="transition-all duration-200 lg:ml-64 ml-0 mt-20 min-h-[calc(100vh-80px)]">
        <section class="">
            <div class="container mx-auto">
                <div class="p-6 rounded-lg shadow-front-2">
                    {{--                    @dd($user)--}}


                    <x-profile-avatar
                        size="md"
                        class="mb-5"
                        :alt="$name"
                        :src="$avatarUrl"
                        wire="newAvatar"
                        default="{{$avatarUrl}}"
                    >
                        <x-slot name="title">
                            {!! __('Profile Photo') !!}
                        </x-slot>

                        <x-input-error for="newAvatar"/>
                    </x-profile-avatar>
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
                                <x-label for="title" value="{{ __('Firstname') }}"/>
                                <x-input id="firstName" wire="firstName"
                                         type="text"/>
                                <x-input-error for="firstName"/>
                            </div>
                            <div class="mb-3">
                                <x-label for="username" value="{!! __('Username') !!}"/>
                                <x-input id="username" wire="username"
                                         type="text"/>
                                <x-input-error for="username"/>
                            </div>
                            <div class="mb-3">
                                <x-label for="email" value="{{ __('Email address') }}"/>
                                <x-input id="email" wire="email"
                                         type="email"/>
                                <x-input-error for="email"/>
                            </div>
                        </x-slot:form>

                        <x-slot:actions>
                            <div class="flex flex-col sm:flex-row items-center w-full">
                                <x-flash-message class="mr-3" on="saved"/>
                                <x-button type="submit">
                                    {{ __('Update Profile') }}
                                </x-button>
                            </div>
                        </x-slot:actions>
                        {{session('error')}}
                    </x-form-section>
                    <x-form-section class="lg:grid gap-7 mt-5" submit="changePassword">
                        <x-slot name="title">
                            {{ __('Réinitialisation du mot de passe') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Veillez à ce que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
                        </x-slot>
                        <x-slot:form>
                            <div class="mb-3">
                                <x-label value="{{__('Mot de passe actuel')}}"/>
                                <x-input :is-password="true" type="password" wire:model="current_password"/>
                                <x-input-error for="current_password"/>
                            </div>
                            <div class="mb-3">
                                <x-label value="{{__('Nouveau mot de passe')}}"/>
                                <x-input :is-password="true" type="password" wire:model="new_password"/>
                                <x-input-error for="new_password"/>
                            </div>
                            <div class="mb-3">
                                <x-label value="{{__('Confirmation du nouveau mot de passe')}}"/>
                                <x-input :is-password="true" type="password" wire:model="new_password_confirmation"/>
                                <x-input-error for="new_password_confirmation"/>
                            </div>
                        </x-slot:form>


                        <x-slot:actions>
                            <div class="flex flex-col sm:flex-row items-center w-full">
                                <x-flash-message on="password" class="mr-3"/>
                                <x-button type="submit">
                                    {{ __('Update Password') }}
                                </x-button>
                            </div>
                        </x-slot:actions>
                        @session('password-error')
                        {{session('password-success')}}
                        @endsession
                    </x-form-section>
                </div>
            </div>
        </section>
    </div>
</div>
