<?php

namespace App\Console\Commands;

use App\Models\Plant;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PopulatePlantSlugs extends Command
{
    protected $signature = 'plants:generate-slugs';
    protected $description = 'Generate and populate unique URL slugs for all plants based on their name';

    public function handle(): void
    {
        $plants = Plant::whereNull('slug')->get();
        $count = 0;

        foreach ($plants as $plant) {
            $baseSlug = Str::slug($plant->name);
            $slug = $baseSlug;
            $counter = 1;

            // Ensure slug uniqueness
            while (Plant::where('slug', $slug)->where('id', '!=', $plant->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }

            $plant->update(['slug' => $slug]);
            $this->info("Successfully generated slug for plant ID {$plant->id}: {$slug}");
            $count++;
        }

        $this->info("Successfully generated slugs for {$count} plant(s).");
    }
}