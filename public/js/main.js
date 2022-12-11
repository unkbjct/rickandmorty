$(document).ready(() => {
    const darkThemeLink = '<link class="dark-css" rel="stylesheet" href="' + window.location.protocol + '//' + window.location.hostname + '/public/css/dark-theme.css"></link>';
    
    if (localStorage.getItem('darkTheme') == null) {
        localStorage.setItem("darkTheme", "false");
    } else if (localStorage.getItem('darkTheme') == 'true') {
        localStorage.setItem('darkTheme', 'true')
        $(".css").after(darkThemeLink);
        $("#dark-theme")[0].checked = 'checked'
    }


    $("#dark-theme").change(() => {
        if ($("#dark-theme")[0].checked) {
            localStorage.setItem("darkTheme", "true");
            $(".css").after(darkThemeLink);
        } else {
            localStorage.setItem("darkTheme", "false");
            $(".dark-css").remove();
        }
    })
})