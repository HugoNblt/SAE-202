<div id="messagerieTitlecontainer">
    <p id="messagerieTitle">Le standard du Grand Hôtel est à votre disposition</p>
</div>
<div id="messagerieContent">
<article id="messageDisclaimer">
    <p>Une question sur votre réservation, l’expérience ou un détail logistique? Le service de réception du Grand Hôtel est à votre écoute. <br><br>
     Nous mettons tout en œuvre pour vous répondre avec clarté, rapidité et courtoisie.</p> <br>
    <p id="boldtext">N’oubliez pas de jeter un œil à notre FAQ avant de nous écrire, votre réponse s’y trouve peut-être déjà.</p>
</article>
<form action="/messagerie/validateForm" method="post" id="messageForm">
<div id="mail">
    <label for="">Mail:</label>
    <input type="email" id="email" name="email" class="form-control" required>
</div>
    <div id="demande">
        <label for="motif">Motif de la demande:</label>
        <select id="motif" name="motif" class="form-control" required>
            <option value="">Sélectionnez un motif</option>
            <option value="demande_informations">Demande d'informations</option>
            <option value="problème_technique">Problème technique</option>
            <option value="suggestion">Suggestion</option>
            <option value="autre">Autre</option>
        </select>
    </div>
        <div id="messagediv">
            <label for="message">Message:</label>
            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
            <button id="submit" type="submit" class="btn btn-primary">Envoyer</button>
        </div>
</form>
</div>