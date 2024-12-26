const PermissionService = {

    getPermission: function (url) {
        return $.ajax({
            async: true,
            url: url,
            method: 'GET',
            error: function (response) {
            }
        });
    },
}

export { PermissionService };