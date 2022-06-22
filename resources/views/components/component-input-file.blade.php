<div>
    <label for="{{$name}}" class="col-form-label "></label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" wire:model="{{$name}}" id="{{$name}}"  >
        <label class="custom-file-label" for="{{$name}}">
            {{$label}}
        </label>
        @if ($errors->has($name))
        <small style="color:red;" class="form-text">{{$errors->first($name)}}</small>
        @endif
    </div>
</div>
