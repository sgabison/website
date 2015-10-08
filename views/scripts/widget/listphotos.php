
    <?php if ($this->editmode) include( PIMCORE_LAYOUTS_DIRECTORY ."/common/header/_header_css.html") ; ?>


<h2> <?= $this->input("headline"); ?></h2>
	<ul data-role="listview" data-inset="true" class="jqm-list" data-theme="d" >
    <li><a href="#">
        <img src="/static/img/societe/didier.png">
        <h2>L'équipe</h2>
        <p>La société, est créée en 2013,autour des trois co-fondateurs (INSEAD+ HEC + Médecin), des professionnels du corps médical, des consultants, des développeurs informatiques.</p></a>
    </li>
    <li><a href="#popupContact" data-rel="popup">
        <img src="/static/img/societe/qrcode.png">
        <h2>Services Professionnels</h2>
        <p>Nous développons une gamme de services innovants pour les laboratoires et l’industrie pharmaceutique.
        <br>S’inscrire pour obtenir une brochure complète.</p></a>
    </li>
    <li><a href="#">
        <img src="/static/img/societe/arbre.png">
        <h2>Les Patients donnent leur avis</h2>
        <p>Pour une meilleure prise en compte de l'intérêt des Patients et de la Médecine</p></a>
    </li>
    <li><a href="#">
        <img src="/static/img/societe/tube.png">
        <h2>Le Label Transparence Médicale</h2>
        <p>Transparence médicale est un label de transparence apposé, avec l’agrément des laboratoires, sur les boites de médicaments 
        </p></a>
    </li>
</ul>


