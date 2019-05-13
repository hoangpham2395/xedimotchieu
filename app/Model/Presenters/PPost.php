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

	public function carType() 
	{
		if (!empty($this->user)) {
			return $this->user->isCarOwner() && !empty($this->car) ? $this->car->car_type : $this->car_type;
		}

		return (!empty($this->car) && !empty($this->car_id)) ? $this->car->car_type : $this->car_type;
	}

	public function getCarType() 
	{
		return getConfig('car_type.' . $this->carType());
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
    	return !empty($this->user) ? $this->user->name : '';
    }

    public function getUrlChat() 
    {
    	return (!empty($this->user) && !empty($this->user->fb_id)) ? getConfig('link_messager').$this->user->fb_id : route('frontend.chat.index');
    }

    public function getSeats() 
    {
    	return ($this->carType() == getConfig('user_type_car_owner')) ? $this->seats . ' chỗ ngồi' : $this->seats . ' chỗ trống';
    }

    public function getCarName() 
    {
    	return (!empty($this->car)) ? $this->car->car_name : '';
    }
}