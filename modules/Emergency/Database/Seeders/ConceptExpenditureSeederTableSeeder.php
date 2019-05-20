<?php

namespace Modules\Emergency\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Emergency\Entities\ConceptExpenditure;


class ConceptExpenditureSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $concepts = [
            ['name' => [
                'es' => 'Cesta básica',
                'en' => 'Basic basket',
                'pt' => 'Cesta básica'
            ]],
            ['name' => [
                'es' => 'Voluntarios',
                'en' => 'Voluntários',
                'pt' => 'Volunteers'
            ]],
            ['name' => [
                'es' => 'Transporte de materiales',
                'en' => 'Transport of materials',
                'pt' => 'Transporte de materiais'
            ]],
            ['name' => [
                'es' => 'Transporte para personas',
                'en' => 'Transportation for people',
                'pt' => 'Transporte para pessoas'
            ]],
            ['name' => [
                'es' => 'Diario y remuneraciones',
                'en' => 'Daily and remunerations',
                'pt' => 'Diariamente e remunerações'
            ]],
            ['name' => [
                'es' => 'Visibilidad',
                'en' => 'Visibility',
                'pt' => 'Visibilidade'
            ]],
            ['name' => [
                'es' => 'Embalaje',
                'en' => 'Packaging',
                'pt' => 'Embalagem'
            ]],
            ['name' => [
                'es' => 'Admin restringido',
                'en' => 'Admin restricted',
                'pt' => 'Administrador restrito'
            ]],
            ['name' => [
                'es' => 'Otro',
                'en' => 'Other',
                'pt' => 'Outro'
            ]],
        ];

        foreach($concepts as $concept) {
            $collect = collect($concept['name']);
            //
            $_concept = new ConceptExpenditure;
            $_concept->slug = $slug = str_slug($collect->first(), '-');
            $_concept->save();

            //
            $translations = translations('concepts-list');

            foreach($collect as $key => $value) {
                $translations->add($slug, $value, $key);
            }

            $translations->publish();
        }
    }
}
