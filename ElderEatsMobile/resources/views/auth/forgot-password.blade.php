<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Wachtwoord vergeten? Geen probleem. Laat ons gewoon weten wat je e-mailadres is en we sturen je een link waarmee je een nieuw wachtwoord kunt kiezen.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-y-2 items-center justify-end mt-4">
            <x-primary-button>
                {{ __('E-mail wachtwoord reset link') }}
            </x-primary-button>
            <a href="{{ url()->previous() ?? '/' }}" class="w-full mt-2 rounded-full text-center"> Ga terug </a>
        </div>
    </form>
</x-guest-layout>
