@if(is_null(old('sessions')))

    <div class=" form-layout-4 cloned-row cloned">
        <hr>
        <div class="row">

            @include('form.input',['type'=>'text','name'=>"sessions[0][content]",'value'=> null,
            'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Session content'),'placeholder'=>trans('courses.Session content')]])

            @include('form.input',['type'=>'date','name'=>"sessions[0][date]",'value'=> null,
            'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session date'),'placeholder'=>trans('courses.Session date'),'required'=>'required']])
        </div>
        <div class="row">
            @include('form.input',['type'=>'time','name'=>'sessions[0][start_time]','value'=> null,
            'attributes'=>['class'=>'form-control timepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session start time'),'placeholder'=>trans('courses.Session start time'),'required'=>'required']])

            @include('form.input',['type'=>'time','name'=>'sessions[0][end_time]','value'=> null,
            'attributes'=>['class'=>'form-control timepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session end time'),'placeholder'=>trans('courses.Session end time'),'required'=>'required']])
        </div>
    </div>

    <hr>
    <div class="form-layout-footer mg-t-15">
        <button id="more" class="btn btn-warning bd-2 more-sessions">
            {{ trans('app.Add more sessions') }}
            <i class="fa fa-plus"></i>
        </button>
    </div>

@elseIf(old('sessions'))

    @foreach(old('sessions') as $key => $session)
        <div class=" form-layout-4  cloned-row cloned">
            <hr>
            <div class="row">

            @include('form.input',['type'=>'text','name'=>"sessions[{$key}][content]",'value'=> null, 'error_name'    => "sessions.{$key}.content",
            'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Session content'),'placeholder'=>trans('courses.Session content')]])

            @include('form.input',['type'=>'date','name'=>"sessions[{$key}][date]",'value'=> null, 'error_name'    => "sessions.{$key}.date",
            'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session date'),'placeholder'=>trans('courses.Session date'),'required'=>'required']])
            </div>
            <div class="row">
            @include('form.input',['type'=>'time','name'=>"sessions[{$key}][start_time]",'value'=> null, 'error_name'    => "sessions.{$key}.start_time",
            'attributes'=>['class'=>'form-control timepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session start time'),'placeholder'=>trans('courses.Session start time'),'required'=>'required']])

            @include('form.input',['type'=>'time','name'=>"sessions[{$key}][end_time]",'value'=> null, 'error_name'    => "sessions.{$key}.end_time",
            'attributes'=>['class'=>'form-control timepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session end time'),'placeholder'=>trans('courses.Session end time'),'required'=>'required']])
            </div>
            @if(! in_array($key, [0, 1]))
                <button class="btn btn-danger delete" id="delete"><i class="fa fa-minus" aria-hidden="true"></i>
                </button>
            @endif

        </div>

        @if($loop->last)
            <hr>
            <div class="form-layout-footer mg-t-15">
                <button id="more"
                        class="btn btn-warning bd-2 more-answers">{{ trans('app.Add more sessions') }}</button>
            </div>
        @endif

    @endforeach

@endif


@push('js')

    <script>
        var removeButton =
            ('<button class="btn btn-danger delete" id="delete">'
                + '<i class="fa fa-minus" aria-hidden="true"></i></button>');

        $("#more").click(function (e) {
            e.preventDefault();
            var clonedRow = $(".cloned:last").clone();
            clonedRow.find(".more-time, .text-danger, .delete").remove();
            clonedRow.append(removeButton);
            clonedRow.find('.cloned_input').val('');
            clonedRow.insertAfter(".cloned:last");

            clonedRow.find('input').each(function () {
                this.name = this.name.replace(/\[(.*?)\]/, function (n) {
                    // remove the pracket
                    n = n.substr(1)
                    // remove the closing pracket
                    n = n.substr(0, n.length - 1)
                    // increment index
                    n++;

                    // return formatted index
                    return "[" + n + "]";
                });

                console.log(this.name);
            });

            $('.nowdatepicker').daterangepicker({
                minDate: today,
                singleDatePicker: true,
                singleClasses: "picker_2",
                locale: {
                    format: 'YYYY-MM-DD'
                },
                autoUpdateInput: false
            }).on("apply.daterangepicker", function (e, picker) {
                picker.element.val(picker.startDate.format(picker.locale.format));
            });

            $('.timepicker').timepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                timePickerSeconds: true,
                singleDatePicker: true,
                locale: {
                    format: 'HH:MM'
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            });
        });

        $('body').on('click', '#delete', function (e) {
            e.preventDefault();
            $(this).parent().remove();
            return false;
        });

    </script>

@endpush
