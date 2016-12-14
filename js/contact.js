$(function () {

    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            $('#preview-place').css('display', 'none');
            $('#preview-image').css('display', 'none');
            sendForm("/Default/Submit", function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                    }
                });
            
            return false;
        }
    });
    $('#preview').on('click', function(e)
    {
        if($('#submit-button').hasClass('disabled'))
        {
            $('#contact-form').validator('validate');
        }
        else
        {
            sendForm("/Default/Preview", function (data)
                {
                    if(data.type != "error")
                    {
                        $('#preview-title').html(data.title);
                        $('#preview-text').html(data.text);
                        if(data.image != "")
                        {
                            $('#preview-image').attr('src', data.image);
                            $('#preview-image').css('display', 'block');
                        }
                        $('#preview-place').css('display', 'block');
                    }
                });
        }
    });
    $('input[type=file]').bootstrapFileInput();
    $('.file-inputs').bootstrapFileInput();
    function sendForm(url, callbackFunc)
    {
        if($('#form_image')[0].files.length > 0)
        {
            var dataToSend = new FormData();
            dataToSend.append('image', $('#form_image')[0].files[0]);
            $.ajax({
                type: "POST",
                url: "/Default/UploadImage",
                data: dataToSend,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (uploaded)
                {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $('#contact-form').serialize() + "&imageSrc=" + uploaded.imageSrc,
                        dataType: 'json',
                        success: function(results)
                        {
                            callbackFunc(results);
                        }
                    });
                }
            });
        }
        else
        {
            $.ajax({
                type: "POST",
                url: url,
                data: $('#contact-form').serialize(),
                success: function(results)
                {
                    callbackFunc(results);
                }
            });
        }
    }

    $('.blog-post').sort(function (a, b) {
      return GetSortValue($(a).attr($('#field-type').val()), $(b).attr($('#field-type').val()), $('#field-type').val(), $('#sort-type').val());
    }).each(function (_, container) {
        $(container).parent().append(container);
        });
    $('#field-type, #sort-type').change(function()
    {
        $('.blog-post').sort(function (a, b) {
      return GetSortValue($(a).attr($('#field-type').val()), $(b).attr($('#field-type').val()), $('#field-type').val(), $('#sort-type').val());
    }).each(function (_, container) {
        $(container).parent().append(container);
        });
    });
    function GetSortValue(value1, value2, data_sort, sort_type)
    {
        if (data_sort == "data-date")
        {
            value1 = new Date(value1).getTime();
            value2 = new Date(value2).getTime();
        }
        result = (value1 < value2) ? -1 : (value1 > value2) ? 1 : 0;
        if (sort_type == "order")
            result *= -1;
        return result;
    }
});