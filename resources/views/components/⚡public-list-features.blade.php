<?php

use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function features()
    {
        return App\Models\Feature::query()
            ->whereNot('status', App\Enums\Feature\FeatureStatus::Cancelled)
            ->withCount(['votes', 'comments'])
            ->orderByDesc('votes_count')
            ->withExists(['votes as hasVoted' => fn ($q) => $q->where('user_id', auth()->id())])
            ->get();
    }

    public function vote(int $featureId): void
    {
        $feature = App\Models\Feature::findOrFail($featureId);

        if ($feature->votes()->where('user_id', auth()->id())->exists()) {
            $feature->votes()->where('user_id', auth()->id())->delete();
        } else {
            $feature->votes()->create(['user_id' => auth()->id()]);
        }

        unset($this->features);
    }
};
?>

<div>
    <section class="w-full max-w-4xl mx-auto">
        <x-feature-list-header />

        <x-feature-quick-filters />

        <div class="space-y-4">
            @foreach($this->features as $feature)
                <x-feature-card :feature="$feature" />
            @endforeach
        </div>

        <x-feature-list-pagination />
    </section>
</div>
