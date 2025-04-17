document.addEventListener('DOMContentLoaded', function () {
    // بيانات المشاتل
    const nurseriesData = {
        kerbala: {
            Tree1: [
                { name: "مشتل كربلاء الأول", location: "كربلاء", image: "photos/photo1.jpg" },
                { name: "مشتل كربلاء الثاني", location: "كربلاء", image: "photos/photo44.jpg" },
                { name: "مشتل كربلاء الثالث", location: "كربلاء", image: "photos/photo43.jpg" },
                { name: "مشتل كربلاء الرابع", location: "كربلاء", image: "photos/photo24.jpg" }
            ],
            Tree2: [
                { name: "مشتل كربلاء للأشجار", location: "كربلاء", image: "photos/photo21.jpg" }
            ]
        },
        hilla: {
            Tree3: [
                { name: "مشتل الحلة", location: "الحلة", image: "photos/photo29.jpg" }
            ]
        }
    };

    const citySelect = document.getElementById('city-select');
    const treeSelect = document.getElementById('tree-select');
    const showNurseriesButton = document.querySelector('.show-nurseries-button');
    const nurseryList = document.getElementById('nursery-list');

    function showNurseries() {
        const selectedCity = citySelect.value;
        const selectedTree = treeSelect.value;

        nurseryList.innerHTML = '';

        if (!selectedCity || !selectedTree) {
            alert('الرجاء اختيار المدينة ونوع الشجرة');
            nurseryList.style.display = 'none';
            return;
        }

        const cityNurseries = nurseriesData[selectedCity];
        if (!cityNurseries || !cityNurseries[selectedTree]) {
            alert('لا توجد مشاتل متاحة للمدينة والشجرة المختارة');
            nurseryList.style.display = 'none';
            return;
        }

        nurseryList.style.opacity = '0';
        const matchingNurseries = cityNurseries[selectedTree];

        matchingNurseries.forEach((nursery, index) => {
            const nurseryBox = document.createElement('div');
            nurseryBox.classList.add('nursery-box');
            nurseryBox.style.opacity = '0';
            nurseryBox.style.transform = 'translateY(20px)';

            nurseryBox.innerHTML = `
                <div class="nursery-image-container">
                    <img src="${nursery.image}" alt="${nursery.name}" class="nursery-image">
                </div>
                <div class="nursery-info">
                    <h3>${nursery.name}</h3>
                    <p>الموقع: ${nursery.location}</p>
                    <button class="donate-button" data-city="${selectedCity}" data-tree="${selectedTree}">تبرع</button>
                </div>
            `;

            nurseryList.appendChild(nurseryBox);

            setTimeout(() => {
                nurseryBox.style.transition = 'all 0.5s ease-out';
                nurseryBox.style.opacity = '1';
                nurseryBox.style.transform = 'translateY(0)';
            }, index * 200);
        });

        setTimeout(() => {
            nurseryList.style.display = 'flex';
            nurseryList.style.transition = 'opacity 0.5s ease-in-out';
            nurseryList.style.opacity = '1';

            const nurseryListTop = nurseryList.getBoundingClientRect().top + window.scrollY;
            const marginTop = 100;
            window.scrollTo({
                top: nurseryListTop - marginTop,
                behavior: 'smooth'
            });
        }, 100);
    }

    // زر البحث
    showNurseriesButton.addEventListener('click', showNurseries);

    // التعامل مع زر التبرع عند النقر عليه
    nurseryList.addEventListener('click', function (e) {
        if (e.target.classList.contains('donate-button')) {
            const city = e.target.dataset.city;
            const tree = e.target.dataset.tree;

            fetch('donate.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `city=${encodeURIComponent(city)}&tree_type=${encodeURIComponent(tree)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    e.target.textContent = "تم التبرع";
                    e.target.disabled = true;
                    e.target.style.backgroundColor = "#28a745";
                } else {
                    alert(data.message || "فشل في التبرع.");
                }
            })
            .catch(error => {
                console.error("خطأ:", error);
                alert("حدث خطأ أثناء التبرع.");
            });
        }
    });
});
