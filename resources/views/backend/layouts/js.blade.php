<script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('backend/js/next-sidebar.js') }}"></script>

{{--<script src="{{ asset('backend/js/feather.min.js') }}" ></script>--}}
{{--<script src="{{ asset('backend/js/dashboard.js') }}"></script>--}}

<!-- for datatable js -->
<script src="{{ asset('backend/js/jquery.dataTables.js') }}"></script>
<!-- for select2 & multiple select -->
<script src="{{ asset('backend/js/select2.min.js') }}"></script>


<!-- for material component js -->
<script src="{{ asset('backend/js/material-components-web.min.js') }}"></script>
<!-- for form validation -->

<script src="{{ asset('backend/js/sweetalert.js') }}"></script>

<!-- for plugin js default js  -->
{{--<script src="{{ asset('backend/js/main-plugin.js') }}"></script>--}}


<script type="text/javascript">
    $(function () {
        $(document).on("change", ".isChecked", function (e) {
            e.preventDefault();
            var table = $(this).attr('dbTable');
            var id = $(this).attr('data-id');
            var val = $(this).val();
            var url = $('.isChecked').attr('data-href');
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {table: table,id:id,value:val},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                $('.setvalue'+response.id).val(response.value);
                if (response.value == 0){
                    $('.allbutton'+response.id).show();
                }else{
                    $('.allbutton'+response.id).hide();
                }
            }).fail(function( jqXHR, textStatus ) {

            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    //User form validation
    $(document).delegate('#UserFormSubmit','click',function () {
        var name = document.getElementById('name').value;

        if (name == ''){
            var validation = false;
            var message = ' Name Must be filled';
        }else{
            if(typeof name === 'string') {
                if (name % 1 == 0) {
                    var message = 'Name Must be String';
                    var validation = false;
                }else{
                    var mobile = document.getElementById('mobile').value;
                    if(mobile == ''){
                        var validation = false;
                        var message = 'Mobile Must be filled';
                    }else{
                        if (mobile%1 != 0){
                            var validation = false;
                            var message = 'Mobile Must be Number';
                        }else{
                            var mobilelenght = mobile.length;
                            if (mobilelenght != 11){
                                var validation = false;
                                var message = 'Mobile Length '+mobilelenght+' but Must be 11';
                            }else{
                                var email = document.getElementById('email').value;
                                if(email == ''){
                                    var validation = false;
                                    var message = 'Email Must be Filled';
                                }else{
                                    function isValidEmailAddress(email) {
                                        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                                        return pattern.test(email);
                                    }
                                    if (!isValidEmailAddress(email)){
                                        var validation = false;
                                        var message = 'Enter valid email';
                                    }else{
                                        var terminals = document.getElementById('terminal').value;
                                        if (terminals == ''){
                                            var message = 'Terminal Must Be Select';
                                            var validation = false;
                                        }else{
                                            var types = document.getElementById('type').value;
                                            if (types == ''){
                                                var message = 'User Must Be Select';
                                                var validation = false;
                                            }else{
                                                var image = document.getElementById('file').value;
                                                var location = $('#file').attr('location');
                                                if(location == 'insert') {
                                                    if (image == '') {
                                                        var message = 'Image Must Be Select';
                                                        var validation = false;
                                                    }else{
                                                        var image1 = document.getElementById("file").files[0];
                                                        var t = image1.type.split('/').pop().toLowerCase();
                                                        if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
                                                            var message = 'Please select a valid image file';
                                                            var validation = false;
                                                        }else{
                                                            var status = document.querySelector('input[name = "status"]:checked');
                                                            if (status == null){
                                                                var message = 'Status must be checked';
                                                                var validation = false;
                                                            }else{
                                                                var validation = true;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (validation == false){
            Swal.fire({
                title: message,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                icon:'question',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
            })
            return false;
        }else{
            return true;
        }

    });

    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function () {
        var url = window.location;
        $('.sidebar-menu a[href="'+ url +'"]').parent().addClass('active-li');
        $('.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active-li');
    });

</script>




