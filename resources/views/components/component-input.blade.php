<div>
    <div class="form-group">
        <label for="{{$name}}" class="col-form-label ">{{$label}}</label>
        <input wire:model="{{$name}}" id="{{$name}}" type="{{$type}}" class="form-control
        @if ($errors->has($name)) is-invalid @endif" placeholder="{{$placeholder}}">
    </div>
    @if ($errors->has($name))
    <small style="color:#dc3545;">{{$errors->first($name)}}</small>
    @endif
</div>
