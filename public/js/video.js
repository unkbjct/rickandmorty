// $('iframe').css('height', document.getElementById("video-html").offsetHeight)
$(document).ready(function () {

    const playImage = window.location.protocol + "//" + window.location.hostname + "/public/storage/img/icons/play-50.png",
        pauseImage = window.location.protocol + "//" + window.location.hostname + "/public/storage/img/icons/pause-50.png",
        fullScreenImage = window.location.protocol + "//" + window.location.hostname + "/public/storage/img/icons/full-screen-50.png",
        exitFullScreenImage = window.location.protocol + "//" + window.location.hostname + "/public/storage/img/icons/exit-full-screen-50.png",
        mutedImage = window.location.protocol + "//" + window.location.hostname + "/public/storage/img/icons/muted-50.png",
        soundImage = window.location.protocol + "//" + window.location.hostname + "/public/storage/img/icons/sound-50.png"
        ;
    var checkFullScreenMode = false;

    // пауза/плей видео
    controls = {
        controls: $("#controls"),
        video: $("#video"),
        playpause: $("#playpause"),
        total: $("#total"),
        buffered: $("#buffered"),
        progress: $("#current"),
        duration: $("#duration"),
        currentTime: $("#currenttime"),
        hasHours: false,
        space: $(".video-content"),
        screen: $("#screen"),
        dynamic: $("#dynamic"),
        togglePlayback: function () {
            (video.paused) ? video.play() : video.pause();
        },
        toggleScreenMode: function () {
            if (checkFullScreenMode) {
                if (document.fullscreenElement) {
                    document.exitFullscreen()
                        .then(() => console.log("Document Exited from Full screen mode"))
                        .catch((err) => console.error(err))
                } else {
                    document.documentElement.requestFullscreen();
                }

                $(controls.screen).attr("src", fullScreenImage)
                checkFullScreenMode = false;
                controls.controls.css("bottom", "6px")
            } else {
                if (controls.space.get(0).requestFullscreen) {
                    controls.space.get(0).requestFullscreen();
                } else if (elem.webkitRequestFullscreen) { /* Safari */
                    controls.space.get(0).webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) { /* IE11 */
                    controls.space.get(0).msRequestFullscreen();
                }

                $(controls.screen).attr("src", exitFullScreenImage)
                checkFullScreenMode = true;
                controls.controls.css("bottom", 0)
            }
        },
        toggleSound: function () {
            (video.muted) ? $(controls.dynamic).attr("src", soundImage) : $(controls.dynamic).attr("src", mutedImage);
            video.muted = !video.muted;
        },
        showControls: function () {
            now_no_active = 0;
            controls.space.css("cursor", "default");
            controls.controls.removeClass("hidden");
        },
        hideControls: function () {
            controls.controls.addClass("hidden");
            now_no_active = 0;
            controls.space.css("cursor", "none");
        }
    };

    var video = controls.video[0];


    video.oncontextmenu = function (e) { return false }
    video.addEventListener("canplay", function () {
        // console.log(video.duration)
        controls.hasHours = (video.duration / 3600) >= 1.0;
        controls.duration.text(formatTime(video.duration, controls.hasHours));
        controls.currentTime.text(formatTime(0), controls.hasHours);
    }, false)

    video.addEventListener("progress", function () {
        var buffered = Math.floor(video.buffered.end(0)) / Math.floor(video.duration);
        controls.buffered[0].style.width = Math.floor(buffered * controls.total.width()) + "px";
    }, false);

    // плей/пауза на кнопку
    controls.playpause.click(function () {
        controls.togglePlayback();
    });

    //плей/пауза при клике на видео 
    controls.video.click(function () {
        controls.togglePlayback();
    });

    //пауза при конце видео
    video.addEventListener("ended", function () {
        controls.togglePlayback();
    });

    //Изменение внешнего вида
    video.addEventListener("play", function () {
        $(controls.playpause).attr("src", pauseImage);
        controls.playpause.toggleClass("paused");
    });
    video.addEventListener("pause", function () {
        $(controls.playpause).attr("src", playImage);
        controls.playpause.toggleClass("paused");
    });

    video.addEventListener("timeupdate", function () {
        var progress = Math.floor(video.currentTime) / Math.floor(video.duration);
        controls.progress[0].style.width = Math.floor(progress * controls.total.width()) + "px";

        controls.currentTime.text(formatTime(video.currentTime), controls.hasHours);
    }, false)

    controls.total.click(function (e) {
        console.log(this.offsetLeft + $(this).parent().offset().left)
        var x = (e.pageX - (this.offsetLeft + $(this).parent().parent().offset().left)) / $(this).width();
        video.currentTime = x * video.duration;
    });

    controls.dynamic.click(function () {
        controls.toggleSound();
    });

    // затухание управления при наведение!
    var no_active_delay = 3;
    var now_no_active = 0;

    setInterval(() => {
        now_no_active++;
    }, 1000);
    setInterval(updateTick, 1000);

    controls.space.on("mousemove", (e) => {
        controls.controls.removeClass("hidden");
        now_no_active = 0;
        controls.space.css("cursor", "default");
    })

    function updateTick() {
        if (now_no_active >= no_active_delay) {
            controls.hideControls();
            return;
        }
    }

    // MOUSE IS COMMING INTO VIDEO
    controls.space.on("mouseover", () => {
        controls.showControls();
    })
    // MOUSE IS OUT FROM VIDEO 
    controls.space.on("mouseout", () => {
        controls.hideControls();
    })


    //------------------SCREEN MODE!!!!---------------------------
    controls.screen.click(() => {
        controls.toggleScreenMode();
    })

    controls.video.on("dblclick", () => {
        controls.toggleScreenMode();
    })

    // --------------------------------MENAGMENT BY KEYBOARDS!!!!!!!!----------------------------------------------

    $(Document).keydown((e) => {
        // F - SCREEN MODE 
        if (e.keyCode == 70) {
            controls.toggleScreenMode();
            controls.showControls()
        }
        // SPACE - PLAY/PAUSED VIDEO
        if (e.keyCode == 32) {
            controls.togglePlayback();
            controls.showControls()
        }
        // M - MUTE/UNMUTE SOUNDS
        if (e.keyCode == 77) {
            controls.toggleSound();
            controls.showControls()
        }
        // -> - +5 SECOND TO CURRENT TIME
        if (e.keyCode == 39) {
            video.currentTime = video.currentTime + 5;
            controls.showControls()
        }
        // -> - -5 SECOND TO CURRENT TIME
        if (e.keyCode == 37) {
            video.currentTime = video.currentTime - 5;
            controls.showControls()
        }
    })

    const darkTheme = '<link class="dark-css" rel="stylesheet" href="'+window.location.protocol + "//" + window.location.hostname + '/public/css/dark-theme.css"></link>';

    $("#dark-theme").change(() => {
        if($("#dark-theme")[0].checked){
            document.cookie = "darkTheme=true; path=/; expires=Tue, 19 Jan 2028 03:14:07 GMT";
            $(".css").after(darkTheme);
        }else {
            document.cookie = "darkTheme=false; path=/; expires=Tue, 19 Jan 2028 03:14:07 GMT";
            $(".dark-css").remove();
        }
    })
});

//----------------------------- FORMAT TIME -------------------------------------------------
function formatTime(time, hours) {
    if (hours) {
        var h = Math.floor(time / 3600);
        time = time - h * 3600;

        var m = Math.floor(time / 60);
        var s = Math.floor(time % 60);

        return h.lead0(2) + ":" + m.lead0(2) + ":" + s.lead0(2);
    } else {
        var m = Math.floor(time / 60);
        var s = Math.floor(time % 60);

        return m.lead0(2) + ":" + s.lead0(2);
    }
}
Number.prototype.lead0 = function (n) {
    var nz = "" + this;
    while (nz.length < n) {
        nz = "0" + nz;
    }
    return nz;
};