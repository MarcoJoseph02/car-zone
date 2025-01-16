@foreach($rows as $key=>$value)
    @foreach($value as $row)
        @if($row->field_type == 'file')
            @include('form.file', ['name' => 'input_'.$row->id, 'attributes' => ['class' => 'form-control custom-file-input', 'col-class' => "col-md-6", 'label' => $row->label, 'value' => $row->value, 'id' => 'input_'.$row->id]])
        @elseif($row->field == 'phone')
            @include('form.input', ['type' => $row->field_type, 'name' => 'input_'.$row->id, 'value' => $row->value, 'attributes' => ['class' => 'form-control '.$row->field_class, 'col-class' => "col-md-6", 'label' => $row->label, $row->field, 'id' => 'mobile','dir' => 'ltr','minlength'=>'10' ,'maxlength'=>'10']])
        @elseif($row->field == 'app_in_review')
            @include('form.boolean', ['name' => 'input_'.$row->id, 'value' => (boolean) $row->value, 'attributes' => ['class' => 'form-control '.$row->field_class, 'col-class' => "col-md-6", 'label' => $row->label]])
        @else
            @if($row->has_translation == 1)
                @include('form.input', ['type' => $row->field_type, 'name' => 'input_'.$row->id.'_en', 'value' => $row->translateOrNew('en')->value, 'attributes' => ['class' => 'form-control '.$row->field_class, 'col-class' => "col-md-6", 'label' => $row->label.' (EN)', $row->field]])
                @include('form.input', ['type' => $row->field_type, 'name' => 'input_'.$row->id.'_ar', 'value' => $row->translateOrNew('ar')->value, 'attributes' => ['class' => 'form-control '.$row->field_class, 'col-class' => "col-md-6", 'label' => $row->label.' (AR)', $row->field]])
            @else
                @include('form.input', ['type' => $row->field_type, 'name' => 'input_'.$row->id, 'value' => $row->value, 'attributes' => ['class' => 'form-control '.$row->field_class, 'col-class' => "col-md-6", 'label' => $row->label, $row->field]])
            @endif
        @endif
    @endforeach
@endforeach
@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const phoneInputField = document.querySelector("#mobile");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "sa", // Set the initial country to Saudi Arabia
            onlyCountries: ["sa"],
            customContainer: "col-12",
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        phoneInputField.closest('div').classList.add('col-md-12');

        document.querySelector('form').addEventListener('submit', function (e) {
            // Get the full phone number with the country code
            const fullNumber = phoneInput.getNumber();
            // Set the full number value to the hidden input field
            phoneInputField.value = fullNumber;
        });
    </script>
@endpush
