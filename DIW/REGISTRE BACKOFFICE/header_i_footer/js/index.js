document.addEventListener("DOMContentLoaded", main);

async function main() {
    const tbody = document.querySelector("#taulaResultat tbody");
    const btnAfegir = document.getElementById("afegirNou");

    const filtreClient = document.getElementById("filtreClient");
    const filtreComparator = document.getElementById("filtreComparator");
    const filtreFavorit = document.getElementById("filtreFavorit");
    const dataDesde = document.getElementById("dataDesde");
    const dataFins = document.getElementById("dataFins");
    const btnFiltrar = document.getElementById("btnFiltrar");
    const btnReset = document.getElementById("btnReset");
    

    // Variables per la paginació
    let paginaActual = 1;
    const regsPerPagina = 10;

    // Afegim el contenidor de la paginació sota la taula
    const paginacioContainer = document.createElement("div");
    paginacioContainer.id = "paginacio";
    paginacioContainer.style.marginTop = "15px";
    document.body.appendChild(paginacioContainer);

    // Carregar registres des de l'API amb fallback
    async function carregarRegistresApi() {
        try {
            const data = await getData(url, "Register");
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.Register)) return data.Register;
        } catch (e) {
            console.warn('API Register no disponible, fallback a localStorage', e);
        }
        const local = localStorage.getItem("Register");
        return local ? JSON.parse(local) : (typeof Register !== "undefined" && Array.isArray(Register) ? Register.slice() : []);
    }

    // Carregar clients des de l'API amb fallback
    async function carregarClientApi() {
        try {
            const data = await getData(url, "Client");
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.Client)) return data.Client;
        } catch (e) {
            console.warn('API Client no disponible, fallback a localStorage/global', e);
        }
        const local = localStorage.getItem("Client");
        return local ? JSON.parse(local) : (typeof Client !== "undefined" && Array.isArray(Client) ? Client.slice() : []);
    }

    // Carregar favorits
    async function carregarFavoritsApi() {
        try {
            const data = await getData(url, "Favorite");
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.Favorite)) return data.Favorite;
        } catch (e) {
            console.warn('API Favorite no disponible, fallback a localStorage/global', e);
        }
        const local = localStorage.getItem("Favorite");
        return local ? JSON.parse(local) : (typeof Favorite !== "undefined" && Array.isArray(Favorite) ? Favorite.slice() : []);
    }

    // Carregar comparadors
    async function carregarComparadorsApi() {
        try {
            const data = await getData(url, "Comparator");
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.Comparator)) return data.Comparator;
        } catch (e) {
            console.warn('API Comparator no disponible, fallback a localStorage/global', e);
        }
        const local = localStorage.getItem("Comparator");
        return local ? JSON.parse(local) : [];
    }

    // Omplir selects de filtres
    async function populateFilters() {
        const [clients, favorits, comparadors] = await Promise.all([
            carregarClientApi(),
            carregarFavoritsApi(),
            carregarComparadorsApi()
        ]);

        // Clients
        if (filtreClient) {
            // netejar
            filtreClient.innerHTML = '<option value="">-- Clients --</option>';
            clients.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = `${c.name || ''} ${c.surname || ''}`.trim() || (c.id ?? '');
                filtreClient.appendChild(opt);
            });
        }

        // Comparadors
        if (filtreComparator) {
            filtreComparator.innerHTML = '<option value="">--Comparadors --</option>';
            comparadors.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id ?? c.session_id ?? '';
                opt.textContent = `${c.id ?? ''} - ${c.session_id ?? ''}`.trim();
                filtreComparator.appendChild(opt);
            });
        }

        // Favorits
        if (filtreFavorit) {
            filtreFavorit.innerHTML = '<option value="">-- Favorits --</option>';
            favorits.forEach(f => {
                const opt = document.createElement('option');
                opt.value = f.id;
                opt.textContent = `${f.id} - ${f.product_name || f.name || 'Favorit'}`;
                filtreFavorit.appendChild(opt);
            });
        }
    }

    // -----------------------------
    // FUNCIÓNS DELS MODALS
    // -----------------------------    
    async function mostraClientModal(clientId) {
        const clients = await carregarClientApi();
        const client = clients.find(c => String(c.id) === String(clientId));
        
        const modal = document.getElementById("modalClient");
        const content = document.getElementById("modalClientContent");
        
        if (!client) {
            content.innerHTML = '<p>Client no trobat.</p>';
        } else {
            let html = '';
            const fields = {
                "ID": client.id,
                "Tipus d'identificació": client.taxidtype,
                "Identificador": client.taxid,
                "Nom": client.name,
                "Cognom": client.surname,
                "Email": client.email,
                "Telèfon": client.phone,
                "Data de naixement": client.birth_date,
                "Adreça": client.address,
                "CP": client.cp,
                "ID País": client.country_id,
                "ID Província": client.province_id,
                "ID Ciutat": client.city_id
            };
            for (const [key, value] of Object.entries(fields)) {
                html += `<p><strong>${key}:</strong> ${value ?? '-'}</p>`;
            }
            content.innerHTML = html;
        }
        modal.style.display = "block";
    }

    async function mostraFavoritModal(favoriteId) {
        const favorites = await carregarFavoritsApi();
        const favorite = favorites.find(f => String(f.id) === String(favoriteId));
        
        const modal = document.getElementById("modalFavorit");
        const content = document.getElementById("modalFavoritContent");
        
        if (!favorite) {
            content.innerHTML = '<p>Favorit no trobat.</p>';
        } else {
            let html = '';
            const fields = {
                "ID": favorite.id,
                "Nom": favorite.name,
                "Product Name": favorite.product_name,
                "Product ID": favorite.product_id
            };
            for (const [key, value] of Object.entries(fields)) {
                if (value !== undefined) {
                    html += `<p><strong>${key}:</strong> ${value ?? '-'}</p>`;
                }
            }
            content.innerHTML = html;
        }
        modal.style.display = "block";
    }

    async function mostraComparatorModal(comparatorId) {
        const registers = await carregarRegistresApi();
        const products = await carregarProductesApi();
        const comparadorLinks = await carregarCompararProductesApi();
        
        const modal = document.getElementById("modalComparador");
        const content = document.getElementById("modalComparadorContent");
        const prodContent = document.getElementById("modalComparadorProducts");
        
        const register = registers.find(r => String(r.comparator_id) === String(comparatorId) || String(r.session_id) === String(comparatorId));
        
        if (!register) {
            content.innerHTML = '<p>Comparador no trobat.</p>';
            prodContent.innerHTML = '';
        } else {
            let html = '';
            const fields = {
                "ID Sessió": register.session_id,
                "User Agent": register.user_agent,
                "Data inici": register.date_start ? new Date(register.date_start).toLocaleDateString("es-ES", {
                    day: "2-digit",
                    month: "2-digit",
                    year: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit"
                }) : '-',
                "Data fi": register.date_end ? new Date(register.date_end).toLocaleDateString("es-ES", {
                    day: "2-digit",
                    month: "2-digit",
                    year: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit"
                }) : '-'
            };
            for (const [key, value] of Object.entries(fields)) {
                html += `<p><strong>${key}:</strong> ${value}</p>`;
            }
            content.innerHTML = html;
            
            //Mostrar productes
            const productsForComparator = comparadorLinks.filter(item => String(item.sessionId) === String(register.session_id));
            let prodHtml = '';
            
            if (productsForComparator.length === 0) {
                prodHtml = '<p>No hi ha productes associats.</p>';
            } else {
                productsForComparator.forEach(item => {
                    const prod = Array.isArray(products) ? products[item.product] : products?.[item.product];
                    if (prod) {
                        prodHtml += `<div style="margin: 15px 0; border: 1px solid #ddd; padding: 10px;">`;
                        prodHtml += `<h4>${prod.name}</h4>`;
                        prodHtml += `<p>${prod.descripton || ''}</p>`;
                        prodHtml += `<p><strong>Preu:</strong> ${prod.price || '-'} €</p>`;
                        if (prod.img) {
                            prodHtml += `<img src="${prod.img}" alt="${prod.name}" style="max-width: 200px;">`;
                        }
                        prodHtml += '</div>';
                    }
                });
            }
            prodContent.innerHTML = prodHtml;
        }
        modal.style.display = "block";
    }

    async function carregarProductesApi() {
        try {
            const data = await getData(url, "Product");
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.Product)) return data.Product;
        } catch (e) {
            console.log('Producte carregat amb API no disponible', e);
        }
        const local = localStorage.getItem("productes");
        return local ? JSON.parse(local) : (typeof Product !== "undefined" && Array.isArray(Product) ? Product.slice() : []);
    }

    //Carregasr productes comparats
    async function carregarCompararProductesApi() {
        try {
            const data = await getData(url, "compararProductes");
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.compararProductes)) return data.compararProductes;
        } catch (e) {
            console.log('Producte comparat carregat amb API no disponible', e);
        }
        const local = localStorage.getItem("compararProductes");
        return local ? JSON.parse(local) : [];
    }

    //Tancar els modasl
    window.addEventListener('click', (event) => {
        const modalClient = document.getElementById("modalClient");
        const modalComparador = document.getElementById("modalComparador");
        const modalFavorit = document.getElementById("modalFavorit");
        
        if (event.target === modalClient) modalClient.style.display = "none";
        if (event.target === modalComparador) modalComparador.style.display = "none";
        if (event.target === modalFavorit) modalFavorit.style.display = "none";
    });

    // -----------------------------
    // PAGINACIÓ
    // -----------------------------
    function crearPaginacio(totalRegistres) {
        paginacioContainer.innerHTML = ""; // netegem

        const totalPagines = Math.ceil(totalRegistres / regsPerPagina);
        if (totalPagines <= 1) return; // si només hi ha una pàgina, no mostrem res

        const btnAnterior = document.createElement("button");
        btnAnterior.textContent = "« Anterior";
        btnAnterior.disabled = paginaActual === 1;
        btnAnterior.addEventListener("click", () => {
            if (paginaActual > 1) {
                paginaActual--;
                mostrarTaula(); // recarregar
            }
        });
        paginacioContainer.appendChild(btnAnterior);

        // Botons numèrics
        for (let i = 1; i <= totalPagines; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.style.margin = "0 3px";
            if (i === paginaActual) btn.disabled = true;
            btn.addEventListener("click", () => {
                paginaActual = i;
                mostrarTaula();
            });
            paginacioContainer.appendChild(btn);
        }

        const btnSeguent = document.createElement("button");
        btnSeguent.textContent = "Següent »";
        btnSeguent.disabled = paginaActual === totalPagines;
        btnSeguent.addEventListener("click", () => {
            if (paginaActual < totalPagines) {
                paginaActual++;
                mostrarTaula();
            }
        });
        paginacioContainer.appendChild(btnSeguent);
    }

    // -----------------------------
    // MOSTRAR TAULA
    // -----------------------------
    async function mostrarTaula(filtres = {}) {
        const registres = await carregarRegistresApi();
        const clients = await carregarClientApi();

        while (tbody.firstChild) tbody.removeChild(tbody.firstChild);

        let pagRegistres = registres;

        // ---- APLICAR FILTRES ----
        if (filtres.clientId || filtres.comparatorId || filtres.favoriteId || filtres.desde || filtres.fins) {
            pagRegistres = registres.filter((reg) => {
                let coincideix = true;

                // Filtro client per ID
                if (filtres.clientId) {
                    coincideix = coincideix && String(reg.client_id) === String(filtres.clientId);
                }

                // Filtro comparator per ID (comparator_id o session_id)
                if (filtres.comparatorId) {
                    coincideix = coincideix && (String(reg.comparator_id) === String(filtres.comparatorId) || String(reg.session_id) === String(filtres.comparatorId));
                }

                // Filtro favorit per ID
                if (filtres.favoriteId) {
                    coincideix = coincideix && String(reg.favorite_id) === String(filtres.favoriteId);
                }

                // Filtro per data
                if (filtres.desde || filtres.fins) {
                    const dataReg = new Date(reg.date_start);
                    if (filtres.desde) {
                        const desdeDate = new Date(filtres.desde);
                        coincideix = coincideix && dataReg >= desdeDate;
                    }
                    if (filtres.fins) {
                        const finsDate = new Date(filtres.fins);
                        coincideix = coincideix && dataReg <= finsDate;
                    }
                }

                return coincideix;
            });
        }

        if (!pagRegistres || pagRegistres.length === 0) {
            const tr = document.createElement("tr");
            const td = document.createElement("td");
            td.colSpan = 8;
            td.textContent = "No hi ha registres que coincideixin amb el filtre.";
            tr.appendChild(td);
            tbody.appendChild(tr);
            paginacioContainer.innerHTML = "";
            return;
        }

        //---Paginació .--------
        const inici = (paginaActual - 1) * regsPerPagina;
        const final = inici + regsPerPagina;
        const registresPagina = pagRegistres.slice(inici, final);

        // ---- MOSTRAR FILES ----
        registresPagina.forEach((registre, index) => {
            const fila = document.createElement("tr");

            const clientNom = clients.find((c) => c.id == registre.client_id) || null;

            const linkClient = document.createElement("a");
            linkClient.href = "#";
            linkClient.textContent = (clientNom ? clientNom.name : "Desconegut") + " " + (clientNom ? clientNom.surname : "");
            linkClient.style.cursor = "pointer";
            linkClient.addEventListener("click", (e) => {
                e.preventDefault();
                mostraClientModal(registre.client_id);
            });

            const linkComparador = document.createElement("a");
            linkComparador.href = "#";
            linkComparador.textContent = registre.comparator_id ? `${registre.comparator_id}` : "-";
            linkComparador.style.cursor = "pointer";
            linkComparador.addEventListener("click", (e) => {
                e.preventDefault();
                if (registre.comparator_id) mostraComparatorModal(registre.comparator_id);
            });

            const linkFavorit = document.createElement("a");
            linkFavorit.href = "#";
            linkFavorit.textContent = registre.favorite_id ? `${registre.favorite_id}` : "-";
            linkFavorit.style.cursor = "pointer";
            linkFavorit.addEventListener("click", (e) => {
                e.preventDefault();
                if (registre.favorite_id) mostraFavoritModal(registre.favorite_id);
            });

            const camps = [
                registre.session_id,
                registre.user_agent,
                linkClient,
                linkComparador,
                linkFavorit,
                registre.date_start,
                registre.date_end,
            ];

            camps.forEach((valor) => {
                const td = document.createElement("td");
                if (valor && valor.tagName === "A") {
                    td.appendChild(valor);
                } else if (valor && !isNaN(Date.parse(valor))) {
                    const fecha = new Date(valor);
                    td.textContent = fecha.toLocaleDateString("es-ES", {
                        day: "2-digit",
                        month: "2-digit",
                        year: "numeric",
                        hour: "2-digit",
                        minute: "2-digit",
                        second: "2-digit",
                    });
                } else {
                    td.textContent = valor ?? "-";
                }
                fila.appendChild(td);
            });

            const tdAccions = document.createElement("td");

            const btnEditar = document.createElement("button");
            btnEditar.textContent = "Editar";
            btnEditar.classList.add("accio", "editar");
            btnEditar.addEventListener("click", () => {
                // Hem de calcular l’índex global del registre (no només el de la pàgina)
                const indexGlobal = inici + index;
                sessionStorage.removeItem("editIndex");
                sessionStorage.removeItem("editId");
                sessionStorage.setItem("editIndex", indexGlobal);
                if (registre && registre.id !== undefined) sessionStorage.setItem("editId", registre.id);
                window.location.href = "./HistoricForm.html";
            });
            
            const btnEsborrar = document.createElement("button");
            btnEsborrar.textContent = "Esborrar";
            btnEsborrar.classList.add("accio", "eliminar");
            btnEsborrar.addEventListener("click", async () => {
                if (!confirm("Vols esborrar aquest registre?")) return;
                try {
                    //crida a l'API si l'element té id
                    if (registre && registre.id !== undefined) {
                        await deleteData(url, "Register", registre.id);
                    }
                } catch (e) {
                    console.error('Error esborrant registre:', e);
                }
                const totalRegs = (await carregarRegistresApi()).length;
                if ((paginaActual - 1) * regsPerPagina >= totalRegs) paginaActual--;
                await mostrarTaula();
            });

            tdAccions.appendChild(btnEditar);
            tdAccions.appendChild(btnEsborrar);
            fila.appendChild(tdAccions);
            tbody.appendChild(fila);
        });

        //Crear o actualitzar la paginació
        crearPaginacio(pagRegistres.length);
    }

    // -----------------------------
    // EVENTS
    // -----------------------------
    btnAfegir.addEventListener("click", () => {
        sessionStorage.removeItem("editIndex");
        window.location.href = "./HistoricForm.html";
    });

    btnFiltrar.addEventListener("click", () => {
        paginaActual = 1;
        const filtres = {
            clientId: filtreClient.value || "",
            comparatorId: filtreComparator ? filtreComparator.value || "" : "",
            favoriteId: filtreFavorit ? filtreFavorit.value || "" : "",
            desde: dataDesde.value,
            fins: dataFins.value,
        };
        mostrarTaula(filtres);
    });

    btnReset.addEventListener("click", () => {
        if (filtreClient) filtreClient.value = "";
        if (filtreComparator) filtreComparator.value = "";
        if (filtreFavorit) filtreFavorit.value = "";
        dataDesde.value = "";
        dataFins.value = "";
        paginaActual = 1;
        mostrarTaula();
    });

    // Omplir selects i mostrar inicial
    await populateFilters();
    mostrarTaula();
}
