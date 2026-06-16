<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌊 ระบบผลิตและควบคุมน้ำหมักจุลินทรีย์ชีวภาพอัจฉริยะด้วย IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* พื้นหลังสีฟ้าน้ำทะเลแบบคลื่นน้ำ (Ocean Gradient) */
        body {
            font-family: 'Prompt', sans-serif;
            background: linear-gradient(-45deg, #0077b6, #00b4d8, #48cae4, #90e0ef);
            background-size: 400% 400%;
            animation: oceanWave 12s ease infinite;
            min-height: 100vh;
            padding-bottom: 2rem;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes oceanWave {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Navbar สไตล์กระจกใต้น้ำ */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 119, 182, 0.3);
        }

        /* จัดการส่วนหัวระบบให้รองรับมือถือ */
        .system-title-wrapper {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }
        .system-logo {
            font-size: clamp(2rem, 5vw, 3rem);
            color: #ffeb3b;
            text-shadow: 0 4px 15px rgba(255, 235, 59, 0.4);
            margin-right: 15px;
        }
        .system-title {
            font-size: clamp(1.1rem, 2.5vw, 1.8rem);
            line-height: 1.4;
            color: #ffffff;
            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
            margin-bottom: 0;
            white-space: normal;
        }
        .iot-badge {
            background: linear-gradient(135deg, #ffeb3b, #fbc02d);
            color: #004d40;
            font-weight: 800;
            font-size: clamp(0.75rem, 1.5vw, 0.9rem);
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(255, 235, 59, 0.3);
        }

        @media (max-width: 768px) {
            .navbar-custom .container {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }
            .system-title-wrapper { width: 100%; }
            .admin-btn { width: 100%; text-align: center; }
        }

        /* บล็อกสีสันสดใส (Colorful Blocks) */
        .block-card {
            border-radius: 25px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            color: white;
            z-index: 2;
        }
        .block-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        /* สีประจำแต่ละบล็อก */
        .bg-coral { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); } 
        .bg-deepsea { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); } 
        .bg-starfish { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); } 
        .bg-seafoam { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); } 
        .bg-rock { background: linear-gradient(135deg, #8baaaa 0%, #aebfbe 100%); } 

        .bg-pattern { position: absolute; top: -20%; right: -10%; width: 150px; height: 150px; background: rgba(255, 255, 255, 0.15); border-radius: 50%; z-index: -1; }
        .bg-pattern-2 { position: absolute; bottom: -20%; left: -10%; width: 100px; height: 100px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; z-index: -1; }

        .icon-large { font-size: 3.5rem; color: rgba(255, 255, 255, 0.9); filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2)); }
        .value-text { font-size: 2.8rem; font-weight: 800; line-height: 1.1; margin-top: 5px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
        .label-text { font-size: 1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.9; }

        .spin-icon { animation: spin 1.2s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* ส่วนของกราฟ (กระจกขุ่น White Glass) */
        .chart-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 25px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 35px rgba(0, 119, 182, 0.2);
            position: relative;
            overflow: hidden;
        }

        /* เส้นแสกนเนอร์ (Scanner Line) เพื่อความล้ำสมัย */
        .scanner-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #00b4d8;
            box-shadow: 0 0 20px 5px rgba(0, 180, 216, 0.6);
            animation: scanMove 3.5s ease-in-out infinite;
            z-index: 10;
            pointer-events: none;
            border-radius: 50%;
        }
        @keyframes scanMove {
            0% { left: 2%; opacity: 0; }
            15% { opacity: 1; }
            85% { opacity: 1; }
            100% { left: 98%; opacity: 0; }
        }

        /* เอฟเฟกต์ฟองอากาศลอยขึ้นจากพื้น (Bubbles) */
        .bubbles { position: fixed; bottom: -50px; width: 100%; display: flex; justify-content: space-around; z-index: 0; pointer-events: none; }
        .bubble { width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; animation: float 8s infinite ease-in; box-shadow: 0 0 10px rgba(255, 255, 255, 0.3); }
        .bubble:nth-child(1) { width: 30px; height: 30px; animation-duration: 7s; }
        .bubble:nth-child(2) { width: 15px; height: 15px; animation-duration: 5s; animation-delay: 1s; }
        .bubble:nth-child(3) { width: 40px; height: 40px; animation-duration: 9s; animation-delay: 2s; }
        .bubble:nth-child(4) { width: 25px; height: 25px; animation-duration: 6s; animation-delay: 3s; }
        .bubble:nth-child(5) { width: 35px; height: 35px; animation-duration: 8s; animation-delay: 4s; }
        @keyframes float { 0% { transform: translateY(0) scale(1); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translateY(-100vh) scale(1.5); opacity: 0; } }
        
        .pulse-dot {
            display: inline-block;
            width: 12px; height: 12px;
            background-color: #ff3b30;
            border-radius: 50%;
            margin-right: 5px;
            box-shadow: 0 0 10px #ff3b30;
            animation: pulse 1s infinite;
        }
        @keyframes pulse { 0% { transform: scale(0.9); opacity: 0.7; } 50% { transform: scale(1.2); opacity: 1; } 100% { transform: scale(0.9); opacity: 0.7; } }
    </style>
