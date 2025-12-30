<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Recuperar conta')" :description="__('informe o seu e-mail e o link de recuperação será enviado')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('E-mail')"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                {{ __('Receber link de recuperação de conta') }}
            </flux:button>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
            <span>{{ __('ou, voltar a') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('iniciar sessão') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
