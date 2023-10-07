$(document).ready(function(){
    $(".reset-btn").click(function(){
        $("#custom-form").trigger("reset");
    });
    $('#custom-form').submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: store,
            method: 'post',
            data: formData,
            success: function (res) {
                if(res.result == "success" ){
                    toastr["success"]($('#arc_success').val());
                    // setTimeout(function(){
                        location.href = list_url;
                    // });
                } else if(res.result == "fail") {
                    // toastr["warning"]("Driver and Bus is N/A!");
                } else {
                    toastr["warning"]("Trip name is already exist.");
                }
            },
            error: function (errors){
                toastr["warning"](errors);
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })
});
