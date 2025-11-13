
let isActive = true;

function generateProfileImages() {
    const profiles = document.querySelectorAll('[id^="profile"]');

    profiles.forEach(profile => {
        const imageId = 'image' + profile.id.replace('profile', '');
        const imageElement = document.getElementById(imageId);
        const seedText = profile.textContent.slice(0, 5) + profile.textContent.slice(-5);
        const baseHue = Array.from(seedText).reduce((acc, char) => acc + char.charCodeAt(0), 0) % 360;

        for (let i = 0; i < 25; i++) { 
            const variation = (Math.random() - 0.5) * 50; // Variación aleatoria de -25 a +25
            const color = `hsl(${baseHue + variation}, 70%, 50%)`;
            const div = document.createElement('div');
            div.style.backgroundColor = color;
            imageElement.appendChild(div);
        }
    });
}

window.addEventListener('load', generateProfileImages);


function toggleMenu() {
    var nav = document.getElementById("nav");
    var hiddenElements = document.getElementsByClassName("hidden");
    var isExpanded = nav.style.width === "15%";
    
    // Alternar los estilos de nav y los menús
    nav.style.width = isExpanded ? "60px" : "15%";
    nav.style.minWidth = isExpanded ? "" : "200px";

    
   
    
    document.getElementById("menu_open").style.display = isExpanded ? "flex" : "none";
    document.getElementById("menu").style.display = isExpanded ? "none" : "flex";
    
    // Alternar la visibilidad de los elementos ocultos
    Array.from(hiddenElements).forEach(element => {
        element.style.display = isExpanded ? "none" : "flex";
        element.style.opacity = isExpanded ? "0" : "1";
    });
    if (isExpanded != true){
        isActive = false;
    }else {isActive = true; }
}


function showThumb(elementId) {
    if (!isActive) {
        console.log("La función showThumb está desactivada porque el menú está expandido.");
        return;  // No hacer nada si isActive es false
    }

    // Solo ejecutar si isActive es true
    var element = document.getElementById(elementId);
    element.style.display = 'block';
    document.getElementById("zindex").style.zIndex = '-1';
}


function hideThumb(elementId) {
    document.getElementById(elementId).style.display = 'none';
    document.getElementById("zindex").style.zIndex= '0';
}



function newsMenu() {
    var nav = document.getElementById("news");
    
    var isclossed = nav.style.right=== "150px";
    
    // Alternar los estilos de nav y los menús
    nav.style.right = isclossed ? "0px" : "150px";
    nav.style.zIndex = isclossed ? "0" : "-99";
    nav.style.opacity = isclossed ? "1" : "0";
    nav.style.borderRadius = isclossed ? "0px 15px 15px 0px" : "0px";
    

    
   
    
    document.getElementById("news_close").style.display = isclossed ? "flex" : "none";
    document.getElementById("news_open").style.display = isclossed ? "none" : "flex";
    
    
}

function loadBitcoinPrice() {
    const url = 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR,CNY,JPY,GBP';
    const url_eth = 'https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD,EUR,CNY,JPY,GBP';

    fetch(url)
        .then(response => response.json())  // Convertir la respuesta a JSON
        .then(data => {
            const usdRate = Math.round(data.USD);  // Acceder al valor del tipo de cambio en USD y redondearlo
            document.getElementById('bitcoinRate').innerText = `USD ${usdRate.toLocaleString()}`;  // Mostrar el valor redondeado en el div
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
            document.getElementById('bitcoinRate').innerText = 'Error loading price';
        });
    fetch(url_eth)
        .then(response => response.json())  // Convertir la respuesta a JSON
        .then(data => {
            const usdRate = Math.round(data.USD);  // Acceder al valor del tipo de cambio en USD y redondearlo
            document.getElementById('ethRate').innerText = `USD ${usdRate.toLocaleString()}`;  // Mostrar el valor redondeado en el div
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
            document.getElementById('ethRate').innerText = 'Error loading price';
        });    
}
    

// Establecer el intervalo para actualizar el precio cada 2 segundos (2000 milisegundos)
setInterval(loadBitcoinPrice, 60000);

// Llamar a la función al cargar la página para tener el precio inicial sin esperar los primeros 2 segundos
loadBitcoinPrice();

