<?php
namespace App\Model\Presenters;

trait PUser
{
    public function getOpenFlag()
    {
        return $this->open_flag;
    }
}