</head>
<body>

<div class="bubbles">
    <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
</div>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom py-3">
    <div class="container d-flex justify-content-between align-items-center">
        
        <div class="system-title-wrapper">
            <div class="system-logo">
                <i class="fas fa-water"></i>
            </div>
            <div>
                <h1 class="fw-bold system-title">
                    ระบบผลิตและควบคุมน้ำหมักจุลินทรีย์ชีวภาพอัจฉริยะ
                </h1>
                <div class="mt-2">
                    <span class="badge rounded-pill iot-badge px-3 py-2">
                        <i class="fas fa-microchip me-1"></i> ด้วย IoT
                    </span>
                </div>
            </div>
        </div>

        <a href="admin.php" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-primary shadow admin-btn mt-3 mt-lg-0">
            <i class="fas fa-fish me-1"></i> ดูข้อมูลย้อนหลัง
        </a>
        
    </div>
</nav>

<div class="container" style="position: relative; z-index: 5;">
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="block-card bg-coral p-4 h-100 d-flex flex-column justify-content-between">
                <div class="bg-pattern"></div><div class="bg-pattern-2"></div>
                <div class="d-flex justify-content-between align-items-start">
                    <div class="label-text">🌡️ อุณหภูมิ</div>
                    <i class="fas fa-temperature-half icon-large"></i>
                </div>
                <div class="value-text" id="txt-temp">-- <span class="fs-4">°C</span></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="block-card bg-deepsea p-4 h-100 d-flex flex-column justify-content-between">
                <div class="bg-pattern"></div><div class="bg-pattern-2"></div>
                <div class="d-flex justify-content-between align-items-start">
                    <div class="label-text">🧪 กรด-ด่าง (pH)</div>
                    <i class="fas fa-flask-vial icon-large"></i>
                </div>
                <div class="value-text" id="txt-ph">--</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="block-card bg-starfish p-4 h-100 d-flex flex-column justify-content-between">
                <div class="bg-pattern"></div><div class="bg-pattern-2"></div>
                <div class="d-flex justify-content-between align-items-start">
                    <div class="label-text">⚡ ความนำไฟฟ้า</div>
                    <i class="fas fa-bolt icon-large"></i>
                </div>
                <div class="value-text" id="txt-ec">-- <span class="fs-5">mS</span></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="block-card bg-rock p-4 h-100 d-flex flex-column justify-content-between" id="card-relay">
                <div class="bg-pattern"></div><div class="bg-pattern-2"></div>
                <div class="d-flex justify-content-between align-items-start">
                    <div class="label-text">💨 ปั๊มออกซิเจน</div>
                    <i class="fas fa-fan icon-large" id="icon-relay"></i>
                </div>
                <div class="value-text" id="txt-relay" style="font-size: 2.2rem;">ปิดพัก</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="chart-glass">
                <div class="scanner-line"></div> <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold m-0" style="color: #0077b6;">
                        <i class="fas fa-chart-area me-2"></i> กราฟติดตามคุณภาพน้ำหมัก
                    </h4>
                    <span class="badge rounded-pill text-dark px-3 py-2 shadow-sm" style="background: #e0f2fe; border: 1px solid #7dd3fc;">
                        <span class="pulse-dot"></span> SENSOR ACTIVE
                    </span>
                </div>
                <div style="position: relative; height:450px; width:100%">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let myChart;
    Chart.defaults.font.family = 'Prompt';

    let isChartInitialized = false;
    let lastRealData = null;

    // ฟังก์ชันดึงข้อมูลจากฐานข้อมูล
    function fetchData() {
        fetch('api_get.php')
            .then(response => response.json())
            .then(data => {
                if(data.length > 0) {
                    let latest = data[data.length - 1];
                    lastRealData = latest; // เก็บค่าล่าสุดไว้ใช้จำลองเซนเซอร์
                    
                    // อัปเดตตัวเลขในการ์ด
                    document.getElementById('txt-temp').innerHTML = latest.temperature + ' <span class="fs-4">°C</span>';
                    document.getElementById('txt-ph').innerHTML = latest.ph_value;
                    document.getElementById('txt-ec').innerHTML = latest.ec_value + ' <span class="fs-5">mS</span>';
                    
                    // อัปเดตสถานะปั๊มลม
                    let relayCard = document.getElementById('card-relay');
                    let relayIcon = document.getElementById('icon-relay');
                    let relayText = document.getElementById('txt-relay');
                    
                    if(latest.relay_status === 'ON') {
                        relayText.innerHTML = 'ทำงาน <i class="fas fa-check-circle ms-1"></i>';
                        relayCard.className = 'block-card bg-seafoam p-4 h-100 d-flex flex-column justify-content-between';
                        relayIcon.classList.add('spin-icon');
                    } else {
                        relayText.innerHTML = 'ปิดพัก <i class="fas fa-moon ms-1"></i>';
                        relayCard.className = 'block-card bg-rock p-4 h-100 d-flex flex-column justify-content-between';
                        relayIcon.classList.remove('spin-icon');
                    }

                    // ถ้ารันครั้งแรก ให้เอาข้อมูลจากฐานข้อมูลมาวาดกราฟตั้งต้น
                    if(!isChartInitialized) {
                        let labels = data.map(item => {
                            let d = new Date(item.created_at);
                            return String(d.getHours()).padStart(2, '0') + ':' + String(d.getMinutes()).padStart(2, '0') + ':' + String(d.getSeconds()).padStart(2, '0');
                        });
                        let phData = data.map(item => parseFloat(item.ph_value));
                        let tempData = data.map(item => parseFloat(item.temperature));
                        let ecData = data.map(item => parseFloat(item.ec_value));

                        initChart(labels, phData, tempData, ecData);
                        isChartInitialized = true;
                    }
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function initChart(labels, phData, tempData, ecData) {
        const ctx = document.getElementById('mainChart').getContext('2d');
        
        let gradientPH = ctx.createLinearGradient(0, 0, 0, 400);
        gradientPH.addColorStop(0, 'rgba(118, 75, 162, 0.4)');
        gradientPH.addColorStop(1, 'rgba(118, 75, 162, 0.0)');

        let gradientTemp = ctx.createLinearGradient(0, 0, 0, 400);
        gradientTemp.addColorStop(0, 'rgba(255, 117, 140, 0.4)');
        gradientTemp.addColorStop(1, 'rgba(255, 117, 140, 0.0)');

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    { 
                        label: 'ค่า pH', data: phData, borderColor: '#764ba2', backgroundColor: gradientPH, 
                        borderWidth: 3, pointBackgroundColor: '#764ba2', pointBorderColor: '#fff', 
                        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 7, fill: true, tension: 0.4, yAxisID: 'y'
                    },
                    { 
                        label: 'อุณหภูมิ (°C)', data: tempData, borderColor: '#ff758c', backgroundColor: gradientTemp, 
                        borderWidth: 3, pointBackgroundColor: '#ff758c', pointBorderColor: '#fff', 
                        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 7, fill: true, tension: 0.4, yAxisID: 'y1'
                    },
                    { 
                        label: 'ความนำไฟฟ้า (mS)', data: ecData, borderColor: '#f6d365', borderWidth: 4, borderDash: [6, 4], 
                        pointBackgroundColor: '#f6d365', pointBorderColor: '#fff', pointBorderWidth: 2, 
                        pointRadius: 4, pointHoverRadius: 7, fill: false, tension: 0.4, yAxisID: 'y1'
                    }
                ]
            },
            options: { 
                responsive: true, maintainAspectRatio: false,
                animation: {
                    duration: 800,
                    easing: 'linear' // ทำให้กราฟไหลไปทางซ้ายแบบสมูท
                },
                interaction: { mode: 'index', intersect: false },
                plugins: { 
                    legend: { position: 'top', labels: { usePointStyle: true, padding: 20, font: { size: 15, weight: 'bold' }, color: '#0077b6' } },
                    tooltip: { backgroundColor: 'rgba(0, 119, 182, 0.9)', titleColor: '#fff', bodyColor: '#e0f2fe', borderColor: '#90e0ef', borderWidth: 2, padding: 15, cornerRadius: 15, titleFont: { size: 14, weight: 'bold' } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#0077b6', font: { weight: 'bold' } } },
                    y: { type: 'linear', display: true, position: 'left', grid: { color: 'rgba(0, 119, 182, 0.1)' }, title: { display: true, text: 'ค่า pH', color: '#764ba2', font: { weight: 'bold', size: 14 } }, ticks: { color: '#0077b6', font: { weight: 'bold' } } },
                    y1: { type: 'linear', display: true, position: 'right', grid: { drawOnChartArea: false }, title: { display: true, text: 'อุณหภูมิ (°C) / ความนำไฟฟ้า (mS)', color: '#ff758c', font: { weight: 'bold', size: 14 } }, ticks: { color: '#0077b6', font: { weight: 'bold' } } }
                }
            }
        });
    }

    // --- ระบบจำลองการไหลของกราฟแบบ Real-time ---
    setInterval(() => {
        if(isChartInitialized && lastRealData && myChart) {
            let now = new Date();
            let timeStr = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0') + ':' + String(now.getSeconds()).padStart(2, '0');

            // จำลองให้ค่ามีการแกว่งนิดๆ (+/-) เหมือนเซนเซอร์กำลังทำงานจริง
            let simPh = parseFloat(lastRealData.ph_value) + (Math.random() * 0.04 - 0.02);
            let simTemp = parseFloat(lastRealData.temperature) + (Math.random() * 0.1 - 0.05);
            let simEc = parseFloat(lastRealData.ec_value) + (Math.random() * 0.02 - 0.01);

            // ดันข้อมูลใหม่เข้าไปในอาร์เรย์
            myChart.data.labels.push(timeStr);
            myChart.data.datasets[0].data.push(simPh.toFixed(2));
            myChart.data.datasets[1].data.push(simTemp.toFixed(2));
            myChart.data.datasets[2].data.push(simEc.toFixed(2));

            // ถ้ามีจุดบนกราฟเกิน 25 จุด ให้ลบจุดเก่าสุดออก (ทำให้กราฟเลื่อนไปทางซ้าย)
            if(myChart.data.labels.length > 25) {
                myChart.data.labels.shift();
                myChart.data.datasets[0].data.shift();
                myChart.data.datasets[1].data.shift();
                myChart.data.datasets[2].data.shift();
            }

            myChart.update(); // สั่งให้ Chart.js ขยับ
        }
    }, 2000); // ขยับทุกๆ 2 วินาที

    // ดึงข้อมูลจริงจากฐานข้อมูลทุก 10 วินาที เพื่ออัปเดตค่าตั้งต้นให้แม่นยำ
    fetchData();
    setInterval(fetchData, 10000);
</script>
</body>
</html>