<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
            <title>Cakes</title>
            <link rel ="stylesheet" href="style.css"/>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >

        </head>
        <body>
<!---adding nav bar--->

        <div id="navbar">
       
    <label class="logo">ABC BAKERY</label>
     
        <ul>
            <li class= "active"><a href ="#">HOME</a></li>
            <li><a href ="aboutus.php">ABOUT US</a></li>
            <li><a href ="#">CONTACT</a></li>
            
            <div class="dropdown">
                <button class="dropbtn">ACCOUNT
                <i class=" fa fa-caret-down"></i>
</button>
<div class="dropdown-content">
                         <a href ="index.php">USER LOG IN</a>
                         <a href ="#">ADMIN </a>
                        <a href ="#">MY PROFILE </a>
</div>
</div>
</div>

                </div>
        </li>
            
            

    <!---end of Nav bar-->         

        </ul>
    </div>

        <div class="cakeproducts">
        <div class="container">
        <h1 class="lg-title"> BREAD & BUNS</h1>
        <br></br>


        <!---a new row-->
  <div class="pagetwo.php">
            <div class="row">
            <div class="column">
            
   <div class="card">
  <img src="dutchbuns.jpg" alt="Denim Jeans" style="width:100%">
  <h1>Dutch Buns</h1>
  <p class="price">30/=</p>
  <p>Made with Chocolate and raisings</p>
  <p><button>Order</button></p>
</div>
</div>


<div class="column">
            
   <div class="card">
  <img src="frenchbun.jpg" alt="Denim Jeans" style="width:100%">
  <h1>French Buns</h1>
  <p class="price">40/=</p>
  <p>Made plain with no Additive or flavours</p>
  <p><button>Order</button></p>
</div>
</div>
        
<div class="column">
            
   <div class="card">
  <img src="whitebreadbuns.jpg" alt="Denim Jeans" style="width:100%">
  <h1>Bread Buns</h1>
  <p class="price">25/=</p>
  <p>Made with a touch of Vanilla!</p>
  <p><button>Order</button></p>
</div>
</div>
</div>


<br></br>
<br></br> 

<div class="pagination">
  <a href="#">&laquo;</a>
  <a href="bread.php">1</a>
  <a class="active" href="pagetwo.php">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>
</div>

</body>
</html>
