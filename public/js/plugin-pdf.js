// получаем текущий домен
const domain = window.location.protocol + '//' + window.location.hostname;

// выбираем все pdf, содержащие ссылки на PDF-файлы
const pdfs = document.querySelectorAll('pdf');     


if (navigator.userAgent.includes("PaleMoon")) {
    // выполняйте код для Pale Moon

    // для каждого pdf создаем iframe для Google Docs Viewer и используем ссылку на PDF-файл из атрибута href
    pdfs.forEach((pdf) => {
        const pdfUrl = pdf.getAttribute('href');
        const iframe = document.createElement('iframe');
        iframe.setAttribute('src', `https://docs.google.com/viewer?url=${domain}${pdfUrl}&embedded=true`);
        iframe.setAttribute('width', '100%');
        iframe.setAttribute('height', '600');
        pdf.appendChild(iframe);
    });

} else {
    // выполнять код для других браузеров
    // для каждого pdf создаем embed с использованием ссылки на PDF-файл из атрибута href и текущего домена
    pdfs.forEach((pdf) => {
        const pdfUrl = pdf.getAttribute('href');
        const embed = document.createElement('embed');
        embed.setAttribute('src', `${domain}${pdfUrl}`);
        embed.setAttribute('type', 'application/pdf');
        embed.setAttribute('width', '100%');
        embed.setAttribute('height', '600');
        pdf.appendChild(embed);
    });
}