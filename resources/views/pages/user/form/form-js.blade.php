<!-- FORM JS -->
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script>
    $("#froles").select2({
        allowClear: true,
        placeholder: "{{ MyHelper::generate_ph('select', __('user_lang.attributes.roles')) }}"
    });
</script>
<script src="{{asset('plugins/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/users/account-settings.js')}}"></script>