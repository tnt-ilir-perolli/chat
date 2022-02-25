require('./bootstrap');

const message_input = document.querySelector("#message_input");
const messages_el = document.querySelector('.messages');
const receiver_id = document.querySelector('#receiver_id');
const current_user_id = document.querySelector('#current_user');
const send_btn = document.querySelector('.send_message');
const current_user_name = document.querySelector('#current_user_name');
const leave_btn = document.querySelector('.leave-channel');
const remove_btn = document.querySelector('#remove');
send_btn.addEventListener('click',function (e){
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

    const data = axios(options).then(response => {

        addElement(response.data.id);
    });


    const addElement = function (id){
        const message = `<div class="message" data-id="${id}"> <strong>${current_user_name.value}</strong>: ${message_input.value} <span id="remove" style="color:red; cursor: pointer">(Fshij)</span></div>`;
        messages_el.insertAdjacentHTML('afterbegin',message);

        message_input.value = '';
        message_input.focus();
    }

});
leave_btn.addEventListener('click',function (){
    window.Echo.leave(`user_chat.${Number(current_user_id.value)}`);
});

window.Echo.private(`user_chat.${Number(current_user_id.value)}`).listen('.user_message',(e)=>{
        const message = `<div class="message"> <strong>${e.sender_name}</strong>: ${e.message}</div>`;
        messages_el.insertAdjacentHTML('afterbegin',message);
});
if (messages_el) {
    messages_el.addEventListener('click', function (e) {
        if (e.target.id == 'remove'){
        const message = e.target.closest('.message');
        const id = message.dataset.id;
            const options = {
                method:'delete',
                url:`/message/${id}`,
            }
            axios(options);
        message.remove();
        }

    });
}

