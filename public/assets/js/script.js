function previewClick(elm){
    $('.homepage-preview-filter p').removeClass('choice')
    $(elm).children().addClass('choice')

    $.ajax({
        type:'POST',
        url:'assets/js/ajax.php',
        data: 'postdata',
        dataType: 'json',
        success: function(result){
            console.log(result)
            $('.homepage-preview-result').html(result)
        }
    })

}