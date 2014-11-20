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
    $('.addressSelect').on('click',ship);
}

function refresh(){

    var coin = $('#currency')[0].selectedOptions[0].value;
    var shipping =  $('#ship').text($('#ship').text().replace('$',''));

    for(var i = 0; i < currency.length; i++){
        switch(coin) {
            case '1':
                currency[i].textContent = '$' + (currencyOriginal[i] * 1).toFixed(2);
                shipping = (shipping * 1).toFixed(2);
                $("#ship").text("$"+shipping);
                break;
            case '2':
                currency[i].textContent = "€" + (currencyOriginal[i] * 0.804547301).toFixed(2);
               shipping = (shipping * 0.804547301).toFixed(2);
               $("#ship").text("€"+shipping);
                break;
            case '3':
                currency[i].textContent = "¢" + (currencyOriginal[i] * 539.374326).toFixed(2);
                shipping = (shipping * 539.374326).toFixed(2);
                $("#ship").text("¢"+shipping);
                break;
        }
    }
}

function ship()
{
    //var address = $('#addressSelect').
    var id = $('input[type=radio][name=addressSelector]:checked').attr('id');
    var t = $("#"+id+".select").text();
    if(t=='Costa Rica'){
        $("#ship").text("$6");
    }else{
        $("#ship").text("$35");
    }
}
