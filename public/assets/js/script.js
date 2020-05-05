function previewClick(elm, url){
    $('.homepage-preview-filter p').removeClass('choice')
    $(elm).children().addClass('choice')

    $('.homepage-preview-result').html('<img style="margin: 0 auto;" width="50" height="50" class="loadingUser"' +
        ' src="https://media.giphy.com/media/L05HgB2h6qICDs5Sms/giphy.gif">')
    $('.homepage-preview-result').load(url)



}

function slideDown(elm){
    $(elm).slideToggle()
}

function choice(elm,target,down){
    $(target).val(elm)
    $(down).slideUp()
}



// input hidden generate (homepage-search)
function formSelect(elm,name){
    // background => to know if field is selected or not
    // if elm isn't selected => click => selected
    if($(elm).css('background-color') === "rgb(68, 137, 200)"){
        // change backrgound-color
        $(elm).css('background-color','#FBB03B')

        // add an input with value
        let input = "<input type='hidden' name='"+name+"' value='selected' id='"+name+"'>"
        $(input).appendTo('.homepage-search-hidden')




    }else{ // if elm is selected => click => deselected
        // change background-color
        $(elm).css('background-color','#4489C8')

        // remove the input hidden
        document.getElementById(name).remove()
    }

}







// autocompletion
$(document).ready(function(){
    // autocompletion for the field "city"
    $('#city').keyup(function(){
        $('#result').slideUp(function(){
            console.log($("#city").data('path'))
            $.ajax({
                type:'POST',
                url: $("#city").data('path'),
                dataType: 'json',
                success: function(result){
                    console.log(result)
                    $('#city').autocomplete({
                        source : result,
                        appendTo: "#resultAutocompletion",
                        messages: {
                            noResults: '',
                            results: ''
                        }
                    })
                }
            })
        })

    })

})