<?php 

namespace App\Model\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Base extends Model
{
	protected $_alias;

	public function getAlias()
    {
        return $this->_alias;
    }

    public function setAlias($alias)
    {
        $this->_alias = $alias;
    }
}