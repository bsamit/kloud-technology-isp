@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false
])
<div class="col-xxl-{{$column}} col-sm-{{$column}}">
    @if($label)
        <label class="col-form-label" for="{{ $name }}"><strong>{{$label}}</strong> <span class='font-danger'>{{$required ? "*" : ''}} </strong> </span></label>
    @endif
    <input class="form-control flatpickr-input" name="{{$name}}" id="human-friendly" type="hidden" value="{{ old($name) ? old($name) : $value }}">
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>