@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('messages.imports')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="GET" action="" class="form">

                        <div class="form-row">

                            <div class="form-group col-md-1">
                                <input type="search" class="form-control" name="filter_search" value="{{$filter->filterSearch}}">
                            </div>
                            <div class="form-group col-md-1">
                                <input type="submit" class="btn btn-success btn-sm form-control" name="action" value="search" style="background: #3c8dbc;"
                                    value="{{ __('messages.btn_search') }}">
                            </div>
                            <div class="form-group col-md-1">
                                <input type="submit" class="btn btn-success btn-sm form-control" name="action" value="export" style="background: #3c8dbc;"
                                    value="{{ __('messages.btn_exoirt') }}">

                            </div>
                            <input type="hidden" name="mainKey" value="{{$filter->mainKey}}" />
                        </div>

                    </form>

                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
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
                        @foreach($records as $record)
                        <tr>
                            <td class="text-center"> {{ $fnOrdinalNumber($loop->index) }} </td>
                            <td class="text-center"> {{ $record->orderDate }}</td>
                            <td class="text-center"> {{ $record->channel }}</td>
                            <td class="text-center"> {{ $record->sku }}</td>
                            <td class="text-center"> {{ $record->itemDescription }}</td>
                            <td class="text-center"> {{ $record->origin }}</td>
                            <td class="text-center"> {{ $record->soNum }}</td>
                            <td class="text-center"> {{ $record->cost }}</td>
                            <td class="text-center"> {{ $record->shippingCost }}</td>
                            <td class="text-center"> {{ $record->totalPrice }}</td>
                            <td class="text-center"> {{ $record->createdAt }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('orders-history',['order'=>$record->id])}}"
                                        class="px-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="/orders/{{$record->id}}" class="btn btn-sm btn-danger js_action_delete ml-2"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $records->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection