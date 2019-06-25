var reviewWindow;
var reviewStars = 0;

$(document).ready(function() {

    window.fbAsyncInit = function() {
        FB.init({
            appId            : '442747476274204',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v2.7'
        });
    };

    gapi.load('auth2', function() {
        gapi.auth2.init();
    });

    $('.open-iframe').on('click', function() {

        var url = $(this).attr('data-url');

        reviewWindow = window.open(
            url,
            "review",
            "width=800, height=900, left=0, top=0"
        );

        $('.review-links').hide();
        $('.review-close').show();

    })

    $('.review-close').click(function(){

        $('.review-close').hide();
        $('.review-links').show();

        GoogleSignOut();
        FBLogout();

        if (reviewWindow)
            reviewWindow.close();

    });

    $('.open-form').on('click', function() {

        $('.review-links').hide();
        $('.review-form').show();

    })

    $('.form-voltar').on('click', function() {

        $('.review-form').hide();
        $('.review-links').show();

    });

    $('.star-unclicked').on('click', function() {

        reviewStars = $(this).attr('data-star');

        $('.review-star').each(function() {

           $(this).removeClass('star-clicked');

           if ($(this).attr('data-star') <= reviewStars)
               $(this).addClass('star-clicked')

        });

        $('#estrelas').val(reviewStars);

    });

});

function GoogleSignOut() {

    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('Google user signed out.');
    });

}

function FBLogout(){
    FB.getLoginStatus(function(response) {
        FB.logout(function(response){
            console.log('Facebook user signed out.');
        });
    });
}