function loadBitcoinDominance() {
    const url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=1&sparkline=false';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let BTCCap = 0;
            let ETHCap = 0;
            let altCap = 0;
            
            // Recopilar datos de Market Cap
            

            data.forEach(coin => {
                if (coin.id === "bitcoin") {
                    BTCCap = coin.market_cap;  
                    console.log(BTCCap);
                    altCap += coin.market_cap;
                } else if (coin.id === "ethereum") {
                    ETHCap = coin.market_cap;  
                    altCap += coin.market_cap;
                } else {
                    altCap += coin.market_cap;  
                }
            });

            
            altCap = altCap -110e9
            const totalMarketCap = formatMarketCap(altCap);
            const totalt = altCap - BTCCap - ETHCap;
            
            document.getElementById('totalMarketCap').innerText = `${totalMarketCap}`;         
            
            const newDominance = (BTCCap / altCap) * 100;  
            document.getElementById('btcDominance').innerText = `${newDominance.toFixed(2)}%`;

            const total3 = formatMarketCapB(totalt);
            document.getElementById('totalt').innerText = `${formatMarketCap(total3)}`;
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
            document.getElementById('btcDominance').innerText = 'Error loading data';
            document.getElementById('totalMarketCap').innerText = 'Error loading data';
        });
}

function formatMarketCap(cap) {
    if (cap >= 1e12) {
        return `${(cap / 1e12).toFixed(1)}T`; // Formatear en trillones
    }
    return cap.toLocaleString(); // Formatear con comas
}
function formatMarketCapB(cap) {
    if (cap >= 1e9) {
        return `${(cap / 1e9).toFixed(0)}B`; // Formatear en trillones
    }
    return cap.toLocaleString(); // Formatear con comas
}
document.addEventListener('DOMContentLoaded', loadBitcoinDominance);

function fetchDataAndUpdateDivs() {
    fetch('https://api.alternative.me/fng/')
        .then(response => response.json())
        .then(data => {
            // Asumiendo que el primer elemento de 'data' es el que quieres mostrar
            const indexData = data.data[0];

            // Actualiza los divs con los nuevos valores
            document.getElementById('sentiment').textContent = indexData.value;
            document.getElementById('value-sentiment').textContent = indexData.value_classification;

            // Configura el próximo intervalo de actualización
            setTimeout(fetchDataAndUpdateDivs, indexData.time_until_update * 1000);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById('sentiment').textContent = 'Valor: Error al cargar datos';
            document.getElementById('value-sentiment').textContent = 'Clasificación: Error al cargar datos';
        });
}

// Llama a la función al cargar la página y luego basado en el tiempo hasta la próxima actualización
fetchDataAndUpdateDivs();


