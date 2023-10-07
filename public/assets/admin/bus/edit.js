$(document).ready(function(){
    $(".reset-btn").click(function(){
        $("#custom-form").trigger("reset");
    });
    $('#custom-form').submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData(this);
        formData.append('_method', 'put');
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: store,
            method: 'post',
            // data: $(this).serialize(),
            data: formData,
            success: function (res) {
                if(res.result == "success" ){
                    toastr["success"]($('#arc_success').val());
                    // setInterval(function(){ 
                        location.href = list_url; 
                    // }, 2000);
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