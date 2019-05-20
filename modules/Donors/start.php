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
				'es' => 'Donantes',
				'en' => 'Donors',
				'pt' => 'Doadores'
			],
			'icon' => 'mdi mdi-cash-multiple',
			'route' => 'admin/donors',
			'items' => [],
			'permissions' => [
				'donors.view'
			]
        ]));

		$module->migrate(true);
	});
}