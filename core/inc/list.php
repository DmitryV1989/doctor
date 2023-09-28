<?

// $CORE['LIST']

return [
	'time' => [
		// рабочий день
		'work' => [
			'start' => strtotime('10:00'),
			'end' => strtotime('19:00')
		],
		// перерыв
		'break' => [
			'start' => strtotime('12:00'),
			'end' => strtotime('13:00')
		],
		'interval' => "+30 minute"	
	],
	'day' => [
		'start' => '+1 Day', // начало приёма со следующего дня относительно нынешней даты
		'step' => 'P1D', // интервал дней приёма, каждый день от первого до крайнего дня
		'count' => '+7 Day' // крайний возможный для приёма день относительно нынешней даты
	],
	'sex' => [
		1 => 'мужской',
		2 => 'женский'
	],
	'visit_status' => [
		0 => [ // индекс является значением для поля visit_status в таблице History
			'label' => 'ещё не прошло',
			'color' => 'white'
		],
		1 => [
			'label' =>	'явка',
			'color' => '#C0C0C0'
		],
		2 => [
			'label' => 'неявка',
			'color' => 'pink'
		]
	],
	'present' => [
		0 => 'black',
		1 => 'green'
	],
	'photo' => [ // $CORE['LIST']['photo']
		'limit_width' => 600,
		'limit_height' => 600,
		'min_width' => 100,
		'min_height' => 100
	],
	'refresh' => 3
];
?>