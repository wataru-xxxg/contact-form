const modal = document.querySelector('.js-modal');
const modalButton = document.querySelector('.js-modal-button');

// 追記
const modalClose = document.querySelector('.js-close-button');　// xボタンのjs-close-buttonを取得し変数に格納

modalButton.addEventListener('click', () => {
  modal.classList.add('is-open');
});

// 追記
modalClose.addEventListener('click', () => { // xボタンをクリックしたときのイベントを登録
  modal.classList.remove('is-open'); 
});