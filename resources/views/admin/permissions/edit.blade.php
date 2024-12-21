<div class="form-row">
    <label for="name">{{ __('messages.guard_name') }}</label>
    <input type="text" class="form-control" id="guard_name" name="guard_name" value="{{$permission->guard_name}}" required>
    @if ($errors->has('guard_name'))
    <span class="text-danger">{{ $errors->first('guard_name') }}</span>
    @endif
</div>