const wrapper=document.querySelector('.wrapper');
const loginLink=document.querySelector('.login-link');
const registerLink=document.querySelector('.register-link');
const btnLogin=document.querySelector('.btnLogin');
const overlady=document.querySelector('.overlady');
const iconClose=document.querySelector('.icon-close');
registerLink.addEventListener('click',()=>{
    wrapper.classList.add('active');
});
loginLink.addEventListener('click',()=>{
    wrapper.classList.remove('active');
});
btnLogin.addEventListener('click',()=>{
    wrapper.classList.add('active-pop');

});
iconClose.addEventListener('click',()=>{
    wrapper.classList.remove('active-pop');

});

const loginForm = document.querySelector('.login form');
const registerForm = document.querySelector('.register form');
const btnRegister = document.querySelector('.btnRegister');

// حدث تسجيل الدخول
loginForm.addEventListener('submit', (e) => {
    e.preventDefault(); // لمنع إعادة تحميل الصفحة

    const email = loginForm.querySelector('input[type="email"]').value;
    const password = loginForm.querySelector('input[type="password"]').value;

    // التحقق من صحة البيانات
    if (email === '' || password === '') {
        alert("Please fill in all fields.");
        return;
    }

    if (!validateEmail(email)) {
        alert("Please enter a valid email.");
        return;
    }

    if (password.length > 6) {
        alert("Password should be less than 6 characters .");
        return;
    }

    // إذا كانت البيانات صحيحة
    alert("Login successful");

    // إخفاء نافذة تسجيل الدخول بعد النجاح
    wrapper.classList.remove('active-pop');
    btnLogin.style.display='none';
});

// وظيفة للتحقق من صحة البريد الإلكتروني
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}

// حدث التسجيل
registerForm.addEventListener('submit', (e) => {
    e.preventDefault(); // لمنع إعادة تحميل الصفحة

    const username = registerForm.querySelector('input[type="text"]').value;
    const email = registerForm.querySelector('input[type="email"]').value;
    const password = registerForm.querySelector('input[type="password"]').value;

    // التحقق من صحة البيانات
    if (username === '' || email === '' || password === '') {
        alert("Please fill in all fields.");
        return;
    }

    if (!validateEmail(email)) {
        alert("Please enter a valid email.");
        return;
    }

    if (password.length > 6) {
        alert("Password should be less than 6 characters .");
        return;
    }

    // إذا كانت البيانات صحيحة
    alert("Registration successful");

    // إخفاء نافذة التسجيل بعد النجاح
    wrapper.classList.remove('active-pop');
    btnLogin.style.display='none';
});
 

//  Responsive  to hide the btnMenu
  const btnMenu=document.getElementById('btnMenu');
  const navigation=document.querySelector('.navigation');
    
     btnMenu.addEventListener('click',()=>{
        btnMenu.classList.toggle('fa-times');
        navigation.classList.toggle('hide');
     })




    //  button to Scroll

    let btnScroll=document.getElementById('btnScroll');
   
        window.onscroll=function(){
            if(scrollY >= 100)
                btnScroll.style.display='block';
            else
            btnScroll.style.display='none';
        }  
        btnScroll.onclick=function(){
            scroll({
                left:0,
                top:0,
                behavior:'smooth'
            })
        }
           // change background of header
        const header=document.querySelector('header');
         document.addEventListener('scroll',()=>{
            if(window.scrollY>=30)
                header.style.background="#162938";
            else 
                header.style.background='transparent';
         })

       // about-text
        function showText() {
            var fullText = document.getElementById("full-text");
            var readMore = document.getElementById("read-more");
            
            fullText.style.display = "block"; // Show the full text
            readMore.style.display = "none"; // Hide the "Read More" link
          }