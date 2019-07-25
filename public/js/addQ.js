$(document).ready(function() {
    $(".addQ").click(function (event) {
        event.preventDefault();
        var id = parseInt($(".selectTypeQ:last").attr('id').match(/[0-9]+/)[0])+1;
        $('<div class="q" id ="q'+id+'">\n' +
            '<div class = "form-group"><label>Название</label><input type="text" name="title'+id+'" class="text form-control"></div>\n' +
            '<div class = "form-group">\n' +
            '                    <label>Количество баллов за правильный ответ</label><input type="text" name="score'+id+'" class="text form-control">\n' +
            '                </div>\n'+
            '<div class = "form-group"><label>Тип вопроса</label>\n' +
            '<select class="selectTypeQ form-control" id ="typeQ'+id+'" name="typeQ'+id+'">\n' +
            '<option value="1">Один ответ из списка</option>\n' +
            '<option value="2">Несколько вариантов из списка</option>\n' +
            '<option value="3">Ввод текста</option>\n' +
            '</select></div>\n' +
            '<button class ="selectTypeB btn btn-primary" id="'+id+'">Выбрать тип</button><hr>\n' +
            '                </div>').insertAfter(".q:last");
    });
});