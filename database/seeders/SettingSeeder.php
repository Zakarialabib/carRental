<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /** @var array */
    protected $settings = [
        [
            'key'   => 'agencyName',
            'value' => 'CarRental',
        ],
        [
            'key'   => 'agencyEmail',
            'value' => 'connect@zakarialabib.com',
        ],
        [
            'key'   => 'agencyPhone',
            'value' => '+212638041919',
        ],
        [
            'key'   => 'agencyAddress',
            'value' => 'Casablanca, Maroc',
        ],
        [
            'key'   => 'agencyLogo',
            'value' => '',
        ],
        [
            'key'   => 'agencyFavicon',
            'value' => '',
        ],
        [
            'key'   => 'footer_text',
            'value' => '',
        ],
        [
            'key'   => 'agency_meta_title',
            'value' => 'CarRental',
        ],
        [
            'key'   => 'agency_meta_description',
            'value' => 'CarRental',
        ],
        [
            'key'   => 'facebookLink',
            'value' => '#',
        ],
        [
            'key'   => 'twitterLink',
            'value' => '#',
        ],
        [
            'key'   => 'instagramLink',
            'value' => '#',
        ],
        [
            'key'   => 'linkedinLink',
            'value' => '#',
        ],
        [
            'key'   => 'whatsappLink',
            'value' => '#',
        ],
        [
            'key'   => 'head_script_tags',
            'value' => '',
        ],
        [
            'key'   => 'body_script_tags',
            'value' => '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Settings::create($setting);

            if ( ! $result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings).' records');
    }
}
