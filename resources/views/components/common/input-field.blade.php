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
    <input {{$attributes->class(['form-control'])->merge(['type' => 'text'])}} id="{{ $name }}" name="{{ $name }}" type="text" placeholder="{{ $placeholder }}" value="{{ old($name) ? old($name) : $value }}">
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>