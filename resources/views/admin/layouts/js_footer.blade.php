 <!-- Bootstrap core JavaScript-->
 <script src="{{ asset('dist/vendor/jquery/jquery.min.js') }}"></script>
 <script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{ asset('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{ asset('dist/js/sb-admin-2.min.js') }}"></script>

 <!-- Page level plugins -->
 <script src="{{ asset('dist/vendor/chart.js/Chart.min.js') }}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script>
 <script src="{{ asset('dist/js/demo/chart-pie-demo.js') }}"></script>

 <!-- Page level plugins -->
 <script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ asset('dist/js/demo/datatables-demo.js') }}"></script>
 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <script>
             iziToast.error({
                 title: '',
                 position: 'topRight',
                 message: '{{ $error }}',
             });
         </script>
     @endforeach
 @endif
 @if (session()->get('success'))
     <script>
         iziToast.success({
             title: '',
             position: 'topRight',
             message: '{{ session()->get('success') }}',
         });
     </script>
 @endif
