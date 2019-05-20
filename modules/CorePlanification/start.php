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
				'es' => 'Planificacion',
				'en' => 'Planification',
				'pt' => 'Planejamento'
			],
			'icon' => 'mdi mdi-calendar-multiple-check',
			'route' => '#',
			'items' => array(
				[
					'name' => [
						'es' => 'Registro',
						'en' => 'Register',
						'pt' => 'Registo'
					],
					'route' => 'admin/planification/register'
				],
				[
					'name' => [
						'es' => 'Ejecutor',
						'en' => 'Ejecuter',
						'pt' => 'Executor'
					],
					'route' => 'admin/planification/ejecuter'
				],
				[
					'name' => [
						'es' => 'Evaluación',
						'en' => 'Evaluation',
						'pt' => 'Avaliação'
					],
					'route' => 'admin/planification/evaluation'
				],
				[
					'name' => [
						'es' => 'Avance de Indicador',
						'en' => 'Indicator Advance',
						'pt' => 'Avanço do indicador'
					],
					'route' => 'admin/planification/indicator-advance'
				],
				[
					'name' => [
						'es' => 'Avance IVO',
						'en' => 'Advance IVO',
						'pt' => 'Avanço da IVO'
					],
					'route' => 'admin/planification/advance-ivo'
				]	
			),
			'permissions' => [
				'planification.view'
			]
        ]));

		$module->migrate();

	});
}
