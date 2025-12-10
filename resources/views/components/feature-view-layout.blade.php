<div class="w-full max-w-4xl mx-auto">
    <a href="{{route('list')}}"
       class="inline-flex items-center gap-2 mb-8 text-sm font-medium transition-colors text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Roadmap
    </a>

    <div class="overflow-hidden border rounded-2xl border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900">
        <x-feature-view-summary :feature="$feature" />

        <div class="p-8 bg-zinc-50/50 dark:bg-zinc-800/30">
            <x-feature-view-comments-header />

            {{ $slot }}

            <x-feature-view-list-comments />
        </div>
    </div>
</div>
