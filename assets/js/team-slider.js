document.addEventListener("DOMContentLoaded", function () {

    const track = document.getElementById("teamCarouselTrack");

    if (!track) {
        return;
    }

    let slides = Array.from(
        track.querySelectorAll(".team-carousel-slide")
    );

    if (slides.length <= 1) {
        return;
    }

    const originalCount = slides.length;

    // Duplicate cards so the carousel never becomes empty
    slides.forEach(function (slide) {

        const clone = slide.cloneNode(true);

        track.appendChild(clone);

    });


    let index = 0;


    function getGap() {

        return parseFloat(
            window.getComputedStyle(track).gap
        ) || 0;

    }


    function moveCarousel() {

        const firstSlide =
            track.querySelector(".team-carousel-slide");

        if (!firstSlide) {
            return;
        }

        const slideWidth =
            firstSlide.getBoundingClientRect().width;

        const gap = getGap();

        index++;

        track.style.transition =
            "transform 0.6s ease";

        track.style.transform =
            `translateX(-${index * (slideWidth + gap)}px)`;


        if (index >= originalCount) {

            setTimeout(function () {

                track.style.transition = "none";

                index = 0;

                track.style.transform =
                    "translateX(0)";

            }, 650);

        }

    }


    setInterval(moveCarousel, 3000);

});