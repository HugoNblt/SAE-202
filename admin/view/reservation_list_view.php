<div id="reservationModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeReservationModal">&times;</span>
        <h2>Ajouter une réservation</h2>
        <form id="addReservationForm" action="/gestion/add_reservation" method="POST">
            <label for="user_id">Utilisateur :</label>
            <select id="user_id" name="user_id" required>
                <option value="">-- Choisir un utilisateur --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>">
                        <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="event_date">Date de l’événement :</label>
            <input type="date" id="event_date" name="event_date" required>

            <label for="nb_places">Nombre de places :</label>
            <input type="number" id="nb_places" name="nb_places" min="1" value="1" required>

            <button type="submit" id="submitReservationBtn" disabled>Ajouter</button>
        </form>
    </div>
</div>

<div id="editReservationModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeEditReservationModal">&times;</span>
        <h2>Modifier une réservation</h2>
        <form action="/gestion/edit_reservation" method="POST" id="editReservationForm">
            <input type="hidden" name="id" id="edit-reservation-id">

            <label for="edit-user_id">ID Utilisateur :</label>
            <input type="number" name="user_id" id="edit-user_id" required>

            <label for="edit-event_date">Date de l’événement :</label>
            <input type="date" name="event_date" id="edit-event_date" required>

            <label for="edit-nb_places">Nombre de places :</label>
            <input type="number" name="nb_places" id="edit-nb_places" min="1" required>

            <button type="submit" id="editReservationBtn" disabled>Enregistrer</button>
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
            <a href="/gestion/comment_list">
                <span class="material-icons-sharp">add_comment</span>
                <h3>Commentaires</h3>
            </a>
            <a href="/gestion/reservation_list" class="active">
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
        <h2>Liste des Réservations</h2>

        <button class="add-user" id="openReservationModal">Ajouter une réservation</button>
        <div class="recent-orders">

          <table>
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Utilisateur</th>
                      <th>Date</th>
                      <th>Places</th>
                      <th>Créée le</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($reservations as $res): ?>
                      <tr>
                          <td><?= htmlspecialchars($res['id']) ?></td>
                          <td><?= htmlspecialchars($res['user_name']) ?></td>
                          <td><?= htmlspecialchars($res['event_date']) ?></td>
                          <td><?= htmlspecialchars($res['nb_places']) ?></td>
                          <td><?= htmlspecialchars($res['created_at']) ?></td>
                          <td>
                              <a href="#" class="edit-reservation-link"
                                data-id="<?= $res['id'] ?>"
                                data-user_id="<?= $res['user_id'] ?>"
                                data-event_date="<?= $res['event_date'] ?>"
                                data-nb_places="<?= $res['nb_places'] ?>">
                                Modifier
                              </a>
                              <a href="/gestion/delete_reservation/?id=<?= $res['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
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