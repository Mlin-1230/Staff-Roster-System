document.addEventListener('click', function(event) {
    var clickedId = event.target.getAttribute('data-id');
    
    if (event.target.classList.contains('edit_event_icon')) {
        location.href = 'events.php?type=edit_event&id=' + clickedId;
    }

    if (event.target.classList.contains('edit_train_icon')) {
        location.href = 'events.php?type=edit_train&id=' + clickedId;
    }

    if (event.target.classList.contains('delete_event_icon')) {
        location.href = './manage/events_delete.php?id=' + clickedId;
    }

    if (event.target.classList.contains('delete_train_icon')) {
        location.href = './manage/train_delete.php?id=' + clickedId;
    }
});