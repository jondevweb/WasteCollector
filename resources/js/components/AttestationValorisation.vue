<template>
    
    <div style="width: 100%">
      <p id="resultMessage" style="font-size: 1rem; width: 50%; margin: auto;">{{ result }}</p>
    </div> 
    <button @click="generatePDF">Générer PDF</button>
    <div id="reset">
        <div id="result" style="width: 794px; height: 1123px"></div>
    </div>
    

</template>
<script setup>
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import { defineProps, ref, watch } from 'vue';

const result = ref("Choissisez un point de collecte");

const content = ref(null);

const error = ref(null);
const id = ref(null);

  
const props = defineProps({
  title: String
});

if(props.title > 0){
  id.value = props.title;
}

watch(() => props.title, (newVal) => {
  if(props.title == 0){
    document.getElementById("resultMessage").style.color = "red";
    result.value = "Choissisez un point de collecte";
    props.title = newVal
    id.value = 0;
  } else {
    result.value = "";
    props.title = newVal
    id.value = props.title;
  }
});

async function generatePDF() {
  if(id.value > 0){
    try {
      store();
      getItems(); // Mise à jour des items après l'ajout
    } catch (error) {
      console.error('Erreur lors de l\'ajout de l\'élément:', error);
    }
  }
};

async function store() {
  try {
    await axios.post('api/generate-pdf/$id', {id:id.value})
  } catch (error) {
    console.error('Erreur lors de la génération du PDF:', error);
  }
};

async function getItems() {
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
              const reset = document.getElementById('reset');
              hiddenDiv.remove();
              const div = document.createElement("div");
              div.id = "result";
              div.style.width = "794px";
              div.style.height = "1123px";
              reset.appendChild(div);
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