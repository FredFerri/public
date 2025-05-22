#!/bin/bash

# === CONFIGURATION ===
SITE_PATH="/data/sites/bx1.be/httpdocs"               # Répertoire de ton site WordPress
BACKUP_PATH="/data/sites/bx1.be/backup"          # Où stocker les backups (modifie si tu veux)
DB_NAME="bx1_prod"
DB_USER="bx1_prod"
DB_PASS=".}sVc6.EThtE7pp"
DATE=$(date +"%Y-%m-%d_%H-%M")

# === SAUVEGARDE DU wp-config.php ===
cp "$SITE_PATH/wp-config.php" "$BACKUP_PATH/wp-config-$DATE.php"

echo "🧩 Sauvegarde du thème actif ($THEME_NAME)..."
zip -r "$BACKUP_PATH/theme-$THEME_NAME-$DATE.zip" "$SITE_PATH/wp-content/themes/$THEME_NAME"

# === EXPORT DE LA BASE DE DONNÉES ===
mysqldump -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$BACKUP_PATH/db-$DATE.sql"

echo "✅ Sauvegarde terminée dans : $BACKUP_PATH"
