<?php

namespace Modules\Emergency\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\TasksChecklist;

class SeedTasksEmergencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $tasks = [
            [
                'name' => [
                    'es' => 'Desastre',
                    'en' => 'Disaster',
                    'pt' => 'Desastre'
                ],
                'class' => 'danger',
                'day_plus' => 0,
                'checklist' => [
                    [
                        'name' => [
                            'es' => 'Comunicación del Evento a la Oficina Central',
                            'en' => 'Communication of the Event to the Central Office',
                            'pt' => 'Comunicação do Evento ao Escritório Central'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Generación del SitRep',
                            'en' => 'Generation of SitRep',
                            'pt' => 'Geração do SitRep'
                        ]
                    ],
                ]
            ],
            [
                'name' => [
                    'es' => 'Contacto',
                    'en' => 'Contact',
                    'pt' => 'Entre em contato'
                ],
                'day_plus' => 1,
                'class' => 'info',
                'checklist' => [
                    [
                        'name' => [
                            'es' => 'Contacto con Autoridades de Defensa Civil',
                            'en' => 'Contact with Civil Defense Authorities',
                            'pt' => 'Contato com as autoridades de defesa civil'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Levantamiento de Daños (EDAN)',
                            'en' => 'Harm Survey (EDAN)',
                            'pt' => 'Inquérito contra Danos (EDAN)'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Fotos de daños y Visita a local Afectado',
                            'en' => 'Damage photos and Visit to local Affected',
                            'pt' => 'Danificar fotos e visitar o local afetado'
                        ]
                    ],
                ]
            ],
            [
                'name' => [
                    'es' => 'Asociación',
                    'en' => 'Association',
                    'pt' => 'Associação'
                ],
                'day_plus' => 2,
                'class' => 'warning',
                'checklist' => [
                    [
                        'name' => [
                            'es' => 'Definición de áreas de respuesta',
                            'en' => 'Defining response areas',
                            'pt' => 'Definindo áreas de resposta'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Menú de Respuesta Confirmado',
                            'en' => 'Confirmed Answer Menu',
                            'pt' => 'Menu de resposta confirmada'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Generación de SitRep Actualizado',
                            'en' => 'Generation of SitRep Updated',
                            'pt' => 'Geração do SitRep Atualizado'
                        ]
                    ],
                ]
            ],
            [
                'name' => [
                    'es' => 'Adquisición',
                    'en' => 'Acquisition',
                    'pt' => 'Aquisição'
                ],
                'day_plus' => 5,
                'class' => 'primary',
                'checklist' => [
                    [
                        'name' => [
                            'es' => 'Definición de Proveedores',
                            'en' => 'Definition of Suppliers',
                            'pt' => 'Definição de Fornecedores'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Verificación de Número Beneficiarios',
                            'en' => 'Beneficiary Number Verification',
                            'pt' => 'Verificação do Número do Beneficiário'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Fotos de los Kits en el Sistema',
                            'en' => 'Photos of the Kits in the System',
                            'pt' => 'Fotos dos kits no sistema'
                        ]
                    ],
                ]
            ],
            [
                'name' => [
                    'es' => 'Distribución',
                    'en' => 'Distribution',
                    'pt' => 'Distribuição'
                ],
                'day_plus' => 7,
                'class' => 'secondary',
                'checklist' => [
                    [
                        'name' => [
                            'es' => 'Distribución Ejecutada',
                            'en' => 'Executed Distribution',
                            'pt' => 'Distribuição Executada'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Documentos de Verificación',
                            'en' => 'Verification Documents',
                            'pt' => 'Documentos de Verificação'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Fotos de la Distribución en el Sistema',
                            'en' => 'Photos of the Distribution in the System',
                            'pt' => 'Fotos da Distribuição no Sistema'
                        ]
                    ],
                ]
            ],
            [
                'name' => [
                    'es' => 'Informes',
                    'en' => 'Reports',
                    'pt' => 'Relatórios'
                ],
                'day_plus' => 20,
                'class' => 'dark',
                'checklist' => [
                    [
                        'name' => [
                            'es' => 'Reporte Final Llenado',
                            'en' => 'Final Report Filling',
                            'pt' => 'Relatório final de preenchimento'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Histórias de Interés Humano en el Sistema',
                            'en' => 'Histories of Human Interest in the System',
                            'pt' => 'Histórias de Interesse Humano no Sistema'
                        ]
                    ],
                    [
                        'name' => [
                            'es' => 'Documentos de Verificación de Recibimiento (Escaneados)',
                            'en' => 'Receipt Verification Documents (Scanned)',
                            'pt' => 'Documentos de Verificação de Recibos (Digitalizados)'
                        ]
                    ],
                ]
            ],
        ];

        foreach($tasks as $task) {
            $task_collect = collect($task['name']);
            //
            $_task = new Task;
            $_task->slug = $slug = str_slug($task_collect->first(), '-');
            $_task->class = $task['class'];
            $_task->day_plus = $task['day_plus'];
            $_task->save();

            //
            $translations = translations('tasks-list');

            foreach($task_collect as $key => $value) {
                $translations->add($slug, $value, $key);
            }

            $translations->publish();


            foreach($task['checklist'] as $check) {   
                $check_collect = collect($check['name']);
                //
                $_checklist = new TasksChecklist;
                $_checklist->task_id = $_task->id;
                $_checklist->slug = $slug_checklist = str_slug($check_collect->first(), '-');
                $_checklist->save();

                $translations = translations('tasks-items-list');

                foreach($check_collect as $key => $value) {
                    $translations->add($slug_checklist, $value, $key);
                }

                $translations->publish();
            }
        }
    }
}
