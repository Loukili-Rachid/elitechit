document.querySelector("body").addEventListener("click",function(event){
    if (!$(event.target).closest('.result > div').length && !$(event.target).is('search-bar-1 > #search')) {
        $(".result > div").hide();
    }
    if (!$(event.target).closest('.result > div').length && !$(event.target).is('search-bar-2 > #search')) {
        $(".result > div").hide();
    }
})

$('body').click(function (event) {
    if ($(event.target).closest('search-bar-1 > #search').length) {
        $(".result > div").show();
    }
    if ($(event.target).closest('search-bar-2 > #search').length) {
        $(".result > div").show();
    }
});


$("search-bar-1 > #search-form").submit(function (e) {
    e.preventDefault();
});
$("search-bar-2 > #search-form").submit(function (e) {
    e.preventDefault();
});

// Desktop Version

var ele = document.querySelectorAll("#search");
ele[0].addEventListener("keyup",function(event){

    let text = ele[0].value;
    let term = text.toLowerCase();
    let _token = $('meta[name="csrf-token"]').attr('content');

    if (term.length >= 20) {
        ele[0].value='';

    }
    if (event.keyCode == 13) {
        event.preventDefault();
        return false;
    }

    const regex = RegExp(/^[a-z A-Z]+$/);
    if (term.length >= 2 && term.length <= 20 && regex.test(term)) {
        const element = document.querySelectorAll("#search-form");
        $.ajax({
            url: element[0].getAttributeNode("action").value,
            type: "POST",
            data: {
                term: term,
                _token: _token
            },
            success: function (response) {
                if (response) {
                    $('.result').html(response);
                }
            },
        });
    }
});

// Mobile Version

ele[1].addEventListener("keyup",function(event){
    
        let text = ele[1].value;
        let term = text.toLowerCase();
        let _token = $('meta[name="csrf-token"]').attr('content');
    
        if (term.length >= 20) {
            ele[1].value='';
    
        }
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    
        const regex = RegExp(/^[a-z A-Z]+$/);
        if (term.length >= 2 && term.length <= 20 && regex.test(term)) {
            const element = document.querySelectorAll("#search-form");
            $.ajax({
                url: element[1].getAttributeNode("action").value,
                type: "POST",
                data: {
                    term: term,
                    _token: _token
                },
                success: function (response) {
                    if (response) {
                        $('.result').html(response);
                    }
                },
            });
        }
    });