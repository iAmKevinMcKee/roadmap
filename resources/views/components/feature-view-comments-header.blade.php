<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
        Comments
        <span class="ml-2 text-sm font-normal text-zinc-500 dark:text-zinc-400">({{$this->feature->comments_count}})</span>
    </h2>
    <div class="flex items-center gap-2">
        <span class="text-sm text-zinc-500 dark:text-zinc-400">Sort by:</span>
        <select
            class="px-3 py-1.5 text-sm font-medium rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500">
            <option>Newest</option>
            <option>Oldest</option>
            <option>Most liked</option>
        </select>
    </div>
</div>
