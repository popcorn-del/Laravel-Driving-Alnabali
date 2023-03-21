$(document).ready(function(){
    $(".reset-btn").click(function(){
        $("#custom-form").trigger("reset");
    });
    $('#custom-form').submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        var endtime = $('#endtime').val();
        var starttime = $('#starttime').val();
        var startDate = $('#startdate').datepicker('getDate');
        var endDate = $('#enddate').datepicker('getDate');
        if(document.getElementById('trip_type_1').checked == false) {
            if((startDate + "") == (endDate + "")){
                console.log(starttime > endtime);
                if(new Date("2000/12/10 " + starttime) > new Date("2000/12/10 " + endtime)){
                    toastr["error"]("Departure time cannot be less than arrival time.");
                    return;
                        // $( "#endtime" ).timepicker('setTime', starttime);
                }
            }
        }
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
                    toastr["success"]("Success!!!");
                    setInterval(function(){ 
                        location.href = list_url; 
                    }, 2000);
                }
                if(res.error){
                    for(i=0; i<res.error.length; i++){
                        toastr["error"](res.error[i]);
                    }
                }
                if(res.result == 'exist') {
                    toastr["error"]("User Name is exist!");
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