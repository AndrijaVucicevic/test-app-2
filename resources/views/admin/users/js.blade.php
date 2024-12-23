<script>
    document.addEventListener("DOMContentLoaded", function() {
        const table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.data') }}",
            columns: [{
                    data: 'firstName',
                    name: 'first_name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'lastName',
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
            language: window.datatablesLanguageConfig

        });
    });
</script>