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
            <a href="/gestion" class="active">
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

        <div class="date">
            <input type="date">
        </div>

        <div class="insights">
            <div class="total-users">
            <span class="material-icons-sharp">person</span>
            <div class="middle">
                <div class="left">
                    <h3>Total utilisateurs</h3>
                    <h1><?= htmlspecialchars($totalUsers) ?></h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="number">
                        <p><?= $totalUsers > 0 ? '81%' : '0%' ?></p> <!-- exemple statique ici -->
                    </div>
                </div>
            </div>
            <small class="text-muted">Dernières 24 heures</small>
        </div>

        <div class="users">
            <span class="material-icons-sharp">group_add</span>
            <div class="middle">
                <div class="left">
                    <h3>Nouveaux utilisateurs</h3>
                    <h1><?= htmlspecialchars($newUsers) ?></h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="number">
                        <p><?= ($userGrowth > 0 ? '+' : '') . $userGrowth ?>%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">Derniers 7 jours</small>
        </div>

            <div class="reservation">
                <span class="material-icons-sharp">event</span>
                <div class="middle">
                    <div class="left">
                        <h3>Réservations à venir</h3>
                        <h1><?= $upcomingCount ?></h1>
                    </div>
                    <div class="progress">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                            <p><?= $growth >= 0 ? '↑' : '↓' ?><?= abs($growth) ?>%</p>
                        </div>
                    </div>
                </div>
                <small class="text-muted">Cette semaine</small>
            </div>
        </div>

        <div class="recent-orders">
            <h2>Réservations récentes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date de l'événement</th>
                        <th>Nombre de places</th>
                        <th>Date de réservation</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentReservations as $res): ?>
                        <tr>
                            <td><?= htmlspecialchars($res['user_name']) ?></td>
                            <td><?= htmlspecialchars($res['event_date']) ?></td>
                            <td><?= htmlspecialchars($res['nb_places']) ?></td>
                            <td><?= htmlspecialchars($res['created_at']) ?></td>
                            <td>
                                <?php
                                    $status = strtotime($res['event_date']) < time() ? 'Annulée' : 'Confirmée';
                                    $class = $status === 'Confirmée' ? 'success' : 'danger';
                                ?>
                                <span class="<?= $class ?>"><?= $status ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
            <a href="/gestion/reservation_list">Tout voir</a>
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
                    <p>Bonjour, <b><?= htmlspecialchars($_SESSION['user']['first_name']) ?></b></p>
                    <small class="text-muted">Admin</small>
                </div>
                <?php
                $avatar = !empty($_SESSION['user']['avatar'])
                    ? htmlspecialchars($_SESSION['user']['avatar'])
                    : '/admin/view/img/default-avatar.png';
                ?>
                <div class="profile-photo">
                    <img src="<?= $avatar ?>" alt="Photo de profil">
                </div>
            </div>

        </div>
        <div class="recent-updates">
        <h2>Améliorations récentes</h2>
        <div class="updates">
            <?php foreach ($commits as $commit): ?>
                <?php
                    $authorName = $commit['commit']['author']['name'] ?? 'Inconnu';
                    $message = $commit['commit']['message'] ?? 'Pas de message';
                    $date = new DateTime($commit['commit']['author']['date']);
                    $timeAgo = time() - $date->getTimestamp();

                    if ($timeAgo < 60) {
                        $timeText = $timeAgo . ' seconds ago';
                    } elseif ($timeAgo < 3600) {
                        $timeText = floor($timeAgo / 60) . ' minutes ago';
                    } elseif ($timeAgo < 86400) {
                        $timeText = floor($timeAgo / 3600) . ' hours ago';
                    } else {
                        $timeText = floor($timeAgo / 86400) . ' days ago';
                    }
                ?>
                <div class="update">
                    <div class="profile-photo">
                        <img src="<?= htmlspecialchars($commit['author']['avatar_url'] ?? '/admin/view/img/default-avatar.png') ?>" alt="Avatar">
                    </div>
                    <div class="message">
                        <p><b><?= htmlspecialchars($authorName) ?></b> <?= htmlspecialchars($message) ?></p>
                        <small class="text-muted"><?= $timeText ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
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