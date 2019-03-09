<?php

function getConstant($key, $default = null)
{
	return config('constant.' . $key, $default);
}

function getMessaage($key, $params = []) 
{
	return trans('messages.' . $key, $params);
}

function getMessage($key, $params = []) 
{
	return trans('messages.' . $key, $params);
}

function getConfig($key, $default = null) 
{
	return config('config.' . $key, $default);
}

function backendGuard() 
{
	return Auth::guard('web');
}

function frontendGuard() 
{
	return Auth::guard('frontend');
}

function getCurrentAdmin() 
{
	return backendGuard()->user();
}

function getCurrentAdminId() 
{
	return backendGuard()->user()->id;
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

function transm($key)
{
	return trans('model.' . $key);
}

function transb($key) 
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

function transa($key) 
{
	return trans('action.' . $key);
}

function getBackendAlias() 
{
	return env('BACKEND_ALIAS', 'management');
}