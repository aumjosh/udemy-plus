/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./src/blocks/auth-modal/frontend.js ***!
  \*******************************************/
document.addEventListener('DOMContentLoaded', () => {
  const openModalBtn = document.querySelectorAll('.open-modal');
  const modalEl = document.querySelector('.wp-block-udemy-plus-auth-modal');
  const modalCloseEl = document.querySelectorAll('.modal-overlay, .modal-btn-close');
  openModalBtn.forEach(el => {
    el.addEventListener('click', event => {
      event.preventDefault();
      modalEl.classList.add('modal-show');
    });
  });
  modalCloseEl.forEach(el => {
    el.addEventListener('click', event => {
      event.preventDefault();
      modalEl.classList.remove('modal-show');
    });
  });
  const tabs = document.querySelectorAll('.tabs a');
  const signinForm = document.querySelector('#signin-tab');
  const signupForm = document.querySelector('#signup-tab');
  tabs.forEach(tab => {
    tab.addEventListener('click', event => {
      event.preventDefault();
      tabs.forEach(currentTab => {
        currentTab.classList.remove('active-tab');
      });
      event.currentTarget.classList.add('active-tab');
      const activeTab = event.currentTarget.getAttribute('href');

      if (activeTab === '#signin-tab') {
        signinForm.style.display = 'block';
        signupForm.style.display = 'none';
      } else {
        signinForm.style.display = 'none';
        signupForm.style.display = 'block';
      }
    });
  }); // we mark this event as async
  // because it will use the fetch() function
  // which will return a promise
  // we don't want to stop executing the code while waiting for the return of the promise

  signupForm.addEventListener('submit', async event => {
    event.preventDefault();
    const signupFieldset = signupForm.querySelector('fieldset');
    signupFieldset.setAttribute('disabled', true);
    const signupStatus = signupForm.querySelector('#signup-status');
    signupStatus.innerHTML = `
            <div class="modal-status modal-status-info">
                Please wait!  We are creating your account.
            </div>
        `; // lets grab the form data

    const formData = {
      username: signupForm.querySelector('#su-name').value,
      email: signupForm.querySelector('#su-email').value,
      password: signupForm.querySelector('#su-password').value
    }; // send the request
    // the async await keyword will tell javascript
    // to wait for the function to resolve
    // the await keyword can be applied to functions that return a promise
    // the await keyword will force function to return the value resolved by the promise
    // so we can assign it to our variable

    const response = await fetch(up_auth_rest.signup, {
      method: 'POST',
      // GET is the default
      headers: {
        'Content-Type': 'application/json' // default is plain-text

      },
      // the fetch function will send objects
      // it must send strings
      body: JSON.stringify(formData)
    });
    const responseJSON = await response.json();

    if (responseJSON.status === 2) {
      signupStatus.innerHTML = `
                <div class="modal-status modal-status-success">
                    Success! Your account has been created.
                </div>
            `; // force the page to refresh to allow the user to be logged in

      location.reload();
    } else {
      // if the user didn't register
      // re-enable the form
      signupFieldset.removeAttribute('disabled');
      signupStatus.innerHTML = `
                <div class="modal-status modal-status-danger">
                    Unable to create account! Please try again later.
                </div>
            `;
    }
  }); // sign-in

  signinForm.addEventListener('submit', async event => {
    event.preventDefault();
    const signinFieldset = signinForm.querySelector('fieldset');
    signinFieldset.setAttribute('disabled', true);
    const signinStatus = signinForm.querySelector('#signin-status');
    signinStatus.innerHTML = `
            <div class="modal-status modal-status-info">
                Please wait!  We are logging you in.
            </div>
        `;
    const formData = {
      user_login: signinForm.querySelector('#si-email').value,
      password: signinForm.querySelector('#si-password').value
    };
    const response = await fetch(up_auth_rest.signin, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    });
    const responseJSON = await response.json();

    if (responseJSON.status === 2) {
      signinForm.status = `
                <div class="modal-status modal-status-success">
                    Success! You have been logged in.
                </div>
            `;
      location.reload();
    } else {
      signinFieldset.removeAttribute('disabled');
      signinStatus.innerHTML = `
                <div class="modal-status modal-status-danger">
                    Unable to log you in! Please try again later.
                </div>
            `;
    }
  });
});
/******/ })()
;
//# sourceMappingURL=frontend.js.map