<label for="{{$name}}" class="form-label select-custom ">{{$label}}</label>
<select class="form-control" wire:model="{{$name}}" id="select2" >
    <option value="">{{$placeholder}}</option>
    @foreach($options as $key => $option)
    <option value="{{$key}}">{{$option}}</option>
    @endforeach
</select>
@if ($errors->has($name))
<small style="color:red;">{{$errors->first($name)}}</small>
@endif
