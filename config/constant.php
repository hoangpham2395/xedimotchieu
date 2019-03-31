<?php
return [
	'APP_NAME' => env('APP_NAME', 'Xe đi một chiều'),
    'BACKEND_NAME' => env('BACKEND_NAME', 'XeDiMotChieu'),
	'APP_NAME_SHORT' => 'XE',
    'PER_PAGE' => 10,
    'DEL_FLAG' => [
    	'ACTIVE' => 0,
    	'DELETED' => 1,
    	'FIELD' => 'del_flag',
    ],
    'SORT_FIELD' => 'id',
    'SORT_TYPE' => 'DESC',
    'FILE_INPUT_NAME' => 'file_input',
    'OPEN_FLAG_ACTIVE' => 1,
    'OPEN_FLAG_NO_ACTIVE' => 0,
    'CHAT_UNREAD' => 0,
    'CHAT_READ' => 1,
];
?>