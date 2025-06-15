document.addEventListener('DOMContentLoaded', function () {
    // Lógica para generar el PDF
    document.getElementById('verPDF').addEventListener('click', function () {
        // Selecciona el elemento que contiene la tabla
        const elemento = document.getElementById('tabla_reporte_ventas');

        // Convierte el contenido en una imagen y luego en PDF
        html2canvas(elemento).then(canvas => {
            const imgData = canvas.toDataURL('image/png'); // Convierte el canvas en una imagen
            const pdf = new jsPDF();
            const anchoPDF = pdf.internal.pageSize.width;
            const altoPDF = pdf.internal.pageSize.height;

            // Escala la imagen para ajustarse al tamaño del PDF
            const proporciones = Math.min(anchoPDF / canvas.width, altoPDF / canvas.height);
            const nuevoAncho = canvas.width * proporciones;
            const nuevoAlto = canvas.height * proporciones;

            pdf.addImage(imgData, 'PNG', 0, 0, nuevoAncho, nuevoAlto); // Agrega la imagen al PDF
            pdf.save('reporte.pdf'); // Guarda el PDF con el nombre especificado
        });
    });
});