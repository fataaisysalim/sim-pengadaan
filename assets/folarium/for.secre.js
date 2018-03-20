$(".ngDocIn").click(function() {
    $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    $("#modal-contents").html("");
    $("#modal-contents").load(baseUrl + "secretariat/document/entry");
});
$(".ngDocOut").click(function() {
    $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    $("#modal-contents").html("");
    $("#modal-contents").load(baseUrl + "secretariat/document/exits");
});
$(".ngLetDep").click(function() {
    $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    $("#modal-contents").html("");
    $("#modal-contents").load(baseUrl + "secretariat/document/deposisi");
});
