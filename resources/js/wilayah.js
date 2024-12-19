





document.addEventListener("DOMContentLoaded", () => {
  const provinsiSelect = document.getElementById("provinsi");
  const kabupatenSelect = document.getElementById("kabupaten");
  const kecamatanSelect = document.getElementById("kecamatan");
  const kelurahanSelect = document.getElementById("kelurahan");

  // Fetch Provinsi data
  fetch("/api/provinces")
    .then((response) => response.json())
    .then((data) => {
      const provinces = data.data;
      provinces.forEach((provinsi) => {
        const option = document.createElement("option");
        option.value = provinsi.code;
        option.textContent = provinsi.name;

        provinsiSelect.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error fetching provinces:", error);
    });
                  
  // Fetch Kabupaten based on selected Provinsi
  provinsiSelect.addEventListener("change", () => {
    const provinsiId = provinsiSelect.value;
    kabupatenSelect.innerHTML = "<option selected>Pilih Kabupaten</option>";
    kecamatanSelect.innerHTML = "<option selected>Pilih Kecamatan</option>";
    kelurahanSelect.innerHTML = "<option selected>Pilih Kelurahan</option>";
    kabupatenSelect.disabled = true;
    kecamatanSelect.disabled = true;
    kelurahanSelect.disabled = true;

    if (provinsiId) {
      fetch(`/api/regencies/${provinsiId}`)
        .then((response) => response.json())
        .then((data) => {
          const regencies = data.data;
          regencies.forEach((kabupaten) => {
            const option = document.createElement("option");
            option.value = kabupaten.code;
            option.textContent = kabupaten.name;
            kabupatenSelect.appendChild(option);
          });
          kabupatenSelect.disabled = false;
        })
        .catch((error) => {
          console.error("Error fetching kabupaten data:", error);
        });
    }
  });

  // Fetch Kecamatan based on selected Kabupaten
  kabupatenSelect.addEventListener("change", () => {
    const kabupatenId = kabupatenSelect.value;
    kecamatanSelect.innerHTML = "<option selected>Pilih Kecamatan</option>";
    kelurahanSelect.innerHTML = "<option selected>Pilih Kelurahan</option>";
    kecamatanSelect.disabled = true;
    kelurahanSelect.disabled = true;

    if (kabupatenId) {
      fetch(`/api/districts/${kabupatenId}`)
        .then((response) => response.json())
        .then((data) => {
          const districts = data.data;
          districts.forEach((kecamatan) => {
            const option = document.createElement("option");
            option.value = kecamatan.code;
            option.textContent = kecamatan.name;
            kecamatanSelect.appendChild(option);
          });
          kecamatanSelect.disabled = false;
        })
        .catch((error) => {
          console.error("Error fetching kecamatan data:", error);
        });
    }
  });

  // Fetch Kelurahan based on selected Kecamatan
  kecamatanSelect.addEventListener("change", () => {
    const kecamatanId = kecamatanSelect.value;
    kelurahanSelect.innerHTML = "<option selected>Pilih Kelurahan</option>";
    kelurahanSelect.disabled = true;

    if (kecamatanId) {
      fetch(`/api/villages/${kecamatanId}`)
        .then((response) => response.json())
        .then((data) => {
          const villages = data.data;
          villages.forEach((kelurahan) => {
            const option = document.createElement("option");
            option.value = kelurahan.code;
            option.textContent = kelurahan.name;
            kelurahanSelect.appendChild(option);
          });
          kelurahanSelect.disabled = false;
        })
        .catch((error) => {
          console.error("Error fetching kelurahan data:", error);
        });
    }
  });
});
