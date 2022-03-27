<label for="{{$name}}" class="form-label select-custom select 2">{{$label}}</label>
<select class="form-control" wire:model="{{$name}}">
    <option value="">{{$placeholder}}</option>
    @foreach($options as $key => $option)
    <option value="{{$key}}">{{$option}}</option>
    @endforeach
</select>
@if ($errors->has($name))
<small style="color:red;">{{$errors->first($name)}}</small>
@endif
