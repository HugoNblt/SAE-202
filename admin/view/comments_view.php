<div class="modal">
    <div id="confirm-delete-popup" class="popup hidden">
        <div class="popup-content">
            <p>Êtes-vous sûr de vouloir supprimer ce commentaire ?</p>
            <button id="confirm-delete-yes">Oui</button>
            <button id="confirm-delete-no">Non</button>
        </div>
    </div>
</div>
<div id="commentModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeCommentModal">&times;</span>
        <h2>Modifier un commentaire</h2>

        <form action="/gestion/publish_comment" method="POST">
            <input type="hidden" id="comment_id" name="comment_id">

            <label for="comment_content">Contenu :</label>
            <textarea id="comment_content" name="comment_content" rows="5" readonly></textarea>

            <label for="new_status">Statut :</label>
            <select id="new_status" name="new_status" required>
                <option value="1">Publié</option>
                <option value="0">En attente</option>
            </select>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</div>

<div class="container">
    <aside>
        <div class="top">
            <div class="logo">
                <img src="/admin/view/img/logo.svg" alt="">
                <h2>Etage 13</h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="/gestion">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="/gestion/user_list">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Utilisateurs</h3>
            </a>
            <a href="/gestion/message_list">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Messages</h3>
                <span class="message-count"><?= $unreadMessages ?></span>
            </a>
            <a href="/gestion/comment_list" class="active">
                <span class="material-icons-sharp">add_comment</span>
                <h3>Commentaires</h3>
            </a>
            <a href="/gestion/reservation_list">
                <span class="material-icons-sharp">event_seat</span>
                <h3>Réservations</h3>
            </a>
            <a href="/">
                <span class="material-icons-sharp">home</span>
                <h3>Retourner au site</h3>
            </a>
            <a href="/gestion/logout">
                <span class="material-icons-sharp">logout</span>
                <h3>Déconnexion</h3>
            </a>
        </div>
    </aside>

    <main>
        <h1>Dashboard</h1>
        <div class="recent-orders">
            <h2>Commentaires récents</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisateur</th>
                        <th>Commentaire</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['id']) ?></td>
                            <td><?= htmlspecialchars($comment['first_name'] . ' ' . $comment['last_name']) ?></td>
                            <td><?= nl2br(htmlspecialchars($comment['content'])) ?></td>
                            <td>
                                <?php if ($comment['is_published']): ?>
                                    <span class="status published">Publié</span>
                                <?php else: ?>
                                    <span class="status pending">En attente</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($comment['created_at']) ?></td>
                            <td>
                                <a href="#" data-isPublished="<?= $comment['is_published'] ?>">Publié</a>
                                <a href="#" class="delete-comment-link" data-id="<?= $comment['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

    </main>

    <div class="right">
        <div class="top">
            <button id="menu-btn">
                <span class="material-icons-sharp">menu</span>
            </button>
            <div class="theme-toggler">
                <span class="material-icons-sharp active">light_mode</span>
                <span class="material-icons-sharp">dark_mode</span>
            </div>
            <div class="profile">
                <div class="info">
                    <p>Bonjour, <b>Alexis</b></p>
                    <small class="text-muted">Admin</small>
                </div>
                <div class="profile-photo">
                    <img src="/admin/view/img/loutre.jpg" alt="">
                </div>
            </div>

        </div>
        <div class="recent-updates">
            <h2>Améliorations récentes</h2>
            <div class="updates">
                <div class="update">
                    <div class="profile-photo">
                        <img src="/admin/view/img/loutre.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>Alexis Laillier</b> Nouvelle update sur le back end du site</p>
                        <small class="text-muted">2 minutes ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="/admin/view/img/loutre.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>Alexis Laillier</b> Nouvelle update sur le back end du site</p>
                        <small class="text-muted">2 minutes ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="/admin/view/img/loutre.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>Alexis Laillier</b> Nouvelle update sur le back end du site</p>
                        <small class="text-muted">2 minutes ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="/admin/view/img/loutre.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>Alexis Laillier</b> Nouvelle update sur le back end du site</p>
                        <small class="text-muted">2 minutes ago</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="analytics">
            <h2>Analytics</h2>

            <div class="item">
                <div class="icon">
                    <span class="material-icons-sharp">trending_up</span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>Taux d’activation</h3>
                        <small class="text-muted">72% des utilisateurs ont interagi</small>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="icon">
                    <span class="material-icons-sharp">event_seat</span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>Réservations moyennes</h3>
                        <small class="text-muted">1.8 réservations par utilisateur actif</small>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="icon">
                    <span class="material-icons-sharp">public</span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>Top Pays</h3>
                        <small class="text-muted">🇫🇷 France (68%), 🇧🇪 Belgique (18%)</small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>