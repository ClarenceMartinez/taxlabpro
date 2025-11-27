<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preset;

class PresetSeeder extends Seeder
{
    public function run(): void
    {
        $presets = [
            'Basic Setup',
            'IRS Resolution Steps',
            '1040 Individual Tax Return',
            'Self-Employed Tax Prep',
            'Small Business Tax Filing (Schedule C)',
            'Client Onboarding',
            'Document Collection',
            'ITIN Application (W-7)',
            'Power of Attorney (Form 2848)',
            'Engagement Letter & Agreement',
            'Prepare Invoice and Secure Payment',
            'E-File Authorization (Form 8879)',
            'Upload to IRS / Submit Forms',
            'Review with Taxpayer',
            'Amendment Request (1040X)',
            'Taxpayer Identity Verification',
            'State Return Preparation',
            'Estimated Tax Payment Setup',
            'Audit Support / Representation',
            'Follow-up / Additional Docs Request',
            'Final Delivery and Archiving',
            'Payment Plan Setup (IRS Form 9465)',
        ];

        foreach ($presets as $name) {
            Preset::create([
                'name' => $name,
                'active' => true,
            ]);
        }
    }
}
