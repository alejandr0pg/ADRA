<?php

namespace Modules\Donors\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Donors\Entities\Origin;

class SeedOriginsDonorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        // Creamos una nueva traducción
        $translations = translations('donors-origins-list');

        $origins = array(
            array('name' => [
                'en' => 'Government',
                'es' => 'Gobierno'
            ]),
            array('name' => [
                'en' => 'Bussiness',
                'es' => 'Empresa'
            ]),
            array('name' => [
                'en' => 'Private',
                'es' => 'Privado'
            ]),
            array('name' => [
                'en' => 'Church',
                'es' => 'Iglesia'
            ])
        );

        foreach( $origins as $data ) {
            if( is_array( $data['name'] ) ) {
                $arrays = collect($data['name']);
                $slug = str_slug($arrays->first(), '-');
                //
                foreach ($data['name'] as $locale => $value) {
                    $translations->add($slug, $value, $locale);
                }
            } else {
                $slug = str_slug($data['name'], '-');
                // Obtenemos los lenguajes instalados.

                foreach ( $translations->getLocales() as $locale) {
                    // Creamos una nueva traducción
                    $translations->add($slug, $data['name'], $locale);
                }
            }

            $origin = new Origin;
            $origin->slug = $slug;
            $origin->save();

            $translations->publish();
        }
    }
}
