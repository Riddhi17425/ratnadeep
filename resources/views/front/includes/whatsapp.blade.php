<!-- intl-tel-input CSS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.4/build/css/intlTelInput.css" />

<style>
    .wa-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
    }

    .wa-button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #25D366; /* WhatsApp Green */
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        border: none;
        position: relative;
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        transition: .3s ease;
        animation: waBounce 2s infinite;
    }

    .wa-button:hover {
        transform: scale(1.08);
    }

    /* Pulse Ring */
    .wa-button::before {
        content: "";
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        border-radius: 50%;
        border: 2px solid rgba(37, 211, 102, 0.7);
        animation: waPulse 2s infinite;
    }

    .wa-button::after {
        content: "";
        position: absolute;
        top: -12px;
        left: -12px;
        right: -12px;
        bottom: -12px;
        border-radius: 50%;
        border: 2px solid rgba(37, 211, 102, 0.35);
        animation: waPulse 2s infinite .8s;
    }

    /* Pulse Animation */
    @keyframes waPulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    /* Small Bounce */
    @keyframes waBounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .wa-modal {
        display: none;
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 350px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
    }

    .wa-header {
        background: #1C1731; /* Ratnadeep Dark Blue */
        color: #fff;
        padding: 25px 20px;
        position: relative;
        text-align: center;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .wa-header h4 {
        margin: 0;
        color: white;
        font-family: inherit;
        font-weight: 600;
        font-size: 20px;
        letter-spacing: 1px;
    }

    .wa-header p {
        font-size: 13px;
        margin-top: 5px;
        margin-bottom: 0px;
        opacity: 0.9;
    }

    .wa-close {
        position: absolute;
        right: 15px;
        top: 10px;
        font-size: 25px;
        cursor: pointer;
    }

    .wa-body {
        padding: 20px;
    }

    .iti {
        width: 100%;
        margin-bottom: 0px;
    }

    #wa-phone {
        width: 100%;
        height: 50px;
        padding-left: 90px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
    }
    
    #wa-phone:focus {
        border-color: #e31e24;
    }

    #wa-textarea {
        width: 100%;
        height: 100px;
        margin-top: 10px;
        margin-bottom: 15px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        resize: none;
        font-family: inherit;
    }
    
    #wa-textarea:focus {
        border-color: #e31e24;
    }

    .wa-send {
        width: 100%;
        height: 50px;
        background: #1C1731; /* Ratnadeep Dark Blue */
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        transition: 0.3s ease;
    }
    
    .wa-send:hover {
        background: #e31e24; /* Ratnadeep Red on hover */
    }

    @media(max-width:768px) {
        .wa-modal {
            width: 320px;
        }
    }
</style>

