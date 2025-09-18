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
            <a href="/gestion/message_list" class="active">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Messages</h3>
                <span class="message-count"><?= $unreadMessages ?></span>
            </a>
            <a href="/gestion/comment_list">
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
            <h2>Voici la liste des messages reçu</h2>

            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Motif</th>
                        <th>Message</th>
                        <th>Date d'envoie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?= htmlspecialchars($message['first_name']) ?></td>
                            <td><?= htmlspecialchars($message['email']) ?></td>
                            <td><?= htmlspecialchars($message['motif']) ?></td>
                            <td><?= htmlspecialchars($message['message']) ?></td>
                            <td><?= htmlspecialchars($message['created_date']) ?></td>
                            <td>
                               <?php if (!$message['is_read']): ?>
                                    <a href="/gestion/update_message?id=<?= $message['message_id'] ?>" class="mark-as-read">Marquer comme lu</a>
                                <?php endif; ?>
                                <a href="#" class="delete-message" data-id="<?= $message['message_id'] ?>">Supprimer</a>
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