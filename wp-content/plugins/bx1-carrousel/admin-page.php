<?php
function bx1_carrousel_register_admin_menu() {
    add_menu_page('Carrousels', 'Carrousels', 'manage_options', 'bx1_carrousel', 'bx1_carrousel_admin_page', 'dashicons-images-alt2');
}
add_action('admin_menu', 'bx1_carrousel_register_admin_menu');

function bx1_carrousel_admin_page() {
    if (isset($_POST['bx1_carrousel_submit'])) {

        $cat_id = intval($_POST['bx1_carrousel_category']);
        $count = intval($_POST['bx1_carrousel_count']);

        $carousels = get_option('bx1_carrousel_carousels', []);
        $new_id = uniqid();
        $name = sanitize_text_field($_POST['bx1_carrousel_name']);
        $color = sanitize_hex_color($_POST['bx1_carrousel_color']);
        $title_color = sanitize_hex_color($_POST['bx1_carrousel_title_color']);

        $carousels[$new_id] = [
            'name'     => $name,
            'category' => $cat_id,
            'count'    => $count,
            'color'    => $color,
            'title_color' => $title_color
        ];
        error_log("✅ Formulaire soumis");
        error_log("Catégorie : " . $_POST['bx1_carrousel_category']);
        error_log("Nombre d'articles : " . $_POST['bx1_carrousel_count']);   

        update_option('bx1_carrousel_carousels', $carousels);

        
        error_log("Option mise à jour : " . print_r($carousels, true));     

        echo '<div class="notice notice-success"><p>Carrousel créé !</p></div>';
    }

    if (isset($_POST['bx1_carrousel_edit_submit'])) {
        $edit_id = sanitize_text_field($_POST['bx1_edit_id']);
        $carousels = get_option('bx1_carrousel_carousels', []);

        if (isset($carousels[$edit_id])) {
            $carousels[$edit_id] = [
                'name'        => sanitize_text_field($_POST['bx1_carrousel_name']),
                'category'    => intval($_POST['bx1_carrousel_category']),
                'count'       => intval($_POST['bx1_carrousel_count']),
                'color'       => sanitize_hex_color($_POST['bx1_carrousel_color']),
                'title_color' => sanitize_hex_color($_POST['bx1_carrousel_title_color']),
            ];

            update_option('bx1_carrousel_carousels', $carousels);
            echo '<div class="notice notice-success"><p>Carrousel mis à jour.</p></div>';
        }
    }
    

    if (isset($_GET['edit'])) {
        $edit_id = sanitize_text_field($_GET['edit']);
        $carousels = get_option('bx1_carrousel_carousels', []);
        if (isset($carousels[$edit_id])) {
            $edit_data = $carousels[$edit_id];

            // Affiche le formulaire d'édition
            ?>
            <h2>Modifier le carrousel</h2>
            <form method="post">
                <input type="hidden" name="bx1_edit_id" value="<?= esc_attr($edit_id); ?>">
                <table class="form-table">
                    <tr>
                        <th>Nom du carrousel</th>
                        <td><input type="text" name="bx1_carrousel_name" value="<?= esc_attr($edit_data['name']); ?>" required></td>
                    </tr>
                    <tr>
                        <th>Catégorie</th>
                        <td>
                            <select name="bx1_carrousel_category" required>
                                <?php foreach (get_categories(['hide_empty' => false]) as $cat): ?>
                                    <option value="<?= esc_attr($cat->term_id); ?>" <?= selected($edit_data['category'], $cat->term_id); ?>>
                                        <?= esc_html($cat->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Nombre d’articles</th>
                        <td><input type="number" name="bx1_carrousel_count" value="<?= intval($edit_data['count']); ?>" min="1" max="20" required></td>
                    </tr>
                    <tr>
                        <th>Couleur de fond du carrousel</th>
                        <td><input type="text" name="bx1_carrousel_color" id="bx1_carrousel_color" value="<?= esc_attr($edit_data['color']); ?>"></td>
                    </tr>
                    <tr>
                        <th>Couleur de fond du titre</th>
                        <td><input type="text" name="bx1_carrousel_title_color" id="bx1_carrousel_title_color" value="<?= esc_attr($edit_data['title_color']); ?>"></td>
                    </tr>
                </table>
                <p><input type="submit" name="bx1_carrousel_edit_submit" class="button button-primary" value="Mettre à jour"></p>
            </form>
            <?php
        } else {
            echo '<div class="notice notice-error"><p>Carrousel introuvable.</p></div>';
        }
    }

    if (isset($_GET['delete'])) {
        $delete_id = sanitize_text_field($_GET['delete']);
        $carousels = get_option('bx1_carrousel_carousels', []);
        if (isset($carousels[$delete_id])) {
            unset($carousels[$delete_id]);
            update_option('bx1_carrousel_carousels', $carousels);
            echo '<div class="notice notice-success"><p>Carrousel supprimé.</p></div>';
        }
    }    

    $categories = get_categories(['hide_empty' => false]);
    $carousels = get_option('bx1_carrousel_carousels', []);
    ?>
    <div class="wrap">
        <h1>Créer un nouveau carrousel</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th>Nom du carrousel</th>
                    <td>
                        <input type="text" name="bx1_carrousel_name" required>
                    </td>
                </tr>
                <tr>
                    <th>Catégorie</th>
                    <td>
                        <select name="bx1_carrousel_category" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= esc_attr($cat->term_id); ?>"><?= esc_html($cat->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Nombre d’articles</th>
                    <td><input type="number" name="bx1_carrousel_count" value="4" min="1" max="20" required></td>
                </tr>
                <tr>
                    <th>Couleur du carrousel</th>
                    <td>
                        <input type="text" name="bx1_carrousel_color" id="bx1_carrousel_color" value="#1f2937">
                    </td>
                </tr>
                <tr>
                    <th>Couleur de fond du titre</th>
                    <td>
                        <input type="text" name="bx1_carrousel_title_color" id="bx1_carrousel_title_color" value="#1f2937">
                    </td>
                </tr>                
            </table>
            <p><input type="submit" name="bx1_carrousel_submit" class="button button-primary" value="Créer le carrousel"></p>
        </form>

        <h2>Carrousels existants</h2>
        <ul>
            <?php foreach ($carousels as $id => $settings): ?>
            <li style="margin-bottom:1rem;">
                <strong><?= esc_html($settings['name']); ?></strong><br>
                Titre : <span style="display:inline-block;width:12px;height:12px;background:<?= esc_attr($settings['title_color']); ?>;border-radius:2px;"></span> <?= esc_html($settings['title_color']); ?><br>

                Catégorie : <?= esc_html(get_cat_name($settings['category'])); ?> (<?= intval($settings['count']); ?> articles)<br>
                Couleur : <span style="display:inline-block;width:12px;height:12px;background:<?= esc_attr($settings['color']); ?>;border-radius:2px;"></span> <?= esc_html($settings['color']); ?><br>
                Shortcode : <code>[bx1_carrousel id="<?= esc_attr($id) ?>"]</code><br>
                PHP : <code>&lt;?php echo do_shortcode('[bx1_carrousel id="<?= esc_attr($id) ?>"]'); ?&gt;</code><br>
                <a href="<?= admin_url('admin.php?page=bx1_carrousel&edit=' . esc_attr($id)); ?>" class="button button-small">Modifier</a>
                <a href="<?= admin_url('admin.php?page=bx1_carrousel&delete=' . esc_attr($id)); ?>" onclick="return confirm('Supprimer ce carrousel ?');" class="button button-small">Supprimer</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', 'bx1_carrousel_enqueue_color_picker');
function bx1_carrousel_enqueue_color_picker($hook) {
    // Charger uniquement sur la page du plugin
    if ($hook !== 'toplevel_page_bx1_carrousel') return;

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('bx1-color-picker-init', plugin_dir_url(__FILE__) . 'color-init.js', ['wp-color-picker'], false, true);
}

