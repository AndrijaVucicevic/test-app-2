<table class="ob-audit-table table table-sm table-striped">
    <thead class="ob-bg text-white align-middle text-center">
    <tr>
        <th>ATRIBUT</th>
        <th class="col-md-2">STARA VREDNOST</th>
        <th class="col-md-2">NOVA VREDNOST</th>
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