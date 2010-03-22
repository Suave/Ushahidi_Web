<?php

$lang = array
(
	'parent_id' => array
	(
		'required'		=> '父栏目是必填项',
		'numeric'		=> '父栏目必须是数字',
		'exists'		=> '父栏目不存在',
		'same'			=> '不能与父栏目相同',
	),
	
	'category_title' => array
	(
		'required'		=> '标题是必填项',
		'length'		=> '标题必须在3至80个字符之间',
	),
	
	'category_description' => array
	(
		'required'		=> 'The description field is required.'
	),	
	
	'category_color' => array
	(
		'required'		=> 'The color field is required.',
		'length'		=> 'The color field must be 6 characters long.',
	),
	
	'category_image' => array
	(
		'valid'		=> 'The image field does not appear to contain a valid file',
		'type'		=> 'The image field does not appear to contain a valid image. The only accepted formats are .JPG, .PNG and .GIF.',
		'size'		=> 'Please ensure that image uploads sizes are limited to 50KB.'
	),	
);