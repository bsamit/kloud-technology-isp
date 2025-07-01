@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false,
    'extension' => 'image/png, image/jpeg',
])
<div class="col-xxl-{{$column}} col-sm-{{$column}}">
    @if($label)
        <label class="form-label" for="{{ $name }}"><strong>{{$label}}</strong> <span class='font-danger'>{{$required ? "*" : ''}} </strong> </span></label>
    @endif
    <input name="{{ $name }}" id="formFile" {{$attributes->class(['form-control'])->merge(['type' => 'file'])}} accept="{{$extension}}" value="{{$value}}">
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>