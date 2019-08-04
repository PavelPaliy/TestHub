
$(function() {
    $(".questions").on("click",".deleteA", function(event) {
        event.preventDefault();
        var an = event.target.id.match(/[0-9]+/g)[0];
        var qn = event.target.id.match(/[0-9]+/g)[1];
        var divs = document.getElementById('q'+qn).getElementsByClassName('form-group');
        for(var i =0; i<divs.length; i++)
        {
            if(i>parseInt(an)+2)
            {
                var inputText = divs[i].getElementsByTagName('input')[1];
                inputText.setAttribute('name', qn+'var'+(i-3));
                var inputRadio = divs[i].getElementsByTagName('input')[0];
                inputRadio.setAttribute('value', (i-3));
                if(inputRadio.getAttribute('type')=='checkbox')
                {
                    inputRadio.setAttribute('name', (i-3)+'answer'+qn);
                }
                var delBut = divs[i].getElementsByClassName('deleteA')[0];
                delBut.setAttribute('id', (i-3)+'deleteA'+qn);
            }
        }
        event.target.parentNode.parentNode.remove();
    });
});
