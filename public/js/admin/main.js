
$(document).ready( () => {
    $(".btn-remove-episode").on("click", (element) => {
        $("#idEpisode").val($(element.currentTarget).data('id-episode'));
        let text = $(element.currentTarget).data('episode-season') + " сезон, " + $(element.currentTarget).data('episode-number') + " серия. <br>" +$(element.currentTarget).data('episode-name');
        $("#modal-body").empty();
        $("#modal-body").append(text);
        console.log(text)
    })
})