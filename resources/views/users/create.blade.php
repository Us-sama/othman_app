<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des utilisateurs') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Informations du profil') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Modifier les informations du profil et l'adresse mail.") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="POST"
                            @if(isset($user))
                                action="{{ route('user.store', $user) }}"
                            @else
                                action="{{ route('user.store') }}"
                            @endif
                            class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label  for="name" :value="__('Nom')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', isset($user) ? $user->name : '')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', isset($user) ? $user->email : '')" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" required name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div>
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">sélectionner un rôle</label>
                                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="agent" {{ old('role', isset($user) ? $user->roles->first()->name ?? '' : '') === 'agent' ? 'selected' : '' }}>Agent</option>
                                    <option value="admin" {{ old('role', isset($user) ? $user->roles->first()->name ?? '' : '') === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="chef" {{ old('role', isset($user) ? $user->roles->first()->name ?? '' : '') === 'chef' ? 'selected' : '' }}>Chef de division</option>
                                </select>
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Enregistré.') }}</p>
                                @endif
                            </div>
                        </form>

                    </section>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
