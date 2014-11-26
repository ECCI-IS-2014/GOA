/**
 * Created by Maria del Mar on 10/11/2014.
 */

$(document).ready(init);

function init() {

    currency = $('.currency');

    currencyOriginal = [];

    for(var i = 0; i < currency.length; i++) {
        var text = currency[i].textContent.replace(/[^0-9]/g,"");
        if (text == "") {
            text = 0;
        }
        currencyOriginal.push(text);
    }

    $('#currency').on('change', refresh);
    $('.addressSelect').on('click',ship);
}

function refresh(){

    var coin = $('#currency')[0].selectedOptions[0].value;

    for(var i = 0; i < currency.length; i++){
        switch(coin) {
            case '1':
                currency[i].textContent = '$' + (currencyOriginal[i] * 1).toFixed(2);
                break;
            case '2':
                currency[i].textContent = "€" + (currencyOriginal[i] * 0.804547301).toFixed(2);
                break;
            case '3':
                currency[i].textContent = "¢" + (currencyOriginal[i] * 539.374326).toFixed(2);
                break;
        }
    }

    if(currencyOriginal[currency.length - 1] == 0) {
        currency[currency.length - 1].textContent = "Choose a shipping address";
    }

}

function ship() {
    //var address = $('#addressSelect').
    var country = $('input[type=radio][name=addressSelector]:checked ').parent().children().filter('p.country').text();
    if(country == 'Costa Rica'){
        currency[currency.length - 1].textContent = '$6'
        currencyOriginal[currency.length - 1] = 6;
    }else{
        currency[currency.length - 1].textContent = '$35'
        currencyOriginal[currency.length - 1] = 35;
    }
}
