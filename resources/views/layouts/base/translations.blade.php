@php
    $translations = [
        'error_general' => __('messages.error_general'),
        'datatable' => __('datatable'),
    ];
@endphp

<script type="text/javascript">
    window.translations = @json($translations, JSON_UNESCAPED_UNICODE);
</script>

