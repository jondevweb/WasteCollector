<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capture du contenu caché</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        #captureButton {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        #hiddenContent {
                width: 794px; /* Largeur d'une feuille A4 en pixels */
                height: 1123px; /* Hauteur d'une feuille A4 en pixels */
               }

        #result {
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <button id="captureButton">Charger et capturer le contenu</button>
   
    <!-- Zone où le contenu sera affiché -->
    <div id="result"></div>

    <!-- Ajouter la bibliothèque html2canvas -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('captureButton').addEventListener('click', function() {
            // Charger le fichier HTML caché
            fetch('generate-pdf')
                .then(response => response.text())
                .then(html => {
                    // Insérer le contenu caché dans la page (temporairement)
                    const hiddenDiv = document.createElement('div');
                    hiddenDiv.innerHTML = html;
                    hiddenDiv.id = 'hiddenContent';
                    document.body.appendChild(hiddenDiv);

                    // Capturer le contenu nouvellement chargé
                    html2canvas(hiddenDiv).then(canvas => {

                        const imgData = canvas.toDataURL('image/png');

// // Générer le PDF avec jsPDF
// const { jsPDF } = window.jspdf;
// const pdf = new jsPDF('p', 'pt', 'a4'); // Format A4

// // Ajouter l'image dans le PDF
// const imgWidth = 595.28;  // Largeur du PDF (A4 en points)
// const imgHeight = canvas.height * imgWidth / canvas.width; // Calculer la hauteur

// pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
// pdf.save('capture-hidden.pdf');  // Sauvegarder en PDF

// // Supprimer le contenu HTML caché après la capture
// hiddenDiv.remove();
                    //     // Afficher l'image capturée dans la section 'result'
                        // document.getElementById('result').appendChild(canvas);
                    
                        // // Supprimer le contenu HTML caché après la capture
                        // hiddenDiv.remove();

                        // // Optionnel : Télécharger l'image en cliquant dessus
                        
                        //     const link = document.createElement('a');
                        //     link.download = 'capture-hidden.png';
                        //     link.href = canvas.toDataURL();
                        //     // link.click();              
                            
                        //     // console.log(link.href);
                        //     //   link.download= 'capture-hidden.png';
                        //     // link.href = canvas.toDataURL();
                        //     // link.click();
                       
                        //     const formData = new FormData();
                        //         formData.append('image', link);

                        //         axios.post('/upload-image', formData)
                        //             .then(response => {
                        //             this.message = response.data.message;
                        //             })
                        //             .catch(error => {
                        //             this.message = 'Erreur lors de l\'upload.';
                        //             });
                       

                        });});});
                        // async function hello() {
                        //     event.preventDefault(); 
                        //     axios.get('/api/generate-pdf')
                        //     .then(response => {
                               
                        //     })
                        //     .catch(error => {
                        //         if (error.response) {
                        //             console.error('Server responded with an error:', error.response.data);
                        //             console.error('Status code:', error.response.status);
                        //         } else if (error.request) {
                        //             console.error('No response received:', error.request);
                        //             if (error.message.includes('Network Error')) {
                        //                 console.error('This might be a CORS issue or network problem.');
                        //             }
                        //         } else {
                        //             console.error('Error setting up request:', error.message);
                        //         }
                        //         console.error('Config:', error.config);
                        //     });
                        // };
                    
                    
                
        // });
    </script>
</body>
</html>
