/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
// Defaults
const swalInit = swal.mixin({
    buttonsStyling: false,
    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-light',
        denyButton: 'btn btn-light',
        input: 'form-control'
    }
});

function reload_table(src){
    src.ajax.reload();
}

function sw_multi_error(dt){
    var pesan = "";
    var obj = JSON.parse(dt.responseJSON['msg_body']);
    $.each(obj, function(key,value) {
        pesan += value+"<br>";
    });
    var swals = swalInit.fire({
        title: dt.responseJSON['msg_title'],
        html: pesan,
        confirmButtonClass: 'btn btn-danger',
        type: "error",
        icon: 'error'
    });

    return swals;
}

function sw_single_error(dt){
    var swals = swalInit.fire({
        title: dt.statusText,
        text: JSON.stringify(dt.responseJSON),
        confirmButtonClass: 'btn btn-danger',
        type: "error",
        icon: 'error',
    });

    return swals;
}

function sw_success(dt){
    // var swals = swalInit.fire({
    //     title: dt.msg_title,
    //     text: dt.msg_body,
    //     type: 'success',
    //     icon: 'success',
    //     confirmButtonClass: 'btn btn-success',
    // });

    var swals = swalInit.fire({
        html: dt.msg_body,
        type: 'success',
        icon: 'success',
        toast: true,
        position: 'top',
        timer: 10000,
        showConfirmButton: false,
    });

    return swals;
}

function sw_error(dt){
    // var swals = swalInit.fire({
    //     title: dt.msg_title,
    //     text: dt.msg_body,
    //     type: 'success',
    //     icon: 'success',
    //     confirmButtonClass: 'btn btn-success',
    // });

    var swals = swalInit.fire({
        html: dt.msg_body,
        type: 'error',
        icon: 'error',
        toast: true,
        position: 'top',
        timer: 10000,
        showConfirmButton: false,
    });

    return swals;
}

function sw_success_redirect(dt, url){
    var swals = swalInit.fire({
        title: dt.msg_title,
        text: dt.msg_body,
        type: 'success',
        icon: 'success',
        confirmButtonClass: 'btn btn-success',
        didClose: function() {
            window.location = url;
        }
    });

    return swals;
}

function sw_delete(postUrl, csrf_pre, identifier, deleteUrl, csrf_post, selector, datatable){
    $.ajax({
        url: postUrl,
        type: "GET",
        data: {
            _token : csrf_pre,
            id : identifier
        },
        beforeSend: function(){
            small_loader_open(selector);
        },
        success: function(s){
            swalInit.fire({
                title: s.msg_title,
                html: s.msg_body,
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, tolong hapus!',
                cancelButtonText: 'Tidak, tolong batalkan!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                allowOutsideClick: false
            }).then(function(result) {
                if(result.value) {

                    $.ajax({
                        url: deleteUrl,
                        type: "DELETE",
                        data: {
                            _token : csrf_post,
                            id : s.id
                        },
                        beforeSend: function(){
                            small_loader_open(selector);
                        },
                        success: function(d){
                            swalInit.fire({
                                title: d.msg_title,
                                html: d.msg_body,
                                type: 'success',
                                icon: 'success',
                                confirmButtonClass: 'btn btn-success',
                            });
                            reload_table(datatable);
                        },
                        complete: function(){
                            small_loader_close(selector);
                        }
                    });
                }
                else if(result.dismiss === swalInit.DismissReason.cancel) {
                    swalInit.fire({
                        title: 'Dibatalkan',
                        html: 'Data Anda aman 😉',
                        type: 'success',
                        icon: 'success',
                        confirmButtonClass: 'btn btn-success',
                        allowOutsideClick: false
                    });
                    small_loader_close(selector);
                }
            });
        },
        complete: function(){
            small_loader_close('section_divider');
        }
    });
}

