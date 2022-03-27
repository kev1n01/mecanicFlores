<div>
    <div class="form-group">
        <label for="{{$name}}" class="col-form-label ">{{$label}}</label>
        <input wire:model="{{$name}}" id="{{$name}}" type="{{$type}}" class="form-control
        @if ($errors->has($name)) is-invalid @endif" placeholder="{{$placeholder}}">
    </div>
    @if ($errors->has($name))
    <small style="color:red;" class="form-text">{{$errors->first($name)}}</small>
    @endif
</div>
