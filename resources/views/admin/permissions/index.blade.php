@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('messages.permissions')}}</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm">
                            {{ __('messages.btn_create') }}
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('components.alert.success') <br>

                    <table id="permissions-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.guard_name')}}</th>
                                <th>{{__('messages.created_at')}}</th>
                                <th>{{__('messages.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@include('components.modal.modal-edit')

@endsection