// Loading Screen

$(window).on('load', function() {
    $('#loadingScreen').attr("style", "display: none !important")
    $('nav').attr("style", "display: block !important")
})

// Libraries

new WOW().init();

// Page Transition

function delay(n) {
    n = n || 2000;
    return new Promise((done) => {
        setTimeout(() => {
            done();
        }, n);
    });
}

function pageTransition() {
    var tl = gsap.timeline();
    tl.to(".loading-screen", {
        duration: 1.2,
        width: "100%",
        left: "0%",
        ease: "Expo.easeInOut",
    });

    tl.to(".loading-screen", {
        duration: 1,
        width: "100%",
        left: "100%",
        ease: "Expo.easeInOut",
        delay: 0.3,
    });
    tl.set(".loading-screen", { left: "-100%" });
}

function contentAnimation() {
    var tl = gsap.timeline();
    tl.from(".animate-this", { duration: 1, y: 30, opacity: 0, stagger: 0.4, delay: 0.2 });
}

$(function () {
    barba.init({
        sync: true,

        transitions: [
            {
                async leave(data) {
                    const done = this.async();

                    pageTransition();
                    await delay(1000);
                    done();

                    setTimeout(() => {
                        let rellax = new Rellax('.rellax');
                    },1200)

                },

                async enter(data) {
                    contentAnimation();
                    $('nav').attr("style", "display: block !important")
        
                    var vid = document.getElementById("jellyfishVideo");
                    vid.play();
                },

                async once(data) {
                    contentAnimation();
                    let rellax = new Rellax('.rellax');

                },
            },
        ],
    });

});

// Functions 

function overlayOn(element) {
    document.getElementById(element).style.display = "block";
    $('.animateBtn').addClass("animated fadeOutDown")
}

function cardFlip(id) {

    if ($(id).hasClass("flip")) {
        $(id).removeClass("flip")
    } else {
        $(id).addClass("flip")
    }
}

function overlayOff(element) {
    setTimeout(function() {
        document.getElementById(element).style.display = "none";
        $('.animateBtn')
        .removeClass("animated fadeOutDown")
        .addClass("animated fadeInUp")
    },500)

    overlayExitTransition("achievementsOverlay")
    overlayExitTransition("projectsOverlay")
    overlayExitTransition("adventuresOverlay")
}

function overlayExitTransition(overlay) {
    exitAnimation('#' + overlay, 'fadeOutUp');
    $('#' + overlay).removeClass(overlay)
    setTimeout(function(){
        $('#' + overlay)
        .removeClass('fadeOutUp')
        .addClass(overlay)
    },1000)
}

function exitAnimation(element, animation) {
    $(element).addClass('animated '+ animation);        
}

function enterAnimation(element, exitAnimation, enterAnimation) {
    $(element).removeClass('animated '+ exitAnimation);
    $(element).addClass('animated '+ enterAnimation);
}

function toggleTestimonialsOverlay() {
    if ($('#testimonialsOverlay').css('display') == "none") {
        $('#testimonialsOverlay').css('display', 'block')
        $('html').css('overflow-y', 'hidden')
        enterAnimation('#testimonialsOverlay', 'fadeOut', 'fadeIn')

    } else {
        setTimeout(() => {
            $('#testimonialsOverlay').css('display', 'none')
        }, 700)
        $('html').css('overflow-y', 'auto')
        exitAnimation('#testimonialsOverlay', 'fadeOut')
    }
}