function sw_delete_validated(postUrl, csrf_pre, identifier, deleteUrl, csrf_post, selector, datatable){
    $.ajax({
        url: postUrl,
        type: "GET",
        data: {
            _token : csrf_pre,
            id : identifier
        },
        beforeSend: function(){
            // small_loader_open(selector);
        },
        success: function(s){
            if(s.permission === 'F'){
                swalInit.fire({
                    title: s.msg_title,
                    html: s.msg_body,
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                // small_loader_close(selector);
            }else{
                swalInit.fire({
                    title: s.msg_title,
                    html: s.msg_body,
                    type: 'warning',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Iya, tolong hapus!',
                    cancelButtonText: 'Tidak, tolong batalkan!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    allowOutsideClick: false
                }).then(function(result) {
                    if(result.value) {
    
                        $.ajax({
                            url: deleteUrl,
                            type: "DELETE",
                            data: {
                                _token : csrf_post,
                                id : s.id
                            },
                            beforeSend: function(){
                                // small_loader_open(selector);
                            },
                            success: function(d){
                                swalInit.fire({
                                    title: d.msg_title,
                                    html: d.msg_body,
                                    type: 'success',
                                    icon: 'success',
                                    confirmButtonClass: 'btn btn-success',
                                });
                                reload_table(datatable);
                            },
                            complete: function(){
                                // small_loader_close(selector);
                            }
                        });
                    }
                    else if(result.dismiss === swalInit.DismissReason.cancel) {
                        swalInit.fire({
                            title: 'Dibatalkan',
                            html: 'Data Anda aman 😉',
                            type: 'success',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-success',
                            allowOutsideClick: false
                        });
                        // small_loader_close(selector);
                    }
                });
            }
        },
        complete: function(){
            // small_loader_close('section_divider');
        }
    });
}

function sw_delete_validated_without_table(postUrl, csrf_pre, identifier, deleteUrl, csrf_post, selector){
    $.ajax({
        url: postUrl,
        type: "GET",
        data: {
            _token : csrf_pre,
            id : identifier
        },
        beforeSend: function(){
            // small_loader_open(selector);
        },
        success: function(s){
            if(s.permission === 'F'){
                swalInit.fire({
                    title: s.msg_title,
                    html: s.msg_body,
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                // small_loader_close(selector);
            }else{
                swalInit.fire({
                    title: s.msg_title,
                    html: s.msg_body,
                    type: 'warning',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Iya, tolong hapus!',
                    cancelButtonText: 'Tidak, tolong batalkan!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    allowOutsideClick: false
                }).then(function(result) {
                    if(result.value) {
    
                        $.ajax({
                            url: deleteUrl,
                            type: "DELETE",
                            data: {
                                _token : csrf_post,
                                id : s.id
                            },
                            beforeSend: function(){
                                // small_loader_open(selector);
                            },
                            success: function(d){
                                swalInit.fire({
                                    title: d.msg_title,
                                    html: d.msg_body,
                                    type: 'success',
                                    icon: 'success',
                                    confirmButtonClass: 'btn btn-success',
                                });
                                // reload_table(datatable);
                            },
                            complete: function(){
                                // small_loader_close(selector);
                            }
                        });
                    }
                    else if(result.dismiss === swalInit.DismissReason.cancel) {
                        swalInit.fire({
                            title: 'Dibatalkan',
                            html: 'Data Anda aman 😉',
                            type: 'success',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-success',
                            allowOutsideClick: false
                        });
                        // small_loader_close(selector);
                    }
                });
            }
        },
        complete: function(){
            // small_loader_close('section_divider');
        }
    });
}

function sw_delete_validated_multiple_params(postUrl, csrf_pre, params, deleteUrl, csrf_post, selector, datatable){
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            _token : csrf_pre,
            param : params
        },
        beforeSend: function(){
            small_loader_open(selector);
        },
        success: function(s){
            if(s.permission === 'F'){
                swalInit.fire({
                    title: s.msg_title,
                    html: s.msg_body,
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                small_loader_close(selector);
            }else{
                swalInit.fire({
                    title: s.msg_title,
                    html: s.msg_body,
                    type: 'warning',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Iya, tolong hapus!',
                    cancelButtonText: 'Tidak, tolong batalkan!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    allowOutsideClick: false
                }).then(function(result) {
                    if(result.value) {
    
                        $.ajax({
                            url: deleteUrl,
                            type: "POST",
                            data: {
                                _token : csrf_post,
                                // id : s.id
                                param : params
                            },
                            beforeSend: function(){
                                small_loader_open(selector);
                            },
                            success: function(d){
                                swalInit.fire({
                                    title: d.msg_title,
                                    html: d.msg_body,
                                    type: 'success',
                                    icon: 'success',
                                    confirmButtonClass: 'btn btn-success',
                                });
                                reload_table(datatable);
                            },
                            complete: function(){
                                small_loader_close(selector);
                            }
                        });
                    }
                    else if(result.dismiss === swalInit.DismissReason.cancel) {
                        swalInit.fire({
                            title: 'Dibatalkan',
                            html: 'Data Anda aman 😉',
                            type: 'success',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-success',
                            allowOutsideClick: false
                        });
                        small_loader_close(selector);
                    }
                });
            }
        },
        complete: function(){
            small_loader_close('section_divider');
        }
    });
}

function sidebar_collapsed(){
    $('.sidebar-main').addClass('sidebar-main-resized');
}