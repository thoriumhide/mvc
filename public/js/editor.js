const visualBtn = document.getElementById('visual');
const htmlBtn = document.getElementById('html');
const visualEditor = document.getElementById('visual-editor');
const htmlEditor = document.getElementById('html-editor');


// По умолчанию показываем визуальный редактор
visualEditor.style.display = 'block';
htmlEditor.style.display = 'none';

// Обработчики нажатия на кнопки
visualBtn.addEventListener('click', () => {
    visualEditor.style.display = 'block';
    htmlEditor.style.display = 'none';
    visualBtn.classList.add('btn-success');
    visualBtn.classList.remove('btn-danger');
    htmlBtn.classList.add('btn-danger');
    htmlBtn.classList.remove('btn-success');
});
htmlBtn.addEventListener('click', () => {
    visualEditor.style.display = 'none';
    htmlEditor.style.display = 'block';
    htmlBtn.classList.add('btn-success');
    htmlBtn.classList.remove('btn-danger');
    visualBtn.classList.add('btn-danger');
    visualBtn.classList.remove('btn-success');
});
// Функция, которая копирует текст из textarea в contenteditable
function syncHtml() {
    visualEditor.innerHTML = htmlEditor.value;
}
// Функция, которая копирует текст из contenteditable в textarea
function syncEditor() {
    htmlEditor.value = visualEditor.innerHTML;
}
// События, которые вызывают функции синхронизации
htmlEditor.addEventListener('input', syncHtml);
visualEditor.addEventListener('input', syncEditor);


/*
// По умолчанию показываем визуальный редактор
editor.style.display = 'none';
htmlEditor.style.display = 'block';

// Обработчики нажатия на кнопки
visualBtn.addEventListener('click', () => {
    editor.style.display = 'block';
    htmlEditor.style.display = 'none';
    editor.innerHTML = htmlEditor.value;
});

htmlBtn.addEventListener('click', () => {
    editor.style.display = 'none';
    htmlEditor.style.display = 'block';
    htmlEditor.value = editor.innerHTML;
});

// Обработчик нажатия на клавишу Enter в визуальном редакторе

editor.addEventListener('keyup', (event) => {
    if (event.keyCode === 13 && editor.innerText.trim() !== '') {
        event.preventDefault();
        document.execCommand('formatBlock', false, 'p');
    }
});
*/

const boldBtn = document.querySelector("#bold-btn");
const underlineBtn = document.querySelector("#underline-btn");
const italicBtn = document.querySelector("#italic-btn");
const colorBtn = document.querySelector("#color-btn");
const paragraphBtn = document.querySelector("#paragraph-btn");
const h1Btn = document.querySelector("#h1-btn");
const h2Btn = document.querySelector("#h2-btn");
const h3Btn = document.querySelector("#h3-btn");
const h4Btn = document.querySelector("#h4-btn");
const h5Btn = document.querySelector("#h5-btn");
const h6Btn = document.querySelector("#h6-btn");
const fontSize1Btn = document.getElementById("font-size-1-btn");
const fontSize2Btn = document.getElementById("font-size-2-btn");
const fontSize3Btn = document.getElementById("font-size-3-btn");
const fontSize4Btn = document.getElementById("font-size-4-btn");
const fontSize5Btn = document.getElementById("font-size-5-btn");
const fontSize6Btn = document.getElementById("font-size-6-btn");
const fontSize7Btn = document.getElementById("font-size-7-btn");
const orderedListBtn = document.querySelector("#orderedList-btn");
const unorderedListBtn = document.querySelector("#unorderedList-btn");
const hrBtn = document.getElementById("hr-btn");
const justifyCenterBtn = document.getElementById("justifyCenter-btn");
const justifyLeftBtn = document.getElementById("justifyLeft-btn");
const justifyRightBtn = document.getElementById("justifyRight-btn");
const justifyFullBtn = document.getElementById("justifyFull-btn");
const removeFormatBtn = document.getElementById("removeFormat-btn");
const unlinkBtn = document.getElementById("unlink-btn");
const subscriptBtn = document.getElementById("subscript-btn");
const superscriptBtn = document.getElementById("superscript-btn");
const strikeThroughBtn = document.getElementById("strikeThrough-btn");

justifyLeftBtn.addEventListener("click", () => {
    document.execCommand("justifyLeft");
});
justifyRightBtn.addEventListener("click", () => {
    document.execCommand("justifyRight");
});
justifyFullBtn.addEventListener("click", () => {
    document.execCommand("justifyFull");
});
justifyCenterBtn.addEventListener("click", () => {
    document.execCommand("justifyCenter");
});
boldBtn.addEventListener("click", () => {
    document.execCommand("bold");
});
underlineBtn.addEventListener("click", () => {
    document.execCommand("underline");
});
italicBtn.addEventListener("click", () => {
    document.execCommand("italic");
});
colorBtn.addEventListener("input", () => {
    document.execCommand("forecolor", false, colorBtn.value);
});
h1Btn.addEventListener("click", () => {
    document.execCommand("formatBlock", false, "h1");
});
h2Btn.addEventListener("click", () => {
    document.execCommand("formatBlock", false, "h2");
});
h3Btn.addEventListener("click", () => {
    document.execCommand("formatBlock", false, "h3");
});
h4Btn.addEventListener("click", () => {
    document.execCommand("formatBlock", false, "h4");
});
h5Btn.addEventListener("click", () => {
    document.execCommand("formatBlock", false, "h5");
});
h6Btn.addEventListener("click", () => {
    document.execCommand("formatBlock", false, "h6");
});
fontSize1Btn.addEventListener("click", () => {
  const fontSize = "1";
  document.execCommand("fontSize", false, fontSize);
});
fontSize2Btn.addEventListener("click", () => {
  const fontSize = "2";
  document.execCommand("fontSize", false, fontSize);
});
fontSize3Btn.addEventListener("click", () => {
  const fontSize = "3";
  document.execCommand("fontSize", false, fontSize);
});
fontSize4Btn.addEventListener("click", () => {
  const fontSize = "4";
  document.execCommand("fontSize", false, fontSize);
});
fontSize5Btn.addEventListener("click", () => {
  const fontSize = "5";
  document.execCommand("fontSize", false, fontSize);
});
fontSize6Btn.addEventListener("click", () => {
  const fontSize = "6";
  document.execCommand("fontSize", false, fontSize);
});
fontSize7Btn.addEventListener("click", () => {
  const fontSize = "7";
  document.execCommand("fontSize", false, fontSize);
});

orderedListBtn.addEventListener("click", () => {
    document.execCommand("insertOrderedList");
});
unorderedListBtn.addEventListener("click", () => {
    document.execCommand("insertUnorderedList");
});
hrBtn.addEventListener("click", () => {
    document.execCommand("insertHorizontalRule");
});
removeFormatBtn.addEventListener("click", () => {
    document.execCommand("removeFormat");
});
unlinkBtn.addEventListener("click", () => {
    document.execCommand("unlink");
});
function addLink() {
  const url = prompt("Enter the URL:");
  document.execCommand("createLink", false, url);
}
subscriptBtn.addEventListener("click", () => {
    document.execCommand("subscript");
});
superscriptBtn.addEventListener("click", () => {
    document.execCommand("superscript");
});
strikeThroughBtn.addEventListener("click", () => {
    document.execCommand("strikeThrough");
});

