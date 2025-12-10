<div class="space-y-6">
    @foreach($this->comments as $comment)
        <x-feature-view-comment :comment="$comment"/>
    @endforeach
</div>

<div class="flex justify-center mt-8">
    <button
        class="px-6 py-2.5 text-sm font-medium transition-all border rounded-lg border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white">
        Load more comments
    </button>
</div>
