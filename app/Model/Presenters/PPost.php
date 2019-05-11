<?php
namespace App\Model\Presenters;

trait PPost 
{
	public function getPlace() 
	{
		return $this->districtFrom->district_name . ' - ' . $this->cityFrom->city_name . ' -> ' . $this->districtTo->district_name . ' - ' . $this->cityTo->city_name;
	}

	public function getPlaceFrom() 
	{
		return $this->districtFrom->district_name . ' - ' . $this->cityFrom->city_name;
	}

	public function getPlaceTo() 
	{
		return $this->districtTo->district_name . ' - ' . $this->cityTo->city_name;
	}

	public function getCarType() 
	{
		return $this->user->isCarOwner() ? $this->car->getCarType() : getConfig('car_type.' . $this->car_type);
	}

	public function getDateStart() 
	{
		return date('H\hi - d/m/Y', strtotime($this->date_start));
	}

	public function getPostType() 
	{
		return getConfig('post_type.' . $this->type);
	}

	public function getCost() 
	{
		return number_format($this->cost, 0, '', ',') . ' VND';
	}

	public function showImage() 
	{
		return !empty($this->image) ? '<img src="'.url($this->image).'" style="max-height: 200px;" alt="Nature" class="w3-margin-bottom">' : '';
	}

	public function getUrlImage() 
    {
        return (!$this->image || !file_exists(public_path($this->image))) ? getNoImage() : asset($this->image);
    }

    public function isOwner() 
    {
    	if (!frontendGuard()->check()) {
    		return false;
    	}

    	return $this->user_id == frontendGuard()->user()->id;
    }

    public function getUserName() 
    {
    	return $this->user->name;
    }
}