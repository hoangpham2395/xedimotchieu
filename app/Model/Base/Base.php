<?php 

namespace App\Model\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 * @package App\Model\Base
 */
class Base extends Model
{
    /**
     * @var
     */
    protected $_alias;

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->_alias;
    }

    /**
     * @param $alias
     */
    public function setAlias($alias)
    {
        $this->_alias = $alias;
    }
}