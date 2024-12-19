// Konfigurasi Chart
const options = {
    chart: {
      height: 350,
      type: "line",
      fontFamily: "Inter, sans-serif",
      toolbar: { show: false },
    },
    tooltip: {
      enabled: true,
      x: { show: true },
    },
    dataLabels: { enabled: false },
    stroke: { width: 4, curve: "smooth" },
    grid: {
      show: true,
      strokeDashArray: 4,
      borderColor: "#E5E7EB", // Warna grid lebih lembut
      padding: { left: 10, right: 10, top: 10, bottom: 10 },
    },
    series: [],
    xaxis: {
      categories: [],
      labels: {
        style: {
          fontSize: "12px",
          fontFamily: "Inter, sans-serif",
          colors: "#6B7280", // Warna label lebih lembut
        },
      },
      axisBorder: { show: true, color: "#E5E7EB" },
      axisTicks: { show: true, color: "#E5E7EB" },
    },
    yaxis: {
      labels: {
        style: {
          fontSize: "12px",
          fontFamily: "Inter, sans-serif",
          colors: "#6B7280",
        },
      },
      gridLines: { show: true },
    },
    colors: ["#1A56DB", "#7E3AF2"], // Warna garis
    responsive: [
      {
        breakpoint: 768,
        options: {
          chart: {
            height: 300,
          },
          xaxis: {
            labels: { style: { fontSize: "10px" } },
          },
          yaxis: {
            labels: { style: { fontSize: "10px" } },
          },
        },
      },
    ],
  };

  // Ambil data dari API dan render grafik
  Promise.all([
    fetch("/penduduk/gender/").then((response) => response.json()),
    fetch("/api/provinces").then((response) => response.json()),
  ])
    .then(([pendudukData, provinsiData]) => {
      // Membuat mapping kode provinsi ke nama provinsi
      const provinsiMap = {};
      provinsiData.data.forEach((prov) => {
        provinsiMap[prov.code] = prov.name;
      });

      // Validasi dan menyinkronkan data dari pendudukData dengan provinsiMap
      const categories = [];
      const dataLaki = [];
      const dataPerempuan = [];

      pendudukData.data_laki.forEach((item, index) => {
        const provinsiName = provinsiMap[item.provinsi];
        if (provinsiName) {
          categories.push(provinsiName);
          dataLaki.push(item.penduduk_laki || 0); // Default 0 jika data kosong
          dataPerempuan.push(
            pendudukData.data_perempuan[index]?.penduduk_perempuan || 0
          );
        }
      });

      // Update data pada chart configuration
      options.xaxis.categories = categories;
      options.series = [
        {
          name: "Laki-laki",
          data: dataLaki,
        },
        {
          name: "Perempuan",
          data: dataPerempuan,
        },
      ];

      // Render chart jika elemen chart ada
      if (document.getElementById("line-chart") && typeof ApexCharts !== "undefined") {
        const chart = new ApexCharts(document.getElementById("line-chart"), options);
        chart.render();
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });
