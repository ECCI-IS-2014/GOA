/**
 * Created by b25528 on 15/10/14.
 */

$(document).ready(function(){
    $("#UserPassword").hover(function(){
        $("#UserPassword").prop('title', 'Please insert a Password between 6 - 40 characters');
    });
    $("#UserPhone").hover(function(){
        $("#UserPhone").prop('title', 'You may insert a phone number with or without extension');
    });
    $("#UserAddress").hover(function(){
        $("#UserAddress").prop('title', 'This address will be used for send your packages, please insert a valid direction');
    });
    $("#UserEmail").hover(function(){
        $("#UserEmail").prop('title', 'This email will be used to confirm data, please insert a valid e-mail');
    });
});