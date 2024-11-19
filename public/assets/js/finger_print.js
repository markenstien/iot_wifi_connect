const signupButton = document.querySelector("[data-signup]")
const loginButton = document.querySelector("[data-login]")
// const emailInput = document.querySelector("[data-email]")
const modal = document.querySelector("[data-modal]")
const closeButton = document.querySelector("[data-close]")

signupButton.addEventListener("click", signup)
loginButton.addEventListener("click", login)
closeButton.addEventListener("click", () => modal.close())

const SERVER_URL = "http://localhost/api_development/api_iot_wifi_connect";
let rawId;

//store challenge in database
let initdata = await getData();
let challengeString = initdata['challenge'];
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

    showModalText(`Successfully registered`);
}

async function login() {
    const url = `${SERVER_URL}/api/get-webauthn?email=${initdata['user_name']}`;

    const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
  
      const json = await response.json();
      const webauthn = json['data']['authn'];

      console.log([
        'webauthn',
        webauthn
      ]);

    const webauthnData = JSON.parse(webauthn);
    
    const data = await navigator.credentials.get({
        publicKey : {
            // challenge : new Uint8Array([0,1,2,3,4,5,6]),
            challenge : new Uint8Array(challengeString.split(',')),
            user : {
                // id: new Uint8Array(16),
                id: new Uint8Array(initdata['user_id']),
                name: initdata['user_name'],
                displayName : initdata['user_name']
            },
            rpId : location.host
        }
    });
    if(data) {
        console.log('okay - login')
    } else {
        console.log('cancel - login');
    }
}

async function showModalText(text) {
    modal.querySelector('[data-content]').innerText = text;
    modal.showModal();
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


