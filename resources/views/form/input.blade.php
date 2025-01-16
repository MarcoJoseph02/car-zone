<div class="form-group {{$attributes['col-class'] ??''}}">
    <div class="row">
        <label class="control-label col-6" for="example-text-input">
            {{ @$attributes['label'] }}
            <span class="tx-danger" style="color: red">{{ (@$attributes['required'])?'*':'' }} {{ (@$attributes['stared'])?'*':'' }}</span>
        </label>
        <div class="col-12">
            @php
                $attributes['autocomplete']='off';
                if($type == "textarea"){
                    $attributes['class'] .= ' summernote';
                            }
            @endphp
            {!! Form::$type($name, isset($value) ? $value : $row->$name ?? '', $attributes)!!}
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
</div>

