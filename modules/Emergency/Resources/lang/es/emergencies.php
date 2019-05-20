<?php 
return [
	'title' => 'Emergencias',
	'add-emergencies' => 'Registrar emergencia',
	'table-list' => 'Listado de emergencias',
	'breadcrumb' => 'Emergencias',
	'table' => [
		'id' => 'ID',
		'code' => 'Código',
		'name' => 'Nombre',
		'cordinator' => 'Coordinador',
		'contribution' => 'Contribución',
		'agency' => 'Agencia',
		'date' => 'Fecha',
		'd+20' => 'D+(20)',
		'action' => 'Acciones',
		'edit' => 'Modificar',
		'delete' => 'Eliminar',
		'empty' => 'Ninguna emergencia registrada'
	],
	'modal' => [
		'title' => 'Nueva emergencia',
		'form' => [
			'code' => 'Código',
			'belong-to' => 'Pertenece a la agencia',
			'name' => 'Eventualidad',
			'description' => 'Descripción',
			'type' => 'Tipo de eventualidad',
			'contribution' => 'Contribución',
			'currency' => 'Moneda',
			'cordinator' => 'Coordinador',
			'vigency' => 'Vigencia',
			'check' => [
				'on' => 'Vigente',
				'off' => 'No vigente'
			],
			'cancel' => 'Cancelar',
			'submit' => 'Registrar emergencia',
			'select-agency' => 'Selecciona una agencia',
			'select-type' => 'Selecciona el tipo de eventualidad',
			'select-contribution' => 'Selecciona el tipo de contribución',
			'select-currency' => 'Selecciona una moneda',
			'select-cordinator' => 'Selecciona el Coordinador',
			'start_date' => 'Fecha de inicio',
			'event_date' => 'Fecha del evento'
		]
	],
	'alerts' => [
		'created' => 'Emergencia creada exitosamente.',
		'updated' => 'Emergencia modificada exitosamente.',
		'deleted' => 'Emergencia eliminada exitosamente.'
	],
	'not-established' => 'Not established',
];