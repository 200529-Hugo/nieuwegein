$(".chb").change(function() {
    $(".chb").prop('checked', false);
    $(this).prop('checked', true);
});

$(".chb2").change(function() {
    $(".chb2").prop('checked', false);
    $(this).prop('checked', true);
});

function scrollDown(){
    var objDiv = document.getElementById("autodata");
    objDiv.scrollTop = objDiv.scrollHeight;
    console.log(objDiv.scrollHeight);
}