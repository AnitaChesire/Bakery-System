const updateform = document.getElementById('updateform')
const profileFirstName = document.getElementById('profileFirstName')
const txtEmail = document.getElementById('txtEmail')
const txtconPwd = document.getElementById('txtconPwd')
const txtpwd = document.getElementById('txtPwd')
 const updateError = document.getElementById('update-error')

// updateform.addEventListener('submit', (e) => {
//     e.preventDefault();
//     let messages = []

  //  if (profileFirstName.value === '' || profileFirstName.value == null) {
//         messages.push('First name is required')
//     }
//     if (txtEmail.value === '' || txtEmail.value == null) {
//         messages.push('Email is required')
//     }

//     if (txtpwd.value.length <= 6) {
//         messages.push('Password must be greater than 8 characters')
//     }

//      if (txtpwd.value.length >= 20) {
//          messages.push('Password cant be greater than 20 characters')
//      }
//      if (txtconPwd.value === '' || txtconPwd.value == null) {
//         messages.push('Confirm your Password')
//     }
//     if (txtconPwd.value != txtpwd.value) {
//         messages.push('Confirm your Password')
//     }


//     if (messages.length > 0) {
//         updateError.innerText = messages.join(', ');
//     }


// });
