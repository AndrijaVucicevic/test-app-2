<script>
    document.addEventListener("DOMContentLoaded", function() {
        const table = $('#permissions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('permissions.data') }}",
            columns: [{
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'guardName',
                    name: 'guard_name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'createdAt',
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
                            <a href="/permissions/${data}/edit" class="btn btn-sm btn-primary js_action_edit" data-id="${data}">{{__('messages.btn_edit')}}</a>
                            <a href="/permissions/${data}" class="btn btn-sm btn-danger js_action_delete">{{__('messages.btn_delete')}}</a>
                        `;
                    }
                },
            ],
            order: [
                [0, 'asc']
            ],
            pageLength: 10,
            lengthMenu: [10, 15, 25, 50],
            language: window.datatablesLanguageConfig
        });
    });
</script>