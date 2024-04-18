<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">
    <div class="col-md-12">
        <div class="from-group">
            {!! Form::label( 'Name', ' Name', array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
            <div class="input-group mb-3">
                <div class="form-control-plaintext">
                    {!! Form::text('name',Input::old('name'),['id'=>'name','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => 'Enter User Name','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                </div>
                <span style="color: #ff0000">{!! $errors->first('name') !!}</span>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="from-group">
                    {!! Form::label(' Mobile', ' Mobile', array('class' => 'form-label')) !!}
                    <span style="color: red">*</span>
                    <div class="input-group mb-3">
                        <div class="form-control-plaintext">
                            {!! Form::text('mobile',Input::old('mobile'),['id'=>'mobile','class' => 'form-control','data-checkify'=>'minlen=11,required,number,maxlen=11','Placeholder' => 'Enter Mobile','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                        </div>
                        <span style="color: #ff0000">{!! $errors->first('mobile') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="from-group">
                    {!! Form::label(' Email', ' Email', array('class' => 'form-label')) !!}
                    <span style="color: red">*</span>
                    <div class="input-group mb-3">
                        <div class="form-control-plaintext">
                            {!! Form::text('email',Input::old('email'),['id'=>'email','class' => 'form-control','Placeholder' => 'Enter email','aria-label' =>'email','aria-describedby'=>'basic-addon2']) !!}
                        </div>
                        <span style="color: #ff0000">{!! $errors->first('email') !!}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="from-group">
            {!! Form::label('Address', 'Address', array('class' => 'form-label')) !!}
{{--            <span style="color: red">*</span>--}}
            <div class="input-group mb-3">
                <div class="form-control-plaintext">
                    {!! Form::textarea('address',Input::old('address'),['id'=>'address','class' => 'form-control','Placeholder' => 'Enter Address','aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>1]) !!}
                </div>
                <span style="color: #ff0000">{!! $errors->first('address') !!}</span>
            </div>
        </div>

        <div class="from-group row">
            <div class="col-md-6">
                {!! Form::label('Organization', 'Organization', array('class' => 'form-label')) !!}
{{--                <span style="color: red">*</span>--}}
                <div class="input-group mb-3">
                    <div class="form-control-plaintext">
                        {!! Form::select('organization_id',$Organization,Input::old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                    </div>
{{--                    <span style="color: #ff0000">{!! $errors->first('organization_id') !!}</span>--}}
                </div>
            </div>

            <div class="col-md-6">
                {!! Form::label('User Roles', 'User Roles', array('class' => 'form-label')) !!}
                <span style="color: red">*</span>
                <div class="input-group mb-3">
                    @if(isset($data))
{{--                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}--}}
                        {!! Form::select('roles[]',$roles,$userRole,['id'=>'roles','multiple'=>'multiple','class' => 'form-select js-example-basic-multiple form-control','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                    @else
                        {!! Form::select('roles[]',$roles,[],['id'=>'roles','multiple'=>'multiple','class' => 'form-select js-example-basic-multiple form-control','aria-label' =>'name','aria-describedby'=>'basic-addon2','required'=>true]) !!}
                    @endif

                    <span style="color: #ff0000">{!! $errors->first('roles') !!}</span>
                </div>
            </div>
        </div>


        <div class="from-group row">
            <div class="col-md-6">

                @if(isset($data))
                    {!! Form::label('Update Password', 'Update Password', array('class' => 'form-label')) !!}
{{--                    <span style="color: red;font-size: 10px;">(If you change password for this user , please enter password, otherwise password field is empty  )</span>--}}
                @else
                    {!! Form::label(' Password', ' Password', array('class' => 'form-label')) !!}
                <span style="color: red">*</span>
                @endif
                <div class="input-group mb-3">
                    <div class="form-control-plaintext">
                        @if(isset($data))
                        {!! Form::text('password','',['id'=>'password','class' => 'form-control','Placeholder' => 'Enter password','aria-label' =>'email','aria-describedby'=>'basic-addon2']) !!}
                        @else
                            {!! Form::text('password',Input::old('password'),['id'=>'password','class' => 'form-control','Placeholder' => 'Enter password','aria-label' =>'email','aria-describedby'=>'basic-addon2','required'=>true]) !!}
                        @endif

                    </div>
                    <span style="color: #ff0000">{!! $errors->first('password') !!}</span>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-4">
{{--        <div class="from-group">--}}
{{--            {!! Form::label('User Image', 'User Image', array('class' => 'form-label','for'=>'formFile')) !!}--}}
{{--            @if(isset($data))--}}
{{--            @else--}}
{{--                <span style="color: red">*</span>--}}
{{--            @endif--}}

{{--            <div class="mb-3">--}}
{{--                <div class="form-image-padding">--}}
{{--                    @if($errors->first('user_image'))--}}
{{--                        <span style="color: #ff0000">{!! $errors->first('user_image') !!}</span>--}}
{{--                    @else--}}
{{--                        <img id="user_image" width="150" height="120"/>--}}
{{--                    @endif--}}

{{--                    @if(isset($data) && $data->user_image !='')--}}
{{--                        <img id="user_image" src="{{ asset('backend/image/UserImage').'/'.$data->user_image}}" width="150" height="120"/>--}}
{{--                    @endif--}}

{{--                </div>--}}

{{--                @if(isset($data))--}}
{{--                    <input class="form-control" accept="image/*" location="update"  name="user_image" type="file" id="file" onchange="loadFile(event)">--}}
{{--                @else--}}
{{--                    <input class="form-control" accept="image/*" location="insert" name="user_image" type="file" id="file" onchange="loadFile(event)">--}}
{{--                @endif--}}


{{--            </div>--}}
{{--        </div>--}}


{{--        <script>--}}
{{--            var loadFile = function(event) {--}}
{{--                var image = document.getElementById('user_image');--}}
{{--                image.src = URL.createObjectURL(event.target.files[0]);--}}
{{--            };--}}
{{--        </script>--}}
{{--    </div>--}}
</div>

<div class="row">
    <div class="col-md-4 offset-md-8">
        <div class="from-group">
            {!! Form::label('Status', 'Status', array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
            <?php
            $Active = '';
            $Inactive = '';
            if (isset($data->status)){
                if ($data->status == 1){
                    $Active = 'checked="checked"';
                }else{
                    $Inactive = 'checked="checked"';
                }
            }else{
                $Active = 'checked="checked"';
            }
            ?>
            <div class="input-group mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadioActive" value="1" {{$Active}}>
                    <label class="form-check-label" for="inlineRadioActive">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input  class="form-check-input" type="radio" name="status" id="inlineRadioInactive" value="0" {{$Inactive}}>
                    <label class="form-check-label" for="inlineRadioInactive">Inactive</label>
                </div>
                <span style="color: #ff0000">{!! $errors->first('status') !!}</span>
            </div>
        </div>

    </div>
</div>




<div class="row">

    <div class="col-md-12" style="text-align: right;">
        <div class="from-group">
            <div class="">
                <button type="reset" class="btn submit-button">Reset</button>
                <button type="submit" class="btn submit-button" id="UserFormSubmit">Submit</button>
            </div>
        </div>
    </div>

</div>
