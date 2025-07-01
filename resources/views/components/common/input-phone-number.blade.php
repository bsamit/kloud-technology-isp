@props([
    'name' => '',
    'value' => '',
    'column' => '12',
    'required' => false
])
<div class="col-xxl-{{$column}} col-sm-{{$column}}">
    <label class="form-label" for="{{ $name }}"><strong> Number </strong> <span class='font-danger'>{{$required ? "*" : ''}} </strong> </span></label>
    <input {{$attributes->class(['form-control input-phone-number'])->merge(['type' => 'text'])}} id="{{ $name }}" name="{{ $name }}" type="text" placeholder="01xxx-xxxxxx" value="{{ old($name) ? old($name) : $value }}">
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>