<div class="wa-container">

    <div class="wa-button" onclick="toggleWAModal()">

        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

            <g clip-path="url(#clip0_1317_780)">

                <path
                    d="M11.6528 0C14.7445 0 17.6523 1.20025 19.8392 3.3874L20.2336 3.79825C21.1279 4.7808 21.8462 5.9126 22.3554 7.14292C22.9368 8.54807 23.2327 10.0547 23.228 11.5754C23.228 17.9521 18.0411 23.1397 11.6638 23.1397C9.81895 23.1397 8.01534 22.7023 6.38485 21.8603L0.885306 23.3051C0.641222 23.3692 0.381616 23.2971 0.20424 23.1176C0.0270453 22.9384 -0.0415868 22.6783 0.0250131 22.4352L1.49468 17.0887C0.638224 15.5084 0.16176 13.7503 0.104976 11.9545L0.0994616 11.5754C0.0886639 5.18708 5.27647 0.00013398 11.6528 0ZM11.6528 1.41176C6.05625 1.41189 1.5012 5.96637 1.51122 11.574V11.5768C1.50895 13.3563 1.97663 15.1056 2.86509 16.6475C2.9589 16.8107 2.98391 17.005 2.93401 17.1865L1.71113 21.6272L6.29248 20.4265L6.42483 20.4044C6.55816 20.3955 6.69205 20.4248 6.81086 20.4899C8.29677 21.3045 9.95906 21.7279 11.6638 21.7279C17.2615 21.7279 21.8163 17.1724 21.8163 11.5754C21.8207 10.2405 21.5602 8.91543 21.0498 7.68199C20.5395 6.44904 19.7898 5.3295 18.844 4.38833L18.8425 4.38695C16.921 2.46484 14.3718 1.41176 11.6528 1.41176ZM8.78106 5.36496L8.88584 5.36635C9.01773 5.37263 9.22246 5.40063 9.43179 5.52075C9.71006 5.68058 9.89593 5.94108 10.0301 6.24457C10.1588 6.53059 10.3574 7.01561 10.5237 7.42747C10.6084 7.63716 10.6862 7.83029 10.747 7.97893L10.8353 8.19538L10.8477 8.21883C10.9601 8.44368 11.1006 8.8621 10.8711 9.32314C10.8658 9.3339 10.8591 9.34439 10.8532 9.35485C10.8029 9.44406 10.6906 9.6948 10.5003 9.91874L10.4989 9.92149C10.4276 10.0046 10.2853 10.1738 10.1584 10.3158C10.3558 10.6238 10.6977 11.1276 11.1551 11.5924L11.4157 11.8392C12.2617 12.595 12.9526 12.8657 13.3224 13.0263C13.3996 12.938 13.5005 12.8263 13.6009 12.705C13.7752 12.4944 13.9235 12.3044 13.9856 12.2073L13.9925 12.1949C14.1578 11.9474 14.4109 11.7288 14.7755 11.6876C15.0578 11.6557 15.3162 11.753 15.418 11.7882H15.4208C15.5975 11.85 16.0429 12.0645 16.4161 12.2459L17.3481 12.7023L17.3797 12.7188C17.4355 12.7491 17.4887 12.7752 17.5439 12.8029C17.595 12.8287 17.659 12.8612 17.7162 12.8925C17.7817 12.9284 17.9236 13.0053 18.0499 13.1407L18.1684 13.2965C18.2333 13.4053 18.2607 13.5124 18.2732 13.5695C18.2881 13.6373 18.2961 13.7056 18.3008 13.7666C18.31 13.8891 18.3085 14.0263 18.2967 14.1692C18.2724 14.4572 18.2042 14.8123 18.0733 15.1853L18.0719 15.1908C17.8741 15.7378 17.3714 16.154 16.9717 16.4109C16.6123 16.6419 16.1789 16.8431 15.8068 16.9196L15.6523 16.9459C15.4449 16.9692 15.0982 17.0443 14.526 16.9679C13.9782 16.8948 13.2267 16.6888 12.0568 16.2276L12.0554 16.2261C10.5368 15.6245 9.32466 14.5601 8.49015 13.6549C8.06966 13.1988 7.73578 12.7741 7.49888 12.4514C7.38021 12.2897 7.28662 12.1526 7.21763 12.0515C7.18354 12.0016 7.15488 11.9598 7.13492 11.9302C7.12049 11.9088 7.11281 11.8984 7.1101 11.8944C7.03215 11.7906 6.72918 11.3856 6.4442 10.8231C6.16182 10.2658 5.86516 9.4925 5.86516 8.66552C5.86533 7.03579 6.74161 6.20618 7.00256 5.92333C7.41344 5.47654 7.91463 5.35394 8.25027 5.35394C8.418 5.35394 8.60208 5.355 8.78106 5.36496ZM8.22545 6.76846C8.2117 6.77104 8.19456 6.77482 8.17582 6.78225C8.13954 6.79668 8.09113 6.82383 8.0407 6.87876C7.7928 7.14749 7.27708 7.62334 7.27693 8.66552C7.27693 9.17547 7.46761 9.71763 7.70431 10.1848C7.82033 10.4138 7.93988 10.6107 8.03795 10.7597L8.24061 11.0479L8.24199 11.0493C8.42754 11.2976 10.0437 13.9106 12.5752 14.9136L13.3307 15.1963C14.0007 15.4308 14.4265 15.5289 14.7135 15.5671C15.0712 15.6149 15.2056 15.5748 15.4952 15.5423C15.5898 15.5318 15.8852 15.4322 16.2092 15.2239C16.5441 15.0086 16.7103 14.8049 16.7443 14.711C16.8323 14.4582 16.8731 14.2248 16.8876 14.0534C16.8438 14.0313 16.7933 14.0053 16.7387 13.9762L15.7984 13.5157C15.6008 13.4195 15.4062 13.3253 15.247 13.251C15.1674 13.2138 15.0986 13.1825 15.0444 13.1586L15.0388 13.1559C14.7828 13.5024 14.3773 13.9783 14.2351 14.1305L14.2323 14.1293C14.0801 14.297 13.8578 14.4624 13.5485 14.4987C13.2619 14.532 13.0113 14.4405 12.8275 14.3498C12.6019 14.2421 11.6086 13.9046 10.4768 12.8939L10.1556 12.5892C9.44362 11.8668 8.97548 11.09 8.83345 10.8631C8.82723 10.8532 8.82124 10.843 8.81552 10.8328C8.66476 10.5623 8.5994 10.2421 8.71763 9.91735C8.80646 9.67356 8.97733 9.50848 9.05541 9.4362L9.4249 9.00468C9.45361 8.97089 9.4728 8.94262 9.49659 8.8999C9.51099 8.87403 9.52419 8.84688 9.54622 8.80476C9.54985 8.79781 9.5533 8.79022 9.55725 8.78271C9.52107 8.70284 9.47592 8.60138 9.44006 8.51386C9.37741 8.36091 9.29761 8.16259 9.21397 7.9555C9.04354 7.53358 8.85858 7.07875 8.74383 6.8236L8.74108 6.81809C8.73339 6.80057 8.72406 6.78672 8.71763 6.77398C8.58397 6.76583 8.43563 6.7657 8.25027 6.7657H8.24338C8.23907 6.7661 8.23237 6.76717 8.22545 6.76846Z"
                    fill="white" />

            </g>

            <defs>

                <clipPath id="clip0_1317_780">

                    <rect width="24" height="24" fill="white" />

                </clipPath>

            </defs>

        </svg>

    </div>

    <div class="wa-modal" id="hnoww-wa-modal">

        <div class="wa-header">

            <span class="wa-close" onclick="toggleWAModal()">&times;</span>

            <h4>Ratnadeep</h4>

            <p>Welcome to Ratnadeep! How can we help you?</p>

        </div>

        <form id="whatsapForm">

            <div class="wa-body whatsappform">

                <input type="tel" id="wa-phone" name="phone" required autocomplete="off">

                 <small id="wa-phone-error" style="color:#d9534f; font-size:12px; display:none;">
                    Please enter a valid phone number.
                </small>

               <textarea id="wa-textarea" name="message_display" placeholder="Type your message here..."></textarea>

                <input type="hidden" id="wa_full_phone" name="number">
                <input type="hidden" id="wa_message_hidden" name="message">

               <button class="wa-send" type="submit" id="waSendBtn">
                    <span class="btn-text">Start Chat on WhatsApp</span>
                    <span class="btn-loader" style="display:none;">
                        <span class="spinner-border spinner-border-sm" style="width:16px;height:16px;border-width:2px;"></span>
                        Sending...
                    </span>
                </button>
            </div>

        </form>

    </div>

