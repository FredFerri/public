<?php

/**
 * Template Name: Élections 2024
 *
 *
 * @package BX1
 */

get_header('v2'); ?>

<div>
    <label for="communeSelect">Sélectionnez une commune :</label>
    <select id="communeSelect">
        <option value="Anderlecht">Anderlecht</option>
        <option value="Auderghem">Auderghem</option>
        <option value="Berchem-Sainte-Agathe">Berchem-Sainte-Agathe</option>
        <option value="Bruxelles">Bruxelles</option>
        <option value="Crainhem">Crainhem</option>
        <option value="Drogenbos">Drogenbos</option>
        <option value="Etterbeek">Etterbeek</option>
        <option value="Evere">Evere</option>
        <option value="Forest">Forest</option>
        <option value="Ganshoren">Ganshoren</option>
        <option value="Ixelles">Ixelles</option>
        <option value="Jette">Jette</option>
        <option value="Koekelberg">Koekelberg</option>
        <option value="Linkebeek">Linkebeek</option>
        <option value="Molenbeek-Saint-Jean">Molenbeek-Saint-Jean</option>
        <option value="Rhode-Saint-Genese">Rhode-Saint-Genese</option>
        <option value="Saint-Gilles">Saint-Gilles</option>
        <option value="Saint-Josse-Ten-Noode">Saint-Josse-Ten-Noode</option>
        <option value="Schaerbeek">Schaerbeek</option>
        <option value="Uccle">Uccle</option>
        <option value="Watermael-Boitsfort">Watermael-Boitsfort</option>
        <option value="Wemmel">Wemmel</option>
        <option value="Wezembeek-Oppem">Wezembeek-Oppem</option>
        <option value="Woluwe-Saint-Lambert">Woluwe-Saint-Lambert</option>
        <option value="Woluwe-Saint-Pierre">Woluwe-Saint-Pierre</option>
    </select>
</div>

