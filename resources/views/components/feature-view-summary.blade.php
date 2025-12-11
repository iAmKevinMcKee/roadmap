<div class="p-8 border-b border-zinc-200 dark:border-zinc-800">
    <div class="flex flex-col gap-6 sm:flex-row">
        <div class="flex flex-col items-center shrink-0">
            <button
                type="button"
                wire:click="vote"
                @class([
                    'flex flex-col cursor-pointer items-center justify-center w-20 h-24 rounded-xl border transition-all group/vote',
                    'border-violet-500 bg-violet-50 dark:bg-violet-500/10 hover:border-red-500 hover:bg-red-50 dark:hover:bg-red-500/10' => $feature->hasVoted,
                    'border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-500/10' => !$feature->hasVoted,
                ])
            >
                @if($feature->hasVoted)
                    <svg class="w-6 h-6 text-violet-500 group-hover/vote:hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 15l7-7 7 7" />
                    </svg>
                    <svg class="w-6 h-6 text-red-500 hidden group-hover/vote:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span class="mt-1 text-2xl font-bold text-violet-600 dark:text-violet-400 group-hover/vote:text-red-600 dark:group-hover/vote:text-red-400">
                                {{ $feature->votes_count }}
                            </span>
                    <span class="text-[10px] font-medium text-violet-500 group-hover/vote:hidden">VOTED</span>
                    <span class="text-[10px] font-medium text-red-500 hidden group-hover/vote:block">UNVOTE</span>
                @else
                    <svg class="w-6 h-6 text-zinc-400 transition-colors group-hover/vote:text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                    <span class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">
                                {{ $feature->votes_count }}
                            </span>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">votes</span>
                @endif
            </button>
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 mb-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                Planned
                            </span>
                    <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white sm:text-3xl">
                        Real-time Collaboration
                    </h1>
                </div>
            </div>

            <p class="mt-4 leading-relaxed text-zinc-600 dark:text-zinc-400">
                Enable multiple team members to work on projects simultaneously with live cursors, instant
                updates, and seamless conflict resolution. This feature will transform how teams collaborate by
                providing a Google Docs-like experience for all project types.
            </p>

            <div class="flex flex-wrap items-center gap-4 mt-6">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                            Core Feature
                        </span>
                <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            Requested Dec 3, 2024
                        </span>
            </div>
        </div>
    </div>
</div>
