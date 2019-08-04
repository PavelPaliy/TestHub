$(function() {
    $(".questions").on("click",".changeType", function(event){
        event.preventDefault();
        var id = parseInt($(".selectTypeQ:last").attr('id').match(/[0-9]+/)[0]);
        var type = $("#typeQ"+id).val();
        var divType = $("#typeQ"+id).parent();
        if(type==1)
        {
            var div = document.getElementById('q'+id);
            var inputs = div.getElementsByTagName('input');
            if(inputs.length==3)
            {
                var val = inputs[2].value;
                var parent = inputs[2].parentNode;
                parent.remove();
                //parent.style.display = 'none';
                $("#"+id+"changeType").remove();
                $("<div class ='form-group'>\n" +
                    "                    <input type='radio' class='form-check-input' name='answer"+id+"' value='1'/>\n" +
                    "                    <input type='text' name='" + id + "var1' class='" + id + "text form-control' value='"+val+"'/>\n" +
                    "                </div>\n" +
                    "                <div class='form-group'>\n" +
                    "                    <input type='radio' class='form-check-input' name='answer"+id+"' value='2' />\n" +
                    "                    <input type='text' name='" + id + "var2' class='" + id + "text form-control'/>\n" +
                    "                </div> <button id='" + id + "addA' class='btn btn-info addA'>Добавить ответ</button> <button id='" + id + "changeType' class='changeType btn btn-warning'>Изменить тип вопроса</button> ").insertAfter(divType);
            }
            else{
                if(document.getElementsByName('1answer'+id)[0])
                {
                    var i = 1;
                    var inputs = [];
                    while(document.getElementsByName(i+'answer'+id)[0])
                    {
                        document.getElementsByName(i+'answer'+id)[0].setAttribute('type', 'radio');
                        document.getElementsByName(i+'answer'+id)[0].setAttribute('class', 'form-check-input');
                        document.getElementsByName(i+'answer'+id)[0].setAttribute('name', 'answer'+id);
                        i++;
                    }

                }
            }
        }
        else if(type == 2)
        {
            var div = document.getElementById('q'+id);
            var inputs = div.getElementsByTagName('input');
            if(inputs.length==3)
            {
                var val = inputs[2].value;
                var parent = inputs[2].parentNode;
                parent.remove();
                //parent.style.display = 'none';
                $("#"+id+"changeType").remove();
                $("<div class ='form-group'>\n" +
                    "                    <input type='checkbox' class='" + id + "checkbox form-check-input' name='1answer"+id+"' value='1'>\n" +
                    "                    <input type='text' name='" + id + "var1' class='" + id + "text form-control'>\n" +
                    "                </div>\n" +
                    "                <div class='form-group'>\n" +
                    "                    <input type='checkbox' name='2answer"+id+"' class='" + id + "checkbox form-check-input' value='2'>\n" +
                    "                    <input type='text' class='" + id + "text form-control' name='" + id + "var2'>\n" +
                    "                </div> <button id='" + id + "addA' class='btn btn-info addA'>Добавить ответ</button> <button id='" + id + "changeType' class='changeType btn btn-warning'>Изменить тип вопроса</button> ").insertAfter(divType);
            }
            else{
                if(document.getElementsByName('answer'+id)[0])
                {

                    var i = 1;
                    var inputs = [];
                    while(document.getElementsByName('answer'+id)[0])
                    {
                        document.getElementsByName('answer'+id)[0].setAttribute('type', 'checkbox');
                        document.getElementsByName('answer'+id)[0].setAttribute('class', id+'checkbox'+' form-check-input');
                        document.getElementsByName('answer'+id)[0].setAttribute('name', i+'answer'+id);
                        i++;
                    }

                }
            }
        }else{
            var div = document.getElementById('q'+id);
            var groups = div.getElementsByClassName('form-group');
            div.getElementsByClassName('addA')[0].remove();
            while(groups.length>4)
            {
                groups[groups.length-1].remove();
            }
            groups[groups.length-1].getElementsByClassName('form-check-input')[0].remove();
            groups[groups.length-1].getElementsByTagName('input')[0].setAttribute('name', 'answer'+id);
            groups[groups.length-1].getElementsByTagName('input')[0].setAttribute('name', 'answer'+id);
        }
    });
});
