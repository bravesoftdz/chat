var Message;
Message = function (arg) {
    this.text = arg.text, this.message_side = arg.message_side;
    this.draw = function (_this) {
        return function () {
            var $message;
            $message = $($('.message_template').clone().html());
            $message.addClass(_this.message_side);
            $message.find('.text').html(_this.text);
            $message.find('.text-data-send').html(arg.date);
            $('.messages').append($message);
            return setTimeout(function () {
                return $message.addClass('appeared');
            }, 0);
        };
    }(this);
    return this;
};

$(function () {
    var getMessageText, sendMessage, readMessage;
    getMessageText = function () {
        var $message_input;
        $message_input = $('.message_input');
        return $message_input.val();
    };
    drawMessage = function (text, date, side) {
        var $messages, message;
        if (text.trim() === '') {
            return;
        }
        $('.message_input').val('');
        $messages = $('.messages');
        message_side = side;
        message = new Message({
            text: text,
            date: date,
            message_side: message_side
        });
        message.draw();
        return $messages.animate({scrollTop: $messages.prop('scrollHeight')}, 300);
    };

    sendMessage = function (text, date) {
        drawMessage(text, date, 'right');
    };

    readMessage = function (text, date) {
        drawMessage(text, date, 'left');
    };

    getMessageHistory = function(userId){
        $.ajax({
            url: "message/getMessageHistory",
            cache: false,
            type: "POST",
            data: {id: userId},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    data.messages.forEach(function(item, i, arr) {
                        if (userId == item.sender_id){
                            drawMessage(item.message, item.created_at, 'left');
                        } else {
                            drawMessage(item.message, item.created_at, 'right');
                        }
                    });
                }
            }
        });
    };

    clickSendMessages = function(e){
        var userId = $('.send_message').data('user');
        var message = getMessageText();
        if (message == ''){
            return false;
        }
        $.ajax({
            url: "message/send",
            cache: false,
            type: "POST",
            data: {id: userId, message: message},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    sendMessage(message, (new Date).toTimeString().slice(0,8));
                }
            }
        });
    };

    readMessageTimer = function () {
        $.ajax({
            url: "message/read",
            cache: false,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    readMessage(data.messageText, (new Date).toTimeString().slice(0,8));
                }
            }
        });
    };

    clickOpenMessageDialog = function (e) {
        var user_id = $(this).data('user');
        var user_name = $(this).data('name');
        //
       chat.messageDialog.clear();
        getMessageHistory(user_id);
        //
        chat.messageDialog.open();
        $(".send_message").data('user', user_id);
        $(".top_menu .title").html('Chat with [ '+user_name+' ]');
    };

    /**
     * Send messgae button
     */
    $('.send_message').click(clickSendMessages);

    $('.message_input').keyup(function (e) {
        if (e.which === 13) {
            $('.send_message').click();
        }
    });

    $(document).on('click', '.btn-write-user-message', clickOpenMessageDialog);

    $('.chat_window .buttons > .close').click(function (e) {
        chat.messageDialog.close();
    });

    // setInterval(readMessageTimer, 1000);
});