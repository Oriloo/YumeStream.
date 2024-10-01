document.addEventListener('DOMContentLoaded', function() {
    const animeId = new URLSearchParams(window.location.search).get('id');
    let currentEpisodes = [];
    const defaultLangue = new URLSearchParams(window.location.search).get('langue') || 'vostfr';
    const defaultEpisode = parseInt(new URLSearchParams(window.location.search).get('episode')) || 1;
    const defaultLangueValue = defaultLangue === 'vf' ? 1 : 0;

    function fetchEpisodes(langue) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch_episodes.php?anime_id=${animeId}&vf_episode=${langue}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const episodes = JSON.parse(this.responseText);
                    resolve(episodes);
                } else {
                    reject(new Error('Failed to fetch episodes'));
                }
            };
            xhr.send();
        });
    }

    function populateEpisodes(episodes, selectedLangue) {
        const selectEpisode = document.getElementById('select-episode');
        const zoneEpisode = document.getElementById('zone-episode');
        const episodeTitle = document.getElementById('episode-titre');
        const episodeDate = document.getElementById('episode-date');

        selectEpisode.innerHTML = '';

        if (episodes.length === 0) {
            zoneEpisode.textContent = 'Aucun épisode trouvé';
            episodeTitle.textContent = '';
            episodeDate.textContent = '';
            return;
        }

        episodes.forEach((episode) => {
            const option = document.createElement('option');
            option.value = episode.nb_episode;
            option.textContent = `épisode ${episode.nb_episode}`;
            if (episode.nb_episode == defaultEpisode) {
                option.selected = true;
            }
            selectEpisode.appendChild(option);
        });

        const selectedEpisodeNumber = selectEpisode.value;
        const episodeExists = episodes.some(ep => ep.nb_episode == selectedEpisodeNumber);

        if (!episodeExists) {
            selectEpisode.value = 1;
        }

        updateEpisodeInfo(selectEpisode.value, episodes);
        updateURL(selectedLangue, selectEpisode.value);
    }

    function updateEpisodeInfo(episodeNumber, episodes) {
        const episode = episodes.find(ep => ep.nb_episode == episodeNumber);
        if (episode) {
            document.getElementById('episode-titre').textContent = episode.titre_episode;
            document.getElementById('episode-date').textContent = new Date(episode.date_episode).toLocaleString();
            document.getElementById('zone-episode').innerHTML = episode.lien_episode;
        }
    }

    function updateURL(langue, episodeNumber) {
        const url = new URL(window.location.href);
        url.searchParams.set('langue', langue);
        url.searchParams.set('episode', episodeNumber);
        window.history.pushState({}, '', url);
    }

    function init() {
        const selectLangue = document.getElementById('select-langue');
        const animeInteractionDiv = document.querySelector('.anime-interaction');

        Promise.all([fetchEpisodes(0), fetchEpisodes(1)]).then(([vostfrEpisodes, vfEpisodes]) => {
            let hasVostfr = vostfrEpisodes.length > 0;
            let hasVf = vfEpisodes.length > 0;

            if (!hasVostfr && !hasVf) {
                animeInteractionDiv.style.display = 'none';
                return;
            }

            if (hasVostfr) {
                const optionVostfr = document.createElement('option');
                optionVostfr.value = 0;
                optionVostfr.textContent = 'VOSTFR';
                if (defaultLangue === 'vostfr') {
                    optionVostfr.selected = true;
                }
                selectLangue.appendChild(optionVostfr);
            }

            if (hasVf) {
                const optionVf = document.createElement('option');
                optionVf.value = 1;
                optionVf.textContent = 'VF';
                if (defaultLangue === 'vf') {
                    optionVf.selected = true;
                }
                selectLangue.appendChild(optionVf);
            }

            const storedEpisodes = localStorage.getItem(`episodes_${animeId}_${defaultLangueValue}`);
            if (storedEpisodes) {
                currentEpisodes = JSON.parse(storedEpisodes);
                populateEpisodes(currentEpisodes, defaultLangue);
            } else {
                fetchEpisodes(defaultLangueValue).then(episodes => {
                    currentEpisodes = episodes;
                    populateEpisodes(currentEpisodes, defaultLangue);
                });
            }
        }).catch(err => {
            console.error(err);
            animeInteractionDiv.style.display = 'none';
        });

        selectLangue.addEventListener('change', function() {
            const langueValue = this.value;
            const langue = langueValue == 1 ? 'vf' : 'vostfr';
            const storedEpisodes = localStorage.getItem(`episodes_${animeId}_${langueValue}`);
            if (storedEpisodes) {
                currentEpisodes = JSON.parse(storedEpisodes);
                populateEpisodes(currentEpisodes, langue);
            } else {
                fetchEpisodes(langueValue).then(episodes => {
                    currentEpisodes = episodes;
                    populateEpisodes(currentEpisodes, langue);
                });
            }
            const episodeExists = currentEpisodes.some(ep => ep.nb_episode == document.getElementById('select-episode').value);
            if (!episodeExists) {
                document.getElementById('select-episode').value = 1;
            }
            updateURL(langue, document.getElementById('select-episode').value);
        });

        document.getElementById('select-episode').addEventListener('change', function() {
            const episodeNumber = this.value;
            updateEpisodeInfo(episodeNumber, currentEpisodes);
            updateURL(document.getElementById('select-langue').value == 1 ? 'vf' : 'vostfr', episodeNumber);
        });

        document.getElementById('btn-precedent').addEventListener('click', function() {
            const selectEpisode = document.getElementById('select-episode');
            if (selectEpisode.selectedIndex > 0) {
                selectEpisode.selectedIndex -= 1;
                const episodeNumber = selectEpisode.value;
                updateEpisodeInfo(episodeNumber, currentEpisodes);
                updateURL(document.getElementById('select-langue').value == 1 ? 'vf' : 'vostfr', episodeNumber);
            }
        });

        document.getElementById('btn-suivant').addEventListener('click', function() {
            const selectEpisode = document.getElementById('select-episode');
            if (selectEpisode.selectedIndex < selectEpisode.options.length - 1) {
                selectEpisode.selectedIndex += 1;
                const episodeNumber = selectEpisode.value;
                updateEpisodeInfo(episodeNumber, currentEpisodes);
                updateURL(document.getElementById('select-langue').value == 1 ? 'vf' : 'vostfr', episodeNumber);
            }
        });
    }

    init();
});
