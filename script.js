function coursesearch() {
  var txt = document.getElementById("txt");
  var cat = document.getElementById("c3");
  var lec = document.getElementById("l");
  var sub = document.getElementById("s");

  var f = new FormData();

  f.append("txt", txt.value);
  f.append("cat", cat.value);
  f.append("lec", lec.value);
  f.append("sub", sub.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("view").innerHTML = t;
    }
  }

  r.open("POST", "courseSearchProcess.php", true);
  r.send(f);

}
var rm;
function regModel1() {
  
  var m = document.getElementById("register");
  rm = new bootstrap.Modal(m);
  rm.show();
}
var qum;
function logModel1() {
  
  var m = document.getElementById("tu1");
  qum = new bootstrap.Modal(m);
  qum.show();
}
function signUp() {

  var f = document.getElementById("f");
  var l = document.getElementById("l");
  var e = document.getElementById("e");
  var p = document.getElementById("p");
  var m = document.getElementById("m");
  var g = document.getElementById("g");

  var form = new FormData;
  form.append("f", f.value);
  form.append("l", l.value);
  form.append("e", e.value);
  form.append("p", p.value);
  form.append("m", m.value);
  form.append("g", g.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      
      if (text == "success") {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msg").className = "bi bi-check2-circle fs-5";
        document.getElementById("alertdiv").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
    } else {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
    }


    }
  }

  request.open("POST", "signUpProcess.php", true);
  request.send(form);

}

function signIn() {

  var email = document.getElementById("e2");
  var password = document.getElementById("p2");
  var rememberme = document.getElementById("rememberme");

  var f = new FormData();
  f.append("e", email.value);
  f.append("p", password.value);
  f.append("r", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "index.php";
      } else {
        alert(t);
      }

    }
  };

  r.open("POST", "signInProcess.php", true);
  r.send(f);

}

function changeView() {
 
  var n = document.getElementById("login");
  lm = new bootstrap.Modal(n);
  lm.show();

}
function addToCart(id) {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          alert(t);
          window.location.reload();
      }
  }

  r.open("GET", "addToCartProcess.php?id=" + id, true);
  r.send();

}
function changeProductImage() {
  var image = document.getElementById("imageuploader");

  image.onchange = function () {

      var file_count = image.files.length;

      if (file_count <= 3) {

          for (var x = 0; x < file_count; x++) {
              var file = this.files[x];
              var url = window.URL.createObjectURL(file);

              document.getElementById("i0" ).src = url;
          }

      } else {
          alert("Please select 3 or less than 3 images.");
      }

  }
}
function addProduct(){
  var title=document.getElementById("t");
  var year=document.getElementById("y");
  var sub=document.getElementById("s");
  var price=document.getElementById("p");
  var lec=document.getElementById("l");
  var image=document.getElementById("imageuploader")

  var f=new FormData();

  f.append("t",title.value);
  f.append("y",year.value);
  f.append("s",sub.value);
  f.append("p",price.value);
  f.append("l",lec.value);
  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
      f.append("image" + x, image.files[x]);
  }
  var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product image saved successfully") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addCourseProcess.php", true);
    r.send(f);
}

