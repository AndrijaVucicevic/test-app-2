<table class="ob-audit-table table table-sm table-striped">
    <thead class="ob-bg text-white align-middle text-center">
    <tr>
        <th>{{__('messages.attribute')}}</th>
        <th class="col-md-2">{{__('messages.old_value')}}</th>
        <th class="col-md-2">{{__('messages.new_value')}}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    @foreach($changes as $attribute => $change)
        <tr>
            <th class="col-md-2 text-center">{{ $attribute }}</th>
            <th class="col-md-5">{{ $change['before'] }}</th>
            <th class="col-md-5">{{ $change['after'] }}</th>
        </tr>
    @endforeach
    </tbody>
</table>