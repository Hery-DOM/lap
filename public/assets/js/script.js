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
    if(target === '#city'){
        //change the attribut action for <form>
        var url = $('.homepage-search-barre form').data('url')
        var newValue = url+'/trouvez-un-logement/'+$('#city').val()
        $('.homepage-search-barre form').attr('action', newValue)
    }
}



// input hidden generate (homepage-search and page-search)
function formSelect(elm,name){
    // background => to know if field is selected or not
    // if elm isn't selected => click => selected
    if(!$(elm).hasClass('selected')){
        // change background-color
        $(elm).addClass('selected')

        // add an input with value
        let input = "<input type='hidden' name='"+name+"' value='selected' class='"+name+"'>"
        $(input).appendTo('.homepage-search-hidden')




    }else{ // if elm is selected => click => deselected
        // change background-color
        $(elm).removeClass('selected')

        // remove the input hidden
        $('.'+name).remove()
    }

}


// contact modal (open)
function contactModal(){
    $('.contact-modal').show()
}

// contact modal (close)
function contactModalClose(){
    $('.contact-modal').hide()
}





// autocompletion
$(document).ready(function(){
    // autocompletion for the field "city"
    $('#city').keyup(function(){

        $('#result').slideUp(function(){
            $.ajax({
                type:'POST',
                url: $("#city").data('path'),
                dataType: 'json',
                success: function(result){
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


// carousel
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        items: 1
    })
})

// aside
$(document).ready(function(){
    // get initial position
    var scrollInit = $(window).scrollTop()
    if(scrollInit >= 715){
        $('.vertical-line').css('background-color','#002849')
        $('.square').css('background-color','#002849')
    }else{
        $('.vertical-line').css('background-color','white')
        $('.square').css('background-color','white')
    }

    if(scrollInit <920){
        $('.square').css({'width':'8px','height':'8px'})
        $('#square1').css({'width':'20px','height':'20px'})

    }else if(scrollInit >=920 && scrollInit <1560){
        $('.square').css({'width':'8px','height':'8px'})
        $('#square2').css({'width':'20px','height':'20px'})
    }else if(scrollInit >=1560 && scrollInit <2135){
        $('.square').css({'width':'8px','height':'8px'})
        $('#square3').css({'width':'20px','height':'20px'})
    }else if(scrollInit >=2135 && scrollInit <3125){
        $('.square').css({'width':'8px','height':'8px'})
        $('#square4').css({'width':'20px','height':'20px'})
    }else if(scrollInit >=3125){
        $('.square').css({'width':'8px','height':'8px'})
        $('#square5').css({'width':'20px','height':'20px'})
    }

    $(window).scroll(function(){
        var scroll = $(window).scrollTop()
        if(scroll >= 715){
            $('.vertical-line').css('background-color','#002849')
            $('.square').css('background-color','#002849')
        }else{
            $('.vertical-line').css('background-color','white')
            $('.square').css('background-color','white')
        }

        if(scroll <920){
            $('.square').css({'width':'8px','height':'8px'})
            $('#square1').css({'width':'20px','height':'20px'})
        }else if(scroll >=920 && scroll <1560){
            $('.square').css({'width':'8px','height':'8px'})
            $('#square2').css({'width':'20px','height':'20px'})
        }else if(scroll >=1560 && scroll <2135){
            $('.square').css({'width':'8px','height':'8px'})
            $('#square3').css({'width':'20px','height':'20px'})
        }else if(scroll >=2135 && scroll <3125){
            $('.square').css({'width':'8px','height':'8px'})
            $('#square4').css({'width':'20px','height':'20px'})
        }else if(scroll >=3125){
            $('.square').css({'width':'8px','height':'8px'})
            $('#square5').css({'width':'20px','height':'20px'})
        }
    })



})


// change URL for search page
$(document).ready(function(){
    $('#city').change(function(){
        // change value in attr action form form (for URL after submit)
        var url = $('.homepage-search-barre form').data('url')
        var newValue = url+'/trouvez-un-logement/'+$('#city').val()
        $('.homepage-search-barre form').attr('action', newValue)
    })



})