function saveInvoice(orderId, mail, amount, cid) {

  var f = new FormData();
  f.append("o", orderId);
  f.append("i", cid);
  f.append("m", mail);
  f.append("a", amount);
  
alert(cid);
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "1") {
              window.location = "invoice.php?id=" + orderId;
          } else {
              alert(t);
          }
      }
  }

  r.open("POST", "saveInvoice.php", true);
  r.send(f);

}
var tum;
function regModel(){
  var n = document.getElementById("tu");
  tum = new bootstrap.Modal(n);
  tum.show();
}
var sum;
function logModel() {
  
  var m = document.getElementById("sl");
  sum = new bootstrap.Modal(m);
  sum.show();
}
function teachersignUp() {
  

  var f = document.getElementById("f");
  var l = document.getElementById("l");
  var e = document.getElementById("e");
  var n = document.getElementById("n");
  var m = document.getElementById("m");
  var g = document.getElementById("g");
  var p = document.getElementById("p");

  var form = new FormData;
  form.append("f", f.value);
  form.append("l", l.value);
  form.append("e", e.value);
  form.append("n", n.value);
  form.append("m", m.value);
  form.append("g", g.value);
  form.append("p", p.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      alert(text);
      if (text == "success") {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msg").className = "bi bi-check2-circle fs-5";
        document.getElementById("alertdiv").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
    } else {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
    }


    }
  }

  request.open("POST", "teachersignup.php", true);
  request.send(form);

}
function teachersignIn() {

  var email = document.getElementById("e2");
  var password = document.getElementById("p2");
  var rememberme = document.getElementById("rememberme");

  var f = new FormData();
  f.append("e", email.value);
  f.append("p", password.value);
  f.append("r", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "teacher.php";
      } else {
        alert(t);
      }

    }
  };

  r.open("POST", "teachersignInProcess.php", true);
  r.send(f);

}
function manageCourse(){

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "managemycourse.php", true);
  r.send();
}
function sellingHistory(){

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "sellingHistory.php", true);
  r.send();
}
function purchaseHistory(){

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "purchaseHistory.php", true);
  r.send();
}
function signout() {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {

              
              window.location="index.php";

          } else {
              alert(t);
          }
      }
  };

  r.open("GET", "signoutProcess.php", true);
  r.send();

}
function addCourse(){

 window.location="addCourse.php";
  
}
function addProduct() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");




  var cost = document.getElementById("cost");
  
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageuploader");

  var f = new FormData();

  f.append("ca", category.value);
  f.append("b", brand.value);
  f.append("m", model.value);
  f.append("t", title.value);
  
 
 
 
  f.append("cost", cost.value);
 
  f.append("desc", desc.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
      f.append("image" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "Product image saved successfully") {
              window.location.reload();
          } else {
              alert(t);
          }
      }
  }

  r.open("POST", "addProductProcess.php", true);
  r.send(f);
}
function deleteCourse(id){
  var cid=id;

  var f=new FormData();
  f.append("cid",cid);

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "deletecourse.php", true);
  r.send(f);
}
function myProfile(){

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "myProfile.php", true);
  r.send();
}
function studentProfile(){

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "studentProfile.php", true);
  r.send();
}
function changeImage() {
  var view = document.getElementById("viewImg");//img tag
  var file = document.getElementById("profileimg");//file chooser

  file.onchange = function () {
      var file1 = this.files[0];
      var url = window.URL.createObjectURL(file1);
      view.src = url;
  }

}

function studentupdateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("m");
  var line1 = document.getElementById("address");
  var email = document.getElementById("e");
  var image = document.getElementById("profileimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("e", email.value);
  f.append("m", mobile.value);
  f.append("l1", line1.value);
  

  if (image.files.length == 0) {

      var confirmation = confirm("Are you sure You don't want to update Profile Image?");

      if (confirmation) {
          alert("you have not selected any image.");
      }

  } else {
      f.append("image", image.files[0]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {
              window.location.reload();
              alert(t);
          } else {
              alert(t);
          }
      }
  }

  r.open("POST", "studentupdateProfileProcess.php", true);
  r.send(f);
}
function myCourse(){

  var r=new XMLHttpRequest();

  r.onreadystatechange=function (){
      if(r.readyState==4){
         var t=r.responseText;
         document.getElementById("body").innerHTML=t;
      }
      
  }
  r.open("POST", "mycourse.php", true);
  r.send();
}
var av;
function adminVerification(){
    var email = document.getElementById("e");
     
    var f =new FormData();
    f.append("e",email.value);

    var r=new XMLHttpRequest();

    r.onreadystatechange=function(){
        if(this.readyState==4){
            var t= r.responseText;
            if(t="Success"){
                var adminVerificationModel= document.getElementById("verificationModel")
                av=new bootstrap.Modal(adminVerificationModel);
                av.show();

            }else{
                alert(t);
            }
        }
    }

    r.open("POST","adminVerificationProcess.php",true);
    r.send(f);
}
function verify(){
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t= r.responseText;
            if(t=="Success"){
                av.hide();
                window.location="adminPanel.php";
            }else{
                alert(t);
            }
        }
    }

    r.open("GET","verificationProcess.php?v="+verification.value,true);
    r.send();
}
function adminpanel(){
  
  var r=new XMLHttpRequest();
  r.onreadystatechange=function(){
    if(r.readyState==4 && r.status==200){
      var t=r.responseText;
      if(t=="success"){
        window.location="adminPanel.php";

      }else{
        window.location="adminSignin.php";
      }
    } 
  }
  r.open("GET","adminloged.php",true);
  r.send();
}
function m(id){
  document.getElementById("btn1").style.display ="none";

  var r = new XMLHttpRequest();

r.onreadystatechange = function () {
if (r.readyState == 4) {
  var t = r.responseText;
  
  var obj = JSON.parse(t);
  

  var mail = obj["mail"];
  var amount = obj["amount"];
  var orderId = obj["id"];
  var cid = obj["c_id"];
  
 

  if (t == "1") {
      alert("Please log in or sign up");
      window.location = "index.php";
  }else {
      paypal.Buttons({
        createOrder:function(data, actions) {
          return actions.order.create({
            intent:'CAPTURE',
            payer:{
              name:{
                  given_name:obj["fname"],
                  surname:obj["lname"],
              },
                 address:{
                  address_line_1:"934A Big Avenue",
                  address_line_2:"Amidh Country Byway",
                  admin_area_2:"Berlin",
                  admin_area_1:"Ohio",
                  postal_code:"91500",
                  country_code:"LK",
                 },
                 email_address:obj["mail"],
                 phone:{
                  phone_type:"MOBILE",
                  phone_number:{
                      national_number:"779693100"
                  }
                 },
                 
            },
      
            purchase_units:[{
              amount:{
                  value:obj["amount"],
                  currency_code:"USD"
              }
            }]
          });
        },
        onApprove:function(data,action){
      
          return action.order.capture().then(function(details){
        console.log(details);
      
        saveInvoice(orderId, mail, amount,cid);

          });
        },
      
        onCancel:function(data){
      alert("Payment cancelled");
        },
        onError:function(err){
      alert("Something wrong with your address information that prevents checkout");
        }
        
      
       
      }).render('#paypal-button-container');
   
  }

}
}

r.open("GET", "buyNowProcess.php?id=" + id , true);
r.send();
  
 
      
      


}
function printInvoice() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}
function blockUser(email){

  var request = new XMLHttpRequest();

  request.onreadystatechange = function(){
      if(request.readyState == 4){
          var txt = request.responseText;
          if(txt == "blocked"){
              document.getElementById("ub"+email).innerHTML = "Unblock";
              document.getElementById("ub"+email).classList = "btn btn-success";
          }else if(txt == "unblocked"){
              document.getElementById("ub"+email).innerHTML = "Block";
              document.getElementById("ub"+email).classList = "btn btn-danger";
          }else{
              alert (txt);
          }
      }
  }

  request.open("GET","userBlockProcess.php?email="+email,true);
  request.send();

}
function blockTeachers(email){

  var request = new XMLHttpRequest();

  request.onreadystatechange = function(){
      if(request.readyState == 4){
          var txt = request.responseText;
          if(txt == "blocked"){
              document.getElementById("ub"+email).innerHTML = "Unblock";
              document.getElementById("ub"+email).classList = "btn btn-success";
          }else if(txt == "unblocked"){
              document.getElementById("ub"+email).innerHTML = "Block";
              document.getElementById("ub"+email).classList = "btn btn-danger";
          }else{
              alert (txt);
          }
      }
  }

  request.open("GET","teacherBlockProcess.php?email="+email,true);
  request.send();

}
function blockProduct(id){

  var request = new XMLHttpRequest();

  request.onreadystatechange = function(){
      if(request.readyState == 4){
          var txt = request.responseText;
          if(txt == "blocked"){
              document.getElementById("pb"+id).innerHTML = "Unblock";
              document.getElementById("pb"+id).classList = "btn btn-success";
          }else if(txt == "unblocked"){
              document.getElementById("pb"+id).innerHTML = "Block";
              document.getElementById("pb"+id).classList = "btn btn-danger";
          }else{
              alert (txt);
          }
      }
  }

  request.open("GET","productBlockProcess.php?id="+id,true);
  request.send();

}
function sort1(x) {

  var search = document.getElementById("s");
  

  var f = new FormData();
  f.append("s", search.value);
 
  
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;

          document.getElementById("sort").innerHTML = t;

      }
  }

  r.open("POST", "sortProcess.php", true);
  r.send(f);

}
function deleteFromCart(id) {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {
              alert("Product removed from cart");
              window.location.reload();
          } else {
              alert(t);
          }
      }
  }

  r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
  r.send();

}
function sendId(id) {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {
              window.location = "updateProduct.php";
              
          } else {
              alert(t);
          }
      }
  }

  r.open("GET", "sendProductIdProcess.php?id=" + id, true);
  r.send();
}
function updateProduct() {

  var title = document.getElementById("title");
 
  
  
  var images = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("t", title.value);
  
 

  

  
      f.append("i" , images.files[0]);
 

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          alert(t);
      }
  }

  r.open("POST", "updateProcess.php", true);
  r.send(f);

}
function changeStatus(id){
  var request =new XMLHttpRequest();
request.onreadystatechange=function(){
  if(request.readyState==4){
    response=request.responseText;

    if(response="success"){
      window.reload;
    }
  }
}
  request.open("GET","changeStatusProcess.php?id="+id,true);
  request.send();
}



