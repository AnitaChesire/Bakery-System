const categoryUploaderror = document.getElementById('categoryUploaderror')
const CategoryName = document.getElementById('categoryName')
const categoryDescription = document.getElementById('categoryDescription')
const uploadCategory = document.getElementById('uploadCategory')



uploadCategory.addEventListener('submit', (e) => {

    ///array that will display the error 
  
    let messages = []
  
  //checks if the field is null
    if (CategoryName.value === '' || CategoryName.value == null) {
      messages.push('Category Name field is required')
    }
    if (categoryDescription.value === '' || categoryDescription.value == null) {
        messages.push('Category Description field is required')
      }
  
    if (messages.length > 0) {
  
     // To prevent default of submitting the form
  
     e.preventDefault()
  
     categoryUploaderror.innerText = messages.join(', ')
    }
    else{
      uploadCategory.submit();
    }
  
  
  });