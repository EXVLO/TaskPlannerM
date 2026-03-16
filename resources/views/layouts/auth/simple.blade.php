<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-slate-950 text-slate-100">
        <div class="relative flex min-h-svh items-center justify-center overflow-hidden px-6 py-10">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute -bottom-24 -right-16 h-80 w-80 rounded-full bg-indigo-500/20 blur-3xl"></div>
            </div>

            <div class="relative w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-5 flex items-center justify-center gap-3" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-400 to-blue-700 text-sm font-bold text-white shadow-lg shadow-blue-900/40">
                        TPM
                    </span>
                    <span class="text-sm font-semibold tracking-wide text-blue-100">TaskPlannerM</span>
                </a>

                <div class="rounded-2xl border border-white/10 bg-slate-900/70 p-6 shadow-2xl shadow-black/40 backdrop-blur">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
