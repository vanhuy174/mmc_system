$(document).ready(function() {
    $('#checkall').click(function() {
        if(this.checked) {
            // Iterate each checkbox
            $('.checkone').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkone').each(function() {
                this.checked = false;
            });
        }
    });
});

