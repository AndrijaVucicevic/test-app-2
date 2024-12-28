@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('messages.order_history')}} - {{__('messages.orders')}} #{{$order->id}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="align-middle">
                                <th colspan="4">
                                    {{ __('messages.table_total') }} <span
                                        class="text-primary">{{ count($records) }}</span>
                                </th>
                            </tr>
                            <tr class="bg-light">
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">{{ __('messages.type') }}</th>
                                <th class="text-center align-middle">{{ __('messages.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">
                                    <div>
                                        {{$record->action_type}}
                                        <a data-toggle="collapse"
                                            class="float-end"
                                            href="#collapse_{{$loop->iteration }}">
                                            @if($record->meta_html)
                                            {{ __('messages.audit_col_meta')}}
                                            @endif
                                        </a>
                                    </div>
                                    <div class="collapse" id="collapse_{{ $loop->iteration }}">
                                        {!! $record->meta_html !!}
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{$record->created_at}}
                                </td>
                            </tr>
                            @endforeach
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

@endsection