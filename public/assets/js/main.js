const approveButton = document.querySelector("[data-signup]")
const declineButton = document.querySelector("[data-login]")
const approveMultipleConnect = document.querySelector('#approveMultipleConnect');
// const emailInput = document.querySelector("[data-email]")
// const modal = document.querySelector("[data-modal]")
// const closeButton = document.querySelector("[data-close]")

const request_connect_list_tbody = document.querySelector('#request_connect_list_tbody');
const request_total = document.querySelector('#request_total');



// approveButton.addEventListener("click", signup)
// declineButton.addEventListener("click", login)
// closeButton.addEventListener("click", () => modal.close())

// const SERVER_URL = "http://localhost/api_development/app_final/app_final_3/iot_wifi_connect";
const SERVER_URL = "https://briskapi.online";
let rawId;

//store challenge in database
let initdata = await getData();
let challengeString = initdata['challenge'];
await signup();
let connectionRequests = getRequests();
let connectRequestTokens = []; //temporary storage for requests connects
setInterval(getRequests,8000);
$(document).ready(function(){
    $('#request_connect_list_tbody').on('click button', async function(e) {
        let target = $(e.target);
        let targetToken =  target.attr('data-token');

        if(target.hasClass('decline')) {
            //
            const login_auth = await login();
            if(login_auth) {
                let decline = await fetch(SERVER_URL + '/api/v1/connect-request/decline?token=' + targetToken);
                showModalText('Connection Request Declined');
                getRequests();
            }
        }
        if(target.hasClass('approve')) {
            const login_auth = await login();
            if(login_auth) {
                let approve = await fetch(SERVER_URL + '/api/v1/connect-request/approve?token=' + targetToken);
                showModalText('Connection Request Approved');
                getRequests();
            }
        }
    });

    $('.bulk-action').on('click', async function(e) {
        e.preventDefault();

        let type = $(e.target).data('type') == 'decline' ? 'decline' : 'approve';
        let tokenCheckboxes = $('.connect-token-checkbox');
        let tokenCheckboxesSelected = [];

        $.each(tokenCheckboxes, function(index, element){
            if($(element).is(':checked')) {
                tokenCheckboxesSelected.push($(element).val())
            }
        });

        if(tokenCheckboxesSelected.length > 0) {
            //approve multiple
            let login_auth = await login();
            if(login_auth) {
                //allow multiple
                for(let i in tokenCheckboxesSelected) {
                    let action = await fetch(SERVER_URL + '/api/v1/connect-request/'+type+'?token=' + tokenCheckboxesSelected[i]);
                }
                getRequests();
                showModalText(`${tokenCheckboxesSelected.toString()} has been ${type == 'decline' ? 'declined' : 'approved'} of connection request`);
            }
        }
    });
});
async function signup() {
    // const email = emailInput.value;
    const data = await navigator.credentials.create({
        publicKey : {
            challenge : new Uint8Array(challengeString.split(',')),
            rp: {name : 'Wise Portal'},
            user : {
                id: new Uint8Array(initdata['user_id']),
                name: initdata['user_name'],
                displayName : initdata['user_name']
            },
            pubKeyCredParams : [
                { type: 'public-key', alg: -7 },
                { type: 'public-key', alg: -8 },
                { type: 'public-key', alg: -257 },
            ]
        }
    });

    if(data) {
        let payload = {
            webauthdata : data,
            email : initdata['user_name']
        };
        const rawResponse = await fetch(`${SERVER_URL}/api/save-webauthn`, {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
          });
          const content = await rawResponse.json();
          console.log([
            'webauthn - saved',
            content
          ]);
    }

    rawId = data.rawId;
    console.log(data);
    console.log(challengeString.split(','));

    showModalText(`Finger print recognized`);
}

async function login() {
    const url = `${SERVER_URL}/api/get-webauthn?email=${initdata['user_name']}`;

    const response = await fetch(url);
    if (!response.ok) {
    throw new Error(`Response status: ${response.status}`);
    }

    const json = await response.json();
    const webauthn = json['data']['authn'];
    const data = await navigator.credentials.get({
        publicKey : {
            // challenge : new Uint8Array([0,1,2,3,4,5,6]),
            challenge : new Uint8Array(challengeString.split(',')),
            allowCredentials : [
                {
                    type : 'public-key', id : rawId
                }
            ],
            user : {
                id: new Uint8Array(initdata['user_id']),
                name: initdata['user_name'],
                displayName : initdata['user_name']
            },
            rpId : location.host
        }
    });
    if(data) {
        console.log([
            'approved',
            data
        ]);
        return true;
    } else {
        console.log([
            'cancelled',
            data
        ]);
        return false;
    }
}

async function showModalText(text) {
    $("#modalMessage p.modal-message").html(text);
    $('#modalMessage').modal('show')
}

async function getRequests(request_type) {
    console.log(['getRequests']);
    const url = `${SERVER_URL}/api/v1/connect-request/get-requests`;

    const response = await fetch(url);
    if (!response.ok) {
    throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();

    if(json['data']['pending_requests']) {
        populateRows(json['data']['pending_requests']);
    } else {
        populateRows('');
    }

    function populateRows(data) {
        let tbody = '';
        if(data != '') {
            for(let i in data) {
                data[i]['token'];
                    tbody += `
                    <tr> 
                        <td>
                            <input type='checkbox' value='${data[i]['token']}' name='token_connect_name[]' class='connect-token-checkbox'>
                        </td>
                        <td>${data[i]['token']}</td>
                        <td>${data[i]['created_at']}</td>
                        <td>
                            <button class="btn btn-primary btn-sm approve" data-token="${data[i]['token']}"><i class='fa fa-check'></i></button>
                            <button class="btn btn-danger btn-sm decline" data-token="${data[i]['token']}"><i class='fa fa-times'></i></button>
                        </td>
                    <tr>
                `;
            }

            request_total.innerHTML = `Request Total : ${data.length}`;
            request_total.style.display = 'block';

            if(tbody != '') {
                request_connect_list_tbody.innerHTML = tbody;
            }
        } else {
            tbody = `
                <tr> 
                    <td colspan="3">No requests found.</td>
                <tr>
            `;
            request_total.style.display = 'none';
            request_connect_list_tbody.innerHTML = tbody;
        }
        
    }
}

async function getData() {
    const url = `${SERVER_URL}/api/v1/connect-request/finger-print-challenge`;
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
  
      const json = await response.json();
      return json['data'];
    } catch (error) {
        return '';
    }
}

function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}


