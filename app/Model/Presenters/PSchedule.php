<?php
namespace App\Model\Presenters;

/**
 * Trait PSchedule
 * @package App\Model\Presenters
 */
trait PSchedule
{
    public function getPlace()
    {
        if (empty($this->district_id)) {
            return $this->city->city_name;
        }

        return $this->district->district_name . ' - ' . $this->city->city_name;
    }
}