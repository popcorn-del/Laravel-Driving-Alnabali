$(document).ready(function () {
    var id;
    function initForm(id) {
        $.ajax({
            url: window.location.href + "/" + id,
            method: 'get',
            success: function (res) {
                result = res.data;
                if (result) {
                    $("input[name='id']").val(id)
                    $("input[name='name_en']").val(result.type_name_en)
                    $("input[name='name_ar']").val(result.type_name_ar)
                    if (result.status == 1) {
                        $("input[name='status'][value='1']").prop('checked', true);
                    } else {
                        $("input[name='status'][value='0']").prop('checked', true);
                    }
                }
            },
            error: function (res) {
                console.log(res)
            },
            cache: false,
            contentType: false,
            processData: false
        })
    }
    $(".reset-btn").click(function () {
        $("#custom-form :input").removeClass("parsley-error");
        $("#custom-form ul").removeClass("filled");
        $("#custom-form").trigger("reset");
        if (document.getElementById("cityTitle").innerHTML != "ADD CLIENT TYPE") {
            console.log(document.getElementById("cityTitle").innerHTML)
            initForm(id);
        }
    });
    $(".cancel-btn").click(function () {
        $(".add-new-form").slideToggle(1000);
        // $(".add-new-form").hide();
        $("#custom-form :input").removeClass("parsley-error");
        $("#custom-form ul").removeClass("filled");
        initForm(id);
    });
    $(".add-new-form").hide()
    $(".add-new").click(function () {
        $(".add-new-form").hide();
        $(".add-new-form").slideToggle(1000);
        $("input[name='name_en']").val("")
        $("input[name='name_ar']").val("")
        $("input[name='status'][value='1']").prop('checked', true);

        $("#cityTitle").text("EDIT CLIENT TYPE");
    });
    $(".edit").click(function () {
        $(".add-new-form").hide()
        $(".add-new-form").slideToggle(1000);
        id = $(this).attr("data-id")
        initForm(id);
    })
    // create bus type
    $('#custom-form').submit(function (e) {
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
                if (res.result == "success") {
                    toastr["success"]($('#arc_success').val());
                    setInterval(function () {
                        location.href = list_url;
                    }, 2000);
                } else if (res.result == "faild") {
                    toastr["warning"]("The data is already exist. Please insert another data.");
                } else {
                    toastr["error"](res.error[0]);
                }
            },
            error: function (errors) {
                toastr["warning"](errors);
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })
    $('.price-status').change(function () {
        var status = $(this).prop('checked');
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: status_url,
            data: { status: status, id: id },
            success: function (res) {
                if (res.result == "success") {
                    toastr["success"]($('#arc_success').val());
                }
            }
        })
    })
    if ($.fn.dataTable.isDataTable('#datatable')) {
        table = $('#datatable').DataTable({
            bDestroy: true,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    }
});