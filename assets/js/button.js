document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('myModal');
    var addButtons = document.querySelectorAll('.add');
    var trainButtons = document.querySelectorAll('.train_btn');
    var SalaryButtons = document.querySelectorAll('.salary_btn');
    var cancelButtons = document.querySelectorAll('.cancel');
    var backButtons = document.querySelectorAll('.back');
    var back2Buttons = document.querySelectorAll('.back2');
    var back3Buttons = document.querySelectorAll('.back3');

    addButtons.forEach(function(addButton) {
        addButton.addEventListener('click', function() {
            location.href = 'events.php?type=add&date=' + clickedDate;
        });
    });

    trainButtons.forEach(function(trainButton) {
        trainButton.addEventListener('click', function() {
            location.href = 'events.php?type=train';
        });
    });

    SalaryButtons.forEach(function(SalaryButton) {
        SalaryButton.addEventListener('click', function() {
            location.href = 'salary.php';
        });
    });

    cancelButtons.forEach(function(cancelButton) {
        cancelButton.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    });

    backButtons.forEach(function(backButton) {
        backButton.addEventListener('click', function(event) {
            location.href = 'schedule.php';
        });
    });

    back2Buttons.forEach(function(back2Button) {
        back2Button.addEventListener('click', function(event) {
            location.href = 'statistic.php';
        });
    });

    back3Buttons.forEach(function(back3Button) {
        back3Button.addEventListener('click', function(event) {
            location.href = 'user.php';
        });
    });
});