@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ __('messages.create_permission') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guard_name">{{ __('messages.guard_name') }}</label>
                                <input type="text" class="form-control" id="guard_name" name="guard_name" value="{{ old('guard_name') }}" required>
                                @if ($errors->has('guard_name'))
                                <span class="text-danger">{{ $errors->first('guard_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.btn_create') }}</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection