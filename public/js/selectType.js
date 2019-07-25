
$(function() {
    $(".questions").on("click",".selectTypeB", function(event){
        event.preventDefault();
        var id = event.target.id;
        var type = $("#typeQ" + id).val();
        $('')
        if (type == 1) {
            var div = $("#typeQ" + id).parent();
            $("<div class ='form-group'>\n" +
                "                    <input type='radio' class='form-check-input' name='answer"+id+"' value='1'/>\n" +
                "                    <input type='text' name='" + id + "var1' class='" + id + "text form-control'/>\n" +
                "                </div>\n" +
                "                <div class='form-group'>\n" +
                "                    <input type='radio' class='form-check-input' name='answer"+id+"' value='2' />\n" +
                "                    <input type='text' name='" + id + "var2' class='" + id + "text form-control'/>\n" +
                "                </div>\n" +
                "                <button id='" + id + "addA' class='btn btn-info'>Добавить ответ</button>").insertAfter(div);
            $("#"+id).remove();
            $("#" + id + "addA").click(function (e) {
                e.preventDefault();
                var value = parseInt($("input[type=radio]:last").val()) + 1;
                var div = $("." + id + "text:last").parent();
                $("<div class ='form-group'><input type='radio' name='answer"+id+"' value='" + value + "' class ='form-check-input'/> <input type='text' name='" + id + "var"+value+"' class='" + id + "text form-control'/></div>").insertAfter(div);
            });
        }
        else if(type==2)
        {
            var div = $("#typeQ" + id).parent();
            $("<div class = 'form-group'>\n" +
                "                    <input type='checkbox' class='" + id + "checkbox form-check-input' name='1answer"+id+"' value='1'>\n" +
                "                    <input type='text' name='" + id + "var1' class='" + id + "text form-control'>\n" +
                "                </div>\n" +
                "                <div class='form-group'>\n" +
                "                    <input type='checkbox' name='2answer"+id+"' class='" + id + "checkbox form-check-input' value='2'>\n" +
                "                    <input type='text' class='" + id + "text form-control' name='" + id + "var2'>\n" +
                "                </div> <button id='" + id + "addA' class='btn btn-info'>Добавить ответ</button>").insertAfter(div);
            $("#"+id).remove();
            $("#" + id + "addA").click(function (e) {
                e.preventDefault();
                var value = parseInt($("input[type=checkbox]:last").val()) + 1;
                var div = $("." + id + "text:last").parent();
                $("<div class = 'form-group'><input type='checkbox' class='" + id + "checkbox form-check-input' name='"+value+"answer"+id+"'  value='" + value + "'><input type='text' class='" + id + "text form-control' name='"+id+"var" + value + "'></div>").insertAfter(div);
            });
        }
        else if(type==3)
        {
            var div = $("#typeQ" + id).parent();
            $("<div class = 'form-group'><label>Ответ</label><input type='text' name='answer" + id + "' class='" + id + "text form-control'></div>").insertAfter(div);
            $("#"+id).remove();
        }

    });
});
