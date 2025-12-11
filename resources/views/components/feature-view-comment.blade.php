@props(['comment'])

<article class="flex gap-4">
    <div class="flex items-center justify-center w-10 h-10 font-medium rounded-full shrink-0 bg-gradient-to-br from-violet-500 to-purple-600 text-white text-sm">
        {{ $comment->user->initials }}
    </div>
    <div class="flex-1 min-w-0">
        <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/50">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $comment->user->name }}</span>
                    @if($comment->user->is_admin)
                        <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-violet-100 dark:bg-violet-500/10 text-violet-600 dark:text-violet-400">TEAM</span>
                    @endif
                    @if(! $comment->is_approved)
                        <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400">PENDING APPROVAL</span>
                    @endif
                </div>
                <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-300">
                {{ $comment->body }}
            </p>
        </div>
    </div>
</article>
