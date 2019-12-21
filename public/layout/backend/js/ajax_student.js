$(document).ready(function() {
    $('#adept').on('change', function () {
        var selectVal = $(this).val();
        console.log(selectVal);
        $.ajax({
            method: "POST",
            url: "{{ route('ajaxclass') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": selectVal},
            success : function ( data ) {
                $('#aclass').html(data);
            }
        })
    });
});
