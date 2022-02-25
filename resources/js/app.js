require('./bootstrap');

const message_input = document.getElementById("message_input");
const message_form = document.querySelector("#message_form");
const messages_el = document.querySelector('.messages');
const receiver_id = document.querySelector('#receiver_id');
const current_user_id = document.querySelector('#current_user');
message_form.addEventListener('submit',function (e){
    e.preventDefault();
    let has_errors = false;

    if (message_input.value == ''){
        alert('Jepni Mesazhin');
        has_errors = true;
    }
    if (has_errors){
        return;
    }
    const options = {
        method:'post',
        url:'/sendMessage',
        data:{
            name:message_input.value,
            receiver_id:receiver_id.value
        }
    }
    axios(options);
    message_input.value = '';
    message_input.focus();

});
window.Echo.private(`user_chat`).listen('.user_message',(e)=>{
    console.log(Number(current_user_id.value),e.sender_id, Number(receiver_id.value))
    if (Number(current_user_id.value) == e.receiver_id || Number(current_user_id.value) == e.sender_id){
        const message = `<div class="message"> <strong>${e.sender_name}</strong>: ${e.message}</div>`;
        messages_el.insertAdjacentHTML('afterbegin',message);
        message_input.value = '';
        message_input.focus();
    }

    // console.log(e.receiver_id, receiver_id.value)

});

