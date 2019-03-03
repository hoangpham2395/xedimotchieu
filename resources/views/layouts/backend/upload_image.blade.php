@php 
    $image = ($image) ? $image : 'image';
    $sessionImage = 'current_file_name';
    $urlImage = null;

    if (isset($entity)) {
        $urlImage = $entity->getUrlAvatar();
    }

    if (Session::has($sessionImage)) {
        $urlImage = getTmpUrl() . '/' . Session::get($sessionImage);
    }
@endphp

<div class="input-group">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        @if ($urlImage)
        <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 200px;">
            <img src="{{ $urlImage }}" alt="Avatar">
        </div>
        @endif
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 200px;"></div>
        <div>
            <span class="btn btn-default btn-file">
                <span class="fileinput-new">Select image</span>
                <span class="fileinput-exists">Change</span>
                <!-- Must have data-name and data-name is same name -> upload success  -->
                <input type="file" name="{{$image}}">
                <!-- Get name file input for base controller -->
                <input type="hidden" name="{{ getConstant('FILE_INPUT_NAME') }}" value="{{$image}}">
            </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
    </div>
</div>