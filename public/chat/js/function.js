$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.items .item:first').addClass('item-active');


    $('.items .item').click(function () {
        $('.items .item').removeClass('item-active');
        $(this).addClass('item-active');
    });


    $('#users-li').click(function () {
        $('#users-list').show();
        $("#mail-section").hide();
        $('#contacts-list').hide();
    });

    $('#contacts-li').click(function () {
        $('#users-list').hide();
        $("#mail-section").hide();
        $('#contacts-list').show();
    });

    $("#mail-li").click(function () {
        $("#mail-section").show();
        $("#chat-section").hide();
        $('#users-list').hide();
        $('#contacts-list').hide();

    });


    function updateChatUI(contactName, contactId) {
        $('.messages-chat').empty();
        $("#chat-section").show();
        $('.discussion').removeClass('message-active');
        $('.select-contact-name, .select-users-list').filter(`[data-contact-id="${contactId}"]`).addClass('message-active');
        $('#display-name').text(contactName);
        $("#select-chat-section").hide();
    }

    function SeenMessages(contactId) {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': csrfToken }
        });
        $.ajax({
            url: '/status-seen',
            method: 'post',
            data: { contact_id: contactId },
            success: function (response) {
                $('.messages-chat').empty();
                $('.messages-chat').append(response);
                // console.log(response);
            }
        });
    }

    function selectContact(contactName, contactId) {
        updateChatUI(contactName, contactId);

        $.ajax({
            url: '/get-messages',
            method: 'GET',
            data: { contact_id: contactId },
            success: function (response) {
                console.log(response);
                $('.messages-chat').append(response);
                window.contactId = contactId;
            }
        });
    }

    $('.select-contact-name').click(function () {
        var contactName = $(this).data('contact-name');
        var contactId = $(this).data('contact-id');
        selectContact(contactName, contactId);
        SeenMessages(contactId);
        console.log('selected contact');
    });

    $('.select-users-list').click(function () {
        var contactName = $(this).data('user-name');
        var contactId = $(this).data('user-id');
        selectContact(contactName, contactId);
        SeenMessages(contactId);
    });


    $('#chat-form').on('submit', function (event) {
        event.preventDefault();
        var message = $('.write-message').val().trim();
        var contactId = window.contactId;

        if (message === '') {
            return;
        }



        $.ajaxSetup({
            headers: { 'X-CSRF-Token': csrfToken }
        });

        $.ajax({
            url: '/send-message',
            method: 'POST',
            data: {
                contact_id: contactId,
                message: message,
            },
            success: function (response) {
                console.log(response);
                $('.messages-chat').empty();
                $('.messages-chat').append(response);
                $('.write-message').val('');
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#mail-form').on('submit', function (e) {
        e.preventDefault();


        var formData = new FormData(this);

        $.ajax({
            url: '/mail/send',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {

            },
            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#mail-form')[0].reset();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred while sending the email. Please try again.');
            },
        });
    });
});
