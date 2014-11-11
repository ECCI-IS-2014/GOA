/**
 * Created by Maria del Mar on 10/11/2014.
 */

$(document).ready(init);

function init() {

    currency = $('.currency');
    currencyOriginal = [];

    for(var i = 0; i < currency.length; i++) {
        currencyOriginal.push(currency[i].textContent.replace("$",""));
    }

    $('#currency').on('change', refresh);
}

function refresh(){

    var coin = $('#currency')[0].selectedOptions[0].value;

    for(var i = 0; i < currency.length; i++){
        switch(coin) {
            case '1':
                currency[i].textContent = '$' + currencyOriginal[i];
                break;
            case '2':
                currency[i].textContent = "€" + (currencyOriginal[i] * 0.804547301);
                break;
            case '3':
                currency[i].textContent = "¢" + (currencyOriginal[i] * 539.374326);
                break;
        }
    }
}