
$(function () {
    let $hash = window.location.hash.slice(1);
    if($hash == ''){
        $(".season")[0].classList.add("active");
    }
    $(".season").each(function () {
        let $season = $(this).data('season');
        if ($season == $hash) {
            $(this).addClass("active");
        }
    });

    $(".link-to-season").click(() => {
        setTimeout(() => {
            let $hash = window.location.hash.slice(1);
            $(".season").each(function () {
                $(this).removeClass("active");
            });
            $(".season").each(function () {
                let $season = $(this).data('season');
                if ($season == $hash) {
                    $(this).addClass("active");
                }
            });
        }, 0);
    })

    
})

