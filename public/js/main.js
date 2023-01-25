function OnLinkClick() {
    var result = confirm('消去しますか？');
    const date = "id";
    if( result == true) {
        location.href = "/trade_delete"
    } else {
        alert('消去をキャンセルしました')
    }
}

function OnLinkClick2() {
    var result = confirm('消去しますか？');
    const date = "id";
    if( result == true) {
        location.href = "/multi_delete"
    } else {
        alert('消去をキャンセルしました')
    }
}

function like() {

    $.ajax({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url:'/good/${itemId}',
        type:"POST",
        datatype: 'json',
    })
    .done(function (data) {
        var target = document.getElementById("good");
        if(target.className == "far fa-heart") {
            target.className = "fas fa-heart";
        } else {
            target.className = "far fa-heart";
        }
        $(".good-counter").html("いいね数: ");
        $(".good-counter").append(data.count);   
        console.log(data.count);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert('sippai');
        console.log("jqXHR"+ jqXHR.status);
        console.log("textStatus"+ textStatus);
        console.log("errorThrown"+ errorThrown.message);
    });
}

