<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Ajouter un utilisateur</h2>
        <form action="/gestion/add_user" method="POST">
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="tel">Téléphone :</label>
            <input type="tel" id="tel" name="tel" required>

            <label for="birthday">Date de naissance :</label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmation du mot de passe :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit" id="submitBtn" disabled>Ajouter</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal" method="post">
    <div class="modal-content">
        <span class="close" id="closeEditModal">&times;</span>
        <h2>Modifier un utilisateur</h2>
        <form action="/gestion/edit_user" method="POST" id="editForm">
            <input type="hidden" name="id" id="edit-id">

            <label>Nom:</label>
            <input type="text" name="last_name" id="edit-last_name" required>

            <label>Prénom:</label>
            <input type="text" name="first_name" id="edit-first_name" required>

            <label>Email:</label>
            <input type="email" name="email" id="edit-email" required>

            <label>Téléphone:</label>
            <input type="text" name="phone" id="edit-phone" required>

            <label>Date de naissance:</label>
            <input type="date" name="birth_date" id="edit-birth_date" required>

            <label>Rôle:</label>
            <select name="role" id="edit-role" required>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>

            <button type="submit" id="editSubmitBtn" disabled>Enregistrer</button>
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
            <a href="/gestion/user_list" class="active">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Utilisateurs</h3>
            </a>
            <a href="/gestion/message_list">
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
        <button class="add-user" id="openModal">Ajouter un utilisateur</button>

        <div class="recent-orders">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date de naissance</th>
                        <th>Inscrit le :</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['last_name']) ?></td>
                            <td><?= htmlspecialchars($user['first_name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td><?= htmlspecialchars($user['birth_date']) ?></td>
                            <td><?= htmlspecialchars($user['created_at']) ?></td>
                            <td><?= htmlspecialchars($user['role']) === "user" ? "Utilisateur" : "Administrateur" ?></td>
                            <td>
                                <a href="#" class="edit-user-link" data-id="<?= $user['id'] ?>"
                                    data-last_name="<?= htmlspecialchars($user['last_name']) ?>"
                                    data-first_name="<?= htmlspecialchars($user['first_name']) ?>"
                                    data-email="<?= htmlspecialchars($user['email']) ?>"
                                    data-phone="<?= htmlspecialchars($user['phone']) ?>"
                                    data-birth_date="<?= $user['birth_date'] ?>"
                                    data-role="<?= $user['role'] ?>">Modifier</a>
                                <a href="#" class="delete-user-link" data-id="<?= $user['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

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