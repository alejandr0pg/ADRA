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
	// Instalación del módulo
	module(__DIR__)->install(function( $module ) {

		leftSidebar('menu')->make(array([
			'name' => [
				'en' => 'Emergencies',
				'es' => 'Emergencias',
				'pt' => 'Emergências'
			],
			'icon' => 'mdi mdi-alert',
			'route' => 'admin/emergencies',
			'items' => [],
			'permissions' => [
				'emergency.view'
			]
        ]));

		leftSidebar('sistema', 'configuracion')->make(array([
				'name' => [
					'en' => 'Events Types',
					'es' => 'Tipos de eventos',
					'pt' => 'Tipos de eventos'
				], 
				'route' => 'admin/settings/events-types'
			],
			[
				'name' => [
					'en' => 'Contributions',
					'es' => 'Contribuciones',
					'pt' => 'Contribuições'
				], 
				'route' => 'admin/settings/contributions'
			],
		));

		$seed = true;
		$module->migrate($seed);
		$module->publish();
	});
}
