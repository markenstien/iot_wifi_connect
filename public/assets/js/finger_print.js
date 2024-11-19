const signupButton = document.querySelector("[data-signup]")
const loginButton = document.querySelector("[data-login]")
const emailInput = document.querySelector("[data-email]")
const modal = document.querySelector("[data-modal]")
const closeButton = document.querySelector("[data-close]")

signupButton.addEventListener("click", signup)
loginButton.addEventListener("click", login)
closeButton.addEventListener("click", () => modal.close())

const SERVER_URL = "http://localhost:3000";

async function signup() {
    const email = emailInput.value;

    const data = await navigator.credentials.create({
        publicKey : {
            challenge : new Uint8Array([0,1,2,3,4,5,6]),
            rp: {name : 'Wise Portal'},
            user : {
                id: new Uint8Array(16),
                name: "test@test.com",
                displayName : 'Mark Angelo Gonzales'
            },
            pubKeyCredParams : [
                { type: 'public-key', alg: -7 },
                { type: 'public-key', alg: -8 },
                { type: 'public-key', alg: -257 },
            ]
        }
    });

    console.log(data);
    showModalText(`Successfully registered ${email}`);
}

async function login() {
    const email = emailInput.value;
    showModalText(`Successfully loggedin ${email}`);
}

async function showModalText(text) {
    modal.querySelector('[data-content]').innerText = text;
    modal.showModal();
}



