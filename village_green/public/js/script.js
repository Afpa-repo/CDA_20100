$(document).ready(function(){

    let $card = $('.guit_bass');

    $card.click(function (e){

        let selector = $(e.target).attr('data-filter');
        $('.grid').isotope({
            filter : selector
        }).css({ margin : '20px' });

        return false;
    })
});