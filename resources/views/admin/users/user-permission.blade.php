<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ __('messages.btn_update') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('users.permissions', $user->id) }}" method="POST" id="user-permissions-form">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="first_name">{{ __('messages.permissions') }}</label>
                                <select class="form-control select2" id="ddl-permissions" name="permissions[]" multiple="multiple" data-placeholder="{{ __('messages.select_permissions') }}" style="width: 100%;">
                                    @foreach($user->permissions as $permission)
                                    <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.btn_update') }}</button>
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