<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

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

	module(__DIR__)->install(function( $module ) {

		leftSidebar('menu')->make(array([
			'name' => [
				'es' => 'Agencias',
				'en' => 'Agencies',
				'pt' => 'Agências'
			],
			'icon' => 'mdi mdi-bank',
			'route' => 'admin/agencies',
			'items' => [],
			'permissions' => [
				'agency.view'
			]
        ]));

        // Creamos la tab "información bancaría" en el perfil 
        profile()->makeTab([
            'name' => [
                'es' => 'Información bancaría',
				'en' => 'Bank Information',
				'pt' => 'Informação Bancária'
            ],
            'route' => 'agency.bank-info.tab'
        ]);

		$module->migrate();
	});
}