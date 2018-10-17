var postId=0;
var postBodyElement=null;
$('.posts').on('click', '.post .interaction .edit', function (event) {
    event.preventDefault();
    postBodyElement=$(this).closest('.post').find('p:eq(0)');
    var postBody = postBodyElement.text();
    $('#post-body').val(postBody);
    postId = event.target.parentNode.parentNode.dataset['postid'];

    $('#edit-modal').modal();
});

/*$('.post').find('.interaction').find('.edit').eq(2).on('click', function (event) {
     event.preventDefault();
    console.log("shit happens");
    var postBody = event.target.parentNode.parentNode.childNodes[1].textContent;
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});*/

// $('.save-btn').on('click',function (event) {
//     event.preventDefault();
// });
$('#modal-save').on('click',function () {

    $.ajax({

       method:'POST',
       url : urlEdit ,
       data :{body:$('#post-body').val(),postId:postId,_token:token}

   }).done(function (msg) {
           $(postBodyElement).text(msg['new_body']);
           $('#edit-modal').modal('hide');
       });
});

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});
