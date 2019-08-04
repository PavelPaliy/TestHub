
$(function() {
    $("form").on("submit", function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                window.href = url;

            },
            error: function (data) {
                for(var i =0; i<data.length; i++)
                {

                    console.log(data[i]);
                }
            },
        });




    });
});