// CHART BTC
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('btcChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(1, 'rgba(0, 255, 0, 0.7)'); // Color verde limón semi-transparente
        gradient.addColorStop(0, 'rgba(0, 0, 0, 0.5)');
        

    let myChart = new Chart(ctx, {
        
        type: 'line',
        data: {
            labels: [], 
            datasets: [{
                label: 'USD',
                fill: true,
                backgroundColor: 'rgba(0, 0, 0, 0)', 
                borderColor: 'rgba(0, 250, 10, 0.7)', 
                pointRadius: 0 ,               
                data: [] 
            }]
        },
        options: {
            
            scales: {
                x: {
                    type: 'category',
                    display: true,
                    ticks: {
                        display: false 
                    },
                    grid: {
                        display:false
                    }
                },
                y: {
                    beginAtZero: false,
                    display: true,
                    ticks: {
                        display: false 
                    },
                    position: 'right',
                    grid: {
                        display:false
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                annotation: {
                    annotations: {}
                }
            }
        }
    });

  

    document.getElementById('liquidationDiv').onclick = function() {
        
        toggleAnnotations('liquidation',['shortLiquidation', 'longLiquidation'],'line');
    };

    document.getElementById('resistanceDiv').addEventListener('click', function() {
        toggleAnnotations('resistance', ['simpleResistance', 'bigResistance'], 'line');
    });

    document.getElementById('supportDiv').addEventListener('click', function() {
        toggleAnnotations('support', ['simpleSupport', 'bigSupport'],'line');
    });
    document.getElementById('emaDiv').onclick = function() {
        
        toggleAnnotations('ema',['ema200','ema100', 'ema50'],'point');
    };

    function toggleAnnotations(type, ids, kind) {
        console.log(kind);
        let isActive = false; 
        ids.forEach(id => {
            const value = document.getElementById(id).textContent;
            const annotationId = `${type}-${id}`;
            const pointAnnotationId = `${type}-point-${id}`;

            let backgroundColor;
            if (type === 'support') {
                backgroundColor = 'rgba(0, 250, 10, 0.5)';  // Rojo
            } else if (type === 'resistance') {
                backgroundColor = 'red';  // Azul
            } else if (type === 'liquidation') {
                backgroundColor = 'black';     // Verde
            } else {
                backgroundColor = 'rgba(128, 128, 128, 0.5)'; // Gris por defecto
            }
            
            if(kind ==='line'){
            if (myChart.options.plugins.annotation.annotations[annotationId]) {
               
                delete myChart.options.plugins.annotation.annotations[annotationId];
            } else {
            
               console.log(value);
                const annotation = {
                    type: 'line',
                    yMin: parseFloat(value),
                    yMax: parseFloat(value),
                    borderColor: backgroundColor,
                    borderWidth: 2,
                    label: {
                        enabled: true,
                        content: `${value}`,
                        
                        position: 'start',
                        font: {
                            size: 10 
                        },
                        backgroundColor: backgroundColor
                    }
                };
                myChart.options.plugins.annotation.annotations[annotationId] = annotation;
                isActive = true;    
           
            }    
            }
            
            if(kind ==='point'){
            if (myChart.options.plugins.annotation.annotations[pointAnnotationId]) {
               
                delete myChart.options.plugins.annotation.annotations[pointAnnotationId];
            } else {
                const lastIndex = myChart.data.labels.length - 1; // Último índice
                const adjustedIndex = Math.max(lastIndex - 1, 0);

                const pointAnnotation = {
                    type: 'point',
                    xValue: adjustedIndex,
                    yValue: parseFloat(value),
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    radius: 5,
                    label: {
                        content: `${type.toUpperCase()} - ${value}`,
                        enabled: true,
                        position: 'start',
                        font: {
                            size: 10 
                        },
                        backgroundColor: backgroundColor
                    }
                };
                myChart.options.plugins.annotation.annotations[pointAnnotationId] = pointAnnotation;

                isActive = true; 
            }
            }

        });
    
        // Actualizar la clase del div basado en el estado de las anotaciones
        const div = document.getElementById(`${type}Div`);
        if (isActive) {
            div.classList.remove('inactive');
            div.classList.add('active');
        } else {
            div.classList.remove('active');
            div.classList.add('inactive');
        }
    
        myChart.update();
    }
    

    
    function updateChartData() {
        fetch('http://127.0.0.1:8000/api') 
            .then(response => response.json())
            .then(data => {
                const btcPrices = data.btcPrices;
                const uniqueTimestamps = [...new Set(btcPrices.map(item => item.timestamp))];
                const prices = btcPrices.map(item => item.price);

                myChart.data.labels = uniqueTimestamps;
                myChart.data.datasets[0].data = prices;
                myChart.update();
            })
            .catch(error => console.error('Error al obtener datos:', error));
    }

    updateChartData();
    setInterval(updateChartData, 100000); // Actualiza cada 100 segundos
});



document.addEventListener('DOMContentLoaded', function() {
    const utcClockDiv = document.getElementById('utcClock');
    document.getElementById('dashboard-content').style.display ="flex";
    document.getElementById('dashboard-title').style.display ="flex";
    document.getElementById('wallet-title').style.display ="none";
    document.getElementById('wallet-content').style.display ="none";
    function updateClock() {
        const now = new Date(); // Obtén la fecha y hora actuales en UTC
        const hour = now.getUTCHours(); // Hora UTC
        const minutes = ('0' + now.getUTCMinutes()).slice(-2); // Minutos UTC
        const seconds = ('0' + now.getUTCSeconds()).slice(-2); // Segundos UTC

        const day = now.getUTCDate(); // Día del mes UTC
        const monthIndex = now.getUTCMonth(); // Índice del mes (0-11) en UTC
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const month = monthNames[monthIndex]; // Nombre abreviado del mes

        const formattedTime = `${hour}:${minutes}:${seconds}`; // Formato de la hora
        const formattedDate = `${day}-${month}`; // Formato de la fecha

        utcClockDiv.textContent = `${formattedTime} ${formattedDate}`; // Actualiza el contenido del div
    }

    setInterval(updateClock, 1000); // Actualiza el reloj cada segundo
    updateClock(); // Llama inicialmente para evitar retraso en la primera actualización
    toggleMenu()
});



function menuActive(id) {
    // Array of all menu div IDs
    const menuIds = ['dashboard', 'wallet', 'token'];

    // Loop through all menu divs
    menuIds.forEach(menuId => {
        const divElement = document.getElementById(menuId);
        const titleElement = document.getElementById(`${menuId}-title`);
        const contentElement = document.getElementById(`${menuId}-content`);

        if (menuId === id) {
            // Set active class, show related title and content
            divElement.style.background ="rgba(20, 20, 20, .8)";
            divElement.style.transform ="scale(1.05)";
            divElement.style.borderRadius ="5px";
            titleElement.style.display ="flex";
            contentElement.style.display ="flex";

            
        } else {
            // Remove active class, hide unrelated title and content
            divElement.style.background ="none";
            divElement.style.transform ="scale(1)";
            divElement.style.borderRadius ="0px";
            titleElement.style.display ="none";
            contentElement.style.display ="none";
           
        }
    });
}
