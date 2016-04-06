/**
 * Created by kozhevnikov on 01.04.2016.
 */
var onmotion = {};
onmotion.gallery = function (id, extOptions) {
    document.getElementById('gallery-links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            options = typeof extOptions == 'object' ? extOptions : JSON.parse(extOptions),
            links = this.getElementsByTagName('a');
        options.index = target.src ? target.parentNode : target;
        options.event = event;
        blueimp.Gallery(links, options);
    };
};

$(document).ready(function () {
    var $galleryItem = $('.gallery-item > img');
    var count = 0;
    var $deleteBtn = $('#photos-delete-btn');
    var $resetBtn = $('#reset-all');
    var $checkAllBtn = $('#check-all');

    function editClick(e) {
        e.preventDefault();
        if ($(this).hasClass('checked')) {
            $(this).removeClass('checked');
            count--;
        } else {
            $(this).addClass('checked');
            count++;
        }
        (count > 0) ? $deleteBtn.show() : $deleteBtn.hide();
        return false;
    }

    $(document).on('click', '#check-toggle', function (e) {
        e.preventDefault();
        if ($(this).hasClass('checked')) {
            $(this).removeClass('checked');
            $galleryItem.off('click', editClick);
            $checkAllBtn.hide();
            $resetBtn.hide();
            $galleryItem.each(function () {
                $(this).removeClass('edit-mode');
            });
        } else {
            $(this).addClass('checked');
            $galleryItem.on('click', editClick);
            $checkAllBtn.show();
            $resetBtn.show();
            $galleryItem.each(function () {
                $(this).addClass('edit-mode');
            });
        }
    });

    $checkAllBtn.click(function (e) {
        e.preventDefault();
        $galleryItem.each(function () {
            $(this).trigger('click');
        });
    });

    $(document).on('click', '#reset-all', function (e) {
        e.preventDefault();
        $galleryItem.each(function () {
            $(this).removeClass('checked');
        });
        count = 0;
        $deleteBtn.hide();
    });


    $(document).on('click', '#photos-delete-confirm-btn', function (e) {
        e.preventDefault();
        var idForRemove = [];
        var $modal = $('#gallery-modal');
        $('img.checked').each(function () {
            idForRemove.push($(this).parent().attr('data-id'));
        });
        var dataForRemove = {};
        dataForRemove.ids = idForRemove;

        $.ajax({
            type: 'post',
            url: $(this).attr('href'),
            data: dataForRemove,
            beforeSend: function () {
                $modal.find('.modal-body').html('<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"><span class="sr-only">100</span></div></div>');
            },
            success: function (data, textStatus, xhr) {
                $modal.find('.modal-body').html('Success!');
                $(this).hide();
                location.reload();
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
                $modal.find('.modal-body').html(xhr);
            }
        });
    });
});
