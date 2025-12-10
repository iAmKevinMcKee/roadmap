@php use App\Enums\Feature\FeatureStatus; @endphp
@props(['feature'])

<div class="group relative overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 transition-all hover:border-violet-500/50 hover:shadow-lg hover:shadow-violet-500/5">
    <div class="absolute inset-0 bg-gradient-to-r from-violet-500/5 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
    <div class="relative flex gap-6">
        <div class="flex flex-col items-center shrink-0">
            <button
                type="button"
                wire:click="vote({{ $feature->id }})"
                @class([
                    'flex flex-col cursor-pointer items-center justify-center w-16 h-20 rounded-xl border transition-all group/vote',
                    'border-violet-500 bg-violet-50 dark:bg-violet-500/10 hover:border-red-500 hover:bg-red-50 dark:hover:bg-red-500/10' => $feature->hasVoted,
                    'border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-500/10' => !$feature->hasVoted,
                ])
            >
                @if($feature->hasVoted)
                    <svg class="w-5 h-5 text-violet-500 group-hover/vote:hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 15l7-7 7 7" />
                    </svg>
                    <svg class="w-5 h-5 text-red-500 hidden group-hover/vote:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span class="mt-1 text-xl font-bold text-violet-600 dark:text-violet-400 group-hover/vote:text-red-600 dark:group-hover/vote:text-red-400">
                        {{ $feature->votes_count }}
                    </span>
                    <span class="text-[10px] font-medium text-violet-500 group-hover/vote:hidden">VOTED</span>
                    <span class="text-[10px] font-medium text-red-500 hidden group-hover/vote:block">UNVOTE</span>
                @else
                    <svg class="w-5 h-5 text-zinc-400 transition-colors group-hover/vote:text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                    <span class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">
                        {{ $feature->votes_count }}
                    </span>
                @endif
            </button>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <a href="{{route('view-feature', $feature->id)}}" class="text-lg font-semibold text-zinc-900 dark:text-white hover:underline">
                        {{ $feature->name }}
                    </a>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2">
                        {{ $feature->description }}
                    </p>
                </div>
                <span @class([
                    'shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full',
                    'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400' => $feature->status === FeatureStatus::Proposed,
                    'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400' => $feature->status === FeatureStatus::Planned,
                    'bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400' => $feature->status === FeatureStatus::InProgress,
                    'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' => $feature->status === FeatureStatus::Completed,
                ])>
                    @if($feature->status === FeatureStatus::Completed)
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    @elseif($feature->status === FeatureStatus::InProgress)
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                    @else
                        <span @class([
                            'w-1.5 h-1.5 rounded-full',
                            'bg-zinc-400' => $feature->status === FeatureStatus::Proposed,
                            'bg-amber-500' => $feature->status === FeatureStatus::Planned,
                        ])></span>
                    @endif
                    {{ $feature->status->getLabel() }}
                </span>
            </div>
            <div class="flex items-center gap-4 mt-4">
                <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                    {{ $feature->comments_count }} {{ Str::plural('comment', $feature->comments_count) }}
                </span>
                @if($feature->type)
                    <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        {{ $feature->type->getLabel() }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
