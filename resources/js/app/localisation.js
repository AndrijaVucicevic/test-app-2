/**
 * app/localisation.js
 */

function translate(key) {

    let translations = {},
        translation = key;

    $.extend(translations, translations, window.translations);

    if (translations.hasOwnProperty(key)) {
        translation = translations[key];
    }

    return translation;
}

export {translate};