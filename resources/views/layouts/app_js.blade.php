<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> -->
  <script src="/js/stisla.js"></script>

  <script src="iziToast.min.js" type="text/javascript"></script>

  <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

 
  <!-- Template JS File -->
  <script src="/js/scripts.js"></script>
  <script src="/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="/js/page/index.js"></script>

  <script>
    @foreach ($errors->all() as $error)
    iziToast.warning({
        title: "Warning",
        message: "{{ $error }}",
        position: 'topRight',
    });
    @endforeach

    @if(Session::has('message'))
      var type = "{{ Session::get('alert-type') }}";
      switch(type){
          case 'info':
          iziToast.info({
            title: "{{ Session::get('title') }}",
            message: "{{ Session::get('message') }}",
            position: 'topRight',
        });
              break;

          case 'warning':
              iziToast.warning({
                title: "{{ Session::get('title') }}",
                message: "{{ Session::get('message') }}",
                position: 'topRight',
            });
              break;

          case 'success':
          iziToast.success({
                title: "{{ Session::get('title') }}",
                message: "{{ Session::get('message') }}",
                position: 'topRight',
                });
              break;

          case 'error':
              iziToast.error({
                title: "{{ Session::get('message') }}",
                message: "{{ Session::get('message') }}",
                position: 'topRight',
                });
              break;
      }
    @endif
  </script>

@yield('script')
</body>
</html>
