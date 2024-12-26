@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ __('messages.create_import') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('components.alert.errors')
                    <div class="container">
                        <h1>Uvoz podataka</h1>
                        <form action="{{ route('imports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="import_type">Odaberite tip uvoza:</label>
                                <select name="import_type" id="select-type" class="form-control">
                                    <option value="">{{__('messages.select_type')}}</option>
                                    @foreach ($data as $type)
                                    <option value="{{ $type['key'] }}_{{$type['file_key']}}" data-val="{{ $type['required_headers']}}">{{ $type['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="file">{{__('messages.select_file')}}</label>
                                <input type="file" name="file" id="file" class="form-control">
                                <span class="text-info" id="show-headers"></span>

                            </div>

                            <button type="submit" class="btn btn-primary">Pokreni uvoz</button>
                        </form>
                    </div>
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