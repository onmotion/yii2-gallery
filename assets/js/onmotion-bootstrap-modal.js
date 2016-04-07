/**
 * Created by kozhevnikov on 04.04.2016.
 */
$(document).ready(function () {
    var $modal = $('#gallery-modal');
    var progressBar = '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"><span class="sr-only">100</span></div></div>';

    $('a[role="modal-toggle"]').on('click', function (e) {
        e.preventDefault();
        $modal.find('.modal-title').text($(this).attr('data-modal-title'));
        $modal.find('.modal-body').text($(this).attr('data-modal-body'));
        $modal.find('#modal-confirm-btn').attr('href', $(this).attr('href'));
        var method = $(this).attr('method');
        if (method == 'get') {
            $.ajax({
                type: 'get',
                url: $(this).attr('href'),
                dataType: 'json',
                beforeSend: function () {
                    $modal.find('.modal-body').html(progressBar);
                },
                success: function (data) {
                    $modal.find('.modal-title').text(data.content.title);
                    $modal.find('.modal-body').html(data.content);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(textStatus);
                    console.log(errorThrown);
                    $modal.find('.modal-body').text(errorThrown);
                }
            });
        }
        $modal.modal();
        return false;
    });

    $('#modal-confirm-btn').on('click', function (e) {
        e.preventDefault();
        var form = $(this).closest('.modal-content').find('form');  //try to find form
        if (form.length > 0){
            form.submit();
            return false;
        }
        var that = $(this);
        $.ajax({
            type: 'post',
            url: that.attr('href'),
            dataType: 'json',
            beforeSend: function () {
                $modal.find('.modal-body').html(progressBar);
            },
            success: function (data) {
                $modal.find('.modal-title').text(data.title);
                $modal.find('.modal-body').html(data.content);
                if(data.forceClose == true)
                    $modal.modal('hide');
                if(data.forceReload == true)
                    location.reload();
                if(data.hideActionButton == true)
                    that.hide();
                return false;
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
                $modal.find('.modal-body').text(errorThrown);
            }
        });
        return false;
    });
    
    var form = $modal.find('form');
    $(document).on("submit", form, function(e){
        e.preventDefault();
        var form = $modal.find('form');
        $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function () {
                $modal.find('.modal-body').html(progressBar);
            },
            success: function (data) {
                $modal.find('.modal-title').text(data.title);
                $modal.find('.modal-body').html(data.content);
                if(data.forceClose == true)
                    $modal.modal('hide');
                if(data.forceReload == true)
                    location.reload();
                if(data.hideActionButton == true)
                    $('#modal-confirm-btn').hide();
                return false;
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
                $modal.find('.modal-body').text(errorThrown);
            }
        });
        return false;
    })
});
