<div class="form-group {{$attributes['col-class'] ??''}}">
<label class="col-6 form-control-label">{{ @$attributes['label'] }}
    <span class="tx-danger" style="color: red">{{ (@$attributes['required'])?'*':'' }} {{ (@$attributes['stared'])?'*':'' }}</span>
</label>
    <div class="col-12">
        @php
            $attributes['style']=@$attributes['style'];
            $attributes['multiple'] = 'multiple';
        @endphp
        {!! Form::select($name, $options,(@$row->$name)?:(isset($old_values)?$old_values:@$value), $attributes) !!}
        @php
            $name=(isset($error_name))?$error_name:$name;
        @endphp

        @if(@$errors)
            @foreach($errors->get($name) as $message)
                <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach
        @endif
    </div>
</div>