</div>

<!-- Latest JS -->

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.4/build/js/intlTelInput.min.js"></script>

<script>
    let iti;



    document.addEventListener("DOMContentLoaded", async function() {



        const phoneInput = document.querySelector("#wa-phone");



        iti = window.intlTelInput(phoneInput, {

            initialCountry: "auto",



            geoIpLookup: function(callback) {



                fetch("https://ipwho.is/")

                    .then(res => res.json())

                    .then(data => {

                        callback(data.country_code.toLowerCase());

                    })

                    .catch(() => {

                        callback("in");

                    });



            },



            separateDialCode: true,



            loadUtils: () => import(
                "https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.4/build/js/utils.js")

        });


            document
                .getElementById("whatsapForm")
                .addEventListener("submit", function (e) {
                    e.preventDefault();

                    // 1. Validate the phone number - block submit if invalid
                    if (!iti.isValidNumber()) {
                        document.getElementById("wa-phone-error").style.display = "block";
                        return;
                    }
                    document.getElementById("wa-phone-error").style.display = "none";

                    // 2. Get the message
                    let userPhone = iti.getNumber();
                    let messageText = document.getElementById("wa-textarea").value;
                    
                    // Add the phone to the message context if needed
                    let finalMessage = "Hello, my contact number is " + userPhone + ".\n\n" + messageText;

                    // 3. Open WhatsApp in new tab for Ratnadeep's number
                    let ratnadeepPhone = "912223805700";
                    let waUrl = "https://wa.me/" + ratnadeepPhone + "?text=" + encodeURIComponent(finalMessage);
                    
                    window.open(waUrl, '_blank');
                    
                    // 4. Close Modal
                    toggleWAModal();
                    document.getElementById("wa-textarea").value = "";
                });



    });



    function toggleWAModal() {

        const modal = document.getElementById("hnoww-wa-modal");

        modal.style.display =

            modal.style.display === "block"

            ?

            "none"

            :

            "block";

    }
</script>
