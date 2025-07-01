@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false,
    'options' => [],
    'placeholder_text' => 'Select Option',
])
<div class="col-xxl-{{$column}} col-sm-{{$column}}">
    @if($label)
        <div for="{{ $name }}" class="col-form-label pt-0">
            <strong>{{$label}}</strong> <span class='font-danger'>{{$required ? "*" : ''}}</span>
        </div>
    @endif
    <select class="js-example-basic-single col-sm-12 job-select2" id="{{ $name }}" name="{{$name}}" aria-invalid="false">
        <optgroup label="{{$placeholder_text}}">
            @foreach($options as $option)
                <option value="{{ gv($option, 'id') ?: '' }}" {{ !gv($option, 'id') ? 'disabled' : '' }} {{ old($name) == gv($option, 'id') ? '' : ($value == gv($option, 'id') ? 'selected' : '') }}>
                    {{ gv($option, 'name') }}
                </option>
            @endforeach
        </optgroup>
    </select>
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>