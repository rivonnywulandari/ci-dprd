jQuery(function($) {
    $('#validation-form').submit(function(e) {
        var currentForm = this;
        e.preventDefault();
        bootbox.confirm("yakin data ini disimpan ?", function(result) {
          if (result) {
            currentForm.submit();
          }
        });
    }); 
    $('.confirm_delete').submit(function(e) {
        var currentForm = this;
        e.preventDefault();
        bootbox.confirm("yakin data ini dihapus ?", function(result) {
          if (result) {
            currentForm.submit();
          }
        });
    }); 
})