<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<!-- FastClick -->
<script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>

<!-- NProgress -->
<script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('assets/build/js/custom.min.js') }}"></script>

<!-- scrollbar Scripts -->
<script src="{{ asset('assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('assets/build/js/customMecanic.min.js') }}"></script>

<!-- Select2 Scripts -->
<script src="{{ asset('assets/build/js/select2.min.js') }}"></script>

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        color: 'white',
        background: '#506e8e',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

function ToastSuccessfulNotification(msg) {
    Toast.fire({
        icon: 'success',
        title: msg,
    })
}

function ToastWarningNotification(msg) {
    Toast.fire({
        icon: 'error',
        title: msg,
    })
}
    function Confirm(id,event)
    {
        Swal.fire({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            icon: 'warning',
            iconColor: '#1ABB9C',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#9d9c9c',
            confirmButtonColor: '#383F5C',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if(result.value) {
                window.livewire.emit(event, id)
                Swal.close()
            }
        })
    }

document.addEventListener('DOMContentLoaded', function () {

    window.livewire.on('successful_alert', Msg => {
        ToastSuccessfulNotification(Msg);
    });
    window.livewire.on('warning_alert', Msg => {
        ToastWarningNotification(Msg);
    });


});

</script>
