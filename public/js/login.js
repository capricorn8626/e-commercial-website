
const container = document.getElementById("container");
const registerBtn = document.getElementById('register');
const dangkySubmit = document.getElementById('dangky');
const dangnhapSubmit = document.getElementById('dangnhap');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', ()=> {
    container.classList.add('active');
});
dangkySubmit.addEventListener('click', ()=> {
    container.classList.add('active');
    let toastTop = 20;
});
loginBtn.addEventListener('click', ()=> {
    container.classList.remove('active');
});
