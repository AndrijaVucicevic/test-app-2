const PermissionService = {

    getPermission: function (url) {
        return $.ajax({
            async: true,
            url: url,
            method: 'GET',
            error: function (response) {
                // console.log('Ajax error');
            }
        });
    },
}

export { PermissionService };