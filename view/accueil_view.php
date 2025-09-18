<img class="banner" src="/view/medias/images/accueil1.webp" alt="Bannière de l'étage 13">

<main>
    <div class="h1Container">
        <h1>Bienvenue au Grand Hôtel de la Motte-Tilly</h1>
    </div>

    <section class="container">
        <div class="left">
            <p class="info-text">Votre Murder Party Géante à 1h30 de Paris, 50min de Troyes</p>
            <img src="/view/medias/images/affiche.webp" alt="Affiche Murder Party" class="murder-img" />
            <p class="duration">Durée : 2 h 30<br>Nombre de joueurs : 5 à 40 personnes</p>
        </div>

        <div class="right">
            <div class="description-box">
                <h2>Plongez dans la peau du nouveau Lobby Boy…</h2>
                <p>
                    Fraîchement engagé par Monsieur Gustave, vous pensiez vivre une formation classique au sein du
                    prestigieux Grand Hôtel de la Motte-Tilly. Mais à peine avez-vous revêtu votre uniforme que le calme
                    de l’établissement vole en éclats…
                </p>
                <p>
                    Zéro, le lobby boy favori, a été retrouvé mort.
                    Piégé dans l’ascenseur de service. Au mystérieux 13ᵉ étage...
                    Mais ce n’est pas tout. Son emblématique chapeau violet a disparu.
                    <br><br>
                    Et ici, on ne quitte jamais son uniforme. <span>Jamais</span>.

                </p>
                <p>
                    Le personnel est bouleversé. Les clients ? Suspects. Et vous ? Vous êtes au cœur de l’enquête.
                    <br><br>
                    Saurez-vous élucider le mystère ?
                    <br><br>
                    Ou finirez-vous à votre tour retrouvés sans vie dans l’ascenseur… ?
                </p>
            </div>
            <div>
                <a href="#" class="cta-button">Devenir Lobby-Boy</a>
            </div>
        </div>
    </section>

    <section class="context">
        <div class="lobby">
            <img src="/view/medias/images/lobby.webp" alt="lobby">
        </div>
        <div class="info">
            <h2>Bienvenue au Grand Hôtel de la Motte-Tilly, palace raffiné suspendu hors du temps. </h2>
            <p>
                Vous venez tout juste d’y être engagés comme Lobby Boys en formation, sous l’autorité du légendaire
                Monsieur Gustave. <br>
                Mais l’apprentissage s’interrompt brusquement : Zéro F., l’employé modèle, a été retrouvé mort. Coincé
                dans un ascenseur figé… au 13ᵉ étage, condamné depuis des années.
            </p>
            <p>
                Et surtout : son chapeau violet a disparu. Or ici, on ne quitte jamais son uniforme. Jamais. Le
                personnel est bouleversé. Les clients sont étrangement nerveux. Et vous ? Vous êtes désormais au cœur de
                l’enquête.
            </p>
            <p>
                Ensemble, entre trahisons, mensonges et faux-semblants, vous devrez infiltrer les coulisses de l’hôtel,
                interroger, observer, et peut-être manipuler… Votre objectif : démasquer le coupable. Et survivre à
                votre première nuit au service du Grand Hôtel. Une murder party grandeur nature, stylisée, inspirée de
                l’univers de Wes Anderson, où chaque détail compte, et où les apparences sont toujours trompeuses.
            </p>
        </div>
        <img class="tel" src="/view/medias/images/tel_accueil.png" alt="">
    </section>
    <section class="comments-section">
    <h2>Commentaires</h2>
    <?php if (!empty($comments)): ?>
        <div class="comments-grid">
            <?php foreach ($comments as $comment): ?>
                <div class="comment-card">
                    <p class="comment-meta">
                        Posté par <strong><?= htmlspecialchars($comment['first_name']) ?></strong><br>
                        <span class="date"><?= date('d/m/Y à H:i', strtotime($comment['created_at'])) ?></span>
                    </p>
                    <p class="comment-content"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun commentaire pour le moment.</p>
    <?php endif; ?>
</section>


</main>