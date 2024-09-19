<template>
    
    
    <button @click="generatePDF">Générer PDF</button>
    <div id="result" style="width: 794px; height: 1123px"></div>

</template>
<script setup>
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import { ref } from 'vue';
  
const title = defineModel('title')

// Référence à l'élément HTML à capturer
const content = ref(null);

const error = ref(null);

const generatePDF = async () => {
  try {
    await axios.get('generate-pdf')
            .then(response => response.data)
            .then(html => {
            // Insérer le contenu caché dans la page (temporairement)
            const hiddenDiv = document.getElementById('result');
            hiddenDiv.innerHTML = html;
            // document.body.appendChild(hiddenDiv);

            // Capturer le contenu nouvellement chargé
            html2canvas(hiddenDiv).then(canvas => {

                const imgData = canvas.toDataURL('image/png');
                // document.getElementById('captureButton').addEventListener('click', function() {
                    // Générer le PDF avec jsPDF
                    const pdf = new jsPDF('p', 'pt', 'a4'); // Format A4

                    // Ajouter l'image dans le PDF
                    const imgWidth = 595.28;  // Largeur du PDF (A4 en points)
                    const imgHeight = canvas.height * imgWidth / canvas.width; // Calculer la hauteur

                    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                    pdf.save('capture-hidden.pdf');  // Sauvegarder en PDF

                    // Supprimer le contenu HTML caché après la capture
                    hiddenDiv.removeChild()
                });
            });
        // });




    // const response = await axios.get('api/generate-pdf', { responseType: 'blob' });
    
    // // Créer un lien pour télécharger le PDF
    // // const blob = new Blob([response.data], { type: 'application/pdf' });
    // // const link = document.createElement('a');
    // // link.href = window.URL.createObjectURL(blob);
    // // link.download = 'mon_pdf.pdf';
    // link.click();
  } catch (error) {
    console.error('Erreur lors de la génération du PDF:', error);
  }
};
  
</script>   