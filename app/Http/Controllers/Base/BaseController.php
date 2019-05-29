<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/**
 * Class BaseController
 * @package App\Http\Controllers\Base
 */
class BaseController extends Controller
{
    /**
     * @var
     */
    protected $_alias;
    /**
     * @var
     */
    protected $_reposiroty;
    /**
     * @var
     */
    protected $_validator;

    /**
     * @param $repository
     */
    public function setRepository($repository)
    {
        $this->_reposiroty = $repository;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->_reposiroty;
    }

    /**
     * @param $validator
     */
    public function setValidator($validator)
    {
        $this->_validator = $validator;
    }

    /**
     * @return mixed
     */
    public function getValidator()
    {
        return $this->_validator;
    }

    /**
     * @param $alias
     */
    public function setAlias($alias)
    {
        $this->_alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->_alias;
    }

    /**
     * @param $fileName
     * @param $link
     */
    public function uploadToTmp($fileName, $link)
    {
        Storage::disks('tmp')->put($fileName, $link);
    }

    /**
     * @return int
     */
    public function getNextId()
    {
        try {
            $statement = DB::select("show table status like '". $this->getAlias() ."'");
            return !empty($statement[0]) ? array_get($statement, 0)->Auto_increment : 0;
        } catch (\Exception $e) {
            logError($e);
            return 0;
        }
   }
}