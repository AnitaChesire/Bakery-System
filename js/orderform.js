const phone = document.getElementById('phone')
const product = document.getElementById('product')
const quantity = document.getElementById('quantity')
const paymentcode = document.getElementById('paymentcode')
const orderForm = document.getElementById('orderForm')
const orderFormError = document.getElementById('orderFormError')

orderForm.addEventListener('submit', (e) => {

    ///array that will display the error 
  
    let messages = []
  
  //checks if the field is null
    if (phone.value === '' || phone.value == null) {
      messages.push('Phone field is required')
    }
  
    // checks the length of the paymentcode. paymentcode shouldnt be less than 7 characters
    if (paymentcode.value.length <= 7) {
      messages.push('Password must be greater than 7 characters')
    }
  
    // check the length of the paymentcode. paymentcode shouldnt be greater than 7 characters
    if (paymentcode.value.length >= 7) {
      messages.push('Password cant be greater than 7 characters')
    }  
    if (messages.length > 0) {
  
     // To prevent default of submitting the form
  
     e.preventDefault()
  
        orderFormError.innerText = messages.join(', ')
    }
    else{
      orderForm.submit();
    }
  
  
  });
  