import {translate} from "./localisation";

const datatableTranslations = translate('datatable');

const datatableSettings = {
    processing: true,
    serverSide: true,
    layout: {
        topStart: null,
        topEnd: null,
    },
    iDisplayLength: 5,
    lengthMenu: [5, 10, 15, 25],
    language: {
        sEmptyTable: datatableTranslations['sEmptyTable'],
        sInfo: datatableTranslations['sInfo'],
        sInfoEmpty: datatableTranslations['sInfoEmpty'],
        sInfoFiltered: datatableTranslations['sInfoFiltered'],
        sInfoPostFix: datatableTranslations['sInfoPostFix'],
        sInfoThousands: datatableTranslations['sInfoThousands'],
        sLengthMenu: datatableTranslations['sLengthMenu'],
        sLoadingRecords: datatableTranslations['sLoadingRecords'],
        sProcessing: datatableTranslations['sProcessing'],
        sSearch: datatableTranslations['sSearch'],
        sZeroRecords: datatableTranslations['sZeroRecords'],
        oPaginate: {
            sFirst: datatableTranslations['oPaginate']['sFirst'],
            sLast: datatableTranslations['oPaginate']['sLast'],
            sNext: datatableTranslations['oPaginate']['sNext'],
            sPrevious: datatableTranslations['oPaginate']['sPrevious'],
        }
    }
}

export {datatableSettings};