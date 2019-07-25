$(document).ready(function() {
    var input = document.getElementById('tags');

    input.oninput = function() {
        var arr = input.value.split(', ');
        let word = arr[arr.length-1];
        if(word!='') {
            $.ajax({
                dataType: "json",
                url: "/tags/" + word,
                success: function (data) {
                    $("#tag-list").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#tag-list").append('<li class="list-group-item">'+data[i]+'</li>');
                        select_tag();
                    }
                },
            });
        }
    };

});

function select_tag() {
    $(".list-group-item").on('click', function (e) {
        var value = $("#tags").val();
        var arr = value.split(', ');
        arr.pop();
        arr.push($(this).text());
        var str = arr.join(', ');
        $("#tags").val(str+', ');
        $("#tag-list").empty();

    });
}