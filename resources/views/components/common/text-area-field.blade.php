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
        <label class="form-label" for="{{ $name }}"><strong>{{$label}}</strong> <span class='font-danger'>{{$required ? "*" : ''}} </strong> </span></label>
    @endif
    <textarea {{$attributes->class(['form-control'])}} id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" >{{ old($name) ? old($name) : $value }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>