function checkout(total){
  document.getElementById("btn1").style.display ="none";

  var r = new XMLHttpRequest();

r.onreadystatechange = function () {
if (r.readyState == 4) {
  var t = r.responseText;
  
  var obj = JSON.parse(t);
  

  var mail = obj["mail"];
  var amount = obj["amount"];
  var orderId = obj["id"];
  var cid = obj["c_id"];
  
 

  if (t == "1") {
      alert("Please log in or sign up");
      window.location = "index.php";
  }else {
      paypal.Buttons({
        createOrder:function(data, actions) {
          return actions.order.create({
            intent:'CAPTURE',
            payer:{
              name:{
                  given_name:obj["fname"],
                  surname:obj["lname"],
              },
                 address:{
                  address_line_1:"934A Big Avenue",
                  address_line_2:"Amidh Country Byway",
                  admin_area_2:"Berlin",
                  admin_area_1:"Ohio",
                  postal_code:"91500",
                  country_code:"LK",
                 },
                 email_address:obj["mail"],
                 phone:{
                  phone_type:"MOBILE",
                  phone_number:{
                      national_number:"779693100"
                  }
                 },
                 
            },
      
            purchase_units:[{
              amount:{
                  value:obj["amount"],
                  currency_code:"USD"
              }
            }]
          });
        },
        onApprove:function(data,action){
      
          return action.order.capture().then(function(details){
        console.log(details);
      
        saveInvoice(orderId, mail, amount,cid);

          });
        },
      
        onCancel:function(data){
      alert("Payment cancelled");
        },
        onError:function(err){
      alert("Something wrong with your address information that prevents checkout");
        }
        
      
       
      }).render('#paypal-button-container');
   
  }

}
}

r.open("GET", "checkOutProcess.php?id="+total , true);
r.send();
  
 
      
      


}
var bm;
function forgotPassword() {

    var email = document.getElementById("e2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}
function showPassword1() {

  var i = document.getElementById("npi");
  var eye = document.getElementById("e1");

  if (i.type == "password") {
      i.type = "text";
      eye.className = "bi bi-eye-fill";
  } else {
      i.type = "password";
      eye.className = "bi bi-eye-slash-fill";
  }

}

function showPassword2() {

  var i = document.getElementById("rnp");
  var eye = document.getElementById("e2");

  if (i.type == "password") {
      i.type = "text";
      eye.className = "bi bi-eye-fill";
  } else {
      i.type = "password";
      eye.className = "bi bi-eye-slash-fill";
  }

}

function resetpw() {

  var email = document.getElementById("e2");
  var np = document.getElementById("npi");
  var rnp = document.getElementById("rnp");
  var vcode = document.getElementById("vc");

  var f = new FormData();
  f.append("e", email.value);
  f.append("n", np.value);
  f.append("r", rnp.value);
  f.append("v", vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {

              bm.hide();
              alert("Password reset success");

          } else {
              alert(t);
          }

      }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(f);

}
function mn(){
  alert("ok");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("m");
  var line1 = document.getElementById("address");
  var email = document.getElementById("e");
  var image = document.getElementById("profileimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("e", email.value);
  f.append("m", mobile.value);
  f.append("l1", line1.value);
  

  if (image.files.length == 0) {

      var confirmation = confirm("Are you sure You don't want to update Profile Image?");

      if (confirmation) {
          alert("you have not selected any image.");
      }

  } else {
      f.append("image", image.files[0]);
  }
  var r =new XMLHttpRequest();

  r.onreadystatechange=function(){
    if(r.readyState==4){
      var t=r.responseText;
      alert(t);
    }
  }

  r.open("POST","updateProfileProcess.php",true);
  r.send(f);
}
function searchInvoiceId() { 
  var txt = document.getElementById("searchtxt").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
      if(r.readyState == 4){
          var t = r.responseText;
          
          document.getElementById("viewArea").innerHTML = t;
          
      }
  }

  r.open("GET","searchInvoiceIdProcess.php?id="+txt,true);
  r.send();
}

function findSellings(){

  var from = document.getElementById("from").value;
  var to = document.getElementById("to").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function (){
      if(r.readyState == 4){
          var t = r.responseText;
          document.getElementById("viewArea").innerHTML = t;
      }
  }

  r.open("GET","findSellingsProcess.php?f="+from+"&t="+to,true);
  r.send();

}
var cam;
function contactAdmin(email){
   
   var m = document.getElementById("contactAdmin"+email);
   cam = new bootstrap.Modal(m);
   cam.show();
}
var cum;


function sum(email){
   var txt1 = document.getElementById("m1"+email).value;
   

   var f = new FormData();
   f.append("t",txt1);
   f.append("r",email);

   var r = new XMLHttpRequest();

   r.onreadystatechange = function(){
       if(r.readyState == 4){
           var t = r.responseText;
           alert (t);
       }
   }

   r.open("POST","sendAdminMessageProcess.php",true);
   r.send(f);
}
function sendAdminMsg(){
   var txt = document.getElementById("msgtxt2").value;
   

   var f = new FormData();
   f.append("t",txt);
  

   var r = new XMLHttpRequest();

   r.onreadystatechange = function(){
       if(r.readyState == 4){
           var t = r.responseText;
           alert (t);
       }
   }

   r.open("POST","sendAdminMessageProcess.php",true);
   r.send(f);
}
function mt(email){
   var n = document.getElementById("m"+email);
   cum = new bootstrap.Modal(n);
   cum.show();
   
   
}
