$(document).ready(function(){

    var $radios = $('input:radio[id=client_type_0]');
    if($radios.is(':checked') === false) {
        $radios.filter('[value=1]').prop('checked', true);
    }

    var $radios = $('input:radio[id=contract_type_0]');
    if($radios.is(':checked') === false) {
        $radios.filter('[value=1]').prop('checked', true);
    }
    
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
                    // setInterval(function(){ 
                        location.href = list_url;
                    // }, 5000);
                }
                if(res.error){
                    for(i=0; i<res.error.length; i++){
                        toastr["error"](res.error[i]);
                    }
                }
            },
            error: function (error){
                console.log(error)
            },
            cache: false,
            contentType: false,
            processData: false
        })

    })
});