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
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>{{__('messages.user')}}</th>
                            <th>{{__('messages.status')}}</th>
                            <th>{{__('messages.notes')}}</th>
                            <th>{{__('messages.actions')}}</th>
                        </tr>
                        @foreach($records as $record)
                        <tr>
                            <td class="text-center"> {{ $fnOrdinalNumber($loop->index) }} </td>
                            <td class="text-center"> {{ $record->user->full_name }}</td>
                            <td class="text-center"> {!! \App\Enums\ImportStatusEnum::tryFrom($record->status)->iconHtml() !!} </td>
                            <td class="text-center"> @if(!empty($record->file_error_csv))
                                <a href="{{route('imports-download',['importLog'=>$record->id])}}"
                                    class="js_btn_remove_user px-2">
                                    {{__('messages.download')}}
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href=""
                                        class="js_btn_remove_user px-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
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