$(".validation-video").click(function(){
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
    $('form').ajaxForm({
        beforeSend: function() {            
            $('#progress').modal('show');
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {            
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
            //console.log(percentVal, position, total);
        },
        success: function() {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            window.location = xhr.responseText;
        }
    });

})(); 