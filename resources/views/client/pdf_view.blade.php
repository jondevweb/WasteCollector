<!DOCTYPE html>
<html>
    <head>
        <title>Laravel PDF</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body {
                margin: 0px;}
            .content {
                font-size: 0.7rem;
                border: 1px black solid;
                width: 794px; /* Largeur d'une feuille A4 en pixels */
                height: 1123px; /* Hauteur d'une feuille A4 en pixels */
                padding: 5px;
                box-sizing: border-box;}
            th, td {
                border-top: 1px solid;}
            table {
                border-collapse: collapse;}
            #exploitant, #producteur{
                top: 5px;} 
            .accolade {
                width: 80px;
                align-items: center;}
            .accolade-parenthèse {
                width: 30px;
                position: absolute;}
            .bgroundLGray{
                background: lightgray;}
            .bBottom{
                border-bottom: 1px black solid;}
            .bottom1{
                bottom: 1px;}
            .bLeft{
                border-left: 1px solid;}
            .bRight{
                border-right: 1px solid;}
            .bTop{
                border-top: 1px solid black;}
            .dflex{
                display: flex;}
            .height2{
                height: 25%;}
            .height15{
                height: 15px;}
            .height20{
                height: 20px;}
            .height25{
                height: 25px;}
            .height44{
                height: 44px;}
            .height70{
                height: 70px;}
            .height100{
                height: 100px;}
            .jusContSA{
                justify-content: space-around;}
            .label {
                display: inline-block;}
            .label2 {
                width: 130px;
                display: inline-block;}
            .label3{
                align-items: center;
                display: grid;}
            .left5{
                left: 5px}
            .left40{
                left: 40px;}
            .lheight{
                line-height: 5px;}
            .pAbsolute{
                position: absolute;}
            .padding015{
                padding: 0px 0 15px 5px;}
            .pad13r20{
                padding: 13px 0 5px 0;
                right: 20px;}
            .padding50 {
                padding: 0 5px;}
            .pbottom{
                bottom: 5px;}
            .pleft10{
                padding-left: 10px;}
            .pleft15{
                padding-left: 15px;}
            .pleft60{
                padding-left: 60px;}
            .pRelative{
                position: relative;}
            .ptop8 {
                padding-top: 8px;}
            .right0{
                right: 0;}
            .right15{
                right: 15px;}
            .right180{
                right: 180px;}
            .span1{
                width: 25px;
                display: inline-block;}
            .span2{
                font-weight: lighter;
                font-size: 0.9rem;}
            .tAlign{
                text-align: center;}
            .tAlignLeft{
                text-align: left;}
            .top3{
                top: 3px;}
            .top11{
                top: 11px;}
            .width5{
                width: 5%;}
            .width10{
                width: 10%;}
            .width20{
                width: 20%;}
            .width25{
                width: 25%;}
            .width30{
                width: 30px;}
            .width35{
                width: 35%;}
            .width50{
                width: 50%;}
            .width70{
                width: 70px;}
            .width100{
                width: 100%;}
            .width250{
                width: 250px;}
            .widthSpecial{
                width: 90%;
                margin: auto;}
        </style>
    </head>
    <body>
        <div class="content" id="captureArea">
            <header>
                <div class="bBottom tAlign">
                    <div>
                        <img />
                    </div>
                    <h1>Attestation de valorisation de déchets de papier/carton, métal, plastique, verre et bois prévue par
                    l’article D. 543-284 du code de l’environnement</h1>
                    <p>(MODELE DEFINI PAR L’ARRETE DU 18-07-2018 PUBLIE AU J.O.R.F N°0173 DU 29 JUILLET 2018)</p>
                </div>
                <div class="dflex">
                    <div class="padding50 width50 bRight">
                        <h3>Attestation n° :  
                            @isset($data)
                             {{ $data['title'] }}
                            @else    
                                Pas de titre disponible
                            @endif
                        </h3>
                    </div>
                    <div class="padding50 width50">
                        <h3>Année : </h3>
                    </div>
                </div>
            </header>
            <main class="bTop bBottom">
                <section>
                    <div class="bgroundLGray padding015">
                        <h2 style="margin: 0px 0 0px 0px;">1. Emetteur de l’attestation</h2>
                    </div>
                    <div class="padding50 bTop bBottom dflex">
                        <div class="padding50 width50 lheight">
                            <div class="height2">
                                <p>Nom :</p>
                                <p>Adresse :</p>
                            </div>
                            <div>
                                <p>N° SIRET : </p>
                                <p>Tél : </p>
                                <p>Mél ou Fax :</p>
                                <p>Personne à contacter :</p>
                            </div>
                        </div>
                        <div class="padding50 width50">
                            <div class="padding50">
                                <div>
                                    <input type="checkbox" id="exploitant" name="emetteur" value="exploitant" class="width70 pRelative"/>
                                    <label for="exploitant">Exploitant d’une installation de valorisation</label>
                                </div>
                                <p>ou</p>
                                <div>
                                    <input type="checkbox" id="intermediaire" name="emetteur" value="intermediaire"  class="pbottom width70 pRelative" />
                                    <label for="intermediaire" class="label width250">Intermédiaire assurant une activité de collecte, de tri,
                                    de négoce de déchets en vue de leur valorisation</label>
                                </div>
                            </div>
                            <div class="dflex lheight padding50">
                                <div class="accolade bTop dflex pRelative">
                                    <p>1.A</p>
                                    <img class="accolade-parenthèse height70 right0" src="/images/parenthesis.png" alt="accolade parenthèse, regrouppement d'information" />
                                </div>
                                <div>
                                    <p>Récépissé n° :</p>
                                    <p>Département :</p>
                                    <p>Activité déclarée en préfecture :</p>
                                    <p>Date de limite de validité :</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="bgroundLGray padding015">
                        <h2 style="margin: 0px 0 0px 0px;">2. Origine des déchets</h2>
                    </div>
                    <div class="padding50 bTop bBottom dflex">
                        <div class="padding50 width50 lheight">
                            <div class="height2">
                                <p>Nom :</p>
                                <p>Adresse :</p>
                            </div>
                            <div>
                                <p>N° SIRET : </p>
                                <p>Tél : </p>
                                <p>Mél ou Fax :</p>
                                <p>Personne à contacter :</p>
                            </div>
                        </div>
                        <div class="padding50 width50">
                            <div class="padding50">
                                <input type="checkbox" id="producteur" name="origine" value="producteur" class="width70 pRelative"/>
                                <label for="producteur">Producteur du déchet</label>
                            </div>
                            <p>ou</p>
                            <div class="padding50">
                                <input type="checkbox" id="detenteur" name="origine" value="detenteur" class="pbottom width70 pRelative"/>
                                <label for="detenteur" class="label width250">Détenteur du déchet (y compris intermédiaire et
                                prestataire de gestion des déchets)</label>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="bgroundLGray padding015">
                        <h2 style="margin: 0px 0 0px 0px;">3. Flux de déchets pris en charge</h2>
                    </div>
                    <div class="padding50 bTop bBottom dflex">
                        <div class="padding50 width50">
                            <p><span class="span1">3.A</span> Dénomination usuelle des déchets : </p>
                            <div>
                                <div class=" dflex">
                                    <p class="pbottom">
                                        <span class="span1">3.B</span>
                                    </p>
                                    <input class="pbottom" type="checkbox" id="tries" name="flux" value="tries" />
                                    <label for="tries">Triés (une seule des 5 natures principales de déchets -
                                    cocher la case correspondante en 3.D)</label>
                                </div>
                                <div class=" dflex">
                                    <p class="pbottom">
                                        <span class="span1">3.C</span>
                                    </p>
                                    <input class="pbottom" type="checkbox" id="melange" name="flux" value="melange" />
                                    <label for="melange">En mélange (deux ou plusieurs natures de déchets -
                                    cocher les cases correspondantes en 3.D)</label>
                                </div>
                            </div>
                        </div>
                        <div class="padding50 width50 dflex lheight" >
                            <div class="pRelative dflex accolade">
                                <p>3.D</p>
                                <img class="accolade-parenthèse height100 right15" src="/images/parenthesis.png" alt="accolade parenthèse, regrouppement d'information" />
                            </div >
                            <div class="pad13r20 pRelative">
                                <div class="height15">
                                    <label class="label2" for="papier/carton">Déchet de papier/carton :</label>
                                    <input type="checkbox" id="papier/carton" name="denomination" value="papier/carton" />   
                                </div>
                                <div class="height15">
                                    <label class="label2" for="metal">Déchet de métal :</label>
                                    <input type="checkbox" id="metal" name="denomination" value="metal" />
                                </div>
                                <div class="height15">
                                    <label class="label2" for="plastique">Déchet de plastique :</label>
                                    <input type="checkbox" id="plastique" name="denomination" value="plastique" />
                                    
                                </div>
                                <div class="height15">
                                    <label class="label2" for="verre">Déchet de verre :</label>
                                    <input type="checkbox" id="verre" name="denomination" value="verre" />
                                    
                                </div>
                                <div class="height15">
                                    <label class="label2" for="bois">Déchet de bois :</label>
                                    <input type="checkbox" id="bois" name="denomination" value="bois" />     
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="bgroundLGray padding015">
                        <h2 style="margin: 0px 0 0px 0px;">4. Quantités de déchets prises en charge <span class="span2">(exprimées en tonne)</span></h2> 
                    </div>
                    <div class="padding50 bTop bBottom">
                        <div class="padding50 pRelative height20">
                            <p class="pAbsolute right180">Modalité de quantification : </p>
                        </div>
                        <div class="dflex jusContSA widthSpecial bBottom">
                            <div class="dflex width35">
                                <p class="width30">4.A</p>
                                <input type="checkbox" id="collectees/receptionnees" name="prises" value="collectees/receptionnees" />
                                <label for="collectees/receptionnees" class="label3 pleft10">Collectées/réceptionnées</label>
                                <span class="label3" style="padding-left: 30px">:</span>
                            </div>
                            <div class="width10">
                                <p>t</p>
                            </div>
                            <div class="ptop8 width20">
                                <input type="checkbox" id="pesees" name="modalite" value="pesees" />
                                <label for="pesees" class="pleft15 bottom pRelative left5">Quantités pesées</label>
                            </div>
                            <p class="width5">ou</p>
                            <div class="ptop8 width20">
                                <input type="checkbox" id="estimees" name="modalite" value="estimees" />
                                <label for="estimees" class="bottom1 pRelative pleft15">Quantités estimées</label>
                            </div>
                        </div>
                        <div class="dflex jusContSA widthSpecial bBottom bTop pRelative" style="line-height: 0px">
                            <div class="width35 dflex">
                                <div>
                                    <div class="dflex">
                                        <p class="width30">4.B</p>
                                        <input type="checkbox" id="transferees" name="prises" value="transferees" />
                                        <label for="transferees" class="label3 pleft10">Transférées</label>
                                    </div>
                                    <div class="dflex">
                                        <p class="width30">4.C</p>
                                        <input type="checkbox" id="valorisees" name="prises" value="valorisees" />
                                        <label for="valorisees" class="label3 pleft10">Valorisées</label>
                                    </div>
                                </div>
                                <img class="width30 height44 left40 pRelative" style="transform: rotate(180deg)" src="/images/parenthesis.png" alt="accolade parenthèse, regrouppement d'information" />
                                <span class="label3 pleft60">:</span>
                            </div>
                            <div class="width10">
                                <p class="label3 top11 pRelative">t</p>
                            </div>
                            <div class="ptop8 width20 top3 pRelative" >
                                <input type="checkbox" id="pesees" name="modalite" value="pesees" />
                                <label for="pesees" class="pleft15 bottom pRelative left5">Quantités pesées</label>
                            </div>
                            <p class="width5 top11 pRelative">ou</p>
                            <div class="ptop8 width20 top3 pRelative"> 
                                <input type="checkbox" id="estimees" name="modalite" value="estimees" />
                                <label for="estimees" class="bottom1 pRelative pleft15">Quantités estimées</label>
                            </div>
                        </div>
                        <div class="dflex jusContSA widthSpecial bTop">
                            <div class="dflex width35">
                                <p class="width30">4.D</p>
                                <input type="checkbox" id="refus" name="prises" value="refus" />
                                <label for="refus"  class="label3 pleft10">Refus et freinte</label>
                                <span class="label3" style="padding-left: 73px">:</span>
                            </div>
                            <div class="width10">
                                <p>t</p>
                            </div>
                            <div class="ptop8 width20">
                                <input type="checkbox" id="pesees" name="modalite" value="pesees" />
                                <label for="pesees" class="pleft15 bottom pRelative left5">Quantités pesées</label>
                            </div>
                            <p class="width5">ou</p>
                            <div class="ptop8 width20">
                                <input type="checkbox" id="estimees" name="modalite" value="estimees" />
                                <label for="estimees" class="bottom1 pRelative pleft15">Quantités estimées</label>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="bgroundLGray padding015">
                        <h2 style="margin: 0px 0 0px 0px;">5. Destinations de valorisation finale des déchets</h2>
                    </div>
                    <div class="bTop">
                        <div class="padding50 height20">(Indiquer, par nature de déchet, les types d’installations au sein desquelles les déchets ont été valorisés ainsi que leur répartition en pourcentage )</div>
                        <div class="dflex">
                            <div class="width50 bRight">
                                <table class="width100">
                                    <thead>
                                        <tr class="height25">
                                            <th scope="col" class="width25 bRight tAlignLeft padding50">Nature de déchet</th>
                                            <th scope="col" class="width50 bRight">Type d’installation</th>
                                            <th scope="col" class="width20 bRight">Répartition</th>
                                            <th scope="col" class="width5"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="height25">
                                            <th rowspan="2" class="bRight tAlignLeft padding50 padding015">Papier/carton</th>
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <th rowspan="2" class="bRight tAlignLeft padding50 padding015">Métal</th>
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <th rowspan="2" colspan="4"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="width50 bLeft">
                                <table class="width100">
                                    <thead>
                                        <tr class="height25">
                                            <th scope="col" class="width25 bRight tAlignLeft padding50">Nature de déchet</th>
                                            <th scope="col" class="width50 bRight">Type d’installation</th>
                                            <th scope="col" class="width20 bRight">Répartition</th>
                                            <th scope="col" class="width5"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="height25">
                                            <th rowspan="2" class="bRight tAlignLeft padding50 padding015">Plastique</th>
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <th rowspan="2" class="bRight tAlignLeft padding50 padding015">Verre</th>
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <th rowspan="2" class="bRight tAlignLeft padding50 padding015">Bois</th>
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                        <tr class="height25">
                                            <td class="bRight"></td>
                                            <td class="bRight"></td>
                                            <td class="tAlign">%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <footer>
                <div class="bgroundLGray padding015 bBottom">
                    <h2 style="margin: 0px 0 0px 0px;">6. Date et signature de l’émetteur de l’attestation : </h2>
                </div>
            </footer>
        </div>
    </body>
</html>