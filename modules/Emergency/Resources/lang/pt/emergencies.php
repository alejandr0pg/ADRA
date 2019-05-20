<?php 
return [
	'title' => 'Emergências',
	'add-emergencies' => 'Registrar emergência',
	'table-list' => 'Lista de emergências',
	'breadcrumb' => 'Emergências',
	'table' => [
		'id' => 'ID',
		'code' => 'Code',
		'name' => 'Nome',
		'cordinator' => 'Coordenador',
		'contribution' => 'Contribuição',
		'agency' => 'Agência',
		'date' => 'Data',
		'd+20' => 'D+(20)',
		'action' => 'Ações',
		'edit' => 'Modificar',
		'delete' => 'Excluir',
		'empty' => 'Nenhuma emergência registrada.'
	],
	'modal' => [
		'title' => 'Nova emergência',
		'form' => [
			'code' => 'Code',
			'belong-to' => 'Pertence à Agência',
			'name' => 'Eventualidade',
			'description' => 'Descrição',
			'type' => 'Tipo de eventualidade',
			'contribution' => 'Contribuição',
			'currency' => 'Moeda',
			'cordinator' => 'Coordenador',
			'vigency' => 'Validade',
			'check' => [
				'on' => 'Válido',
				'off' => 'Não é válido'
			],
			'cancel' => 'Cancelar',
			'submit' => 'Registrar emergência',
			'select-agency' => 'Selecione uma Agência',
			'select-type' => 'Selecione o tipo de eventualidade',
			'select-contribution' => 'Selecione o tipo de contribuição',
			'select-currency' => 'Selecione uma moeda',
			'select-cordinator' => 'Selecione o coordenador',
			'start_date' => 'Data de início',
			'event_date' => 'Data do evento'
		]
	],
	'alerts' => [
		'created' => 'Emergência criada com sucesso.',
		'updated' => 'Emergência modificada com sucesso.',
		'deleted' => 'Emergência eliminada com sucesso.'
	],
	'not-established' => 'Not established',
];