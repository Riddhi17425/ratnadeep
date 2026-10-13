<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $events = [
            [
                'title' => 'Stainless Steel World Middle East',
                'icon' => 'frontend/assets/images/Events/event-card-1.png',
                'alt_icon_text' => 'Stainless Steel World Middle East',
                'short_description' => 'We are pleased to inform you all we are going to participate in most reputed expo of the domain “Stainless Steel” in Muscat – Oman. We welcome our clients and industry partners to meet and discuss opportunities in stainless steel and alloy tubes.',
                'date_from' => '2020-03-09',
            ],
            [
                'title' => 'Duesseldorf Germany 2020',
                'icon' => 'frontend/assets/images/Events/event-card-2.png',
                'alt_icon_text' => 'Duesseldorf Germany 2020',
                'short_description' => 'We are pleased to inform you all we are going to participate in most reputed expo of the domain “TUBE DUESSELDORF” in Germany. We welcome our clients and global partners to meet and discuss customized tubing solutions.',
                'date_from' => '2020-03-30',
            ],
            [
                'title' => 'Stainless Steel World 2019',
                'icon' => 'frontend/assets/images/Events/event-card-3.png',
                'alt_icon_text' => 'Stainless Steel World 2019',
                'short_description' => 'Ratnadeep participated in Stainless Steel World Expo, presenting our precision manufacturing lines, seamless nickel alloy tubes, and certified quality management practices.',
                'date_from' => '2019-03-30',
            ],
            [
                'title' => 'Duesseldorf Germany 2018',
                'icon' => 'frontend/assets/images/Events/event-card-4.png',
                'alt_icon_text' => 'Duesseldorf Germany 2018',
                'short_description' => 'We participated in the TUBE DUESSELDORF trade fair in Germany, engaging with international EPC contractors and process engineering leaders.',
                'date_from' => '2018-04-16',
            ],
        ];

        foreach ($events as $event) {
            if (DB::table('upcoming_events')->where('title', $event['title'])->exists()) {
                continue;
            }

            DB::table('upcoming_events')->insert($event + [
                'reference' => 'work@ratnadeepmetal.com',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Keep events as admin-managed content if this migration is rolled back.
    }
};
