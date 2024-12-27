@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('messages.orders')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="orders-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{__('messages.order_date')}}</th>
                                <th>{{__('messages.channel')}}</th>
                                <th>{{__('messages.sku')}}</th>
                                <th>{{__('messages.item_description')}}</th>
                                <th>{{__('messages.origin')}}</th>
                                <th>{{__('messages.so_num')}}</th>
                                <th>{{__('messages.cost')}}</th>
                                <th>{{__('messages.shipping_cost')}}</th>
                                <th>{{__('messages.total_price')}}</th>
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

@endsection
