// $('iframe').css('height', document.getElementById("video-html").offsetHeight)
$(document).ready(function () {


    setTimeout(() => {
        // $('iframe').css('height', $("video-html").height());
        // $('iframe')[0].offsetHeight = $('#video-html')[0].offsetHeight
    }, 1000);
    $('.dropdown-toggle').dropdown();

    $(".btn-answer").click((element) => {

        let formAddComment = $("#form-add-comment");

        formAddComment.remove();

        $(element.target).parent().parent().parent().after(formAddComment);

        formAddComment.css("display", "block")

        $("#parent_id").val($(element.target).parent().parent().parent().data('id'));
    })

    $(".comment-content").click((element) => {

        console.log()
        if ($(element.target).is('#cross-img')) {
            $("#parent_id").val('');
            $("#form-add-comment").css("display", "none");
        }

    })

    $("#btn-add-new-comment").click((element) => { 
        let formAddComment = $("#form-add-comment");

        formAddComment.remove();

        $(element.target).parent().after(formAddComment);

        formAddComment.css("display", "block")

        $("#parent_id").val();
    })
});

