<script>




    {{--Notifications--}}

    @if (session('pop_error'))
    pop({msg : '{{ session('pop_error') }}', type : 'error'});
    @endif

    @if (session('pop_warning'))
    pop({msg : '{{ session('pop_warning') }}', type : 'warning'});
    @endif

    @if (session('pop_success'))
    pop({msg : '{{ session('pop_success') }}', type : 'success', title: 'GREAT!!'});
    @endif



    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }

    @endif



    @if (session('flash_info'))
      flash({msg : '{{ session('flash_info') }}', type : 'info'});
    @endif

    @if (session('flash_success'))
      flash({msg : '{{ session('flash_success') }}', type : 'success'});
    @endif

    @if (session('flash_warning'))
      flash({msg : '{{ session('flash_warning') }}', type : 'warning'});
    @endif

     @if (session('flash_error') || session('flash_danger'))
      flash({msg : '{{ session('flash_error') ?: session('flash_danger') }}', type : 'danger'});
    @endif

    {{--End Notifications--}}

    function pop(data){
        Swal.fire({
            title: data.title ? data.title : 'Oops...',
            text: data.msg,
            icon: data.type,
            
        });
        // swal({
        //     title: data.title ? data.title : 'Oops...',
        //     text: data.msg,
        //     icon: data.type
        // });
    }

    function flash(data){
        Swal.fire({
            text: data.msg,
            type: data.type,
            hide : data.type !== "danger"
        });
        // new PNotify({
        //     text: data.msg,
        //     type: data.type,
        //     hide : data.type !== "danger"
        // });
    }

    $(function(){
        $(document).on('click','#delete', function(e){
            e.preventDefault();
            var link = $(this).attr("href");


                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        )
                    }
                } )
        });
    });

    // function confirmDelete(id) {

    //     swal({
    //         title: "Are you sure?",
    //         text: "Once deleted, you will not be able to recover this item!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true
    //     }).then(function(willDelete){
    //         if (willDelete) {
    //          swal(
    //             $('form#item-delete-'+id).submit();
    //             'Deleted!',
    //             'Your data has been deleted.'
    //          )
    //         }
    //     });
    // }

    function confirmReset(id) {
        swal({
            title: "Are you sure?",
            text: "This will reset this item to default state",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-reset-'+id).submit();
            }
        });
    }

    $('form#ajax-reg').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');        
        // var div = $(this).data('reload');
        // div ? reloadDiv(div) : '';

        $('#ajax-reg-t-0').get(0).click();
    });

//     $('form.ajax-pay').on('submit', function(ev){
//         ev.preventDefault();
//         submitForm($(this), 'store');

// //        Retrieve IDS
//         var form_id = $(this).attr('id');
//         var td_amt = $('td#amt-'+form_id);
//         var td_amt_paid = $('td#amt_paid-'+form_id);
//         var td_bal = $('td#bal-'+form_id);
//         var input = $('#val-'+form_id);

//         // Get Values
//         var amt = parseInt(td_amt.data('amount'));
//         var amt_paid = parseInt(td_amt_paid.data('amount'));
//         var amt_input = parseInt(input.val());

// //        Update Values
//         amt_paid = amt_paid + amt_input;
//         var bal = amt - amt_paid;

//         td_bal.text(''+bal);
//         td_amt_paid.text(''+amt_paid).data('amount', ''+amt_paid);
//         input.attr('max', bal);
//         bal < 1 ? $('#'+form_id).fadeOut('slow').remove() : '';
//     });

    $('form.ajax-store').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('form.ajax-update').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    // $('.download-receipt').on('click', function(ev){
    //     ev.preventDefault();
    //     $.get($(this).attr('href'));
    //     flash({msg : '{{ 'Download in Progress' }}', type : 'info'});
    // });

    function reloadDiv(div){
        var url = window.location.href;
        url = url + ' '+ div;
        $(div).load( url );
    }

    function submitForm(form, formType){
        var btn = form.find('button[type=submit]');
        disableBtn(btn);
        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:new FormData(form[0])
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn(btn);
            formType == 'store' ? clearForm(form) : '';
            scrollTo('body');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){
                var errors = e.responseJSON.errors;
                displayAjaxErr(errors);
            }
           if(e.status == 500){
               displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])
           }
            if(e.status == 404){
               displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])
           }
            enableBtn(btn);
            return e.status;
        });
    }

    function disableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submitting';
        btn.prop('disabled', true).html('<i class="icon-spinner mr-2 spinner"></i>' + btnText);
    }

    function enableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submit Form';
        btn.prop('disabled', false).html(btnText + '<i class="icon-paperplane ml-2"></i>');
    }

    function displayAjaxErr(errors){
        $('#ajax-alert').show().html(' <div class="alert alert-danger border-0 alert-dismissible" id="ajax-msg"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>');
        $.each(errors, function(k, v){
            $('#ajax-msg').append('<span><i class="icon-arrow-right5"></i> '+ v +'</span><br/>');
        });
        scrollTo('body');
    }

    function scrollTo(el){
        $('html, body').animate({
            scrollTop:$(el).offset().top
        }, 2000);
    }

    function hideAjaxAlert(){
        $('#ajax-alert').hide();
    }

    function clearForm(form){
        form.find('.select, .select-search').val([]).select2({ placeholder: 'Select...'});
        form[0].reset();
    }



</script>
