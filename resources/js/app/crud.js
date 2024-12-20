const crud = {
    delete: function (url) {
        return $.ajax({
            url: url,
            method: 'DELETE',
            dataType: 'json',
        });
    },
};

export {crud};