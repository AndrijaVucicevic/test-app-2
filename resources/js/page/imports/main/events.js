import { selector } from "./selector";


const showConfig = (e) => {
    e.preventDefault();

    const $modal = $(selector.modal).modal('show');

    const url = $(e.target).closest('a').attr('href');

    API.service.importLog.getImportLog(url).done(function (response) {

        let validation = JSON.stringify(response.importLog['validation'], null, 4);
        $modal.find(selector.modalBody).html(validation)

    })

}


export { showConfig };