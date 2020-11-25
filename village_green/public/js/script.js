$(document).ready(function(){

    let $card = $('.guit_bass');

    $card.click(function (e){

        $('.guit_bass').removeClass('active');
        e.target.classList.add('active');

        let selector = $(e.target).attr('data-filter');
        $('.grid').isotope({
            filter : selector
        });

        return false;
    })
});