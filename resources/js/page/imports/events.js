import { selector } from "./selector";


const editHeaders = (e) => {
    e.preventDefault();

    var selectedOption = $(e.target).find(':selected');
    const headers = selectedOption.data('val');

    $(selector.showHeaders).html(headers ?? '')

}


export { editHeaders };