<div id="chartsContainer"></div> <!-- Un conteneur pour afficher dynamiquement les graphiques -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script> <!-- Chart.js version compatible -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> <!-- Plugin DataLabels compatible -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const urls = {
        'Anderlecht': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Anderlecht.json',
        'Auderghem': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Auderghem.json',
        'Berchem-Sainte-Agathe': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Berchem-Sainte-Agathe.json',
        'Bruxelles': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Bruxelles.json',
        'Crainhem': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Crainhem.json',
        'Drogenbos': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Drogenbos.json',
        'Etterbeek': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Etterbeek.json',
        'Evere': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Evere.json',
        'Forest': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Forest.json',
        'Ganshoren': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Ganshoren.json',
        'Ixelles': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Ixelles.json',
        'Jette': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Jette.json',
        'Koekelberg': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Koekelberg.json',
        'Linkebeek': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Linkebeek.json',
        'Molenbeek-Saint-Jean': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Molenbeek-Saint-Jean.json',
        'Rhode-Saint-Genese': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Rhode-Saint-Genese.json',
        'Saint-Gilles': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Saint-Gilles.json',
        'Saint-Josse-Ten-Noode': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Saint-Josse-Ten-Noode.json',
        'Schaerbeek': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Schaerbeek.json',
        'Uccle': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Uccle.json',
        'Watermael-Boitsfort': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Watermael-Boitsfort.json',
        'Wemmel': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Wemmel.json',
        'Wezembeek-Oppem': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Wezembeek-Oppem.json',
        'Woluwe-Saint-Lambert': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Woluwe-Saint-Lambert.json',
        'Woluwe-Saint-Pierre': 'https://bx1.be/jsontest/Infogram_Communales_Commune_Woluwe-Saint-Pierre.json'
    };

    const selectElement = document.getElementById('communeSelect');
    
    // Charger automatiquement le graphique pour la première ville (Anderlecht)
    const initialCommune = 'Anderlecht';
    loadChart(urls[initialCommune], initialCommune);

    // Event listener pour la liste déroulante
    selectElement.addEventListener('change', function() {
        const selectedCommune = selectElement.value;
        if (selectedCommune) {
            const url = urls[selectedCommune];
            loadChart(url, selectedCommune);
        }
    });

    function loadChart(url, communeName) {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const chartsContainer = document.getElementById('chartsContainer');
                chartsContainer.innerHTML = '';  // Réinitialiser le conteneur pour afficher le nouveau graphique
                generateChart(data[0], communeName, url);
            });
    }

    function generateChart(dataArray, communeName, url) {
        // Créer dynamiquement un conteneur pour les graphiques
        const chartsContainer = document.getElementById('chartsContainer');

        // Calculer la hauteur du graphique en fonction du nombre de partis (40px minimum par barre)
        const numBars = dataArray.length - 1;  // Exclure la première ligne qui contient les intitulés
        let chartHeight = Math.max(numBars * 40, 220);  // 40px par barre, minimum de 220px

        // Si la largeur de l'écran est inférieure à 768px, multiplier la hauteur par 2
        if (window.innerWidth < 768) {
            chartHeight *= 2;
        }

        // Générer un ID unique pour les graphiques de chaque commune
        const chartId = `chart_${communeName}`;
        const chartIdProgress = `chartProgress_${communeName}`;

        // Créer dynamiquement l'élément canvas avec l'ID unique
        const chartContainer = document.createElement('div');
        chartContainer.innerHTML = `
            <h3>Résultats pour la commune : ${communeName}</h3>
            <canvas id="${chartId}" width="400" height="${chartHeight}"></canvas>
            <canvas id="${chartIdProgress}" width="400" height="100"></canvas> <!-- Graphique pour le dépouillement avec une hauteur augmentée -->
        `;
        chartsContainer.appendChild(chartContainer);

        // La première ligne est les intitulés : "Partis", "2024", "2018"
        const labels = dataArray.slice(1).map(row => row[0]);  // Les noms des partis sont dans la première colonne

        // Les valeurs pour 2024 sont dans la colonne indexée par 1, et 2018 par 2
        const data2024 = dataArray.slice(1).map(row => row[1]);
        const data2018 = dataArray.slice(1).map(row => row[2]);

        // Créer un seul graphique avec deux datasets : un pour 2024 et un pour 2018
        const ctx = document.getElementById(chartId).getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: '2024',
                        data: data2024,
                        backgroundColor: 'rgba(227, 205, 139, 0.9)',
                        borderColor: 'rgba(227, 205, 139, 0.9)',
                        borderWidth: 1
                    },
                    {
                        label: '2018',
                        data: data2018,
                        backgroundColor: 'rgba(106, 100, 90, 0.5)',
                        borderColor: 'rgba(106, 100, 90, 0.5)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                indexAxis: 'y',  // Pour afficher les barres horizontalement
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + '%';  // Ajouter le symbole "%" au survol
                            }
                        }
                    },
                    datalabels: {
                        align: 'start',  // Aligner à gauche
                        anchor: 'start',  // Ancrer à gauche
                        formatter: function(value) {
                            return value > 0 ? value + '%' : '';  // Afficher uniquement les valeurs > 0
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]  // Activer le plugin ChartDataLabels pour afficher les valeurs statiques
        });

        // Charger et afficher le pourcentage de dépouillement
        const progressUrl = url.replace('.json', '_prog.json');  // Générer l'URL du fichier JSON pour le dépouillement

        fetch(progressUrl)
            .then(response => response.json())
            .then(progressData => {
                var progressValue = progressData[0][1][1];  // Extraire le pourcentage de dépouillement du fichier
                progressValue = progressValue.substr(0, progressValue.indexOf('%'));

                // Créer le graphique pour le dépouillement
                const ctxProgress = document.getElementById(chartIdProgress).getContext('2d');

                new Chart(ctxProgress, {
                    type: 'bar',
                    data: {
                        labels: ['Dépouillement'],
                        datasets: [
                            {
                                label: 'Dépouillement en %',
                                data: [progressValue],
                                backgroundColor: 'rgba(93, 112, 82, 0.6)',  // Couleur différente (vert ici)
                                borderColor: 'rgba(93, 112, 82, 0.6)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y',  // Afficher la barre horizontalement
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100,  // Assurer que la barre ne dépasse pas 100%
                                ticks: {
                                    display: false  // Masquer les ticks de l'axe des abscisses
                                }
                            },
                            y: {
                                ticks: {
                                    display: true  // Afficher les ticks sur l'axe Y pour indiquer "Dépouillement"
                                }
                            }
                        },
                        responsive: true,
                        barThickness: 30,  // Contrôler explicitement la hauteur des barres
                        plugins: {
                            legend: {
                                display: true  // Rétablir la légende pour les graphiques de dépouillement
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.raw + '%';  // Ajouter le symbole "%" au survol
                                    }
                                }
                            },
                            datalabels: {
                                align: 'start',  // Aligner à gauche
                                anchor: 'start',  // Ancrer à gauche
                                formatter: function(value) {
                                    return value > 0 ? value + '%' : '';  // Afficher uniquement les valeurs > 0
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]  // Activer le plugin ChartDataLabels pour afficher les valeurs statiques
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement du fichier de dépouillement:', error);
            });
    }
});
</script>

<style>
  /* Appliquer un style responsive pour les graphiques */
  #chartsContainer canvas {
      width: 100% !important;  /* Faire en sorte que les graphiques prennent 100% de la largeur du conteneur */
      height: auto !important; /* Hauteur auto pour ajuster aux écrans */
  }

  /* Ajuster la hauteur des barres pour les graphiques de dépouillement */
  canvas[id^="chartProgress"] {
      height: 50px !important;  /* Hauteur plus élevée pour les barres de dépouillement */
  }

  @media (max-width: 768px) {
      /* Réduire la taille des polices pour les petits écrans */
      #chartsContainer h3 {
          font-size: 1.2em;
      }
      canvas[id^="chart_"] {
          height: 150px !important;  /* Ajuster la hauteur des graphiques principaux sur mobile */
      }
  }
</style>

<?php get_footer('v2'); ?>
