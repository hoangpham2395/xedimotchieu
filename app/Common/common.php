<?php
if (! function_exists('getConstant')) {
    /**
     * @param $key
     * @param null $default
     * @return \Illuminate\Config\Repository|mixed
     */
    function getConstant($key, $default = null)
    {
        return config('constant.' . $key, $default);
    }
}

if (! function_exists('getMessage')) {
    /**
     * @param $key
     * @param array $params
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function getMessage($key, $params = [])
    {
        return trans('messages.' . $key, $params);
    }
}

if (! function_exists('getConfig')) {
    /**
     * @param $key
     * @param null $default
     * @return \Illuminate\Config\Repository|mixed
     */
    function getConfig($key, $default = null)
    {
        return config('config.' . $key, $default);
    }
}

if (! function_exists('backendGuard')) {
    /**
     * @return mixed
     */
    function backendGuard()
    {
        return Auth::guard('web');
    }
}

if (! function_exists('frontendGuard')) {
    /**
     * @return mixed
     */
    function frontendGuard()
    {
        return Auth::guard('frontend');
    }
}

if (! function_exists('getCurrentAdmin')) {
    /**
     * @return mixed
     */
    function getCurrentAdmin()
    {
        return backendGuard()->user();
    }
}

if (! function_exists('getCurrentAdminId')) {
    /**
     * @return mixed
     */
    function getCurrentAdminId()
    {
        return backendGuard()->user()->id;
    }
}

if (! function_exists('getAvatarDefault')) {
    /**
     * @return string
     */
    function getAvatarDefault()
    {
        return asset(getConfig('avatar_default'));
    }
}

if (! function_exists('getNoImage')) {
    /**
     * @return string
     */
    function getNoImage()
    {
        return asset(getConfig('no_image'));
    }
}

if (! function_exists('getTmpUrl')) {
    /**
     * @return string
     */
    function getTmpUrl()
    {
        return asset(getConfig('url_tmp'));
    }
}

if (! function_exists('getMediaUrl')) {
    /**
     * @param null $alias
     * @return string
     */
    function getMediaUrl($alias = null)
    {
        $url = asset(getConfig('url_media'));
        if (!$alias) {
            return $url;
        }
        return $url . '/' . $alias;
    }
}

if (! function_exists('getCurrentUser')) {
    /**
     * @return mixed
     */
    function getCurrentUser()
    {
        return Auth::user();
    }
}

if (! function_exists('transm')) {
    /**
     * @param $key
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transm($key)
    {
        return trans('model.' . $key);
    }
}

if (! function_exists('transb')) {
    /**
     * @param $key
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transb($key)
    {
        return trans('breadcrumb.' . $key);
    }
}

if (! function_exists('logError')) {
    /**
     * @param $message
     * @param array $context
     */
    function logError($message, array $context = [])
    {
        // try {
        // 	ChannelLog::error('error', $message, $context);
        // } catch (\Exception $e) {

        // }
    }
}

if (! function_exists('transa')) {
    /**
     * @param $key
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transa($key)
    {
        return trans('action.' . $key);
    }
}

if (! function_exists('getBackendAlias')) {
    /**
     * @return mixed
     */
    function getBackendAlias()
    {
        return env('BACKEND_ALIAS', 'management');
    }
}

if (! function_exists('getFrontendAlias')) {
    /**
     * @return mixed
     */
    function getFrontendAlias()
    {
        return env('FRONTEND_ALIAS', 'client');
    }
}

if (! function_exists('rjust')) {
    /**
     * @param $string
     * @param $totalLength
     * @param string $fillChar
     * @return string
     */
    function rjust($string, $totalLength, $fillChar = ' ')
    {
        return str_pad($string, $totalLength, $fillChar, STR_PAD_RIGHT);
    }
}

if (! function_exists('ljust')) {
    /**
     * @param $string
     * @param $totalLength
     * @param string $fillChar
     * @return string
     */
    function ljust($string, $totalLength, $fillChar = ' ')
    {
        return str_pad($string, $totalLength, $fillChar, STR_PAD_LEFT);
    }
}

if (!function_exists('randomString')) {
    function randomString($length = 8) {
        $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($string, 5)), 0, $length);
    }
}

if (!function_exists('isElementInString')) {
    function isElementInString($element, $string) 
    {
         if (empty(strstr($string, $element))) {
              return false;
         }
         return true;
    }
}