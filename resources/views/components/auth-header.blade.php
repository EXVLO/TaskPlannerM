@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <flux:heading size="xl" class="bg-gradient-to-r from-blue-300 to-blue-500 bg-clip-text text-transparent">
        {{ $title }}
    </flux:heading>
    <flux:subheading class="mt-1 text-slate-300">
        {{ $description }}
    </flux:subheading>
</div>
