
$(function() {
    $(".questions").on("click",".deleteQ", function(event) {
        event.preventDefault();
        var qn = event.target.id.match(/[0-9]+/g)[0];
        var qDivs = document.getElementsByClassName('q');
        for(var i =0; i<qDivs.length; i++)
        {
            if(i>=qn)
            {
                qDivs[i].id = 'q'+(i);
                var h4 = qDivs[i].getElementsByTagName('h4')[0];
                h4.innerHTML= (i)+' вопрос';
                qDivs[i].getElementsByClassName('deleteQ')[0].setAttribute('id', 'deleteQ'+i);
                qDivs[i].getElementsByClassName('form-group')[0].getElementsByTagName('input')[0].setAttribute('name', 'title'+i);
                qDivs[i].getElementsByClassName('form-group')[1].getElementsByTagName('input')[0].setAttribute('name', 'score'+i);
                qDivs[i].getElementsByClassName('form-group')[2].getElementsByTagName('select')[0].setAttribute('id', 'typeQ'+i);
                qDivs[i].getElementsByClassName('form-group')[2].getElementsByTagName('select')[0].setAttribute('name', 'typeQ'+i);
                if(qDivs[i].getElementsByClassName('selectTypeB')[0]!=null) qDivs[i].getElementsByClassName('selectTypeB')[0].setAttribute('id', i);
                var j =1;
                while(document.getElementsByName((i+1)+'var'+j)[0])
                {
                    if(document.getElementsByName((i+1)+'var'+j)[0])
                    {
                        document.getElementsByName((i+1)+'var'+j)[0].setAttribute('class', (i)+'text form-control');
                        document.getElementsByName((i+1)+'var'+j)[0].setAttribute('name', (i)+'var'+j);
                    }
                    if(document.getElementsByName('answer'+(i+1))[0]) document.getElementsByName('answer'+(i+1))[0].setAttribute('name', 'answer'+(i));
                    if(document.getElementsByName(j+'answer'+(i+1))[0])
                    {
                        document.getElementsByName(j+'answer'+(i+1))[0].setAttribute('class', i+'checkbox form-check-input');
                        document.getElementsByName(j+'answer'+(i+1))[0].setAttribute('name', j+'answer'+(i))
                    }
                    j++;
                }
                if(document.getElementById((i+1)+'addA')) document.getElementById((i+1)+'addA').setAttribute('id', (i)+'addA');
                if(document.getElementById((i+1)+'changeType')) document.getElementById((i+1)+'changeType').setAttribute('id', (i)+'changeType');
            }
        }
        event.target.parentNode.parentNode.parentNode.remove();
    });
});
