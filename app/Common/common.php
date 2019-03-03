<?php

function getConstant($key, $default = null)
{
	return config('constant.' . $key, $default);
}

function getMessaage($key) 
{
	return trans('messages.' . $key);
}

function getConfig($key, $default = null) 
{
	return config('config.' . $key, $default);
}

function getCurrentAdmin() 
{
	return Auth::user();
}

function getCurrentAdminId() 
{
	return Auth::user()->id;
}

function getAvatarDefault()
{
	return asset(getConfig('avatar_default'));
}

function getNoImage() 
{
	return asset(getConfig('no_image'));
}

function getTmpUrl() 
{
	return asset(getConfig('url_tmp'));
}

function getMediaUrl($alias = null) 
{
	$url = asset(getConfig('url_media'));
	if (!$alias) {
		return $url;
	}
	return $url . '/' . $alias;
}

function getCurrentUser() 
{
	return Auth::user();
}

function getTitle($key)
{
	return trans('model.' . $key);
}

function getBreadcrumb($key) 
{
	return trans('breadcrumb.' . $key);
}

function logError($message, array $context = [])
{
	// try {
	// 	ChannelLog::error('error', $message, $context);
	// } catch (\Exception $e) {

	// }
}