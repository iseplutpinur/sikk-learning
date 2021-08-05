$(document).ready(function () {
    $("#btn-reload").click(() => {
        $('iframe').attr('src', '<?= base_url("game/memoryGameDisplay") ?>');
    })
});