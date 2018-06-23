<script>
    window.user = @if(\Auth::user()) {!! \Auth::user() !!} @else {} @endif;
</script>
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
{{ $slot }}
