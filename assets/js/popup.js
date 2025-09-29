var clickedDate;

function formatDate(date) {
    var d = new Date(date);
    var year = d.getFullYear();
    var month = ('0' + (d.getMonth() + 1)).slice(-2);
    var day = ('0' + d.getDate()).slice(-2);
    return year + '-' + month + '-' + day;
}

document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('myModal');
    var openModals = document.querySelectorAll('.Calendar_day.clickable');
    var cancelModals = document.querySelectorAll('.cancel');
    var modalTitle = document.querySelector('.modal-content h2');
    var modalContent = document.querySelector('.modal-content p');
    var clickedYear, clickedMonth, clickedDay;

    openModals.forEach(function(openModal) {
        openModal.addEventListener('click', function() {
            modal.style.display = 'block';
            clickedYear = document.querySelector('select[name="year"]').value;
            clickedMonth = document.querySelector('select[name="month"]').value;
            clickedDay = this.textContent.substring(0, 2);
            clickedDate = formatDate(clickedYear + '-' + clickedMonth + '-' + clickedDay);
            modalTitle.textContent = clickedDate + ' 詳細資訊';

            modalContent.innerHTML = '';

            var found = false;
            for (var i = 0; i < eventsData.length; i++) {
                var getDate = eventsData[i]['Date'];
                if (getDate == clickedDate) {
                    var Id = eventsData[i]['Event_Id'];
                    var Name = eventsData[i]['Name'];
                    var Remark = eventsData[i]['Info_Remark'] != '' ? eventsData[i]['Info_Remark'] : '無';
                    var startTime = eventsData[i]['Time_Start'];
                    var endTime = eventsData[i]['Time_End'];
                    var Content = eventsData[i]['Info_Content'];
                    modalContent.innerHTML += '<hr>';
                    if (access == '管理員') {
                        modalContent.innerHTML += '<i class="fa-solid fa-pen-to-square edit_event_icon" data-id="' + Id + '"></i>';
                        modalContent.innerHTML += '<i class="fa-solid fa-trash delete_event_icon" data-id="' + Id + '"></i>';
                    }
                    modalContent.innerHTML += '姓名：' + Name + '<br>備註：' + Remark;
                    modalContent.innerHTML += '<br>時間：' + startTime+' - ' + endTime + '<br><br>工作內容：<br>' + Content;
                    found = true;
                } 
            }
            for (var i = 0; i < trainsData.length; i++) {
                var getDate = trainsData[i]['Date'];
                if (getDate == clickedDate) {
                    var Id = trainsData[i]['Train_Id'];
                    var Name1 = trainsData[i]['Name1'];
                    var Name2 = trainsData[i]['Name2'];
                    var startTime = trainsData[i]['Time_Start'];
                    var endTime = trainsData[i]['Time_End'];
                    var Content = trainsData[i]['Train_Content'];
                    modalContent.innerHTML += '<hr>';
                    if (access == '管理員') {
                        modalContent.innerHTML += '<i class="fa-solid fa-pen-to-square edit_train_icon" data-id="' + Id + '"></i>';
                        modalContent.innerHTML += '<i class="fa-solid fa-trash delete_train_icon" data-id="' + Id + '"></i>';
                    }
                    modalContent.innerHTML += '培訓人員：' + Name1 + '<br>實習人員：' + Name2;
                    modalContent.innerHTML += '<br>時間：' + startTime + ' - ' + endTime + '<br><br>工作內容：<br>' + Content;
                    found = true;
                } 
            }
            if (found) {
                document.querySelector('.modal-content').style.display = 'block';
            } else {
                modalContent.innerHTML += '<hr>無資料';
            }
        });
    });

    cancelModals.forEach(function(cancelModal) {
        cancelModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    });

    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});