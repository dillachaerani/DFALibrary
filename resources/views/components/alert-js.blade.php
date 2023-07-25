@if ($is_error)
    <script>
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        swal({
            title: "@lang('Failed!')",
            text: "{{ $message }}",
            type: 'error',
            padding: '2em'
        })
    </script>
@else
    <script>
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        swal({
            title: "@lang('Success!')",
            text: "{{ $message }}",
            type: 'success',
            padding: '2em'
        })
    </script>
@endif