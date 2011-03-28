$(document).ready(function(){

    $('#addform2').click(function() {
        var found = false;
        $('#ValuesFormsP form input[name="wine_property_value[id]"]').each(function (){
            if($(this).val()==''){
                found = true;
            }
        });
        if (!found) {
            $.ajax({
                url: $('#addform2').attr('href'),
                success: function(data){
                    $('#ValuesFormsP').append(data);
                    initForms();
                }
            });
        }
        return false;
    });

    initForms();

    $('#addformProperty').click(function() {
        var found = false;
        $('#ValuesForms form input[name="wine_properties[id]"]').each(function (){
            if($(this).val()==''){
                found = true;
            }
        });
        if (!found) {
            $.ajax({
                url: $('#addformProperty').attr('href'),
                success: function(data){
                    $('#ValuesForms').append(data);
                    initForms();
                }
            });
        }
        return false;
    });

//    $('#type_login').change(function (){
//        $('#logins').submit();
//    });

});
function initForms(){
    $('#ValuesForms form').each(function (){
        var form = $(this);
        $(this).ajaxForm({
            success: function(data){
                form.closest('#ValuesForms').html(data);
                initForms();
            }
        }); 
        updateSelect(form);
    });
    $('#ValuesFormsP form').each(function (){
        var form = $(this);
        $(this).ajaxForm({
            success: function(data){
                form.closest('div').replaceWith(data);
                initForms();
            }
        });
    });
}
function updateSelect(form){ 
   $('select[name="wine_properties[name_id]"]', form).change(function(){
       var val = $(this).val();
       var select = $('select[name="wine_properties[value_id]"]', form);
       select.emptySelect();
        $.ajax({
                url: '/backend.php/wines/getpr/'+val,
                dataType: 'json',
                success: function(data){
                  select.loadSelect(data);
                }
            });
   });
}

(function($) {
    $.fn.emptySelect = function() {
        return this.each(function(){
            if (this.tagName=='SELECT') {
                $(this).html('');
            // this.options.length = 0;
            }
        });
    }
    $.fn.loadSelect = function(optionsDataArray,emptyStr) {

        return this.emptySelect().each(function() {
            if (this.tagName == 'SELECT') {
                var selectElement = this;
                if (emptyStr) {
                    var option = new Option('', '');
                    if ($.browser.msie) {
                        selectElement.add(option);
                    }
                    else {
                        selectElement.add(option, null);
                    }
                }
                $.each(optionsDataArray, function(index, optionData) {
                    if (optionData.gpoup== null) {


                        var option = new Option(optionData.text, optionData.value);
                        if ($.browser.msie) {
                            selectElement.add(option);
                        }
                        else {
                            selectElement.add(option, null);
                        }
                    } else {
                        var gpoup= $('<optgroup label="'+optionData.gpoup+'">');
                        $.each(optionData.items, function(itemIndex, itemData) {
                            var option = new Option(itemData.text, itemData.value);
                            $(option).appendTo(gpoup);
                        });
                        gpoup.appendTo(selectElement);
                    }

                });
              
            }
        });

    }

})(jQuery);