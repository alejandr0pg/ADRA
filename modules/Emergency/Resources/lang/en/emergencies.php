<?php 
return [
	'title' => 'Emergencies',
	'add-emergencies' => 'Register emergency',
	'table-list' => 'List of Emergencies',
	'breadcrumb' => 'Emergencies',
	'table' => [
		'id' => 'ID',
		'code' => 'Code',
		'name' => 'Name',
		'cordinator' => 'Coordinator',
		'contribution' => 'Contribution',
		'agency' => 'Agency',
		'date' => 'Date',
		'd+20' => 'D+(20)',
		'action' => 'Actions',
		'edit' => 'Modify',
		'delete' => 'Remove',
		'empty' => 'No registered emergency.'
	],
	'modal' => [
		'title' => 'New emergency',
		'form' => [
			'code' => 'Code',
			'belong-to' => 'Belongs to the Agency',
			'name' => 'Eventuality',
			'description' => 'Description',
			'type' => 'Type of eventuality',
			'contribution' => 'Contribution',
			'currency' => 'Currency',
			'cordinator' => 'Coordinator',
			'vigency' => 'Vigencia',
			'check' => [
				'on' => 'Valid',
				'off' => 'Not Valid'
			],
			'cancel' => 'Cancel',
			'submit' => 'Register emergency',
			'select-agency' => 'Select an Agency',
			'select-type' => 'Select the type of eventuality',
			'select-contribution' => 'Select the type of Contribution',
			'select-currency' => 'Select a currency',
			'select-cordinator' => 'Select the Coordinator',
			'start_date' => 'Start date',
			'event_date' => 'Date of the event'
		]
	],
	'alerts' => [
		'created' => 'Emergency created successfully.',
		'updated' => 'Successfully modified emergency.',
		'deleted' => 'Emergency successfully eliminated.'
	],
	'not-established' => 'Not established',
];