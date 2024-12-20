<script>
    document.addEventListener("DOMContentLoaded", function() {
        const table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.data') }}",
            columns: [{
                    data: 'first_name',
                    name: 'first_name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'last_name',
                    name: 'last_name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'email',
                    name: 'email',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: true
                },
                {
                    data: 'id',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="/users/${data}/edit" class="btn btn-sm btn-primary">{{__('messages.btn_edit')}}</a>
                            <a href="/users/${data}" class="btn btn-sm btn-danger js_action_delete">{{__('messages.btn_delete')}}</a>
                        `;
                    }
                },
            ],
            order: [
                [0, 'asc']
            ],
            pageLength: 10,
            lengthMenu: [10, 15, 25, 50],
            language: {
                lengthMenu: "{{ __('messages.datatables.lengthMenu') }}",
                zeroRecords: "{{ __('messages.datatables.zeroRecords') }}",
                info: "{{ __('messages.datatables.info') }}",
                infoEmpty: "{{ __('messages.datatables.infoEmpty') }}",
                infoFiltered: "{{ __('messages.datatables.infoFiltered') }}",
                search: "{{ __('messages.datatables.search') }}",
                paginate: {
                    first: "{{ __('messages.datatables.paginate.first') }}",
                    last: "{{ __('messages.datatables.paginate.last') }}",
                    next: "{{ __('messages.datatables.paginate.next') }}",
                    previous: "{{ __('messages.datatables.paginate.previous') }}"
                }
            }
        });
    });
</script>