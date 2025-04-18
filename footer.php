 <!-- Footer -->


 <footer>
   <div class="container">
     <div class="row">
       <div class="col-md-4">
         <h4>FashionGuide</h4>
         <p>Your personal style companion</p>
       </div>
       <div class="col-md-4">
         <h4>Quick Links</h4>
         <ul class="list-unstyled">
           <li><a href="/about.html">About Us</a></li>
           <li><a href="/contact.html">Contact</a></li>
           <li><a href="#privacy">Privacy Policy</a></li>
         </ul>
       </div>
       <div class="col-md-4">
         <h4>Connect With Us</h4>
         <div class="social-icons">
           <a href="#"><i class="fab fa-facebook"></i></a>
           <a href="#"><i class="fab fa-instagram"></i></a>
           <a href="#"><i class="fab fa-pinterest"></i></a>
         </div>
       </div>
     </div>
   </div>
 </footer>


 <script>
   function alert(type, msg, position = 'body') {
     let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
     let element = document.createElement('div')
     element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert" >
            <strong class="me-3">${msg}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

     if (position == 'body') {
       document.body.append(element)
       element.classList.add('custome-alert')

     } else {
       document.getElementById(position).appendChild(element)
     }
     setTimeout(remAlert, 3000)
   }

   function remAlert() {
     let alertBox = document.getElementById('alert');
     if (alertBox) {
       alertBox.remove();
     }
   }



   //  register form backend

   let register_form = document.getElementById('register-form')
   register_form.addEventListener('submit', (e) => {
     e.preventDefault()
     let data = new FormData(register_form);

     data.append('name', register_form.elements['name'].value)
     data.append('email', register_form.elements['email'].value)
     data.append('phonenum', register_form.elements['phonenum'].value)
     data.append('gender', register_form.elements['gender'].value)

     data.append('dob', register_form.elements['dob'].value)
     data.append('pass', register_form.elements['pass'].value)
     data.append('cpass', register_form.elements['cpass'].value)
     data.append('profile', register_form.elements['profile'].files[0])

     data.append('register', '')
     var myModal = document.getElementById('registerModal');
     var modal = bootstrap.Modal.getInstance(myModal);
     modal.hide();

     let xhr = new XMLHttpRequest();
     xhr.open('POST', 'ajax/login_register.php', true);

     xhr.onload = function() {
       let response = this.responseText.trim(); // Trim spaces

       if (response === 'pass_mismatched') {
         alert('error', "Password mismatch");
       } else if (response === 'email_already') {
         alert('error', "Email already exists");
       } else if (response === 'phone_already') {
         alert('error', "Phone number already exists");
       } else if (response === 'inv_image') {
         alert('error', "Only jpeg, jpg, webp images allowed");
       } else if (response === 'upd_failed') {
         alert('error', "Failed to upload image");
       } else if (response === 'mail_failed') {
         alert('error', "Failed to send mail");
       } else if (response === 'ins_failed') {
         alert('error', "Failed to insert data");
       } else {
         alert('success', "Registration successful!!");
         register_form.reset();
       }
     };

     xhr.send(data);

   })


   let login_form = document.getElementById('login-form');

   login_form.addEventListener('submit', (e) => {
     e.preventDefault();

     let data = new FormData(login_form);
     data.append('login', ''); // Required for PHP condition

     // Hide modal after submitting form
     let myModal = document.getElementById('loginModal');
     let modal = bootstrap.Modal.getInstance(myModal);
     modal.hide();

     // Create AJAX request
     let xhr = new XMLHttpRequest();
     xhr.open('POST', 'ajax/login_register.php', true);

     xhr.onload = function() {
       let response = this.responseText.trim(); // Remove any accidental spaces

       if (response === 'inv_email_mob') {
         alert('error',"Invalid Email or Phone Number");
       } else if (response === 'invalid_pass') {
         alert('error',"Incorrect Password");
       } else if (response === '1') { // Login successful
         window.location.reload();
         login_form.reset(); // Refresh to load session data
       } else {
         console.log("Unexpected response:", response); // Debugging
         alert('error',"Login failed! Please try again.");
       }
     };

     xhr.send(data);
   });
 </script>