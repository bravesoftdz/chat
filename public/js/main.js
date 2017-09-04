function renderTemplate(name, data) {
    var template = document.getElementById(name).innerHTML;

    for(var property in data) {
        if(data.hasOwnProperty(property)) {
            var search = new RegExp('{' + property + '}', 'g');
            template = template.replace(search, data[property]);
        }
    }
    return template;
}

function MessageDialog() {

    this.close = function() {
        $('.chat_window').addClass('hidden');
    };

    this.open = function() {
        $('.chat_window').removeClass('hidden');
    };

    this.clear = function() {
        $(".chat_window ul.messages").empty();
    };
}

function Status() {
    this.clear = function(e) {
        var status = $('#user_id .user-status-icon');
        status.removeClass('text-success');
        status.removeClass('text-warning');
        status.removeClass('text-danger');
    };

    this.set = function(new_status) {
        var obj = $('#user_id .user-status-icon');
        switch(new_status) {
            case 1:
                obj.addClass('text-success');
                break;
            case 2:
                obj.addClass('text-warning');
                break;
            case 3:
                obj.addClass('text-danger');
                break;
        }
    };
}

function Chat() {

    this.messageDialog = new MessageDialog();
    this.status = new Status();

    this.moveFriendToUserList = function(user) {
        $('.panel-friend .table-friends .user-id-' + user.id).remove();
        var new_user = renderTemplate('new-user-item', {id: user.id, name: user.name});
        $('.panel-users .table-users tbody').append(new_user);
    };

    this.moveUserToFriendList = function(user) {
        $('.panel-users .table-users tr.user-id-' + user.id).remove();
        var new_user = renderTemplate('new-friend-item', {
            id: user.id,
            name: user.name,
            data: (new Date).toTimeString().slice(0, 8)
        });
        $('.panel-friend .table-friends tbody').append(new_user);
    };

    this.incCounter = function(counter) {
        counter.html(parseInt(counter.html()) + 1);
    };

    this.decCounter = function(counter) {
        counter.html(parseInt(counter.html()) - 1);
    };
};

var chat = new Chat('Зверь');