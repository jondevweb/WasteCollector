<template>
    
    
    <button @click="generatePDF">Générer PDF</button>
    <div id="result"></div>

</template>
<script setup>
import { ref } from 'vue';
  
const title = defineModel('title')

// Référence à l'élément HTML à capturer
const content = ref(null);

const error = ref(null);

const generatePDF = async () => {
  try {
    const response = await axios.get('api/generate-pdf', { responseType: 'blob' });
    
    // Créer un lien pour télécharger le PDF
    // const blob = new Blob([response.data], { type: 'application/pdf' });
    // const link = document.createElement('a');
    // link.href = window.URL.createObjectURL(blob);
    // link.download = 'mon_pdf.pdf';
    // link.click();
  } catch (error) {
    console.error('Erreur lors de la génération du PDF:', error);
  }
};
  
</script>   