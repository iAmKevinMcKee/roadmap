<?php

use App\Models\Feature;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public Feature $feature;

    public function mount(): void
    {
        $this->refreshFeature();
    }

    public function refreshFeature(): void
    {
        $this->feature = Feature::withCount(['votes', 'comments'])
            ->withExists(['votes as hasVoted' => fn($q) => $q->where('user_id', auth()->id())])
            ->findOrFail($this->feature->id);
    }

    public function vote(): void
    {
        if ($this->feature->votes()->where('user_id', auth()->id())->exists()) {
            $this->feature->votes()->where('user_id', auth()->id())->delete();
            $this->feature->hasVoted = false;
        } else {
            $this->feature->votes()->create(['user_id' => auth()->id()]);
            $this->feature->hasVoted = true;
        }

        $this->refreshFeature();
    }

    #[Computed]
    public function comments()
    {
        return $this->feature->comments()->with('user')->latest()->get();
    }
};
?>

<x-feature-view-layout :feature="$feature">
    {{-- TODO replace this with a Filament form component  --}}
    <form class="mb-8">
        <div class="flex gap-4">
            <div
                class="flex items-center justify-center w-10 h-10 font-medium rounded-full shrink-0 bg-gradient-to-br from-violet-500 to-purple-600 text-white text-sm">
                JD
            </div>
            <div class="flex-1">
                        <textarea
                            rows="3"
                            placeholder="Add a comment..."
                            class="w-full px-4 py-3 text-sm transition-colors border rounded-xl border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 resize-none"
                        ></textarea>
                <div class="flex justify-end mt-3">
                    <button type="submit"
                            class="px-5 py-2 text-sm font-medium text-white transition-all rounded-lg bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                        Post Comment
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-feature-view-layout>
