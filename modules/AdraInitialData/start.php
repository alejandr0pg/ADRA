<?php

/*
|--------------------------------------------------------------------------
| Instalador del módulo
|--------------------------------------------------------------------------
|
| Aquí se establecerán todas las reglas de instalación
| de tal forma que se pueda instalar automaticamente el módulo
| sin necesidad de instalarlo manualmente, ejecutar migraciones, 
| copiar assets, etc.
|
*/

if( sys_installed() ) {

	module_install(__DIR__, function( $module ) {
		
		$roles = [
            [
            	'name' => [
                    'en' => 'Employee', 
                    'es' => 'Empleado',
                    'pt' => 'Empregado'
                ],
            	'route' => '/admin/agencies'
            ],
            [
            	'name' => [
                    'en' => 'Voluntary', 
                    'es' => 'Voluntario',
                    'pt' => 'Voluntário'
                ],
            	'route' => '/admin/agencies'
            ],
        ];

        foreach($roles as $role) {
            $rol = roles()->create($role);
        } 
        
        $permissions = [
            [
                'group' => [
                    'en' => 'Agency',
                    'es' => 'Agencia',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Details',
                            'es' => 'Detalles',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Bank Info',
                            'es' => 'Información bancaría',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Emergency',
                    'es' => 'Emergencia',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Details',
                            'es' => 'Detalles',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Country',
                    'es' => 'Paises',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Currency',
                    'es' => 'Monedas',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Donors',
                    'es' => 'Donantes',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Planification',
                    'es' => 'Planificación',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                ]
            ],
        ];

        foreach ($permissions as $data) {
            $slug = data_get($data, 'slug');

            $perm = permissions()
                ->addGroup($data['group'], $slug)
                ->make($data['items']);
        }
	});
}