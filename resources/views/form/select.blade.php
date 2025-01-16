<div class="form-group {{$attributes['col-class'] ??''}}">
    <label class="control-label col-6" for="exampleFormControlSelect1" >
        {{ @$attributes['label'] }}
        <span class="tx-danger" style="color: red">{{ (@$attributes['required'])?'*':'' }} {{ (@$attributes['stared'])?'*':'' }}</span>
    </label>
    <div class="col-12">
        @php
            $attributes['autocomplete']='off';
        @endphp
        {!! Form::select($name, $options,(@$row->$name)?:(@$value), $attributes) !!}
        @php
            $name=(isset($error_name))?$error_name:$name;
        @endphp

        @if(@$errors)
            @php
                $name=(isset($error_name))?$error_name:$name;
            @endphp
            <ul class="parsley-errors-list filled">
                @foreach($errors->get($name) as $message)
                    <li class="parsley-required text-danger">{{ $message }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

