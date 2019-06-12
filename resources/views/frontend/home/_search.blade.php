{!! Form::open(['route' => 'home.community', 'method' => 'GET']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('city_from_id', transm('posts.city_from_id')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    {!! Form::select('city_from_id', array_get($params, 'listCities'), Request::get('city_from_id'), ['class' => 'form-control select-fake', 'placeholder' => transm('posts.city_from_id'), 'data-action' => route('frontend.districts.get_districts_by_city'), 'data-token' => csrf_token(), 'data-id' => 'district_from_id', 'onchange' => 'PostsController.getDistricts(this);']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('district_from_id', transm('posts.district_from_id')) !!}
                <div class="input-group" id="district_from_id">
                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                    {!! Form::select('district_from_id', array_get($params, 'listDistrictsFrom'), Request::get('district_from_id'), ['class' => 'form-control select-fake', 'placeholder' => transm('posts.district_from_id')]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('city_to_id', transm('posts.city_to_id')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    {!! Form::select('city_to_id', array_get($params, 'listCities'), Request::get('city_to_id'), ['class' => 'form-control select-fake', 'placeholder' => transm('posts.city_to_id'), 'data-action' => route('frontend.districts.get_districts_by_city'), 'data-token' => csrf_token(), 'data-id' => 'district_to_id', 'onchange' => 'PostsController.getDistricts(this);']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('district_to_id', transm('posts.district_to_id')) !!}
                <div class="input-group" id="district_to_id">
                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                    {!! Form::select('district_to_id', array_get($params, 'listDistrictsTo'), Request::get('district_to_id'), ['class' => 'form-control select-fake', 'placeholder' => transm('posts.district_to_id')]) !!}
                </div>
            </div>
        </div>
    </div>

    <div id="search_schedule" class="row {{ !frontendGuard()->check() || frontendGuard()->user()->isCarOwner() ? 'hidden' : '' }}">
        <div class="col-md-6">
            <div class="form-group">
                <label>Tỉnh/Thành phố đi qua (lịch trình)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    {!! Form::select('schedule_city_id', array_get($params, 'listCities'), Request::get('schedule_city_id'), ['class' => 'form-control select-fake', 'placeholder' => transm('posts.city_to_id'), 'data-action' => route('frontend.districts.get_districts_by_city'), 'data-token' => csrf_token(), 'data-id' => 'schedule_district_id', 'onchange' => 'PostsController.getDistricts(this);']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Huyện/Quận đi qua (lịch trình)</label>
                <div class="input-group" id="schedule_district_id">
                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                    {!! Form::select('schedule_district_id', array_get($params, 'listDistrictsTo'), Request::get('schedule_district_id'), ['class' => 'form-control select-fake', 'placeholder' => transm('posts.district_to_id')]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('type', transm('posts.type')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                    @if (frontendGuard()->check())
                        @php
                            $postType = frontendGuard()->user()->isCarOwner() ? getConfig('user_type_passenger') : getConfig('user_type_car_owner');
                            if (!empty(Request::get('type'))) {
                                $postType =  Request::get('type');
                            }
                        @endphp
                        {!! Form::select('type', getConfig('post_type'), $postType, ['class' => 'form-control', 'onchange' => 'PostsController.displaySchedule(this)']) !!}
                    @else
                        {!! Form::select('type', getConfig('post_type'), Request::get('type'), ['class' => 'form-control', 'placeholder' => getConfig('select_default'), 'onchange' => 'PostsController.displaySchedule(this)']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('car_type', transm('posts.car_type')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                    {!! Form::select('car_type', getConfig('car_type'), Request::get('car_type'), ['class' => 'form-control', 'placeholder' => getConfig('select_default')]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-bottom">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('date_start', transm('posts.date_start')) !!}
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('date_start', Request::get('date_start'), ['class' => 'form-control pull-right datetimepicker', 'placeholder' => transm('posts.date_start')]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <p>
                <label for="amount">{{transm('posts.cost')}}: </label>
                <span id="amount" style="color:rgb(96, 125, 139); font-weight:bold;">
                    {{getMessage('home_search_cost', [
                        'min' => Request::get('min_cost') ? Request::get('min_cost') : getConfig('cost_search.min'),
                        'max' => Request::get('max_cost') ? Request::get('max_cost') : getConfig('cost_search.max'),
                    ])}}
                </span>
            </p>
            <div id="slider-range"></div>
            <input type="hidden" name="min_cost" id="amount1" value="0">
            <input type="hidden" name="max_cost" id="amount2" value="10">
        </div>
    </div>

    <div class="row padding-bottom">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('seats', transm('posts.seats')) !!}
                <div class="input-group" style="display: inline-flex; width: 100%;  ">
                    {!! Form::input('number', 'min_seat', Request::get('min_seat'), ['class' => 'form-control', 'placeholder' => transm('posts.seats'), 'style' => '']) !!}
                    <p style="padding: 5px">~</p>
                    {!! Form::input('number', 'max_seat', Request::get('max_seat'), ['class' => 'form-control', 'placeholder' => transm('posts.seats'), 'style' => '']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>

    <div class="row padding-bottom">
        <div class="col-md-12">
            <button type="submit" class="w3-button w3-theme"><i class="fa fa-search"></i> &nbsp;{{transa('search')}}</button> 
        </div>
    </div>
{!! Form::close() !!}