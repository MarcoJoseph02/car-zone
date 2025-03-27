{{-- @if(isset($row))
    <div class="form-group">
        <label for="name" class="form-control-label">{{ trans('users.Type') }}</label> :
        <span style="font-size: 16px; font-weight: bold; color: black;">( {{ trans('users.' . $row->type) }} )</span>
    </div>
@else
    @include('form.select',['name'=>'type','options'=> $userType , $row->type ?? null ,'attributes'=>['id'=>'type','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('users.Type'),'placeholder'=>trans('users.Type')]])
@endif
@php
    $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.First name'),'placeholder'=>trans('users.First name') ];
@endphp
@include('form.input',['type'=>'text','name'=>'first_name','value'=> $row->first_name ?? null,'attributes'=>$attributes, ])
@php
    $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Last name'),'placeholder'=>trans('users.Last name')];
@endphp
@include('form.input',['type'=>'text','name'=>'last_name','value'=> $row->last_name ?? null,'attributes'=>$attributes])
@php
    $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Mobile'),'placeholder'=>trans('users.Mobile'),'id'=>'mobile','dir' => 'ltr'];
@endphp
@include('form.input',['type'=>'text','name'=>'mobile','value'=> $row->mobile ?? null,'attributes'=>$attributes])
@php
    $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Email'),'placeholder'=>trans('users.Email')];
@endphp
@include('form.input',['type'=>'text','name'=>'email','value'=> $row->email ?? null,'attributes'=>$attributes])
@if(isset($row->id))
    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Password'),'placeholder'=>trans('users.Password')];
    @endphp

    @include('form.password',['name'=>'password','attributes'=>$attributes])
    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Password confirmation'),'placeholder'=>trans('users.Password confirmation')];
    @endphp

    @include('form.password',['name'=>'password_confirmation','attributes'=>$attributes])
@endif


<span id="type-instructor" class="row"
      style="display: @if((isset($row) && $row->type == \App\Modules\Users\UserEnums::INSTRUCTOR_TYPE)||old('type') ==\App\Modules\Users\UserEnums::INSTRUCTOR_TYPE)  block @else none  @endif ">
        @include('form.input',['type'=>'textarea','name'=>'about_instructor','value'=> $relation->about_instructor ?? null,
            'attributes'=>['class'=>'form-control','col-class'=>"col-md-12",'label'=>trans('users.about_instructor'),'placeholder'=>trans('users.about_instructor') , 'id'=>'about_instructor']])
    </span>
@php
    $attributes=[
        'class'=>'form-control',
    'col-class'=>"col-md-6",
    'id'=>'profile_picture',
    'label'=>trans('users.Profile Picture') . ' (' . trans('users.image dimensions') . ')',
     'accept'=>'image/png, image/jpg, image/jpeg'
     ];
@endphp
@include('form.file',['name'=>'profile_picture','value'=>$row->profile_picture ?? null,'attributes'=>$attributes ])

@php
    $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Is active') .' *'];
@endphp
@include('form.boolean',['name'=>'is_active','value'=>$row->is_active ?? null,'attributes'=>$attributes])
@push('js')
    <script>
        let typeSelector = $('#type');
        $(document).ready(function () {
            typeSelector.on('change', function () {
                if ($(this).val() == '{{ \App\Modules\Users\UserEnums::INSTRUCTOR_TYPE }}') {
                    $('#type-instructor').css('display', 'block');
                } else {
                    $('#type-instructor').css('display', 'none');
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const phoneInputField = document.querySelector("#mobile");
        const phoneInput = window.intlTelInput(phoneInputField, {
            onlyCountries: ["sa"],
            customContainer: "col-12",
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            // Get the full phone number with the country code
            const fullNumber = phoneInput.getNumber();
            // Set the full number value to the hidden input field
            phoneInputField.value = fullNumber;
        });
    </script>
@endpush
 --}}

 @php
    $attributes = ['class' => 'form-control', 'col-class' => "col-md-12"];
    
    $fields = [
        'fname' => ['label' => "First Name", 'placeholder' => "Enter First Name", 'type' => 'text'],
        'lname' => ['label' => "Last Name", 'placeholder' => "Enter Last Name", 'type' => 'text'],
        'email' => ['label' => "Email", 'placeholder' => "Enter Email", 'type' => 'email'],
        //'password' => ['label' => "Password", 'placeholder' => "Enter Password", 'type' => 'password'],
        'phone_no' => ['label' => "Phone Number", 'placeholder' => "Enter Phone Number", 'type' => 'text'],
        'address' => ['label' => "Address", 'placeholder' => "Enter Address", 'type' => 'text'],
        //'otp' => ['label' => "OTP", 'placeholder' => "Enter OTP", 'type' => 'text','nullable' => true],
    ];
@endphp

@foreach($fields as $name => $details)
    @include('form.input', [
        'type' => $details['type'],
        'name' => $name,
        'value' => $row->$name ?? null,
        'attributes' => array_merge($attributes, [
            'label' => $details['label'],
            'placeholder' => $details['placeholder']
        ])
    ])
@endforeach
